
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?= e($title ?? 'Bartoli Mechanics Basket') ?> | Bartoli Mechanics Basket</title>

    <meta name="description" content="Il sito demo della Bartoli Mechanics Basket: squadra, calendario, risultati e notizie.">

    <meta property="og:title" content="<?= e($title ?? 'Bartoli Mechanics Basket') ?> | Bartoli Mechanics Basket">
    <meta property="og:description" content="Passione, territorio, pallacanestro.">

    <link rel="icon" href="assets/images/bartoli-logo.jpeg" type="image/jpeg">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@500;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="assets/css/style.css">
    <script defer src="assets/js/app.js"></script>
</head>

<body>

<div class="demo-strip">
    SITO DIMOSTRATIVO · contenuti e statistiche di prova
</div>

<header class="site-header">

    <a class="brand" href="index.php">
        <img
            src="assets/images/bartoli-logo.jpeg"
            alt="Logo Bartoli Mechanics Basket"
        >

        <span>
            BARTOLI <b>MECHANICS</b>
            <small>BASKET · MARCHE</small>
        </span>
    </a>

    <button class="menu-toggle" aria-label="Apri menu" aria-expanded="false">
        ☰
    </button>

    <nav class="main-nav">
        <a href="index.php">Home</a>
        <a href="squadra.php">Squadra</a>
        <a href="calendario.php">Calendario</a>
        <a href="classifica.php">Classifica</a>
        <a href="news.php">News</a>
        <a href="storia.php">Società</a>
        <a class="nav-ticket" href="biglietti.php">Biglietti ↗</a>
    </nav>

</header>

<main>
