var recette = {
    /* VARIABLES */
    indexEtape: 1,

    /* HTML COMPONENTS */
    liIngredient: '<li class="line-ingredient display-none">' +
    '<div class="form-group row">'+
    '<div class="col-lg-5"><input type="text" class="ingredient form-control" placeholder="Commencez à taper" /></div>' +
    '<input type="hidden" class="ingredient-id" /> ' +
    '<div class="col-lg-3"><input type="number" class="qte form-control" /></div>' +
    '<div class="col-lg-3"><select class="unites form-control"></select></div>' +
    '<div class="col-lg-1"><button type="button" class="btn btn-danger remove">-</button></div>'+
    '</div>' +
    '</li>',

    liEtape: '<li class="line-etape display-none">' +
    '<div class="form-group row">'+
    '<div class="col-lg-1"><input type="number" class="etape_ordre form-control" disabled /></div>' +
    '<div class="col-lg-10"><textarea class="rct-etape form-control"></textarea></div>' +
    '<input type="hidden" class="recette-id" />'+
    '<div class="col-lg-1"><button type="button" class="btn btn-danger remove">-</button></div>'+
    '</div>' +
    '</li>',

    /* METHODES */
    /**
     * Init controller on DomReady
     */
    init: function () {
        $(function () {
            var $addIngredient = $('#add-ingredient');
            $addIngredient.click(recette.addIngredientLine);

            var $addEtape = $('#add-etape');
            $addEtape.click(recette.addEtapeLine);

            $('#form-recette-body').submit(recette.submit);

            $('.line-etape .remove').click(recette.removeEtapeLine);
            $('.line-ingredient .remove').click(recette.removeIngredientLine);
        });
    },

    /**
     *
     * @returns {jQuery|HTMLElement}
     */
    buildEtapeLine: function () {
        var html = recette.liEtape;
        var $li = $(html);

        // -- Handle index
        $li.find('.etape_ordre').val(recette.indexEtape);
        recette.indexEtape++;

        // -- Suppression ligne
        $li.find('.remove').click(recette.removeEtapeLine);

        return $li;
    },

    /**
     *
     */
    addEtapeLine: function () {
        var $etapesList = $('#rct_list_etapes'),
            $li = recette.buildEtapeLine();

        $etapesList.append($li);
        $li.slideDown();
    },

    /**
     *
     */
    removeEtapeLine: function () {
        var $theLi = $(this).parents('.line-etape');
        $theLi.slideUp(function () {
            $(this).remove();
        });
    },

    addIngredientLine: function () {
        var $ingredientsList = $('#rct_list_ingredients'),
            $li = recette.buildIngredientLine();

        $ingredientsList.append($li);
        $li.slideDown();
    },

    /**
     *
     * @returns {jQuery|HTMLElement}
     */
    buildIngredientLine: function () {
        var html = recette.liIngredient;

        // -- Gestion unites
        var htmlUnites = '';
        var unites = Ez.getData('unites');
        for (var key in unites) {
            var nom = unites[key];
            htmlUnites += '<option value="' + key + '">' + nom + '</option>';
        }
        var $li = $(html);

        // -- Gestion des unites
        $li.find('select.unites').html(htmlUnites);

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
        $li.find('.remove').click(recette.removeIngredientLine);

        return $li;
    },

    /**
     *
     */
    removeIngredientLine: function () {
        var $theLi = $(this).parents('.line-ingredient');
        $theLi.slideUp(function () {
            $(this).remove();
        });
    },

    /**
     * Control form submit
     * @param event
     * @returns {boolean}
     */
    submit: function (event) {
        event.preventDefault();
        var $form = $(this);

        var recetteBodyData = $form.serializeArray();


        // -- Ingredients
        var ingredients = {'name': 'ingredients', 'values': []};
        $('#rct_list_ingredients').find('li').each(function () {
            var $li = $(this);

            var ingredientData = {
                name:       $li.find('.ingredient').val(),
                qty:        $li.find('.qte').val(),
                id:         $li.find('.ingredient-id').val(),
                unite:      $li.find('.unites').val()
            };

            ingredients.values.push(ingredientData);
        });
        recetteBodyData.push(ingredients);

        // -- Etapes
        var etapes = {'name': 'etapes', 'values': []};
        $('#rct_list_etapes').find('li').each(function () {
            var $li = $(this);

            var etapeData = {
                order:       $li.find('.etape_ordre').val(),
                text:        $li.find('.rct-etape').val()
            };

            etapes.values.push(etapeData);
        });
        recetteBodyData.push(etapes);

        $.post(
            $form.attr('action'),
            {recetteJSON: JSON.stringify(recetteBodyData)},
            function (data) {
                window.location.reload();
            }
        );

        return false;
    }
};

recette.init();