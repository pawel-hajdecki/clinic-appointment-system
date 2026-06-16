# Clinic Appointment System

## Opis projektu

Aplikacja webowa do zarządzania rejestracją wizyt w przychodni. Projekt jest oparty na PHP i wykorzystuje własny prosty framework MVC z systemem routingu, autoloadingu, szablonami Smarty oraz bazą danych obsługiwaną przez Medoo.

Aplikacja obsługuje różne role użytkowników:
- `patient` — pacjent
- `receptionist` — recepcjonista
- `admin` — administrator

## Funkcjonalności

- logowanie i wylogowywanie użytkowników
- rejestracja pacjentów oraz dodawanie recepcjonistów przez admina
- przegląd lekarzy oraz szczegóły lekarza
- zarządzanie terminarzem i umówionymi wizytami
- rezerwacja, edycja i anulowanie wizyt
- zarządzanie lekarzami, recepcjonistami i pacjentami
- zmiana hasła oraz edycja danych konta użytkownika
- obsługa predefiniowanych powodów wizyt

## Struktura projektu

- `app/`
  - `controllers/` — kontrolery obsługujące akcje i logikę aplikacji
  - `forms/` — obiekty formularzy
  - `services/` — narzędzia pomocnicze, logika dostępu do bazy
  - `transfer/` — obiekty transferowe danych
  - `views/` — szablony Smarty
- `core/` — baza frameworka: router, konfiguracja, sesje, walidacja
- `public/` — katalog publiczny aplikacji, punkt wejścia
- `lib/` — biblioteki zewnętrzne: Smarty i Medoo
- `tests/` — testy jednostkowe PHPUnit

## Technologie

- PHP
- Smarty
- Medoo
- PHPUnit (do testów)
- PSR-4 autoloading w `composer.json`

## Konfiguracja

1. Skopiuj lub dostosuj plik `config.php`.
2. Ustaw dane połączenia z bazą:
   - `db_type`
   - `db_server`
   - `db_name`
   - `db_user`
   - `db_pass`
3. W projekcie używane są zmienne środowiskowe:
   - `DB_NAME`
   - `DB_ROOT_PASS`

Domyślna konfiguracja zakłada, że aplikacja jest dostępna z katalogu `public`:
- `app_root = '/public'`


## Instrukcja Wdrożenia (Deployment)

### Instalacja i Uruchomienie

#### Przygotowanie Środowiska (Ubuntu Server)
Zaktualizuj system i zainstaluj środowisko Docker wraz z Docker Compose v2:
#### Aktualizacja pakietów i instalacja Dockera
sudo apt update && sudo apt install docker.io docker-compose-v2 -y
#### Dodanie bieżącego użytkownika do grupy docker (znosi wymóg używania sudo)
sudo usermod -aG docker $USER
#### Pobranie kodu
Git clone https://github.com/MajaPytowska/clinic-appointment-system
#### Pliki kofiguracyjne
Stworz pliki kofiguracyjne .env oraz Dockerfile i docker-compose.yml
#### Uruchomienie kontenerów
docker compose up -d --build

