CREATE TABLE Categorie
(
	idCat VARCHAR(3),
	nomCat VARCHAR(30) NOT NULL,
	PRIMARY KEY(idCat)
) Engine=InnoDB ;

CREATE TABLE Produit
(
	idProd VARCHAR(5),
	idCat VARCHAR(3),
	nomProd VARCHAR(20),
	detailProd VARCHAR(25),
	imageProd VARCHAR(20),
	estNouveauProd TINYINT(1),
	estPromoProd TINYINT(1),
	estSelectProd TINYINT(1),
	poidsProd TINYINT(3),
	estDispoProd TINYINT(1),
	delaiProd VARCHAR(20),
	prixHTprod NUMBER(7,2),
	prixHTpromoPro NUMBER(7,2),
	tauxTVAprod NUMBER(3,1),
	PRIMARY KEY(idCat),
	FOREIGN KEY(idCat) REFERENCES CAtegorie (idCat)
) Engine=InnoDB ;

CREATE TABLE Client
(
	idClient INT(5) AUTO_INCREMENT,
	nomClient VARCHAR(20),
	prenomClient VARCHAR(20),
	adresseClient VARCHAR(20),
	codePostalClient VARCHAR(5),
	villeClient VARCHAR(20),
	regionClient VARCHAR(20),
	telClient CHAR(10),
	emailClient VARCHAR(20),
	PRIMARY KEY(idClient),
) Engine=InnoDB ;

CREATE TABLE Commande
(
	idCom INT(5) AUTO_INCREMENT,
	dateCreationCom DATE,
	idClient INT(5) NOT NULL,
	dateEnvoiCom DATE,
	estFinie TINYINT(1),
	idPaiement CHAR(2),
	refPaiement VARCHAR(13),
	totalCom INT(9,2),
	PRIMARY KEY(idCom),
	FOREIGN KEY(idClient) REFERENCES Client (idClient)
) Engine=InnoDB ;