<?php

use Phalcon\Mvc\Model;

class Who extends Model
{
    public $name;
    public $nickname;

    public function initialize()
    {
    }
}
/*
CREATE TABLE `who` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(50) NOT NULL,
    `nick_a` VARCHAR(50) NOT NULL,
    `nick_b` VARCHAR(50) NOT NULL,
    `nick_c` VARCHAR(50) NOT NULL,
    `nick_d` VARCHAR(50) NOT NULL,
    `nick_e` VARCHAR(50) NOT NULL,
    `nick_f` VARCHAR(50) NOT NULL,
    `nick_g` VARCHAR(50) NOT NULL,
    `nick_h` VARCHAR(50) NOT NULL,
    `nick_i` VARCHAR(50) NOT NULL,
    `nick_j` VARCHAR(50) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `name` (`name`),
    INDEX `nickname` (`nick_a`),
    INDEX `nick_b` (`nick_b`),
    INDEX `nick_c` (`nick_c`),
    INDEX `nick_d` (`nick_d`),
    INDEX `nick_e` (`nick_e`),
    INDEX `nick_f` (`nick_f`),
    INDEX `nick_g` (`nick_g`),
    INDEX `nick_h` (`nick_h`),
    INDEX `nick_i` (`nick_i`),
    INDEX `nick_j` (`nick_j`)
) COLLATE='latin1_swedish_ci' ENGINE=InnoDB;
*/
########################################

include 'init.php';

$db = $di->get('db');
$db->execute('TRUNCATE TABLE who');

timer_start('t1');
$columns = [
    'name',
    'nick_a', 'nick_b', 'nick_c', 'nick_d', 'nick_e',
    'nick_f', 'nick_g', 'nick_h', 'nick_i', 'nick_j'
];
$data = [];
$pad = str_repeat('x', 30);
for ($i=0; $i<1000; $i++) {
    $data[] = [
        'name-'.$i,
        'nick_a-'.$i.'-'.$pad,
        'nick_b-'.$i.'-'.$pad,
        'nick_c-'.$i.'-'.$pad,
        'nick_d-'.$i.'-'.$pad,
        'nick_e-'.$i.'-'.$pad,
        'nick_f-'.$i.'-'.$pad,
        'nick_g-'.$i.'-'.$pad,
        'nick_h-'.$i.'-'.$pad,
        'nick_i-'.$i.'-'.$pad,
        'nick_j-'.$i.'-'.$pad,
    ];
}
$sql = genInsertSql('who', $columns, $data);
$db->execute($sql);
timer_end();

/*
timer_start('t1');
$db->execute('TRUNCATE TABLE who');
timer_end();

timer_start('t2');
$db->begin();
for ($i=0; $i<1000; $i++) {
    $who = new Who();
    $who->name = 'name-'.($i+1);
    $who->nickname = 'nickname-'.($i+1);
    $who->save();
}
$db->commit();
timer_end();
*/
print_r(timer_fetch());

//$who = Who::findFirst("name='name-9'");
//$who->delete();
