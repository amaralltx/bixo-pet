<?php
define('DB_SERVER', '10.220.240.186');
define('DB_USERNAME', 'lucas');
define('DB_PASSWORD', 'senhadtb');
define('DB', 'bixopet');
 
/* Tenta conectar com a database*/
$link = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB);

if (!$link) {
    die("Erro ao conectar à database. " . mysqli_connect_error());
} 

