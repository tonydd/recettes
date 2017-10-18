<?php
/**
 * @var Renderer $this
 */

/** @var Categorie[] $categories */
$categories = $data['categories'] ?? array();
?>

<h1>Gestion des catégories</h1>


<?php foreach ($categories as $category) { ?>

    <div class="category-display">
        <h4><?php echo $category->getNom();?></h4>
        <a href=""><button type="button" class="btn btn-primary">Editer</button></a>
        <button type="button" class="btn btn-danger">Supprimer</button>
    </div>

<?php } ?>

<a href="#">
    <button type="button" class="btn btn-success">Créer une catégorie</button>
</a>
