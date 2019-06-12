PHP str_diff Function
=====================

Calculates the difference between two strings.

Usage:

```PHP
<?php

require "vendor/autoload.php";

use function Bdelespierre\StrDiff\str_diff;
use function Bdelespierre\StrDiff\str_diff as aliased_diff;
use function Bdelespierre\StrDiff\colorize;
use function Bdelespierre\StrDiff\colorized_diff;

$diff = str_diff(
    'I am inevitable !',
    'I am Iron Man !'
);

var_dump($diff);

array(4) {
  'common_start' =>
  string(5) "I am "
  'common_end' =>
  string(2) " !"
  'left' =>
  string(10) "inevitable"
  'right' =>
  string(8) "Iron Man"
}

See ANSI escape codes, colors section -> https://en.wikipedia.org/wiki/ANSI_escape_code#Colors

echo colorize('<blue>'.$diff['common_start'] . '</blue>') . "\n\n";

$colorized_diff = colorized_diff(
    'I am inevitable !',
    'I am Iron Man !'
);

echo $colorized_diff . "\n\n";

# Aliased the function to avoid conflicts even further
$aliased_diff = aliased_diff(
    'I am aliased !',
    'I am Iron Man !'
);

var_dump($aliased_diff);

array(4) {
  'common_start' =>
  string(5) "I am "
  'common_end' =>
  string(2) " !"
  'left' =>
  string(7) "aliased"
  'right' =>
  string(8) "Iron Man"
}

```
