<?php
return [ 'db_host'=>getenv('DB_HOST') ?: '127.0.0.1', 'db_name'=>getenv('DB_NAME') ?: 'bartoli_mechanics_basket', 'db_user'=>getenv('DB_USER') ?: 'root', 'db_pass'=>getenv('DB_PASS') ?: '', 'base_url'=>getenv('BASE_URL') ?: '', 'timezone'=>'Europe/Rome' ];
