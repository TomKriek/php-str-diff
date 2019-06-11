PHP str_diff Function
=====================

Calculates the difference between two strings.

Usage:

```PHP
<?php

include 'vendor/autoload.php';

$diff = str_diff(
    'I am inevitable !',
    'I am Iron Man !'
);

echo $diff['common_start']; // "I am"
echo $diff['common_end'];   // " !"
echo $diff['left'];         // "inevitable"
echo $diff['right'];        // "Iron Man"
```
