<?php
use Illuminate\Database\Capsule\Manager as Capsule;

include __DIR__.'/vendor/autoload.php';
include __DIR__.'/spreadsheet-reader-master/SpreadsheetReader.php';
include __DIR__.'/spreadsheet-reader-master/SpreadsheetReader_XLSX.php';

$capsule = new Capsule;

$capsule->addConnection([
    'driver'    => 'mysql',
    'host'      => 'localhost',
    'database'  => 'is331',
    'username'  => 'root',
    'password'  => '',
    'charset'   => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix'    => '',
]);

// Make this Capsule instance available globally via static methods... (optional)
$capsule->setAsGlobal();