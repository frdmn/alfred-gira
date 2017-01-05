#!/usr/bin/env php
<?php
// Load configuration

putenv("PATH=" .@$_ENV["PATH"]. ':'.$_SERVER['HOME'].'/.npm-packages/bin:/usr/local/bin');
shell_exec("gira {$argv[1]}");

// Exit without errors
exit;
