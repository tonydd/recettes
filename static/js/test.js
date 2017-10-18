console.log('chargé');

var conf = {
    'model'         : 'Ingredient',
    'queryField'    : 'Nom',
    'term'          : '%i%',
    'comp'          : 'LIKE',
    'fields'        : ['id', 'nom']
};

var url = Ez.buildUrl('ajax', 'autocomplete', {autocomplete: conf});

console.log(url);