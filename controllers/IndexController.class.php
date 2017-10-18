<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 09/10/17
 * Time: 21:43
 */

class IndexController extends Controller
{
    public function indexAction()
    {
        $this->getRenderer()
            ->setTitle("Accueil")
            ->setTemplate('index')
            ->assignJs('maData', array('a' => 'b'))
            ->assignJs('maData2', array('c' => 'd'))
            ->render();
    }

    public function testAction()
    {
        $this->redirect(
            'recette',
            'form',
            ['recette_id' => 9]
        );
    }
}