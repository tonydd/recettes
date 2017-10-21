<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 09/10/17
 * Time: 19:01
 */

class AdminController extends Controller
{
    public function indexAction()
    {
        $this->getRenderer()
            ->setTitle("Admin")
            ->setTemplate('test')
            ->render();
    }

    public function anotherAction()
    {
        $this->redirect('Admin', 'index', array('a' => 'b'));
    }
}