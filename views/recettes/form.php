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

            <i>Si l'ingrédient n'existe pas, il sera crée.</i>

            <ul id="rct_list_ingredients">
                <?php foreach ($recette->getRecetteIngredient() as $detailIngredient) : ?>
                    <li class="line-ingredient">
                        <div class="form-group row">
                            <div class="col-lg-5">
                                <input type="text" class="ingredient form-control" placeholder="Commencez à taper" value="<?php echo $detailIngredient->getIngredient()->getNom();?>" />
                            </div>
                            <input type="hidden" class="ingredient-id" value="<?php echo $detailIngredient->getIngredient()->getId();?>" />
                            <div class="col-lg-3"><input type="number" class="qte form-control"value="<?php echo $detailIngredient->getUniteQty();?>" /></div>
                            <div class="col-lg-3"><select class="unites form-control"></select></div>
                            <div class="col-lg-1"><button type="button" class="btn btn-danger remove">-</button></div>
                        </div>
                    </li>
                <?php endforeach;?>
            </ul>

            <button class="btn btn-success" id="add-ingredient">+</button>
        </fieldset>
    </div>

    <br/>

    <div class="form-etapes form-container">
        <fieldset>
            <legend>Etapes</legend>

            <ul id="rct_list_etapes">
                <?php foreach ($recette->getEtapes() as $etape) : ?>
                    <li class="line-etape">
                        <div class="form-group row">
                            <div class="col-lg-1">
                                <input type="number" class="etape_ordre form-control" disabled value="<?php echo $etape->getOrdre();?>"/>
                            </div>
                            <div class="col-lg-10">
                                <textarea class="rct-etape form-control"><?php echo $etape->getExplication(); ?></textarea>
                            </div>
                            <input type="hidden" class="recette-id" />
                            <div class="col-lg-1"><button type="button" class="btn btn-danger remove">-</button></div>
                        </div> 
                    </li>
                <?php endforeach;?>
            </ul>

            <button class="btn btn-success" id="add-etape">+</button>
        </fieldset>
    </div>

    <div class="controls row">
        <div class="col-lg-4">
            <button class="btn btn-primary" type="submit">Créer la recette</button>
        </div>
    </div>
</div>
