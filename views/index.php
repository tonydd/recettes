<?php
/**
 * @var Renderer $this
 */
?>

<h1>Mes recettes</h1>

<h2>Ajouter une recette</h2>
<a href="<?php echo $this->buildUrl('recette','form');?>">C'est parti</a>


<hr/><br/>

<a href="<?php echo $this->buildUrl('recette', 'form', ['recette_id' => 20], false);?>">
    la recette numéro 20 !
</a>
