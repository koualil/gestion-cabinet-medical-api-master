DROP DATABASE IF EXISTS cabinet_medical_db;
CREATE DATABASE cabinet_medical_db;
use cabinet_medical_db;

CREATE TABLE Utilisateur(
   idUtilisateur int PRIMARY KEY AUTO_INCREMENT,
   cin varchar(10) NOT NULL UNIQUE,
   nom varchar(25) NOT NULL,
   prenom varchar(25) NOT NULL,
   email varchar(50) NOT NULL,
   motDePasse varchar(80) NOT NULL,
   situationFamilliale ENUM('marie', 'celibataire', 'Divorce', 'pacse', 'veuf') NOT NULL,
   genre ENUM('homme', 'femme') NOT NULL,
   tel varchar(25) NOT NULL,
   adresse varchar(255) NOT NULL,
   imageProfile varchar(255),
   dateNaissance date,
   type ENUM('patient', 'medecin', 'secretaire') NOT NULL
);

CREATE TABLE Service(
   idService INT PRIMARY KEY AUTO_INCREMENT,
   nom varchar(25) NOT NULL
);

CREATE TABLE Patient(
   idUtilisateur int UNIQUE,
   groupeSanguin varchar(10),-- فصيلة الدم
   decede boolean DEFAULT false,
   FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(idUtilisateur)
);

CREATE TABLE Medecin(
   idUtilisateur int UNIQUE NOT NULL,
   idService INT,
   FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(idUtilisateur),
   FOREIGN KEY (idService) REFERENCES Service(idService)
);

CREATE TABLE Secretaire(
   idUtilisateur int UNIQUE NOT NULL,
   FOREIGN KEY (idUtilisateur) REFERENCES Utilisateur(idUtilisateur)
   -- idCompteRendu int ,
   -- idAudio int,
   -- FOREIGN KEY (idCompteRendu) REFERENCES Utilisateur(CompteRendu),
   -- FOREIGN KEY (idAudio) REFERENCES Utilisateur(Audio),  
   
);

CREATE TABLE Diplome(
   idDiplome INT PRIMARY KEY AUTO_INCREMENT,
   nom varchar(25) NOT NULL,
   idMedecin INT,
   FOREIGN KEY (idMedecin) REFERENCES Medecin(idUtilisateur)
);

CREATE TABLE Antecedent(
   idAntecedent INT PRIMARY KEY AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   description text,
   type ENUM('medical', 'familial', 'psychologue', 'traumas', 'autre') NOT NULL,
   date date DEFAULT CURRENT_DATE,
   idPatient INT NOT NULL,
   FOREIGN KEY (idPatient) REFERENCES Patient(idUtilisateur)
);

CREATE TABLE RDV(
   idRDV INT PRIMARY KEY AUTO_INCREMENT,
   dateCreation date DEFAULT CURRENT_DATE,
   dateRDV date NOT NULL,
   type ENUM('visite', 'constrol') NOT NULL,
   status ENUM('enAttente', 'confirme', 'termine') NOT NULL,
   idPatient INT NOT NULL,
   idMedecin INT NOT NULL,
   FOREIGN KEY (idPatient) REFERENCES Patient(idUtilisateur),
   FOREIGN KEY (idMedecin) REFERENCES Medecin(idUtilisateur)
);

CREATE TABLE ElementSante(
   idElement INT PRIMARY KEY AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   description text,
   dateCreation date DEFAULT CURRENT_DATE,
   idPatient INT NOT NULL,
   FOREIGN KEY (idPatient) REFERENCES Patient(idUtilisateur)
);


CREATE TABLE Consultation(
   idConsultation INT PRIMARY KEY AUTO_INCREMENT,
   motif text,
   dateCreation date DEFAULT CURRENT_DATE,
   duree float,
   type ENUM('visite', 'constrol') NOT NULL,
   hauteur float,
   poid float,
   remarques text,
   idElement INT,
   idMedecin INT,
   FOREIGN KEY (idElement) REFERENCES ElementSante(idElement),
   FOREIGN KEY (idMedecin) REFERENCES Medecin(idUtilisateur)
);

CREATE TABLE Prescription(
   idPrescription INT PRIMARY KEY AUTO_INCREMENT,
   conseilsMedicaux text,
   idConsultation INT,-- unique
   FOREIGN KEY (idConsultation) REFERENCES Consultation(idConsultation)
);

CREATE TABLE Medicament(
   idMedicament INT PRIMARY KEY AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   descriptionTraitement text,
   dureeParJour INT,
   dosage varchar(25),
   idPrescription INT,
   FOREIGN KEY (idPrescription) REFERENCES Prescription(idPrescription)
);

--
CREATE TABLE Diagnostic(
   idDiagnostic int PRIMARY key,
   nom varchar(50) ,
   description text,
   date date DEFAULT CURRENT_DATE,
   idConsultation int unique,
   foreign key (idConsultation) REFERENCES Consultation(idConsultation) 
);

CREATE TABLE CompteRendu(
   idCompteRendu INT PRIMARY KEY AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   description text,
   date date DEFAULT CURRENT_DATE,
   type varchar(25),
   url varchar(255) NOT NULL,
   idConsultation INT,
   idDiagnostic int ,
   -- idSecretaire INT,
   FOREIGN KEY (idConsultation) REFERENCES Consultation(idConsultation),
   FOREIGN KEY (idDiagnostic) REFERENCES Diagnostic(idDiagnostic)
   -- FOREIGN KEY (idSecretaire) REFERENCES Secretaire(idUtilisateur)
);

CREATE TABLE Audio(
   idAudio INT PRIMARY KEY AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   description text,
   url varchar(255) NOT NULL,
   date date DEFAULT CURRENT_DATE,
   idDiagnostic INT,
   idCompteRendu int,
   -- idSecretaire INT,
   FOREIGN KEY (idCompteRendu) REFERENCES CompteRendu(idCompteRendu),
   FOREIGN KEY (idDiagnostic) REFERENCES Diagnostic(idDiagnostic)
   -- FOREIGN KEY (idSecretaire) REFERENCES Secretaire(idUtilisateur)
);

CREATE TABLE Examen(
   idExamen INT PRIMARY KEY AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   description text,
   date date DEFAULT CURRENT_DATE,
   type varchar(25),
   idConsultation INT,
   idDiagnostic int ,
   FOREIGN KEY (idConsultation) REFERENCES Consultation(idConsultation),
   FOREIGN KEY (idDiagnostic) REFERENCES Diagnostic(idDiagnostic)
);

CREATE TABLE Document(
   idDocument INT PRIMARY KEY AUTO_INCREMENT,
   nom varchar(50) NOT NULL,
   description text,
   type varchar(25),
   url varchar(255) NOT NULL,
   idExamen INT,
   FOREIGN KEY (idExamen) REFERENCES Examen(idExamen)
);

