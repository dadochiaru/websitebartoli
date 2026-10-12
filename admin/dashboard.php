<?php
require __DIR__ . '/../app/bootstrap.php';

if (empty($_SESSION['admin_id'])) {
    header('Location: login.php');
    exit;
}

$counts = [];

foreach ([
    'players' => 'Giocatori',
    'matches' => 'Partite',
    'news' => 'Notizie',
    'staff' => 'Staff',
    'market_moves' => 'Movimenti'
] as $t => $label) {
    $counts[$label] = (int) $db
        ->query("SELECT COUNT(*) FROM `$t`")
        ->fetchColumn();
}
?>
<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard · Bartoli Mechanics Basket</title>
    <link rel="stylesheet" href="../public/assets/css/style.css">

    <style>
        .admin-links {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .admin-form {
            display: grid;
            gap: 8px;
        }

        .brand-logo {
            width: 62px;
            height: 62px;
            object-fit: contain;
            flex-shrink: 0;
        }

        .site-header .brand {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
        }

        .site-header .brand > span {
            display: flex;
            flex-direction: column;
        }

        .site-header .brand b {
            color: #1455a3;
        }

        .site-header .brand small {
            color: #64748b;
        }

        .admin-links .btn {
            border-radius: 5px;
        }

        @media (max-width: 680px) {
            .brand-logo {
                width: 48px;
                height: 48px;
            }

            .site-header {
                padding-left: 14px;
                padding-right: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="demo-strip">AREA AMMINISTRATIVA</div>

    <header class="site-header">
        <a class="brand" href="../public/index.php">
            <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSNUzQ8-05wFWcbR_TWs7iYMiJf-XcRfzrds-IcHM5Zofs7O1bFKI-mpl0&amp;s=10"
                alt="Logo Bartoli Mechanics Basket"
                class="brand-logo"
            >

            <span>
                <b>BARTOLI MECHANICS</b>
                <small>
                    ADMIN · <?= e($_SESSION['admin_name']) ?>
                </small>
            </span>
        </a>

        <nav class="main-nav" style="display:flex">
            <a href="../public/index.php">Apri sito ↗</a>
            <a href="logout.php">Esci</a>
        </nav>
    </header>

    <main class="wrap section">

        <span class="eyebrow">PANORAMICA</span>

        <h1>Dashboard <em>contenuti</em></h1>

        <p>
            Le modifiche effettuate vengono salvate nel database.
            Tutte le eliminazioni richiedono conferma.
        </p>

        <div class="stat-grid">
            <?php foreach ($counts as $label => $num): ?>
                <div>
                    <b><?= $num ?></b>
                    <small><?= e(strtoupper($label)) ?></small>
                </div>
            <?php endforeach; ?>
        </div>

        <h2>Gestione contenuti</h2>

        <div class="admin-links">
            <?php foreach ([
                'players' => 'Giocatori',
                'staff' => 'Staff',
                'matches' => 'Partite',
                'news' => 'Notizie',
                'market_moves' => 'Mercato',
                'sponsors' => 'Sponsor',
                'social_links' => 'Social',
                'site_settings' => 'Impostazioni',
                'live_streams' => 'Dirette'
            ] as $table => $label): ?>

                <a
                    class="btn btn-ghost"
                    href="manage.php?table=<?= e($table) ?>"
                >
                    <?= e($label) ?> →
                </a>

            <?php endforeach; ?>
        </div>

        <p class="fine-print">
            Per la prima versione è disponibile un CRUD generico per i
            campi principali. Non caricare file non attendibili in ambiente pubblico.
        </p>

    </main>

</body>
</html>