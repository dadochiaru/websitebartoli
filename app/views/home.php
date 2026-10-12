
<?php require __DIR__.'/partials/header.php'; ?>

<section class="hero">
    <div class="hero-image"></div>
    <div class="hero-content wrap">
        <span class="eyebrow">STAGIONE 2026 / 2027 · SERIE B INTERREGIONALE</span>
        <h1>IL CAMPO<br><em>È NOSTRO.</em></h1>
        <p>Orgoglio del territorio. Energia senza compromessi. Una squadra, una comunità.</p>
        <div class="actions">
            <a class="btn btn-red" href="squadra.php">Scopri la squadra <span>↗</span></a>
            <a class="btn btn-ghost" href="calendario.php">Calendario partite</a>
        </div>
        <div class="hero-foot">
            <span>FERMIGNANO × FOSSOMBRONE</span>
            <span>PASSIONE CHE UNISCE <b>●</b></span>
        </div>
    </div>
</section>

<section class="wrap section match-feature">
    <div class="section-head">
        <div>
            <span class="eyebrow">NEXT GAME</span>
            <h2>PROSSIMA <em>PARTITA</em></h2>
        </div>
        <a class="text-link" href="calendario.php">Tutto il calendario ↗</a>
    </div>

    <?php if ($next): ?>
        <div class="match-card">
            <div class="match-side">
                <img
                    src="assets/images/bartoli-logo.jpeg"
                    alt="Logo Bartoli Mechanics Basket"
                    class="brand-logo"
                >
                <strong>BARTOLI<br>MECHANICS</strong>
                <small>CASA</small>
            </div>

            <div class="match-meta">
                <span class="live-pill">IN PROGRAMMA</span>
                <div class="versus">VS</div>
                <p><?= e(date('d.m.Y · H:i', strtotime($next['match_date']))) ?></p>
                <small><?= e($next['venue']) ?></small>
                <a class="btn btn-red" href="biglietti.php">Biglietti ↗</a>
            </div>

            <div class="match-side">
                <div class="opponent-mark"><?= e(mb_substr($next['opponent'], 0, 2)) ?></div>
                <strong><?= e($next['opponent']) ?></strong>
                <small><?= $next['is_home'] ? 'TRASFERTA' : 'AVVERSARIA' ?></small>
            </div>
        </div>
    <?php else: ?>
        <p class="empty">Nessuna partita programmata nel database.</p>
    <?php endif; ?>
</section>

<section class="dark-section">
    <div class="wrap section">
        <div class="section-head">
            <div>
                <span class="eyebrow">ULTIMO RISULTATO</span>
                <h2>IL TABELLINO</h2>
            </div>
        </div>

        <?php if ($last): ?>
            <div class="result-row">
                <div>
                    <span class="eyebrow">PARTITA TERMINATA</span>
                    <h3>Bartoli Mechanics <span>vs</span> <?= e($last['opponent']) ?></h3>
                    <p><?= e(date('d/m/Y', strtotime($last['match_date']))) ?> · <?= e($last['venue']) ?></p>
                </div>
                <div class="score">
                    <?= $last['is_home'] ? (int)$last['home_score'] : (int)$last['away_score'] ?>
                    <i>:</i>
                    <?= $last['is_home'] ? (int)$last['away_score'] : (int)$last['home_score'] ?>
                </div>
            </div>
        <?php else: ?>
            <p class="empty">I risultati appariranno qui dopo l'inserimento nel database.</p>
        <?php endif; ?>
    </div>
</section>

