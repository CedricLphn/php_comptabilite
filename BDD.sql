CREATE DATABASE comptabilite CHARACTER SET 'utf8';

USE comptabilite;

CREATE TABLE utilisateur(
	id_utilisateur INT UNSIGNED NOT NULL AUTO_INCREMENT,
	mail VARCHAR (101) NOT NULL UNIQUE,
	mdp VARCHAR (101) NOT NULL,
	PRIMARY KEY (id_utilisateur)
)
ENGINE=INNODB; 


CREATE TABLE categorie(
	id_categorie INT UNSIGNED NOT NULL AUTO_INCREMENT,
	nom_categorie VARCHAR(50) NOT NULL,
	type_transaction ENUM ('debit', 'credit'),
	PRIMARY KEY (id_categorie)
)
ENGINE=INNODB;

CREATE TABLE compte_bancaire(
	id_cb INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_utilisateur INT UNSIGNED NOT NULL,
	nom_compte VARCHAR(50) NOT NULL UNIQUE,
	type_compte ENUM ('courant','epargne','compte_joint') NOT NULL,
	solde FLOAT(100,2) NOT NULL,
	devise ENUM ('USD','EUR') NOT NULL,
	PRIMARY KEY (id_cb),
	FOREIGN KEY (id_utilisateur) REFERENCES utilisateur(id_utilisateur) ON DELETE CASCADE
	)
ENGINE=INNODB;

CREATE TABLE operation(
	id_operation INT UNSIGNED NOT NULL AUTO_INCREMENT,
	id_cb INT UNSIGNED NOT NULL,
	id_categorie INT UNSIGNED NOT NULL,
	nom_operation VARCHAR(50) NOT NULL,
	montant_operation FLOAT(100,2) NOT NULL,
	date_operation DATETIME DEFAULT CURRENT_TIMESTAMP,
	PRIMARY KEY (id_operation),
	FOREIGN KEY (id_cb) REFERENCES compte_bancaire(id_cb) ON DELETE CASCADE,
	FOREIGN KEY (id_categorie) REFERENCES categorie(id_categorie) ON DELETE CASCADE
)
ENGINE=INNODB;
