<?php

use App\Auth;
use App\Connection;
use App\Table\SlotTable;

Auth::check();

$pdo = Connection::getPDO();
$table = new SlotTable($pdo);
$slot = $table->find($params['id']);

$table->delete($params['id']);
header('Location:' . $router->url('admin_slots'). '?delete=1');
