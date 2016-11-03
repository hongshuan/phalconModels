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
        "options"  => [
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'",
            PDO::ATTR_CASE               => PDO::CASE_LOWER,
        ]
    ];

    $db = new \Phalcon\Db\Adapter\Pdo\Mysql($config);

    $eventsManager = new EventsManager();

    $logger = new FileLogger("db.log");
    $formatter = new FormatterLine('%date% [%type%] %message%', 'Y-m-d H:i:s');
    $logger->setFormatter($formatter);

    $eventsManager->attach("db:beforeQuery",
        function (Event $event, $connection)  use ($logger) {
            $sql = $connection->getSQLStatement();

            $logger->log($sql, Logger::INFO);

            // Check for malicious words in SQL statements
            if (preg_match("/DROP|ALTER/i", $sql)) {
                // DROP/ALTER operations aren't allowed in the application,
                // this must be a SQL injection!
                return false;
            }

            // It's OK
            return true;
        }
    );

    $db->setEventsManager($eventsManager);

    return $db;
});

Model::setup([
    "events"         => false,
    "columnRenaming" => false,
]);

// Set a models manager
$di->set("modelsManager", new ModelsManager());

// Use the memory meta-data adapter or other
$di->set("modelsMetadata", new MetaData());

class Robots extends Model
{
    public $id;
    public $name;

    // Postgres Only
    public function getSequenceName()
    {
        return "robots_sequence_name";
    }

    public function initialize()
    {
       #$this->keepSnapshots(true);
       #$this->useDynamicUpdate(true);

       #$this->setSource("toys_robot_parts");

       #$this->setReadConnectionService("dbSlave");
       #$this->setWriteConnectionService("dbMaster");

        // Skips fields/columns on both INSERT/UPDATE operations
       #$this->skipAttributes(["year", "price"]);

        // Skips only when inserting
       #$this->skipAttributesOnCreate(["created_at"]);

        // Skips only when updating
       #$this->skipAttributesOnUpdate(["modified_in"]);

        $this->hasMany("id", "RobotsParts", "robots_id");

       #$this->hasManyToMany(
       #    "id",
       #    "RobotsParts",
       #    "robots_id", "parts_id",
       #    "Parts",
       #    "id"
       #);
    }
}

class Parts extends Model
{
    public $id;
    public $name;

    public function initialize()
    {
        $this->hasMany("id", "RobotsParts", "parts_id");
    }
}

class RobotsParts extends Model
{
    public $id;
    public $robots_id;
    public $parts_id;

    public function onConstruct() { }

    public function initialize()
    {
        $this->belongsTo("robots_id", "Robots", "id");
        $this->belongsTo("parts_id",  "Parts",  "id");
    }
}

########################################

//echo Robots::count(), EOL;

// Get a record from the database
#$robot = Robots::findFirst('id=2');
#echo $robot->name, ', ', $robot->year, ', ', $robot->type, EOL;

#$robot = Robots::findFirst(2);
#echo $robot->name, ', ', $robot->year, ', ', $robot->type, EOL;

#$robots = Robots::find();
#foreach ($robots as $robot) {
#    echo $robot->name, ', ', $robot->year, ', ', $robot->type, EOL;
#}

#$robots = Robots::query()
##   ->where("type = :type:")
#    ->andWhere("year < 2015")
##   ->bind(["type" => "type-1"])
#    ->order("name")
#    ->execute();
#
#foreach ($robots as $robot) {
#    echo $robot->name, ', ', $robot->year, ', ', $robot->type, EOL;
#}

#$robot = Robots::findFirstByName('robot-3');
#echo $robot->name, ', ', $robot->year, ', ', $robot->type, EOL;

$robot = Robots::findFirst(2);

foreach ($robot->robotsParts as $robotPart) {
    echo $robot->name, ', ', $robotPart->parts->name, "\n";
}

#$robots->setHydrateMode(Resultset::HYDRATE_ARRAYS);  // Return every robot as an array
#$robots->setHydrateMode(Resultset::HYDRATE_OBJECTS); // Return every robot as a stdClass
#$robots->setHydrateMode(Resultset::HYDRATE_RECORDS); // Return every robot as a Robots instance

#pr($robot->toArray());

// Change a column
//$robot->name = "Other name";
//$robot->save();

//pr($robot->getChangedFields()); // ["name"]
//pr($robot->hasChanged("name")); // true
//pr($robot->hasChanged("type")); // false

########################################

//echo Parts::count(), EOL;
$part = Parts::findFirst();
#pr($part->toArray());
