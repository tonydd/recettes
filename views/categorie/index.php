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

        <a href="<?php echo $this->buildUrl('categorie', 'form', ['cat_id' => $category->getId()]);?>">
            <button type="button" class="btn btn-primary">Editer</button>
        </a>

        <a href="<?php echo $this->buildUrl('categorie', 'delete', ['cat_id' => $category->getId()]);?>">
            <button type="button" class="btn btn-danger">Supprimer</button>
        </a>
    </div>

<?php } ?>

<a href="<?php echo $this->buildUrl('categorie', 'form');?>">
    <button type="button" class="btn btn-success">Créer une catégorie</button>
</a>


<a href="<?php echo $this->buildUrl('categorie', 'test', ['aa' => '&?=wesh'], false);?>">
    TEST de la famille
</a>
