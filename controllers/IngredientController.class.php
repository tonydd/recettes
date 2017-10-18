<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 16/10/17
 * Time: 19:52
 */

class IngredientController extends Controller
{
    public function autocompleteAction()
    {
        $this->setheader('Content-Type', 'application/json');

        $parameters = $this->getParameters();
        $term = $parameters['term'] ?? null;
        $out = [];

        if ($term !== null) {
            $ingredients = Ingredient::loadByFields([
                [
                    'field'     => 'nom',
                    'value'     => "%$term%",
                    'compare'   => 'LIKE',
                    'case'      => false
                ]
            ]);

            $out = array_map(function ($o) {
                return [
                    'id'    => $o->getId(),
                    'value' => $o->getNom()
                ];
            }, $ingredients);
        }

        echo json_encode($out);
    }
}