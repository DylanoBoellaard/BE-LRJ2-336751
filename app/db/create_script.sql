-- Step: 01
-- Goal: Create a new database mvc-2209b-P4-Ljr1
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            04-04-2023      Arjan de Ruijter            New
-- **********************************************************************************/

-- Check if the database exists
DROP DATABASE IF EXISTS `mvc-2209b-P4-Ljr1`;

-- Create a new Database
CREATE DATABASE IF NOT EXISTS `mvc-2209b-P4-Ljr1`;

-- Use database mvc-2209b-P4-Ljr1
Use `mvc-2209b-P4-Ljr1`;

-- Step: 02
-- Goal: Create a new table Instructeur
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            04-04-2023      Arjan de Ruijter            New
-- **********************************************************************************/

-- Drop table Instructeur
DROP TABLE IF EXISTS Instructeur;

CREATE TABLE IF NOT EXISTS Instructeur
(
    Id              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Voornaam        VARCHAR(50)                     NOT NULL
   ,Tussenvoegsel   VARCHAR(10)                     NOT NULL
   ,Achternaam      VARCHAR(50)                     NOT NULL
   ,Mobiel          VARCHAR(12)                     NOT NULL
   ,DatumInDienst   DATE                            NOT NULL
   ,AantalSterren   VARCHAR(6)                      NOT NULL
   ,IsActief        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt DateTime(6)                     NOT NULL
   ,DatumGewijzigd  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Instructeur_Id   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;


-- Step: 03
-- Goal: Fill table Instructeur with data
-- **********************************************************************************
-- Version       Date:           Author:                     Description:
-- *******       **********      ****************            ******************
-- 01            04-04-2023      Arjan de Ruijter            New
-- **********************************************************************************/

INSERT INTO Instructeur
(
     Voornaam
    ,Tussenvoegsel
    ,Achternaam
    ,Mobiel
    ,DatumInDienst
    ,AantalSterren
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
     ('Li', '', 'Zhan', '06-28493827', '2015-04-17', '***', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Leroy', '', 'Boerhaven', '06-39398734', '2018-06-25', '*', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Yoeri', 'Van', 'Veen', '06-24383291', '2010-05-12', '***', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Bert', 'Van', 'Sali', '06-48293823', '2023-01-10', '****', 1, NULL, SYSDATE(6), SYSDATE(6))
    ,('Mohammed', 'El', 'Yassidi', '06-34291234', '2010-06-14', '*****', 1, NULL, SYSDATE(6), SYSDATE(6));


-- Stap 04, Create TypeVoertuig table
CREATE TABLE IF NOT EXISTS TypeVoertuig
(
    Id                      TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,TypeVoertuig            VARCHAR(50)                     NOT NULL
   ,Rijbewijscategorie      VARCHAR(10)                     NOT NULL
   ,IsActief                BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen             VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt         DateTime(6)                     NOT NULL
   ,DatumGewijzigd          DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_TypeVoertuig_Id   PRIMARY KEY CLUSTERED(Id)
) ENGINE=InnoDB;


-- Stap 05, Fill TypeVoertuig table with data
INSERT INTO TypeVoertuig
(
    TypeVoertuig
    ,Rijbewijscategorie
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
('Personenauto', 'B', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Vrachtwagen', 'C', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Bus', 'D', 1, NULL, SYSDATE(6), SYSDATE(6))
,('Bromfiest','AM', 1, NULL, SYSDATE(6), SYSDATE(6));


-- Stap 06, Create Voertuig table
CREATE TABLE IF NOT EXISTS Voertuig
(
    Id              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,Kenteken        VARCHAR(50)                     NOT NULL
   ,Type            VARCHAR(50)                     NOT NULL
   ,Bouwjaar        DATE                            NOT NULL
   ,Brandstof       VARCHAR(12)                     NOT NULL
   ,TypeVoertuigId  TINYINT         UNSIGNED        NOT NULL
   ,IsActief        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt DateTime(6)                     NOT NULL
   ,DatumGewijzigd  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_Voertuig_Id      PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      FK_Voertuig_TypeVoertuigId_TypeVoertuig_Id   FOREIGN KEY (TypeVoertuigId) REFERENCES TypeVoertuig(Id)
) ENGINE=InnoDB;


-- Stap 07, Fill Voertuig table with data
INSERT INTO Voertuig
(
    Kenteken
    ,Type
    ,Bouwjaar
    ,Brandstof
    ,TypeVoertuigId
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
('AU-67-IO', 'Golf', '2017-06-12', 'Diesel', 1, 1, NULL, SYSDATE(6), SYSDATE(6))
,('TR-24-OP', 'DAF', '2019-05-23', 'Diesel', 2, 1, NULL, SYSDATE(6), SYSDATE(6))
,('TH-78-KL', 'Mercedes', '2023-01-01', 'Benzine', 1, 1, NULL, SYSDATE(6), SYSDATE(6))
,('90-KL-TR', 'Fiat 500', '2021-09-12', 'Benzine', 1, 1, NULL, SYSDATE(6), SYSDATE(6))
,('34-TK-LP', 'Scania', '2015-03-13', 'Diesel', 2, 1, NULL, SYSDATE(6), SYSDATE(6))
,('YY-OP-78', 'BMW M5', '2022-05-13', 'Diesel', 1, 1, NULL, SYSDATE(6), SYSDATE(6))
,('UU-HH-JK', 'M.A.N', '2017-12-03', 'Diesel', 2, 1, NULL, SYSDATE(6), SYSDATE(6))
,('ST-FZ-28', 'Citroën', '2018-01-20', 'Elektrisch', 1, 1, NULL, SYSDATE(6), SYSDATE(6))
,('123-FR-T', 'Piaggio ZIP', '2021-02-01', 'Benzine', 4, 1, NULL, SYSDATE(6), SYSDATE(6))
,('DRS-52-P', 'Vespa', '2022-03-21', 'Benzine', 4, 1, NULL, SYSDATE(6), SYSDATE(6))
,('STP-12-U', 'Kymco', '2022-07-02', 'Benzine', 4, 1, NULL, SYSDATE(6), SYSDATE(6))
,('45-SD-23', 'Renault', '2023-01-01', 'Diesel', 3, 1, NULL, SYSDATE(6), SYSDATE(6));

-- Stap 08, Create table VoertuigInstructeur
CREATE TABLE IF NOT EXISTS VoertuigInstructeur
(
    Id              TINYINT         UNSIGNED        NOT NULL    AUTO_INCREMENT
   ,VoertuigId      TINYINT         UNSIGNED        NOT NULL
   ,InstructeurId   TINYINT         UNSIGNED        NOT NULL
   ,DatumToekenning DATE                            NOT NULL
   ,IsActief        BIT                             NOT NULL    DEFAULT 1
   ,Opmerkingen     VARCHAR(250)                        NULL    DEFAULT NULL
   ,DatumAangemaakt DateTime(6)                     NOT NULL
   ,DatumGewijzigd  DateTime(6)                     NOT NULL

   ,CONSTRAINT      PK_VoertuigInstructeur_Id                               PRIMARY KEY CLUSTERED(Id)
   ,CONSTRAINT      FK_VoertuigInstructeur_VoertuigId_Voertuig_Id           FOREIGN KEY (VoertuigId) REFERENCES Voertuig(Id)
   ,CONSTRAINT      FK_VoertuigInstructeur_InstructeurId_Instructeur_Id     FOREIGN KEY (InstructeurId) REFERENCES Instructeur(Id)
) ENGINE=InnoDB;


-- Stap 09, Fill TypeVoertuig table with data
INSERT INTO VoertuigInstructeur
(
    VoertuigId
    ,InstructeurId
    ,DatumToekenning
    ,IsActief
    ,Opmerkingen
    ,DatumAangemaakt
    ,DatumGewijzigd
)
VALUES
(1, 5, '2017-06-18', 1, NULL, SYSDATE(6), SYSDATE(6))
,(3, 1, '2021-09-26', 1, NULL, SYSDATE(6), SYSDATE(6))
,(9, 1, '2021-09-27', 1, NULL, SYSDATE(6), SYSDATE(6))
,(3, 4, '2022-08-01', 1, NULL, SYSDATE(6), SYSDATE(6))
,(5, 1, '2019-08-30', 1, NULL, SYSDATE(6), SYSDATE(6))
,(10, 5, '2020-02-02', 1, NULL, SYSDATE(6), SYSDATE(6));