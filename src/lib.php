<?php
/**
 * Copyright 2019 Benjamin Delespierre
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
 * FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS
 * IN THE SOFTWARE.
 */

namespace Bdelespierre\StrDiff;

function str_diff(string $left, string $right): array
{
    $from_start   = strspn($left ^ $right, "\0");
    $common_start = $from_start ? substr($left, 0, $from_start) : '';

    if ($from_start) {
        $left     = substr($left, $from_start);
        $right    = substr($right, $from_start);
    }

    $from_end     = strspn(strrev($left) ^ strrev($right), "\0");
    $common_end   = $from_end ? substr($left, -$from_end) : '';

    if ($from_end) {
        $left     = substr($left, 0, -$from_end);
        $right    = substr($right, 0, -$from_end);
    }

    return compact('common_start', 'common_end', 'left', 'right');
}

function colorized_diff($left, $right): string
{
    extract(str_diff($left, $right));

    $left  = "$common_start<red>$left</red>$common_end";
    $right = "$common_start<green>$right</green>$common_end";

    return colorize("{$left}\n{$right}");
}

function colorize(string $message): string
{
    static $colors = [
        'black'         => "0;30",
        'red'           => "0;31",
        'green'         => "0;32",
        'brown'         => "0;33",
        'blue'          => "0;34",
        'magenta'       => "0;35",
        'cyan'          => "0;36",
        'light-grey'    => "0;37",
        'dark-grey'     => "1;30",
        'light-red'     => "1;31",
        'light-green'   => "1;32",
        'yellow'        => "1;33",
        'light-blue'    => "1;34",
        'light-magenta' => "1;35",
        'light-cyan'    => "1;36",
        'white'         => "1;37",
    ];

    foreach ($colors as $color => $code) {
        $message = preg_replace("#<{$color}>([^<]*)</{$color}>#", "\e[{$code}m$1\e[0m", $message);
    }

    return $message;
}
