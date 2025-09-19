-- Create database
DROP DATABASE IF EXISTS `Sneakerness`;
CREATE DATABASE IF NOT EXISTS `Sneakerness` CHARACTER
SET
    = utf8mb4 COLLATE = utf8mb4_unicode_ci;

USE `Sneakerness`;

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
        ,SpecialeStatus BOOLEAN NOT NULL DEFAULT FALSE
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
        ,VerkoperId INT NOT NULL
        ,StandType ENUM ('A', 'AA', 'AA+') NOT NULL
        ,Prijs DECIMAL(10, 2) NOT NULL
        ,VerhuurdStatus BOOLEAN NOT NULL DEFAULT FALSE
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
        ,Telefoonnummer VARCHAR(20)
        ,Emailadres VARCHAR(255)
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

-- Evenementen
INSERT INTO
    Evenement (
        Naam,
        Datum,
        Locatie,
        AantalTicketsPerTijdslot,
        BeschikbareStands,
        Opmerking
    )
VALUES
    (
        'Sneakerness Rotterdam 2025'
        ,'2025-11-08'
        ,'Rotterdam Ahoy'
        ,100
        ,120
        ,'Weekend editie'
    )
    ,(
        'Sneakerness Amsterdam 2025'
        ,'2025-05-10'
        ,'RAI Amsterdam'
        ,80
        ,90
        ,'Spring edition'
    )
    ,(
        'Sneakerness Utrecht 2024'
        ,'2024-09-12'
        ,'Jaarbeurs'
        ,100
        ,75
        ,'Local event'
    )
    ,(
        'Sneakerness Antwerp 2023'
        ,'2023-10-05'
        ,'Antwerp Expo'
        ,60
        ,50
        ,'International'
    )
    ,(
        'Sneakerness Berlin 2022'
        ,'2022-06-20'
        ,'Station Berlin'
        ,70
        ,40
        ,'Historic'
    );

-- Organisatoren
INSERT INTO
    Organisator (Naam, Gebruikersnaam, Wachtwoord, Opmerking)
VALUES
    (
        'Sander de Vries'
        ,'sander'
        ,'{HASHED_PW}'
        ,'Lead organisator'
    )
    ,(
        'Marieke Janssen'
        ,'marieke'
        ,'{HASHED_PW}'
        ,'Ticketing en sales'
    )
    ,('Tom Peters'
        ,'tom'
        ,'{HASHED_PW}'
        ,'Logistiek'
    )
    ,(
        'Anna de Boer'
        ,'anna'
        ,'{HASHED_PW}'
        ,'PR & marketing'
    )
    ,('K. van Dijk'
        ,'kdijk'
        ,'{HASHED_PW}'
        ,'Finance'
    );

-- Bezoekers
INSERT INTO
    Bezoeker (Naam, Emailadres, Opmerking)
VALUES
    ('Jeroen Bak'
        ,'jeroen.bak@example.com'
        ,'VIP'
    )
    ,(
        'Sofia Kuiper'
        ,'sofia.kuiper@example.com'
        ,'Loyalty'
    )
    ,(
        'Lars van der Meer'
        ,'lars.meer@example.com'
        ,NULL
    )
    ,('Emma Visser'
        ,'emma.visser@example.com'
        ,NULL
    )
    ,(
        'Ali Rafiq'
        ,'ali.rafiq@example.com'
        ,'First time'
    );

-- Prijzen
INSERT INTO
    Prijs (EvenementId, Datum, Tijdslot, Tarief, Opmerking)
VALUES
    (
        1
        ,'2025-11-08'
        ,'11:00-12:00'
        ,12.50
        ,'Early bird'
    )
    ,(1
        ,'2025-11-08'
        ,'12:00-13:00'
        ,15.00
        ,NULL
    )
    ,(1
        ,'2025-11-08'
        ,'14:00-15:00'
        ,20.00
        ,'Peak'
    )
    ,(2
        ,'2025-05-10'
        ,'11:00-12:00'
        ,10.00
        ,NULL
    )
    ,(
        2
        ,'2025-05-10'
        ,'12:00-13:00'
        ,14.00
        ,'Afternoon'
    );

