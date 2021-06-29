<?php

use App\Auth;
use App\Connection;
use App\Table\PriceTable;

Auth::check();

$pdo = Connection::getPDO();
$table = new PriceTable($pdo);

$table->delete($params['id']);
header('Location:' . $router->url('admin_prices'). '?delete=1');
