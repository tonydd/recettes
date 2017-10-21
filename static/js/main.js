//console.log(Ez.getData('maData'));

console.log(Ez.buildUrl('categorie','test', {
    'aa': {
        'a' : '1',
        'b' : '?=lol',
        'c' : '|=>#'
        }
    },true)
);

console.log('Sisi la mif', Ez.buildUrl('categorie','test', {
    'aa': 'adm@in.fr?=hello'}
    , true)
);