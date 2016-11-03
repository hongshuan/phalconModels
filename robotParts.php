<?php

use Phalcon\Mvc\Model;

class Robots extends Model
{
    public $id;
    public $name;

    public function initialize()
    {
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

include 'init.php';

$robot = Robots::findFirst("type='type-2'");

$robots = Robots::find();

foreach ($robots as $robot) {
    echo $robot->name, ': ';
    foreach ($robot->robotsParts as $robotPart) {
        echo $robotPart->parts->name, ' ';
    }
    echo EOL;
}

########################################

#$part = Parts::findFirst();
#foreach ($part->robotsParts as $robotPart) {
#    echo $part->name, ', ', $robotPart->parts->name, EOL;
#}
