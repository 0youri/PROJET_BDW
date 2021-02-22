DROP TABLE IF EXISTS HISTORIQUE;
DROP TABLE IF EXISTS POSSEDE;
DROP TABLE IF EXISTS PASSAGE_SECRET;
DROP TABLE IF EXISTS EXISTE;
DROP TABLE IF EXISTS SE_TROUVE;
DROP TABLE IF EXISTS RELIER;
DROP TABLE IF EXISTS CONTRIBUE;
DROP TABLE IF EXISTS GENERER;
DROP TABLE IF EXISTS Zone;
DROP TABLE IF EXISTS Carte;
DROP TABLE IF EXISTS Environnement;
DROP TABLE IF EXISTS Parametre;
DROP TABLE IF EXISTS Mobilier;
DROP TABLE IF EXISTS PNJ;
DROP TABLE IF EXISTS Creature;
DROP TABLE IF EXISTS Piege;
DROP TABLE IF EXISTS Equipement;
DROP TABLE IF EXISTS Element;
DROP TABLE IF EXISTS Etre;
DROP TABLE IF EXISTS Contributrice;


CREATE TABLE Contributrice(
   idContributrice INTEGER NOT NULL AUTO_INCREMENT,
   nom VARCHAR(100),
   prenom VARCHAR(100) NOT NULL,
   date DATETIME NOT NULL,
   PRIMARY KEY(idContributrice)
);

CREATE TABLE Etre(
   idEtre INTEGER NOT NULL AUTO_INCREMENT,
   nom VARCHAR(100),
   categorie VARCHAR(100),
   quantiteOr INT,
   ptAtt INT,
   pv INT,
   PRIMARY KEY(idEtre)
);

CREATE TABLE Element(
   idElement INTEGER NOT NULL AUTO_INCREMENT,
   nom VARCHAR(100),
   cheminImage VARCHAR(100),
   PRIMARY KEY(idElement)
);

CREATE TABLE Equipement(
   idElement_1_1 INTEGER NOT NULL,
   valeurOr INT,
   dimension VARCHAR(100),
   PRIMARY KEY(idElement_1_1),
   FOREIGN KEY(idElement_1_1) REFERENCES Element(idElement)
);

CREATE TABLE Piege(
   idElement_1_1 INTEGER NOT NULL,
   categorie VARCHAR(100),
   zoneEffet VARCHAR(100),
   detecter VARCHAR(100),
   esquiver VARCHAR(100),
   desamorcer VARCHAR(100),
   PRIMARY KEY(idElement_1_1),
   FOREIGN KEY(idElement_1_1) REFERENCES Element(idElement)
);

CREATE TABLE Creature(
   idEtre_1_1 INTEGER NOT NULL,
   climat VARCHAR(100),
   environnement VARCHAR(100),
   difficulte INT,
   PRIMARY KEY(idEtre_1_1),
   FOREIGN KEY(idEtre_1_1) REFERENCES Etre(idEtre)
);

CREATE TABLE PNJ(
   idEtre_1_1 INTEGER NOT NULL,
   metierPNJ VARCHAR(100),
   caracterePNJ VARCHAR(100),
   phraseTypePNJ VARCHAR(100),
   PRIMARY KEY(idEtre_1_1),
   FOREIGN KEY(idEtre_1_1) REFERENCES Etre(idEtre)
);

CREATE TABLE Mobilier(
   idElement_1_1 INTEGER NOT NULL,
   deplacable VARCHAR(100),
   dimension VARCHAR(100),
   PRIMARY KEY(idElement_1_1),
   FOREIGN KEY(idElement_1_1) REFERENCES Element(idElement)
);

CREATE TABLE Parametre(
   idParametre INTEGER NOT NULL AUTO_INCREMENT,
   nom VARCHAR(100),
   valeur INT,
   PRIMARY KEY(idParametre)
);

CREATE TABLE Environnement(
   nomE VARCHAR(100),
   description VARCHAR(50),
   PRIMARY KEY(nomE)
);

