<?php

require __DIR__ . '/../app/bootstrap.php';

$title = 'Home';

$next = $db->query("
    SELECT m.*, t.name AS opponent
    FROM matches m
    JOIN teams t ON t.id = m.opponent_id
    WHERE m.status = 'programmata'
    ORDER BY m.match_date
    LIMIT 1
")->fetch();

$last = $db->query("
    SELECT m.*, t.name AS opponent
    FROM matches m
    JOIN teams t ON t.id = m.opponent_id
    WHERE m.status = 'terminata'
    ORDER BY m.match_date DESC
    LIMIT 1
")->fetch();

$news = $db->query("
    SELECT *
    FROM news
    ORDER BY published_at DESC
    LIMIT 3
")->fetchAll();

$players = $db->query("
    SELECT *
    FROM players
    ORDER BY points_avg DESC
    LIMIT 4
")->fetchAll();

$standings = standings($db);

require __DIR__ . '/../app/views/home.php';

?>
