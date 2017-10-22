<?php
/**
 * @var Renderer $this
 */

/** @var Recette $recette */
$recette = $data['recette'];
?>

<h2>Créer/Modifier une recette</h2>

<div id="form_recette">
    <br/>
    <?php echo $recette->generateForm();?>

    <div class="form_ingredients form-container">
        <fieldset>
            <legend>Ingrédients</legend>

            <ul id="rct_list_ingredients">

            </ul>

            <button class="btn btn-success" id="add-ingredient">+</button>
        </fieldset>
    </div>

    <br/>

    <div class="form-etapes form-container">
        <fieldset>
            <legend>Etapes</legend>
        </fieldset>
    </div>
</div>
