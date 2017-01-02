#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

// Create new workflow instance
$alfred = new \frdmn\PhpAlfred\Workflows();

$config = @json_decode(@file_get_contents($_SERVER['HOME'].'/.alfred-gira.json'));
$error = null;

if (!$config) {
  $error = 'no configuration file ~/.alfred-gira.json found';
}

if ($error) {
  $array = [
    [
      'uid'   => 0,
      'title' => 'Error: '.$error
    ]
  ];
} else {
  $array = [
    [
      'uid'   => 0,
      'icon'  => getcwd().'/assets/on.png',
      'title' => 'On',
      'arg' => 'On'
    ],
    [
      'uid'   => 1,
      'icon'  => getcwd().'/assets/off.png',
      'title' => 'Off',
      'arg' => 'Off'
    ]
  ];

  if (isset($argv[1])) {
    $argv[1] = strtolower(trim($argv[1]));
    if ($argv[1] == 'on' || $argv[1] == 'off') {
      $array = [
        [
          'uid'   => 0,
          'icon'  => getcwd().'/assets/'.$argv[1].'.png',
          'title' => ucfirst($argv[1]),
          'arg' => $argv[1]
        ]
      ];
    }
  }
}

// Print XML
print $alfred->toXML($array);
