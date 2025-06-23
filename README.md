Projektbeschreibung
--------------------
Dieses Projekt stellt eine REST-API zur Verwaltung von Aufgaben bereit. Die Anwendung wurde mit dem Laravel Framework entwickelt.
Es handelt sich um eine Backend-seitige Anwendung mit Authentifizierung über Laravel Sanctum und einer CRUD-Funktionalität für Aufgaben.

Voraussetzungen
----------------
- PHP 8.1 oder höher
- Composer
- MySQL
- Laravel 12.x
- Thunder Client oder Postman für API-Tests

Lokale Installation
--------------------
1. Repository klonen oder lokal bereitstellen
2. Im Projektverzeichnis folgenden Befehl ausführen:

        composer install
3. .env-Datei anlegen
4. Datenbankverbindung in der .env-Datei anpassen:

       DB_CONNECTION=mysql
       DB_HOST=127.0.0.1
       DB_PORT=3307
       DB_DATABASE=managementdb
       DB_USERNAME=root
       DB_PASSWORD=

5. Applikationsschlüssel generieren:

       php artisan key:generate
6. Migrationen ausführen:

       php artisan migrate
7. Server starten:

       php artisan serve

Authentifizierung
------------------
Die Authentifizierung erfolgt über Laravel Sanctum (API Token).

Login:

Route: POST /api/login

Body:

    {
      "email": "test@testmail.com",
      "password": "password"
    }

Antwort:

        {
          "token": "<API-TOKEN>",
          "user": { ... }
        }

Token verwenden:
Authorization: Bearer <API-TOKEN>

API-Endpunkte
--------------
Alle Endpunkte befinden sich unter dem Präfix /api und sind durch Sanctum geschützt.

Aufgaben:

    GET     /aufgaben          - Liste aller Aufgaben
    GET     /aufgaben/{id}     - Einzelne Aufgabe abrufen
    POST    /aufgaben          - Neue Aufgabe erstellen
    PUT     /aufgaben/{id}     - Aufgabe aktualisieren
    DELETE  /aufgaben/{id}     - Aufgabe löschen

Beispiel für POST/PUT-Body:

    {
      "title": "Beispieltitel",
      "description": "Beispielbeschreibung",
      "status": "todo"
    }
Mögliche Status-Werte: todo, in_progress, done

Tests
------
Es wurden PHPUnit-Tests für die wichtigsten API-Funktionen (Erstellung, Aktualisierung, Löschung) erstellt.

Testausführung:

    php artisan test

Die Tests befinden sich unter tests/Feature/AufgabenTest.php

Sonstiges
----------
- Rate Limiting: max. 60 Anfragen/Minute pro IP
- Datenbank: MySQL über Port 3307

Autor
-----------
Cevher-Samil Yigittekin

samil.yigittekin@gmail.com
