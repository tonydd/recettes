<?php
/**
 * @var Renderer $this
 */

/** @var Recette $recette */
$categorie = $data['categorie'];
?>

<h2>Créer/Modifier une catégorie</h2>

<div id="form_categorie">
    <br/>
    <?php echo $categorie->generateForm();?>

</div>
