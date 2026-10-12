<?php
require __DIR__.'/../app/bootstrap.php';
if(PHP_SAPI!=='cli'){http_response_code(403);exit("Solo CLI.\n");}
$username=$argv[1]??'';if(!preg_match('/^[a-zA-Z0-9_.-]{3,80}$/',$username)){fwrite(STDERR,"Uso: php scripts/create_admin.php username (3-80 caratteri)\n");exit(1);}fwrite(STDOUT,"Password nuova (almeno 12 caratteri): ");$password=trim((string)fgets(STDIN));if(strlen($password)<12){fwrite(STDERR,"Password troppo corta.\n");exit(1);} $s=$db->prepare('INSERT INTO admin_users(username,password_hash) VALUES(?,?)');$s->execute([$username,password_hash($password,PASSWORD_DEFAULT)]);echo "Amministratore creato.\n";
