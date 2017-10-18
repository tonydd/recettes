function Recette() {

    this.init();

};

Recette.liIngredient = '<li class="line-ingredient">' +
    '<div class="form-group">'+
    '<input type="text" class="ingredient" />' +
    '<input type="number" class="qte" />' +
    '<select class="unite"></select>' +
    '</div>' +
    '</li>';

Recette.prototype.init = function () {
    var $addIngredient = $('#add-ingredient');
    $addIngredient.click(Recette.addIngredientLine);

};

Recette.addIngredientLine = function () {
     var $ingredientsList = $('#rct_list_ingredients'),
         $li = Recette.buildIngredientLine();

     $ingredientsList.append($li);
     $li.slideDown();
};

Recette.buildIngredientLine = function () {
    var html = '<li class="line-ingredient display-none">' +
        '<div class="form-group">'+
        '<input type="text" class="ingredient" placeholder="Commencez à taper" />' +
        '<input type="hidden" class="ingredient-id" /> ' +
        '<input type="number" class="qte" />';

    // -- Gestion unites
    html += '<select class="unites">';
    var unites = Ez.getData('unites');
    for (var key in unites) {
        var nom = unites[key];
        html += '<option value="' + key + '">' + nom + '</option>';
    }
    html += '</select>';

    html += '<button type="button" class="btn btn-danger remove">-</button>';
    html += '</div>' +
        '</li>';

    var $li = $(html);

    // -- gestion des ingrédients
    var autocompleteUrl = Ez.buildUrl('ingredient', 'autocomplete');

    var $ingredient = $li.find('.ingredient');
    var $ingredientId = $li.find('.ingredient-id');

    $ingredient.autocomplete({
        source: autocompleteUrl,
        minLength: 1,
        select: function( event, ui ) {
            $ingredientId.val(ui.item.id);
        }
    });

    // -- Suppression ligne
    $li.find('.remove').click(function () {
        var $theLi = $(this).parents('.line-ingredient');
        $theLi.slideUp(function () {
            $(this).remove();
        });
    });

    return $li;
};

var recette;
$(function () {
    recette = new Recette();
});