CREATE TABLE Carte(
   idCarte INTEGER NOT NULL AUTO_INCREMENT,
   nom VARCHAR(100),
   description VARCHAR(1000),
   date DATETIME NOT NULL,
   PRIMARY KEY(idCarte)
);

CREATE TABLE Zone(
   idZone INTEGER NOT NULL AUTO_INCREMENT,
   description VARCHAR(1000) NOT NULL,
   dimensions VARCHAR(100),
   idCarte INTEGER NOT NULL,
   PRIMARY KEY(idZone),
   FOREIGN KEY(idCarte) REFERENCES Carte(idCarte)
);

CREATE TABLE GENERER(
   idCarte INTEGER NOT NULL,
   idParametre INTEGER NOT NULL,
   PRIMARY KEY(idCarte, idParametre),
   FOREIGN KEY(idCarte) REFERENCES Carte(idCarte),
   FOREIGN KEY(idParametre) REFERENCES Parametre(idParametre)
);

CREATE TABLE CONTRIBUE(
   idCarte INTEGER NOT NULL,
   idContributrice INTEGER NOT NULL,
   date DATETIME,
   type VARCHAR(100),
   PRIMARY KEY(idCarte, idContributrice),
   FOREIGN KEY(idCarte) REFERENCES Carte(idCarte),
   FOREIGN KEY(idContributrice) REFERENCES Contributrice(idContributrice)
);

CREATE TABLE RELIER(
   idZone INTEGER NOT NULL,
   idZone_1 INTEGER NOT NULL,
   PRIMARY KEY(idZone, idZone_1),
   FOREIGN KEY(idZone) REFERENCES Zone(idZone),
   FOREIGN KEY(idZone_1) REFERENCES Zone(idZone)
);

CREATE TABLE SE_TROUVE(
   idZone INTEGER NOT NULL,
   idElement INTEGER NOT NULL,
   position VARCHAR(100),
   PRIMARY KEY(idZone, idElement),
   FOREIGN KEY(idZone) REFERENCES Zone(idZone),
   FOREIGN KEY(idElement) REFERENCES Element(idElement)
);

CREATE TABLE EXISTE(
   idEtre INTEGER NOT NULL,
   idZone INTEGER NOT NULL,
   PRIMARY KEY(idEtre, idZone),
   FOREIGN KEY(idEtre) REFERENCES Etre(idEtre),
   FOREIGN KEY(idZone) REFERENCES Zone(idZone)
);

CREATE TABLE PASSAGE_SECRET(
   idZone INTEGER NOT NULL,
   idZone_1 INTEGER NOT NULL,
   idElement_1_1 INTEGER NOT NULL,
   nomPS VARCHAR(100),
   difficultePS VARCHAR(100),
   PRIMARY KEY(idZone, idZone_1, idElement_1_1),
   FOREIGN KEY(idZone) REFERENCES Zone(idZone),
   FOREIGN KEY(idZone_1) REFERENCES Zone(idZone),
   FOREIGN KEY(idElement_1_1) REFERENCES Mobilier(idElement_1_1)
);

CREATE TABLE POSSEDE(
   idEtre_1_1 INTEGER NOT NULL,
   idZone INTEGER NOT NULL,
   nomE VARCHAR(100),
   PRIMARY KEY(idEtre_1_1, idZone, nomE),
   FOREIGN KEY(idEtre_1_1) REFERENCES Creature(idEtre_1_1),
   FOREIGN KEY(idZone) REFERENCES Zone(idZone),
   FOREIGN KEY(nomE) REFERENCES Environnement(nomE)
);

CREATE TABLE HISTORIQUE(
   idCarte INTEGER NOT NULL,
   idParametre INTEGER NOT NULL,
   PRIMARY KEY(idCarte, idParametre),
   FOREIGN KEY(idCarte) REFERENCES Carte(idCarte),
   FOREIGN KEY(idParametre) REFERENCES Parametre(idParametre)
);
