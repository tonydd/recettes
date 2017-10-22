<?php
/**
 * @var Renderer $this
 */

/** @var LoginController $loginCtl */
$loginCtl = Controller::getInstance('login');
?>

<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo $this->homepage();?>">Ma recette</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class="active">
                    <a href="<?php echo $this->buildUrl('recette', 'index');?>">
                        Recettes
                    </a>
                </li>
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Action</a></li>
                        <li><a href="#">Another action</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Nav header</li>
                        <li><a href="#">Separated link</a></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <?php if ($loginCtl->isLogged()) : ?>
                <?php $this->_include('menu_user_logged');?>
            <?php else: ?>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href="<?php echo $this->buildUrl('login', 'loginForm')?>">Se connecter</a></li>
                </ul>
            <?php endif;?>
        </div><!--/.nav-collapse -->
    </div>
</nav>