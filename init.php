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

function genInsertSql($table, $columns, $data)
{
    $columnList = '`' . implode('`, `', $columns) . '`';

    $query = "INSERT INTO `$table` ($columnList) VALUES\n";

    $values = array();

    foreach($data as $row) {
        foreach($row as &$val) {
            $val = addslashes($val);
        }
        $values[] = "('" . implode("', '", $row). "')";
    }

    $update = implode(', ',
        array_map(function($name) {
            return "`$name`=VALUES(`$name`)";
        }, $columns)
    );

    return $query . implode(",\n", $values);
#   return $query . implode(",\n", $values) . "\nON DUPLICATE KEY UPDATE " . $update . ';';
}

function &timer_fetch()
{
    static $timers = [ '__names__' => [] ];
    return $timers;
}

function timer_start($name)
{
    $timers = &timer_fetch();
    array_push($timers['__names__'], $name);
    $timers[$name] = microtime(true);
}

function timer_end($name = null)
{
    $timers = &timer_fetch();
    if (!$name) {
        $name = array_pop($timers['__names__']);
    } else {
        $key = array_search($name, $timers['__names__']);
        unset($timers['__names__'][$key]);
    }
    $start = $timers[$name];
    $end = microtime(true);
    $timers[$name] = number_format($end - $start, 3);
}
