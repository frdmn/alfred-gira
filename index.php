#!/usr/bin/env php
<?php

require __DIR__ . '/vendor/autoload.php';

// Create new workflow instance
$alfred = new \frdmn\PhpAlfred\Workflows();

// Load configuration
$config = @json_decode(@file_get_contents($_SERVER['HOME'].'/.alfred-gira.json'));
$error = null;

// Make sure configuration file exists
if (!$config) {
  $error = 'no configuration file ~/.alfred-gira.json found';
}

// Check for possible errors
if ($error) {
  $array = [
    [
      'uid'   => 0,
      'title' => 'Error: '.$error
    ]
  ];
// Continue to construct XML menu
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

  // If user is directly using sub commmand, only show that one
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

// Exit without errors
exit;
