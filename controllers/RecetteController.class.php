<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 09/10/17
 * Time: 21:54
 */

class RecetteController extends Controller
{
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
            ->setTemplate("form_recette")
            ->assign('recette', $recette)
            ->assignJs('unites', $unitesJson)
            ->render();
    }

    public function saveAction()
    {
        $recette = new Recette();

        $recette
            ->setData($this->getParameters())
            ->save();

        $this->getRenderer()
            ->addMessage("Recette créée avec succes !", Renderer::SUCCESS_MESSAGE);

        $this->redirect('recette', 'form');
    }
}