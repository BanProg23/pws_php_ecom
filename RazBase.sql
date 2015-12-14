DROP TABLE IF EXISTS DetailCommande;
DROP TABLE IF EXISTS Proposer;
DROP TABLE IF EXISTS Produit;
DROP TABLE IF EXISTS Categorie;
DROP TABLE IF EXISTS Commande;
DROP TABLE IF EXISTS Client;

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
	prixHTprod NUMERIC(7,2),
	prixHTpromoPro NUMERIC(7,2),
	tauxTVAprod NUMERIC(3,1),
	PRIMARY KEY(idProd),
	FOREIGN KEY(idCat) REFERENCES Categorie (idCat)
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
	PRIMARY KEY(idClient)
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
	totalCom NUMERIC(9,2),
	PRIMARY KEY(idCom),
	FOREIGN KEY(idClient) REFERENCES Client (idClient)
) Engine=InnoDB ;

CREATE TABLE Proposer
(
	idProd1 VARCHAR(5),
	idProd2 VARCHAR(5),
	nbFois MEDIUMINT(4) CHECK (nbFois > 0),
	PRIMARY KEY (idProd1, idProd2),
	FOREIGN KEY (idProd1) REFERENCES Produit(idProd),
	FOREIGN KEY (idProd2) REFERENCES Produit(idProd)
) Engine=InnoDB ;

CREATE TABLE DetailCommande
(
	idProd VARCHAR(5),
	idCom INT(5),
	qteCdee MEDIUMINT(4),
	prixLigneCom NUMERIC(8,2),
	PRIMARY KEY (idProd, idCom),
	FOREIGN KEY (idProd) REFERENCES Produit(idProd),
	FOREIGN KEY (idCom) REFERENCES Commande(idCom)
) Engine=InnoDB ;

 
INSERT INTO Categorie VALUES ('100', 'Televiseur'); 
INSERT INTO Categorie VALUES ('200', 'Camescope'); 
INSERT INTO Categorie VALUES ('300', 'Ordinateur'); 
 
 
INSERT INTO Produit VALUES ('115', '100', 'TV thomson 214i', 'television full hd', 'prod115.gif',  1, 0, 1, 4, 1, '7 jours', 1000.00, 1000.00, 20); 
INSERT INTO Produit VALUES ('198', '100', 'TV samsung highcolor', 'television hdi', 'prod198.gif', 0, 1, 0, 5, 1, '9 jours', 1200.00, 1000.00, 20); 
INSERT INTO Produit VALUES ('231', '200', 'camescope highTrack', 'camescope pour sports', 'prod231.gif', 0, 1, 1, 2, 0, '3 jours', 500.00, 400.00, 10); 
INSERT INTO Produit VALUES ('302', '300', 'PC HP 5980', 'PC multimedia', 'prod302.gif',  1, 1, 0, 6, 1, '15 jours', 1800.00, 1500.00, 20); 
INSERT INTO Produit VALUES ('357', '300', 'PC Server', 'Serveur Professionnel', 'prod357.gif',  0, 0, 0, 7, 0, '12 jours', 2450.00, 2450.00, 20); 
 
 
INSERT INTO Client VALUES (NULL, 'martin', 'jacques', '3 rue des fleurs', '31200', 'Toulouse', 'Sud-Ouest', '0561255487', 'mart@free.fr'); 
INSERT INTO Client VALUES (NULL, 'dupont', 'henri', '14 impasse parla', '31700', 'Beauzelle', 'Sud-Ouest', '0521548736',  'dup@aol.fr'); 
INSERT INTO Client VALUES (NULL, 'lomu', 'albert', '5 rue pin', '75002', 'Paris', 'Ile de France', '0125369821',  'lom@ist.fr'); 
 
 
INSERT INTO Commande VALUES (NULL, '2015-12-12', 1, NULL        , 0, 'ch', '1265487', 2400.00); 
INSERT INTO Commande VALUES (NULL, '2015-11-10', 2, '2015-11-19', 1, 'cb', '54874', 48340.00); 
INSERT INTO Commande VALUES (NULL, '2015-08-09', 2, '2015-08-23', 1, 'ch', '1254128', 30280.00); 
INSERT INTO Commande VALUES (NULL, '2015-12-19', 3, NULL        , 0, 'cb', '55654', 9600.00); 
INSERT INTO Commande VALUES (NULL, '2015-12-21', 1, NULL        , 0, 'cb', '98547', 21600.00); 
 
 
INSERT INTO DetailCommande VALUES ('115', 1, 2, 2400.00); 
INSERT INTO DetailCommande VALUES ('198', 2, 15, 18000.00);
INSERT INTO DetailCommande VALUES ('115', 2, 3, 3600.00); 
INSERT INTO DetailCommande VALUES ('231', 2, 11, 4840.00);  
INSERT INTO DetailCommande VALUES ('302', 2, 4, 7200.00); 
INSERT INTO DetailCommande VALUES ('357', 2, 5, 14700.00);
INSERT INTO DetailCommande VALUES ('231', 3, 2, 880.00); 
INSERT INTO DetailCommande VALUES ('357', 3, 10, 29400.00); 
INSERT INTO DetailCommande VALUES ('115', 4, 7, 8400.00); 
INSERT INTO DetailCommande VALUES ('198', 4, 1, 1200.00); 
INSERT INTO DetailCommande VALUES ('302', 5, 12, 21600.00); 

INSERT INTO Proposer
SELECT p1.idProd, p2.idProd, COUNT(*)
FROM Produit p1, Produit p2, DetailCommande dc1, DetailCommande dc2
WHERE p1.idProd = dc1.idProd
AND p2.idProd = dc2.idProd
AND dc1.idCom = dc2.idCom
AND p1.idProd <> p2.idProd
GROUP BY p1.idProd;
