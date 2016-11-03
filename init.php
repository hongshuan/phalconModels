<?php

use Phalcon\Di;

use Phalcon\Events\Event;
use Phalcon\Events\Manager as EventsManager;

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Manager as ModelsManager;
use Phalcon\Mvc\Model\Metadata\Memory as MetaData;

use Phalcon\Logger;
use Phalcon\Logger\Adapter\File as FileLogger;
use Phalcon\Logger\Formatter\Line as FormatterLine;

const EOL = PHP_EOL;

function pr($var) { var_export($var); echo EOL; }

$di = new Di();

$di->set('db', function () {
    $config = [
        "host"     => "127.0.0.1",
        "username" => "root",
        "password" => "",
        "dbname"   => "test",
        "options"  => [ PDO::ATTR_CASE => PDO::CASE_LOWER ]
    ];

    $db = new \Phalcon\Db\Adapter\Pdo\Mysql($config);

    return $db;
});

$di->set("modelsManager",  new ModelsManager());
$di->set("modelsMetadata", new MetaData());
