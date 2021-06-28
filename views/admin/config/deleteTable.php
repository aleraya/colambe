<?php

use App\Auth;
use App\Connection;
use App\Table\ConfigTable;

Auth::check();

$pdo = Connection::getPDO();
$configTable = new ConfigTable($pdo);
$configTable->deleteTable($params['table']);
header("Location:" . $router->url("admin_tables") .'?delete=1');

