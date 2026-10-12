# Bartoli Mechanics Basket — prototipo PHP/MySQL

Sito dimostrativo responsive in PHP 8+, MySQL/MariaDB, HTML, CSS e JavaScript vanilla. I contenuti inventati sono marcati DEMO; non pubblicare senza sostituirli e verificarli.

## Fonti e scelte
- Pagina LiveTicket verificata il 12/10/2026: https://www.liveticket.it/bartolimechanicsbasket — riporta la stagione 2026/2027, Serie B Interregionale e PalaSpada a Fossombrone. Il link è usato come collegamento esterno configurabile.
- Riferimento stampa per contesto territoriale e giovani: https://www.basketmarche.it/mostra_news.php?id_news=144688 (06/08/2026). I profili del prototipo NON sono i giocatori ufficiali.
- Non sono state scaricate fotografie di atleti reali: il prototipo usa SVG originali locali come fallback/immagini dimostrative.
- Palette provvisoria antracite, bianco e rosso; logo SVG originale sostituibile.

## Requisiti
- PHP 8.1+ con estensioni PDO e pdo_mysql
- MySQL 8+ o MariaDB recente
- Apache/Nginx o server PHP integrato per sviluppo

## Avvio locale
1. Copia la cartella in `htdocs` (XAMPP) o in una directory servita dal web server.
2. Crea/importa il database: `mysql -u root -p < database/schema.sql`, poi `mysql -u root -p bartoli_mechanics_basket < database/seed.sql`.
3. Imposta credenziali in `app/config/config.php` oppure tramite variabili d'ambiente `DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`. Non mettere password reali nel repository.
4. Imposta la document root su `public/`. In sviluppo puoi lanciare dalla radice: `php -S 127.0.0.1:8000 -t public`; in tal caso il pannello admin è nella cartella `/admin` e potrebbe richiedere una configurazione Apache separata o avvio dalla root con routing appropriato. Consigliato Apache virtual host con root `public/` e alias protetto `/admin`.
5. Apri `http://127.0.0.1:8000`.

## Primo amministratore
Dalla root del progetto esegui `php scripts/create_admin.php nomeutente` e inserisci la password quando richiesta. Lo script usa `password_hash`; non esiste una password predefinita.

## Pannello
Apri `/admin/login.php` nel server configurato. Il login usa `password_verify`, sessione rigenerata e token CSRF. La dashboard offre CRUD per giocatori, staff, partite, notizie, mercato, sponsor, social, impostazioni e dirette. Le operazioni principali vengono salvate con PDO e query preparate.

## Personalizzazione
- Logo: `public/assets/images/logo.svg`.
- Palette: variabili CSS all'inizio di `public/assets/css/style.css`.
- Immagini: `public/assets/images/`; puoi sostituire SVG segnaposto con immagini per cui hai diritti d'uso.
- Testi e dati: tramite pannello e tabelle MySQL.
- Link LiveTicket: tabella `site_settings`, chiave `liveticket_url`; la pagina biglietti usa questa impostazione.
- Social: tabella `social_links`.
- Risultati: aggiorna `matches.status`, `home_score` e `away_score`. La classifica viene calcolata dai risultati terminati.
- Diretta: crea/aggiorna un record in `live_streams`, usa un URL YouTube e imposta lo stato `live`. Il player incorpora solo URL validi da `youtube.com/watch?v=` o `youtu.be/` tramite `youtube-nocookie.com`; altrimenti mostra la schermata di indisponibilità.

## Stato delle funzionalità
Operative: pagine richieste, navigazione responsive, filtri roster/calendario/news/mercato, classifica calcolata dai risultati, schede giocatori, statistiche demo, CRUD amministrativo per i campi configurati, login, CSRF, link esterni, player condizionale.

Da completare prima della produzione: gestione upload immagini con validazione MIME e scansione, paginazione completa delle tabelle admin, rate limiting login, recupero password, policy privacy/cookie, ruoli amministrativi granulari, migrazioni/versionamento DB, test automatici end-to-end, integrazione ufficiale social e dati live. Le foto sono segnaposto locali. Il sito non vende biglietti e non conferma prenotazioni.

## Note sicurezza
Il prototipo va eseguito in locale o in ambiente di staging. Non esporre direttamente il server PHP integrato su Internet. Imposta HTTPS, limita l'accesso admin, proteggi la directory `storage/uploads` e completa i controlli upload prima di abilitarli. Tutti i contenuti demo vanno sostituiti con dati verificati.
# websitebartoli
