<?php

use App\Auth;
use App\Connection;
use App\Table\EventTable;
use App\Upload;

Auth::check();

$pdo = Connection::getPDO();
$table = new EventTable($pdo);
$event = $table->find($params['id']);
$picture = $event->getPicture();

$table->delete($params['id']);
if (isset($picture) && $picture !=='') {
    $uploader = new Upload(EVENT_PATH);
    $uploader->delete($picture);
}
header('Location:' . $router->url('admin_events'). '?delete=1');
