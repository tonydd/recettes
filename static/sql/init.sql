# Categories
CREATE TABLE categorie (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255),

	PRIMARY KEY (`id`)
);

# Ingredients
CREATE TABLE ingredient (
		id INT(11) NOT NULL AUTO_INCREMENT,
		nom VARCHAR(255),

	PRIMARY KEY (`id`)
);

# Unites
CREATE TABLE unite (
	id INT(11) NOT NULL AUTO_INCREMENT,
	nom VARCHAR(255),
  abbr VARCHAR(3),

	PRIMARY KEY (`id`)
);

# Recettes
CREATE TABLE recette (
	id INT(11) NOT NULL AUTO_INCREMENT,
	categorie_id INT(11),
	nom VARCHAR(255),
	nb_personnes INT(4),
	temps_preparation INT(4),
	temps_cuisson INT(4),
	vegetarien TINYINT(1),
	abordable TINYINT(3),

	PRIMARY KEY(`id`),
	FOREIGN KEY (`categorie_id`) REFERENCES categorie(`id`)
);

# Etapes
CREATE TABLE recette_etape (
	id INT(11) NOT NULL AUTO_INCREMENT,
	id_recette INT(11),
	ordre INT(11),
	explication TEXT,

	PRIMARY KEY (`id`),
	FOREIGN KEY (`id_recette`) REFERENCES recette(`id`)

);

CREATE TABLE recette_ingredient (
	id_recette INT(11),
	id_ingredient INT(11),
	id_unite INT(11),
	unite_qty INT(11),

	PRIMARY KEY (`id_recette`, `id_ingredient`, `id_unite`),
	FOREIGN KEY (`id_recette`) REFERENCES recette(`id`),
	FOREIGN KEY (`id_ingredient`) REFERENCES ingredient(`id`),
	FOREIGN KEY (`id_unite`) REFERENCES unite(`id`)
);

