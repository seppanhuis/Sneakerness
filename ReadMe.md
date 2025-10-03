# 👟 Sneakerness - Event Management Platform

Een webapplicatie voor het beheren van sneaker evenementen, tickets, verkopers en stands.

## 📋 Overzicht

Sneakerness is een MVC-gebaseerde PHP applicatie die is ontworpen voor het beheren van sneaker evenementen. Het platform biedt functionaliteiten voor ticketverkoop, verkopersbeheer, standbeheer en contactpersoonbeheer.

## ✨ Features

### 🎫 Ticket Management
- **Ticket verkoop**: Bezoekers kunnen tickets kopen voor verschillende evenementen
- **Tijdslot beheer**: Verschillende prijzen per tijdslot
- **Overzicht**: Complete lijst van verkochte tickets met bezoeker- en evenementinformatie

### 🏪 Verkoper & Stand Management  
- **Verkopersbeheer**: Registratie en beheer van verkopers
- **Stand toewijzing**: Verschillende standtypes (A, AA, AA+)
- **Prijsbeheer**: Dynamische prijzen per standtype
- **Status tracking**: Verhuurstatus van stands

### 📅 Evenement Management
- **Evenement aanmaak**: Nieuwe sneaker evenementen organiseren
- **Locatiebeheer**: Verschillende locaties en capaciteiten
- **Datum planning**: Evenementen plannen voor verschillende data

### 👥 Contact Management
- **Contactpersonen**: Beheer van contactgegevens per verkoper
- **Communicatie**: Telefoon en email gegevens bijhouden

## 🛠️ Technische Stack

- **Backend**: PHP 8+ met MVC architectuur
- **Database**: MySQL 8.0+
- **Frontend**: HTML5, CSS3, Bootstrap 5
- **JavaScript**: Vanilla JS voor interactiviteit

## 📁 Project Structuur

```
Sneakerness/
├── app/
│   ├── controllers/          # MVC Controllers
│   │   ├── ticket.php
│   │   ├── Verkopers.php
│   │   ├── Stands.php
│   │   ├── Event.php
│   │   └── ContactPersoon.php
│   ├── models/              # Database Models
│   │   ├── ticketmodel.php
│   │   ├── VerkopersModel.php
│   │   ├── StandsModel.php
│   │   ├── evenementModel.php
│   │   └── ContactPersoonModel.php
│   ├── views/               # HTML Views
│   │   ├── ticket/
│   │   ├── verkopers/
│   │   ├── stands/
│   │   ├── event/
│   │   └── includes/
│   ├── config/              # Configuratie bestanden
│   ├── libraries/           # Core biblioteken
│   └── db/                  # Database scripts
├── public/                  # Publieke bestanden
│   ├── css/
│   ├── js/
│   ├── img/
│   └── index.php
└── README.md
```

## 🗄️ Database Schema

### Belangrijkste Tabellen

**Ticket**
- Koppeling tussen Bezoeker, Evenement en Prijs
- Tracking van aantal tickets en datum

**Evenement** 
- Sneaker evenement informatie
- Locatie en capaciteit beheer

**Verkoper**
- Verkoper informatie en specialisaties
- Stand type voorkeuren

**Stand**
- Stand toewijzingen en prijzen
- Verhuurstatus tracking

## 🚀 Installatie

### Vereisten
- PHP 8.0 of hoger
- MySQL 8.0 of hoger
- Apache/Nginx webserver
- Composer (optioneel)

### Setup Stappen

1. **Clone het project**
   ```bash
   git clone https://github.com/seppanhuis/Sneakerness.git
   cd Sneakerness
   ```

2. **Database Setup**
   ```sql
   -- Importeer het database script
   mysql -u username -p < app/db/createscript.sql
   ```

3. **Configuratie**
   ```php
   // Update app/config/config.php met jouw database gegevens
   define('DB_HOST', 'localhost');
   define('DB_USER', 'jouw_username');
   define('DB_PASS', 'jouw_password');
   define('DB_NAME', 'Sneakerness');
   ```

4. **Webserver Configuratie**
   - Zet de document root naar de `public/` folder
   - Zorg dat URL rewriting is ingeschakeld

## 📖 Gebruik

### Ticket Systeem
1. Ga naar `/ticket/create` om een nieuw ticket aan te maken
2. Selecteer bezoeker, evenement en tijdslot
3. Geef het aantal tickets op
4. Bekijk alle tickets via `/ticket/index`

### Verkoper Management
1. Voeg verkopers toe via `/verkopers/create`
2. Wijs stands toe via `/stands/create`
3. Beheer contactpersonen via `/contactpersoon/index`

### Event Management
1. Creëer nieuwe evenementen via `/event/create`
2. Stel prijzen per tijdslot in
3. Monitor verkochte tickets

## 👨‍💻 Development Team

Dit project is ontwikkeld door studenten voor een school project:

- **Sep Panhuis** - Lead Developer
- **[Teamgenoot naam]** - Frontend Developer  
- **[Teamgenoot naam]** - Database Designer

## 📝 Technische Log

Zie `app/Technische log/` voor gedetailleerde ontwikkelingsnotities en wijzigingen.

## 🔄 Git Workflow

- **main**: Productie-ready code
- **dev**: Development branch voor nieuwe features
- **feature-***: Feature branches voor specifieke functionaliteiten

## 📄 License

Dit project is ontwikkeld voor educatieve doeleinden als onderdeel van een school project.

## 🐛 Bug Reports & Feature Requests

Voor bug reports of feature requests, maak een issue aan in de GitHub repository.

---

**Sneakerness** - *Where sneaker culture meets event management* 👟✨
