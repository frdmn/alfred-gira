#!/usr/bin/env php
<?php

// Load configuration
$config = @json_decode(@file_get_contents($_SERVER['HOME'].'/.alfred-gira.json'));

// For each configured outlet in configuration ...
foreach ($config->outlets as $outlet) {
    // Read desired state from argv
    $state = (strtolower($argv[1]) == 'on' ? 'ein' : 'aus');
    // Control outlet using HTTP/curl
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $config->server.'/'.$config->office.'licht0'.$outlet.$state);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $output = curl_exec($ch);
    curl_close($ch);
}

// Exit without errors
exit;
