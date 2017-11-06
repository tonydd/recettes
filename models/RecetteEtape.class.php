<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 14/10/17
 * Time: 15:54
 */

class RecetteEtape extends Model
{
    protected $id;
    protected $id_recette;
    protected $ordre;
    protected $explication;

    protected static $_relations = array(
        'id_recette'  => array(
            'class' => 'Recette',
            'type'  => Model::RELATION_ONE
        )
    );
}