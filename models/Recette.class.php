<?php
/**
 * Created by PhpStorm.
 * User: tony
 * Date: 08/10/17
 * Time: 19:34
 */

class Recette extends Model
{
    protected $id;
    protected $categorie_id;
    protected $nom;
    protected $nb_personnes;
    protected $temps_preparation;
    protected $temps_cuisson;
    protected $vegetarien;
    protected $abordable;
    protected $etapes;
    protected $recette_ingredient;

    /* Define here table relations */
    protected static $_relations = array(
        'categorie_id'  => array(
            'class' => 'Categorie',
            'type'  => Model::RELATION_ONE
        ),
        'etapes'    => array(
            'class' => 'RecetteEtape',
            'type'  => Model::RELATION_MANY,
            'col'   => 'id_recette'
        ),
        'recette_ingredient' => array(
            'class'     => 'RecetteIngredient',
            'type'      => Model::RELATION_MANY,
            'col'       => 'id_recette',
        )
    );

    public function getIngredients()
    {
        if (!in_array('ingredients', $this->_relationsLoaded)) {
            $sql = "SELECT i.*
                    FROM ingredient i
                    LEFT JOIN recette_ingredient ri ON i.id = ri.id_ingredient
                    WHERE ri.id_recette = " . PDOHelper::pdoQuote($this->getId());

            $this->ingredients = PDOHelper::getInstance()->findInstances('Ingredient', $sql);
        }

        return $this->ingredients;
    }

    public function generateForm()
    {
        $renderer = Controller::getCurrentController()->getRenderer();


        $html = '<form method="post" action="' . $renderer->buildUrl('recette', 'save') . '">';
        $html .= '<fieldset>';
        $html .= '<legend>Recette</legend>';
        $html .= '<div class="row">';
        $html .= '<div class="form-container">';


        // -- Manually handle fields
        // Id
        if (($id = $this->getId()) !== null) {
            $html .= '<input type="hidden" name="id" id="id" value="' . $id . '" />';
        }

        // Category : A gérer en select
        $categories = Categorie::loadAll();
        $currentCat = $this->getCategorieId();
        $currentCatId = $currentCat !== null ? $currentCat->getId() : 0;
        $html .= '<div class="form-group">';
        $html .= '<div class="col-lg-6">';
        $html .= '<label for="nom">Catégorie : </label>';
        $html .= '<select id="categorie_id" name="categorie_id" class="form-control">';
        foreach ($categories as $category) {
            $html .= '<option value="' . $category->getId() . '"';
            if ($currentCatId === $category->getId()) {
                $html .= ' selected ';
            }
            $html .= ' >' . $category->getNom() . '</option>';
        }
        $html .= '</select>';
        $html .= '</div>';
        $html .= '</div>';

        // Nom
        $html .= '<div class="form-group">';
        $html .= '<div class="col-lg-6">';
        $html .= '<label for="nom">Nom : </label>';
        $html .= '<input type="text" class="form-control" id="nom" name="nom" value="'.$this->getNom().'" />';
        $html .= '</div>';
        $html .= '</div>';

        // nb_personnes
        $html .= '<div class="form-group">';
        $html .= '<div class="col-lg-6">';
        $html .= '<label for="nb_personnes">Nombre de personnes : </label>';
        $html .= '<input type="number" class="form-control" step="1" min="1" max="64" id="nb_personnes" name="nb_personnes" value="'.$this->getNbPersonnes().'" />';
        $html .= '</div>';
        $html .= '</div>';

        // Temps préparation
        $html .= '<div class="form-group">';
        $html .= '<div class="col-lg-6">';
        $html .= '<label for="temps_preparation">Temps de préparation (en minutes) : </label>';
        $html .= '<input type="number" class="form-control" step="5" min="0" max="1000" id="temps_preparation" name="temps_preparation" value="'.$this->getTempsPreparation().'" />';
        $html .= '</div>';
        $html .= '</div>';

        // Temps cuisson
        $html .= '<div class="form-group">';
        $html .= '<div class="col-lg-6">';
        $html .= '<label for="temps_cuisson">Temps de cuisson (en minutes) : </label>';
        $html .= '<input type="number" class="form-control" step="5" min="0" max="1000" id="temps_cuisson" name="temps_cuisson" value="'.$this->getTempsCuisson().'" />';
        $html .= '</div>';
        $html .= '</div>';

        // Vegetarien
        $html .= '<div class="form-check">';
        $html .= '<div class="col-lg-6">';
        $html .= '<label for="vegetarien" class="form-check-label">';
        $html .= '<input type="checkbox" class="form-check-input" id="vegetarien" name="vegetarien" value="1" /> Végétarien';
        $html .= '</label>';
        $html .= '</div>';
        $html .= '</div>';

        // Abordable (faire des étoiles)
        $html .= '<div class="form-check">';
        $html .= '<div class="col-lg-6">';
        $html .= '<label for="abordable" class="form-check-label">Abordable</label>';
        $html .= '<input type="number" class="form-control" step="1" min="1" max="5"
                    id="abordable" name="abordable" value="'.$this->getAbordable().'" />';
        $html .= '</div>';
        $html .= '</div>';

        // TODO gestion des étapes

        // TODO gestion des ingrédients


        $html .= '<button type="submit" class="btn btn-primary">Valider</button>';

        $html .= '</div>'; // End div.form-container
        $html .= '</div>'; // End div.row
        $html .= '</fieldset>';
        $html .= '</form>';

        return $html;
    }
}