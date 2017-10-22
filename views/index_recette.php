<?php
/**
 * @var Renderer $this
 */

/** @var Recette[] $recettes */
$recettes = $data['recettes'];
?>

<h1>Les recettes</h1>

<fieldset>
    <legend>Filtres</legend>
</fieldset>

<br/><hr/>

<fieldset>
    <legend>Toutes les recettes</legend>

    <?php foreach ($recettes as $recette) : ?>

        <div class="row">
            <div class="col-lg-12">
                <h4><?php echo $recette->getNom();?></h4>
            </div>
        </div>

    <?php endforeach;?>

    <?php echo $data['paginator']->getControls();?>
</fieldset>
