<?php

use App\Auth;
use App\Connection;
use App\Table\EventTable;

Auth::check();

$pdo = Connection::getPDO();
$table = new EventTable($pdo);
//$table->delete($params['id']);
header('Location:' . $router->url('admin_events'). '?delete=1');
