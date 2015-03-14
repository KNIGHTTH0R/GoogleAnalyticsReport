<?php

require_once 'Stats.php';

$stat = new Stats();
$stat->setMail("xxxx-xxx@developer.gserviceaccount.com");
$stat->setApiCode("AIzaSyAdKOcXBBPHwrLN5MMd96");
$stat->setId("ga:xxxxxx");
$stat->setDimension("ga:eventCategory,ga:eventAction");
$stat->setMetrics("ga:totalEvents");
$stat->setAppName("My app");
$stat->setMaxResult(100);
$stat->setDateStart('2015-01-01');
$stat->setDateEnd('2015-03-14');
$stat->setPathKey('path/to/key.p12');

$data = $stat->fetch();