-- Tickets
INSERT INTO
    Ticket (
        BezoekerId,
        EvenementId,
        PrijsId,
        AantalTickets,
        Datum,
        Opmerking
    )
VALUES
    (1
        ,1
        ,1
        ,2
        ,'2025-11-08'
        ,'Klant vroeg aangemeld'
    )
    ,(2
        ,1
        ,3
        ,1
        ,'2025-11-08'
        ,NULL
    )
    ,(3
        ,2
        ,4
        ,3
        ,'2025-05-10'
        ,'Groep'
    )
    ,(4
        ,2
        ,5
        ,1
        ,'2025-05-10'
        ,NULL
    )
    ,(5
        ,1
        ,2
        ,1
        ,'2025-11-08'
        ,'Promocode gebruikt'
    );

-- Verkopers
INSERT INTO
    Verkoper (
        Naam,
        SpecialeStatus,
        VerkooptSoort,
        StandType,
        Dagen,
        Logo,
        Opmerking
    )
VALUES
    (
        'SneakerShop NL'
        ,TRUE
        ,'Vintage Sneakers'
        ,'AA+'
        ,'2'
        ,'/logos/sneakershop.png'
        ,'Partner'
    )
    ,(
        'StreetFood Co'
        ,FALSE
        ,'Eten & Drinken'
        ,'A'
        ,'1'
        ,NULL
        ,NULL
    )
    ,(
        'KidsCorner'
        ,FALSE
        ,'Kids Toys'
        ,'A'
        ,'1'
        ,NULL
        ,NULL
    )
    ,(
        'RetroKicks'
        ,FALSE
        ,'Secondhand'
        ,'AA'
        ,'2'
        ,NULL
        ,'Reservelijst'
    )
    ,(
        'UrbanWear'
        ,TRUE
        ,'Kleding'
        ,'AA+'
        ,'2'
        ,'/logos/urbanwear.png'
        ,'Sponsor'
    );

-- Stands
INSERT INTO
    Stand (
        VerkoperId,
        StandType,
        Prijs,
        VerhuurdStatus,
        Opmerking
    )
VALUES
    (1
        ,'AA+'
        ,500.00
        ,TRUE
        ,'Hoog profiel stand'
    )
    ,(2
        ,'A'
        ,150.00
        ,FALSE
        ,NULL
    )
    ,(3
        ,'A'
        ,120.00
        ,TRUE
        ,'Kids area'
    )
    ,(4
        ,'AA'
        ,300.00
        ,FALSE
        ,'Back-up'
    )
    ,(5
        ,'AA+'
        ,700.00
        ,TRUE
        ,'Premium partner'
    );

-- Contactpersonen
INSERT INTO
    Contactpersoon (Naam, Telefoonnummer, Emailadres, Opmerking)
VALUES
    (
        'Peter de Jong'
        ,'+31 6 12345678'
        ,'peter.jong@example.com'
        ,'Stand/contact voor SneakerShop'
    )
    ,(
        'Laila Ahmed'
        ,'+31 6 87654321'
        ,'laila.ahmed@example.com'
        ,'StreetFood contact'
    )
    ,(
        'Tom van Leeuwen'
        ,'+31 6 11223344'
        ,'tom.leeuwen@example.com'
        ,NULL
    )
    ,(
        'Sanne Koster'
        ,'+31 6 44332211'
        ,'sanne.koster@example.com'
        ,NULL
    )
    ,(
        'Rick Vermeulen'
        ,'+31 6 55443322'
        ,'rick.vermeulen@example.com'
        ,'Logistiek'
    );

-- ContactPerVerkoper
INSERT INTO
    ContactPerVerkoper (VerkoperId, ContactpersoonId, Opmerking)
VALUES
    (1
        ,1
        ,'Hoofdcontact SneakerShop'
    )
    ,(2
        ,2
        ,'Foodtruck coordinator'
    )
    ,(3
        ,3
        ,NULL
    )
    ,(4
        ,4
        ,'Reservering stand'
    )
    ,(5
        ,5
        ,'Sponsorship contact'
    );