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
}