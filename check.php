<?php

include('alarm.php');

$alarm = new Alarm();
$alarm->current(); // will tweet the current score if it has changed

?>