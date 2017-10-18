<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 14/10/17
 * Time: 16:18
 */

class RecetteIngredient extends Model
{
    protected $id_recette;
    protected $id_ingredient;
    protected $id_unite;
    protected $unite_qty;

    /* Define here table relations */
    protected static $_relations = array(
        'id_recette'  => array(
            'class' => 'Recette',
            'type'  => Model::RELATION_ONE
        ),
        'id_ingredient'    => array(
            'class' => 'Ingredient',
            'type'  => Model::RELATION_ONE,
        ),
        'id_unite' => array(
            'class'     => 'Unite',
            'type'      => Model::RELATION_ONE,
        )
    );
}