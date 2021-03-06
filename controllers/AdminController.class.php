<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 09/10/17
 * Time: 19:01
 */

class AdminController extends Controller
{
    protected function _beforeAction()
    {
        /** @var LoginController $loginCtl */
        $loginCtl = Controller::getInstance('login');

        if (!$loginCtl->isAdmin()) {
            $this->getRenderer()
                ->addMessage("Vous n'avez pas autorisation de voir cette page.", Renderer::WARN_MESSAGE);

            return $this->redirectHome();
        }
    }

    public function indexAction()
    {
        $this->getRenderer()
            ->setTitle("Admin")
            ->setTemplate('index_admin')
            ->render();
    }

    public function anotherAction()
    {
        $conf = new CoreConf();
        $conf->getCoreVal('cdn/js');
    }
}