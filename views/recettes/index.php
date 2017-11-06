<?php
/**
 * @var Renderer $this
 */

/** @var Recette[] $recettes */
$recettes = $data['recettes'];

/** @var Paginator $paginator */
$paginator = $data['paginator'];

$url = $this->buildUrl('recette','index', [
    'filters' => [
        [
            'field' => 'nom',
            'value' => 'TEST'
        ],
        [
            'field' => 'vegetarien',
            'value' => 1
        ]
    ]
]);

?>

<h1>Les recettes</h1>

<fieldset>
    <legend>Filtres</legend>

    <a href="<?php echo $url;?>">Filtre nom</a>
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

    <?php echo $paginator->getControls();?>
    <hr/>
    <?php echo $paginator->getInfos();?>
</fieldset>