<section class="wrap section">
    <div class="section-head">
        <div>
            <span class="eyebrow">DAL MONDO BARTOLI</span>
            <h2>ULTIME <em>NEWS</em></h2>
        </div>
        <a class="text-link" href="news.php">Tutte le notizie ↗</a>
    </div>

    <div class="news-grid">
        <?php foreach ($news as $n): ?>
            <article class="news-card">
                <a href="notizia.php?id=<?= (int)$n['id'] ?>">
                    <div
                        class="news-image"
                        style="background-image:url('<?= e($n['image_url'] ?: 'assets/images/basket.svg') ?>')"
                    >
                        <span class="tag"><?= e($n['category']) ?></span>
                    </div>
                    <div class="news-copy">
                        <small><?= e(date('d M Y', strtotime($n['published_at']))) ?> · <?= $n['is_demo'] ? 'DEMO' : 'NEWS' ?></small>
                        <h3><?= e($n['title']) ?></h3>
                        <p><?= e($n['excerpt']) ?></p>
                        <span class="text-link">Leggi la notizia ↗</span>
                    </div>
                </a>
            </article>
        <?php endforeach; ?>
    </div>
</section>

<section class="wrap section">
    <div class="section-head">
        <div>
            <span class="eyebrow">IL CAMPIONATO</span>
            <h2>LA <em>CLASSIFICA</em></h2>
        </div>
        <a class="text-link" href="classifica.php">Classifica completa ↗</a>
    </div>

    <div class="table-scroll">
        <table>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Squadra</th>
                    <th>G</th>
                    <th>V</th>
                    <th>P</th>
                    <th>Diff.</th>
                    <th>Pt</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach (array_slice($standings, 0, 5) as $i => $t): ?>
                    <tr class="<?= $t['is_home_team'] ? 'highlight' : '' ?>">
                        <td><?= $i + 1 ?></td>
                        <td>
                            <?= e($t['name']) ?>
                            <?= $t['is_home_team'] ? '<span class="tag">BM</span>' : '' ?>
                        </td>
                        <td><?= $t['played'] ?></td>
                        <td><?= $t['wins'] ?></td>
                        <td><?= $t['losses'] ?></td>
                        <td><?= $t['pf'] - $t['pa'] ?></td>
                        <td><b><?= $t['points'] ?></b></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <p class="fine-print">Classifica calcolata dai risultati demo presenti nel database: non è una classifica ufficiale.</p>
</section>

<section class="spotlight">
    <div class="wrap spotlight-inner">
        <div>
            <span class="eyebrow">GAME DAY · LIVE</span>
            <h2>LA PARTITA.<br><em>OVUNQUE TU SIA.</em></h2>
            <p>Qui troverai i collegamenti alle dirette ufficiali, quando disponibili.</p>
            <a class="btn btn-red" href="diretta.php">Vai alla diretta ↗</a>
        </div>
        <div class="court-art">
            <span>BM</span>
            <div class="court-circle"></div>
        </div>
    </div>
</section>

<section class="wrap section">
    <div class="section-head">
        <div>
            <span class="eyebrow">ROSTER 26/27</span>
            <h2>FATTI PER <em>COMPETERE</em></h2>
        </div>
        <a class="text-link" href="squadra.php">Tutti i giocatori ↗</a>
    </div>

    <div class="player-grid">
        <?php foreach ($players as $p): ?>
            <a class="player-card" href="giocatore.php?id=<?= (int)$p['id'] ?>">
                <div class="player-photo">
                    <img
                        loading="lazy"
                        src="<?= e($p['image_url'] ?: 'assets/images/player.svg') ?>"
                        alt="Avatar di <?= e($p['name']) ?>"
                    >
                    <b>#<?= (int)$p['jersey_number'] ?></b>
                </div>
                <div class="player-info">
                    <small><?= e($p['position']) ?> · DEMO</small>
                    <h3><?= e($p['name']) ?></h3>
                    <span><?= number_format((float)$p['points_avg'], 1) ?> PPG ↗</span>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</section>

<section class="wrap section social-callout">
    <div>
        <span class="eyebrow">RESTIAMO CONNESSI</span>
        <h2>LA COMMUNITY<br><em>È PARTE DEL GIOCO.</em></h2>
        <p>Segui gli aggiornamenti e i contenuti dietro le quinte.</p>
    </div>
    <a class="btn btn-red" href="social.php">Seguici sui social ↗</a>
</section>

<?php require __DIR__.'/partials/footer.php'; ?>
