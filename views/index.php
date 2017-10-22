<?php
/**
 * @var Renderer $this
 */
?>

<h1>Mes recettes</h1>

<h2>Ajouter une recette</h2>
<a href="<?php echo $this->buildUrl('recette','form');?>">C'est parti</a>


<hr/><br/>

<a href="<?php echo $this->buildUrl('recette', 'form', ['recette_id' => 9], false);?>">
    la recette numéro 9 !
</a>
