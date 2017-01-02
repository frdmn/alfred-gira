<?php

require __DIR__ . '/vendor/autoload.php';

// Create new workflow instance
$alfred = new \frdmn\PhpAlfred\Workflows();

// Construct array with workflow data
$array = [
    [
      'uid'   => 0,
      'arg'   => 'test',
      'title' => 'Title'
    ]
];

// Print XML
print $alfred->toXML($array);
