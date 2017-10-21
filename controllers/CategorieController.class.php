<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 09/10/17
 * Time: 22:27
 */

class CategorieController extends Controller
{
    public function indexAction()
    {
        $categories = Categorie::loadAll();

        $this->getRenderer()
            ->setTitle('Catégories')
            ->assign('categories', $categories)
            ->setTemplate('categories_index')
            ->render();
    }

    public function formAction()
    {
        $params = $this->getParameters();

        if (isset($params['cat_id'])) {
            $cat = Categorie::load($params['cat_id']);

            if (!$cat || $cat === null) {
                $cat = new Categorie();
            }

        } else {
            $cat = new Categorie();
        }


        $this->getRenderer()
            ->setTitle("Créer/Modifier une catégorie")
            ->setTemplate("form_categorie")
            ->assign('categorie', $cat)
            ->render();
    }

    public function deleteAction()
    {
        $parameters = $this->getParameters();
        $renderer = $this->getRenderer();

        if (isset($parameters['cat_id'])) {

            $catId = (int)$parameters['cat_id'];
            $categorie = Categorie::load($catId);

            if ($categorie !== null) {

                if ($categorie->delete()) {
                    $renderer->addMessage("La catégorie a été supprimée.", Renderer::INFO_MESSAGE);
                }
                else {
                    $renderer->addMessage("Impossible de supprimer la catégorie $catId", Renderer::ERR_MESSAGE);
                }
            }
            else {
                $renderer->addMessage("Catégorie $catId introuvable ...", Renderer::ERR_MESSAGE);
            }

        } else {
            $renderer->addMessage("Paramètre [Catégorie ID] manquant", Renderer::ERR_MESSAGE);
        }

        $this->redirect('categorie','index');
    }
    public function saveAction()
    {
        $categorie = new Categorie();

        $categorie
            ->setData($this->getParameters())
            ->save();

        $this->getRenderer()
            ->addMessage("Catégorie créée avec succes !", Renderer::SUCCESS_MESSAGE);

        $this->redirect('categorie', 'index');
    }

    public function testAction()
    {
        $p = $this->getParameters();
        $t = $p['aa'];
        die(var_export($t,true));
    }

}