-- Création de la table "Projets"
CREATE TABLE Projets (
    ID_Projet INT AUTO_INCREMENT PRIMARY KEY,
    Nom_Projet VARCHAR(255) NOT NULL,
    Objectif_Projet TEXT NOT NULL,
    Explications_Fonctionnement TEXT NOT NULL,
    Fonctionnalites TEXT NOT NULL,
    Langages_Utilises VARCHAR(100) NOT NULL,
    Contribution_Personnelle TEXT NOT NULL,
    Exemple_Code TEXT NOT NULL,
    Image_Principale VARCHAR(255) NOT NULL
);

-- Création de la table "Images_Projet"
CREATE TABLE Images_Projet (
    ID_Image INT AUTO_INCREMENT PRIMARY KEY,
    ID_Projet INT,
    Chemin_Image VARCHAR(255) NOT NULL,
    FOREIGN KEY (ID_Projet) REFERENCES Projets(ID_Projet) ON DELETE CASCADE
);