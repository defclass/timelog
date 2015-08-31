<?php

//Silence is Gold.

include "./config.php";

raintpl::configure("base_url", null );
raintpl::configure("tpl_dir", "tpl/" );
raintpl::configure("cache_dir", "tmp/");

//initialize a Rain TPL object
$tpl = new RainTPL;

$tpl->draw('index');
$tpl->draw('footer');

?>
