<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 09/10/17
 * Time: 21:54
 */

class RecetteController extends Controller
{
    public function indexAction()
    {
        $paginator = Paginator::getPaginator('Recette');
        $paginator->setPagesize(5);

        $filters = $this->getParameter('filters');
        if ($filters !== null) {
            $paginator->setRequest(Recette::getQueryForFilters($filters));
        }

        $recettes = $paginator->fetch();

        $this->getRenderer()
            ->setTitle('Recettes')
            ->setTemplate('recettes/index')
            ->assign('recettes', $recettes)
            ->assign('paginator', $paginator)
            ->render();
    }
    
    public function formAction()
    {
        $params = $this->getParameters();

        if (isset($params['recette_id'])) {
            $recette = Recette::load($params['recette_id']);

            if (!$recette || $recette === null) {
                $recette = new Recette();
            }

        } else {
            $recette = new Recette();
        }

        $unites = Unite::loadAll();
        $unitesJson = [];
        foreach ($unites as $unite) {
            $unitesJson[$unite->getId()] = utf8_encode($unite->getNom());
        }

        $this->getRenderer()
            ->setTitle("Créer/Modifier une recette")
            ->setTemplate("recettes/form")
            ->assign('recette', $recette)
            ->assignJs('unites', $unitesJson)
            ->render();
    }

    public function saveAction()
    {
        $recette = new Recette();


        $this->setheader('Content-Type', 'application/json');

        $recetteRawData = $this->getParameter('recetteJSON');
        $recetteData = json_decode($recetteRawData,true);

        $ingredients = [];
        $etapes = [];

        foreach ($recetteData as $component) {
            if ($component['name'] === 'ingredients') {
                $ingredients = $component['values'];
            }
            else if ($component['name'] === 'etapes') {
                $etapes = $component['values'];
            }
            else {
                $method = "set" . ucfirst(Helper::toCamelCase($component['name']));
                $recette->$method($component['value']);
            }
        }

        $recette->save();

        // -- Now $recette does have an id
        $idRecette = $recette->getId();

        // -- Save ingredients relations
        foreach ($ingredients as $ingredient) {
			$name = $ingredient['name'];
            $qty = $ingredient['qty'];
            $id = $ingredient['id'];
            $unite = $ingredient['unite'];

            if ($id !== null && $id !== '') {
                $modelIngredient = Ingredient::load($id);
            }
            else {
                $modelIngredient = null;
            }

            if ($modelIngredient === null) {
                $modelIngredient = new Ingredient();
                $modelIngredient->setNom($name)
                    ->save();
            }

            $idIngredient = $modelIngredient->getId();

            $unite = Unite::load($unite);
            $idUnite = $unite->getId();

            $recetteIngredient = new RecetteIngredient();
            $recetteIngredient->setIdRecette($idRecette)
                ->setIdIngredient($idIngredient)
                ->setIdUnite($idUnite)
                ->setUniteQty($qty)
                ->save();
        }

        // -- Save etapes relations
        foreach ($etapes as $etape) {
            $order = $etape['order'];
            $text = $etape['text'];

            $recetteEtape = new RecetteEtape();
            $recetteEtape->setOrdre($order)
                ->setExplication($text)
                ->setIdRecette($idRecette)
                ->save();
        }

        //$this->redirect('recette', 'form');

        $this->getRenderer()->addMessage('Recette sauvegardée !', Renderer::SUCCESS_MESSAGE);

        echo json_encode('ok');
    }
}