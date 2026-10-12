<?php
$view=__DIR__.'/../views/'.$page.'.php'; if(!is_file($view)){http_response_code(404);$title='Pagina non trovata';require __DIR__.'/../views/404.php';exit;} require $view;
