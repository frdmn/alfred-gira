#!/usr/bin/env php
<?php

$config = @json_decode(@file_get_contents($_SERVER['HOME'].'/.alfred-gira.json'));

foreach ($config->outlets as $outlet) {
    $state = (strtolower($argv[1]) == 'on' ? 'ein' : 'aus');
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $config->server.'/'.$config->office.'licht0'.$outlet.$state);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
}
