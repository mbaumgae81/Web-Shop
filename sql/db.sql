-- Start Script zur initialisierung der Datenbank WebShop
-- V 0.1

CREATE DATABASE webshop;
use webshop;
CREATE TABLE webshop.User(
    userID int PRIMARY KEY AUTO_INCREMENT,
    VorName varchar(255),
    NachName varchar(255),
    Adresse varchar(255),
    Telefon varchar(25),
    EmailAdresse varchar(50),
    LoginName varchar(50),
    PasswortHash varchar(255),
    istAdmin boolean
);

CREATE TABLE webshop.Kategorie(
    kategorieID int PRIMARY KEY AUTO_INCREMENT,
    bezeichnung varchar(255) NOT NULL

);

CREATE TABLE webshop.Artikel(


    artikelID int PRIMARY KEY AUTO_INCREMENT,
    name varchar(255),
    preis float(10),
    bild LONGBLOB,
    bildType varchar(255),
    beschreibung varchar(255),
    verfuegbar boolean,
    hersteller varchar(255),
    kategorieA int,
    kategorieB int,
    kategorieC int,
    FOREIGN KEY (kategorieA) REFERENCES Kategorie(kategorieID),
    FOREIGN KEY (kategorieB) REFERENCES Kategorie(kategorieID),
    FOREIGN KEY (kategorieC) REFERENCES Kategorie(kategorieID)
    
    );

CREATE TABLE webshop.Bestellungen(
    bestellungID int PRIMARY KEY AUTO_INCREMENT,
    datum date,
    const_userID int,
    artikelID int,
    userID int,
    FOREIGN KEY (userID) REFERENCES User (userID)
);

CREATE TABLE webshop.BestellungenPos(
    bestellungID int,
    artikelID int,
    anzahl int,
    PRIMARY KEY (bestellungID, artikelID),
    FOREIGN KEY (bestellungID) REFERENCES Bestellungen(bestellungID),
    FOREIGN KEY (artikelID) REFERENCES Artikel(artikelID)
    
);
