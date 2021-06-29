<?php

use App\Auth;
use App\Connection;
use App\Table\PriceSectionTable;

Auth::check();

$pdo = Connection::getPDO();
$table = new PriceSectionTable($pdo);
$event = $table->find($params['id']);

$table->delete($params['id']);
header('Location:' . $router->url('admin_pricesections'). '?delete=1');
