<?php
//
require 'ls66pig.class.php';

$pig1=new Pig();
$pig1->weight=100;

$pig1->addWeight(10);
$pig1->showWeight();
?>