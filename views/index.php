<?php
/**
 * @var Renderer $this
 */
?>

<h1>Mes recettes</h1>

<h2>Ajouter une recette</h2>
<a href="<?php echo $this->buildUrl('recette','form');?>">C'est parti</a>

<br/>
<h2>Gérer les catégories</h2>
<a href="<?php echo $this->buildUrl('categorie','index');?>">Par ici</a>

<hr/><br/>

<a href="<?php echo $this->buildUrl('recette', 'form', ['recette_id' => 9]);?>">
    la recette numéro 9 !
</a>
