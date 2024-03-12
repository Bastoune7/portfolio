CREATE TABLE demande_compte
(
    id                INT AUTO_INCREMENT PRIMARY KEY,
    nom_utilisateur   VARCHAR(255) NOT NULL,
    email             VARCHAR(255) NOT NULL,
    autre_information TEXT,
    date_demande      TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);