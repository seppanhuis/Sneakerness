-- Create database
CREATE DATABASE IF NOT EXISTS `Sneakerness2` CHARACTER
SET
    = utf8mb4 COLLATE = utf8mb4_unicode_ci;

USE `Sneakerness2`;

-- Tabel: Organisator
CREATE TABLE
    Organisator (
        Id INT PRIMARY KEY AUTO_INCREMENT
        ,Naam VARCHAR(255) NOT NULL
        ,Gebruikersnaam VARCHAR(100) UNIQUE NOT NULL
        ,Wachtwoord VARCHAR(255) NOT NULL
        ,IsActief BIT NOT NULL DEFAULT 1
        ,Opmerking VARCHAR(255) Default NULL
        ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6)
        ,DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6) ON UPDATE NOW(6)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Tabel: Bezoeker
CREATE TABLE
    Bezoeker (
        Id INT PRIMARY KEY AUTO_INCREMENT
        ,Naam VARCHAR(255) NOT NULL
        ,Emailadres VARCHAR(255) UNIQUE NOT NULL
        ,IsActief BIT NOT NULL DEFAULT 1
        ,Opmerking VARCHAR(255) Default NULL
    ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6)
    ,DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6) ON UPDATE NOW(6)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Tabel: Evenement
CREATE TABLE
    Evenement (
        Id INT PRIMARY KEY AUTO_INCREMENT
        ,Naam VARCHAR(255) NOT NULL
        ,Datum DATE NOT NULL
        ,Locatie VARCHAR(255) NOT NULL
        ,AantalTicketsPerTijdslot INT NOT NULL DEFAULT 0
        ,BeschikbareStands INT NOT NULL DEFAULT 0
        ,IsActief BIT NOT NULL DEFAULT 1
        ,Opmerking VARCHAR(255) Default NULL
    ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6)
    ,DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6) ON UPDATE NOW(6)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Tabel: Prijs
CREATE TABLE
    Prijs (
        Id INT PRIMARY KEY AUTO_INCREMENT
        ,EvenementId INT NOT NULL
        ,Datum DATE NOT NULL
        ,Tijdslot VARCHAR(50) NOT NULL
        ,Tarief DECIMAL(10, 2) NOT NULL
        ,IsActief BIT NOT NULL DEFAULT 1
        ,Opmerking VARCHAR(255) Default NULL
    ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6)
    ,DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6) ON UPDATE NOW(6)
        ,FOREIGN KEY (EvenementId) REFERENCES Evenement (Id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Tabel: Ticket
CREATE TABLE
    Ticket (
        Id INT PRIMARY KEY AUTO_INCREMENT
        ,BezoekerId INT NOT NULL
        ,EvenementId INT NOT NULL
        ,PrijsId INT NOT NULL
        ,AantalTickets INT NOT NULL DEFAULT 1
        ,Datum DATE NOT NULL
        ,IsActief BIT NOT NULL DEFAULT 1
        ,Opmerking VARCHAR(255) Default NULL
    ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6)
    ,DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6) ON UPDATE NOW(6)
        ,FOREIGN KEY (BezoekerId) REFERENCES Bezoeker (Id) ON DELETE CASCADE
        ,FOREIGN KEY (EvenementId) REFERENCES Evenement (Id) ON DELETE CASCADE
        ,FOREIGN KEY (PrijsId) REFERENCES Prijs (Id) ON DELETE RESTRICT
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Tabel: Verkoper
CREATE TABLE
    Verkoper (
        Id INT PRIMARY KEY AUTO_INCREMENT
        ,Naam VARCHAR(255) NOT NULL
        ,SpecialeStatus bit NOT NULL DEFAULT 0
        ,VerkooptSoort VARCHAR(100)
        ,StandType ENUM ('A', 'AA', 'AA+') NOT NULL
        ,Dagen ENUM ('1', '2') NOT NULL
        ,Logo VARCHAR(255)
        ,IsActief BIT NOT NULL DEFAULT 1
        ,Opmerking VARCHAR(255) Default NULL
    ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6)
    ,DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6) ON UPDATE NOW(6)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Tabel: Stand
CREATE TABLE
    Stand (
        Id INT PRIMARY KEY AUTO_INCREMENT
        ,VerkoperId INT NULL
        ,StandType ENUM ('A', 'AA', 'AA+') NOT NULL
        ,Prijs DECIMAL(10, 2) NOT NULL
        ,VerhuurdStatus BIT NOT NULL DEFAULT FALSE
        ,IsActief BIT NOT NULL DEFAULT 1
        ,Opmerking VARCHAR(255) Default NULL
        ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6)
        ,DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6) ON UPDATE NOW(6)
        ,FOREIGN KEY (VerkoperId) REFERENCES Verkoper (Id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Tabel: Contactpersoon
CREATE TABLE
    Contactpersoon (
        Id INT PRIMARY KEY AUTO_INCREMENT
        ,Naam VARCHAR(255) NOT NULL
        ,Telefoonnummer VARCHAR(20) NOT NULL
        ,Emailadres VARCHAR(255) UNIQUE NOT NULL
        ,IsActief BIT NOT NULL DEFAULT 1
        ,Opmerking VARCHAR(255) Default NULL
    ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6)
    ,DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6) ON UPDATE NOW(6)
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

-- Koppeltabel: ContactPerVerkoper
CREATE TABLE
    ContactPerVerkoper (
        Id INT PRIMARY KEY AUTO_INCREMENT
        ,VerkoperId INT NOT NULL
        ,ContactpersoonId INT NOT NULL
        ,IsActief BIT NOT NULL DEFAULT 1
        ,Opmerking VARCHAR(255) Default NULL
        ,DatumAangemaakt DATETIME(6) NOT NULL DEFAULT NOW(6)
        ,DatumGewijzigd DATETIME(6) NOT NULL DEFAULT NOW(6) ON UPDATE NOW(6)
        ,FOREIGN KEY (VerkoperId) REFERENCES Verkoper (Id) ON DELETE CASCADE
        ,FOREIGN KEY (ContactpersoonId) REFERENCES Contactpersoon (Id) ON DELETE CASCADE
    ) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;
