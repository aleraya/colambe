<?php

use App\Auth;
use App\Connection;
use App\Table\ConfigTable;

Auth::check();

$pdo = Connection::getPDO();
$configTable = new ConfigTable($pdo);
$configTable->delete($params['id']);
header('Location:' . $router->url('admin_events'). '?delete=1');
header("Location:" . $router->url("admin_table_edit",['table'=>$params['table']]) .'?delete=1');

