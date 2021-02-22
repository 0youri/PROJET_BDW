INSERT INTO `Element` (`idElement`, `nom`, `cheminImage`) VALUES (NULL, 'equipement1', NULL);
INSERT INTO `Element` (`idElement`, `nom`, `cheminImage`) VALUES (NULL, 'equipement2', NULL);
INSERT INTO `Element` (`idElement`, `nom`, `cheminImage`) VALUES (NULL, 'equipement3', NULL);
INSERT INTO `Element` (`idElement`, `nom`, `cheminImage`) VALUES (NULL, 'equipement4', NULL);
INSERT INTO `Element` (`idElement`, `nom`, `cheminImage`) VALUES (NULL, 'equipement5', NULL);

INSERT INTO `Equipement` (`idElement_1_1`, `valeurOr`, `dimension`) VALUES ('221', '1', '1x1');
INSERT INTO `Equipement` (`idElement_1_1`, `valeurOr`, `dimension`) VALUES ('222', '2', '2x2');
INSERT INTO `Equipement` (`idElement_1_1`, `valeurOr`, `dimension`) VALUES ('223', '3', '3x3');
INSERT INTO `Equipement` (`idElement_1_1`, `valeurOr`, `dimension`) VALUES ('224', '4', '4x4');
INSERT INTO `Equipement` (`idElement_1_1`, `valeurOr`, `dimension`) VALUES ('225', '5', '5x5');

INSERT INTO `Contributrice` (`idContributrice`, `nom`, `prenom`, `date`) VALUES (NULL, 'Nom_1', 'Prénom_1', '2020-11-26 10:21:45');
INSERT INTO `Contributrice` (`idContributrice`, `nom`, `prenom`, `date`) VALUES (NULL, 'Nom_2', 'Prénom_2', '2020-11-26 10:21:45');
INSERT INTO `Contributrice` (`idContributrice`, `nom`, `prenom`, `date`) VALUES (NULL, 'Nom_3', 'Prénom_3', '2020-11-26 10:21:45');
INSERT INTO `Contributrice` (`idContributrice`, `nom`, `prenom`, `date`) VALUES (NULL, 'Nom_4', 'Prénom_4', '2020-11-26 10:21:45');
INSERT INTO `Contributrice` (`idContributrice`, `nom`, `prenom`, `date`) VALUES (NULL, 'Nom_5', 'Prénom_5', '2020-11-26 10:21:45');

INSERT INTO `Carte` (`idCarte`, `nom`, `description`, `date`) VALUES (NULL, 'Carte_1', NULL, '2020-11-26 10:23:25');
INSERT INTO `Carte` (`idCarte`, `nom`, `description`, `date`) VALUES (NULL, 'Carte_2', NULL, '2020-11-26 10:23:25');
INSERT INTO `Carte` (`idCarte`, `nom`, `description`, `date`) VALUES (NULL, 'Carte_3', NULL, '2020-11-26 10:23:25');
INSERT INTO `Carte` (`idCarte`, `nom`, `description`, `date`) VALUES (NULL, 'Carte_4', NULL, '2020-11-26 10:23:25');
INSERT INTO `Carte` (`idCarte`, `nom`, `description`, `date`) VALUES (NULL, 'Carte_5', NULL, '2020-11-26 10:23:25');

INSERT INTO `CONTRIBUE` (`idCarte`, `idContributrice`, `date`, `type`) VALUES ('1', '1', '2020-11-26 10:24:25', 'création');
INSERT INTO `CONTRIBUE` (`idCarte`, `idContributrice`, `date`, `type`) VALUES ('2', '1', '2020-11-26 10:24:25', 'création');
INSERT INTO `CONTRIBUE` (`idCarte`, `idContributrice`, `date`, `type`) VALUES ('3', '2', '2020-11-26 10:24:25', 'création');
INSERT INTO `CONTRIBUE` (`idCarte`, `idContributrice`, `date`, `type`) VALUES ('4', '4', '2020-11-26 10:24:25', 'création');
INSERT INTO `CONTRIBUE` (`idCarte`, `idContributrice`, `date`, `type`) VALUES ('5', '5', '2020-11-26 10:24:25', 'création');

INSERT INTO `Etre` (`idEtre`, `nom`, `categorie`, `quantiteOr`, `ptAtt`, `pv`) VALUES (NULL, 'PNJ_1', '1', '1', '1', '1');
INSERT INTO `Etre` (`idEtre`, `nom`, `categorie`, `quantiteOr`, `ptAtt`, `pv`) VALUES (NULL, 'PNJ_2', '2', '2', '2', '2');
INSERT INTO `Etre` (`idEtre`, `nom`, `categorie`, `quantiteOr`, `ptAtt`, `pv`) VALUES (NULL, 'PNJ_3', '3', '3', '3', '3');
INSERT INTO `Etre` (`idEtre`, `nom`, `categorie`, `quantiteOr`, `ptAtt`, `pv`) VALUES (NULL, 'PNJ_4', '4', '4', '4', '4');
INSERT INTO `Etre` (`idEtre`, `nom`, `categorie`, `quantiteOr`, `ptAtt`, `pv`) VALUES (NULL, 'PNJ_5', '5', '5', '5', '5');

INSERT INTO `PNJ` (`idEtre_1_1`, `metierPNJ`, `caracterePNJ`, `phraseTypePNJ`) VALUES ('888', 'metier_1', 'caractere_1', 'phrase_1');
INSERT INTO `PNJ` (`idEtre_1_1`, `metierPNJ`, `caracterePNJ`, `phraseTypePNJ`) VALUES ('889', 'metier_2', 'caractere_2', 'phrase_2');
INSERT INTO `PNJ` (`idEtre_1_1`, `metierPNJ`, `caracterePNJ`, `phraseTypePNJ`) VALUES ('890', 'metier_3', 'caractere_3', 'phrase_3');
INSERT INTO `PNJ` (`idEtre_1_1`, `metierPNJ`, `caracterePNJ`, `phraseTypePNJ`) VALUES ('891', 'metier_4', 'caractere_4', 'phrase_4');
INSERT INTO `PNJ` (`idEtre_1_1`, `metierPNJ`, `caracterePNJ`, `phraseTypePNJ`) VALUES ('892', 'metier_5', 'caractere_5', 'phrase_5');