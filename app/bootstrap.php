<?php

declare(strict_types=1);

session_start();

$config = require __DIR__ . '/config/config.php';

date_default_timezone_set($config['timezone']);

try {
    $db = new PDO(
        "mysql:host={$config['db_host']};dbname={$config['db_name']};charset=utf8mb4",
        $config['db_user'],
        $config['db_pass'],
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]
    );
} catch (PDOException $e) {
    error_log('ERRORE DATABASE: ' . $e->getMessage());

    http_response_code(500);

    die('Errore di connessione al database. Controlla il terminale PHP.');
}

function e($v): string
{
    return htmlspecialchars(
        (string) $v,
        ENT_QUOTES | ENT_SUBSTITUTE,
        'UTF-8'
    );
}

function url($p = 'index.php'): string
{
    return $p;
}

function csrf(): string
{
    if (empty($_SESSION['csrf'])) {
        $_SESSION['csrf'] = bin2hex(random_bytes(32));
    }

    return $_SESSION['csrf'];
}

function csrf_check(): void
{
    if (!hash_equals($_SESSION['csrf'] ?? '', $_POST['csrf'] ?? '')) {
        http_response_code(419);
        die('Token non valido. Ricarica la pagina.');
    }
}

function standings(PDO $db): array
{
    $teams = $db->query(
        'SELECT id, name, is_home_team FROM teams'
    )->fetchAll();

    foreach ($teams as &$t) {
        $t += [
            'played' => 0,
            'wins' => 0,
            'losses' => 0,
            'pf' => 0,
            'pa' => 0,
            'points' => 0,
        ];
    }

    unset($t);

    $idx = [];

    foreach ($teams as $i => $t) {
        $idx[$t['id']] = $i;
    }

    $q = $db->query(
        "SELECT * FROM matches
         WHERE status = 'terminata'
         AND home_score IS NOT NULL
         AND away_score IS NOT NULL"
    );

    foreach ($q as $m) {
        $a = $idx[$m['home_team_id']] ?? null;
        $b = $idx[$m['opponent_id']] ?? null;

        if ($a === null || $b === null) {
            continue;
        }

        foreach ([$a, $b] as $i) {
            $teams[$i]['played']++;
        }

        $bmHome = (bool) $m['is_home'];

        $bmScore = $bmHome
            ? (int) $m['home_score']
            : (int) $m['away_score'];

        $oppScore = $bmHome
            ? (int) $m['away_score']
            : (int) $m['home_score'];

        $teams[$a]['pf'] += $bmScore;
        $teams[$a]['pa'] += $oppScore;

        $teams[$b]['pf'] += $oppScore;
        $teams[$b]['pa'] += $bmScore;

        if ($bmScore > $oppScore) {
            $teams[$a]['wins']++;
            $teams[$a]['points'] += 2;
            $teams[$b]['losses']++;
        } elseif ($bmScore < $oppScore) {
            $teams[$b]['wins']++;
            $teams[$b]['points'] += 2;
            $teams[$a]['losses']++;
        } else {
            $teams[$a]['points']++;
            $teams[$b]['points']++;
        }
    }

    usort($teams, function ($a, $b) {
        return ($b['points'] <=> $a['points'])
            ?: (($b['pf'] - $b['pa']) <=> ($a['pf'] - $a['pa']));
    });

    return $teams;
}

function setting(PDO $db, string $key, string $default = ''): string
{
    $s = $db->prepare(
        'SELECT setting_value FROM site_settings WHERE setting_key = ?'
    );

    $s->execute([$key]);

    return (string) ($s->fetchColumn() ?: $default);
}
