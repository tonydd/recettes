INSERT INTO categorie (nom)
    VALUES ('Repas'), ('Entree'),('Dessert');

INSERT INTO ingredient (nom)
    VALUES ('Ail'), ('Oignon'), ('Ciboulette');

INSERT INTO unite (nom, abbr)
  VALUES ('Gramme','g'), ('Cuillère à soupe', 'cas');

INSERT INTO recette (categorie_id, nom, nb_personnes, temps_preparation, temps_cuisson, vegetarien, abordable)
  VALUES (1, 'TEST', 3, 10, 10, 0, 1), (2, 'AUTRE TEST', 4, 15, 30, 1, 3);

INSERT INTO recette_ingredient (id_recette, id_ingredient, id_unite, unite_qty)
  VALUES (1,1,2,1), (1,3,1,10) ,(2,2,1,4);

INSERT INTO recette_etape (id_recette, ordre, explication)
  VALUES (1,1,'Chauffer le four'), (1,2,'Mettre à cuire'), (2,1,'Couper les ingrédients'), (2,2,'Mettre à chauffer');