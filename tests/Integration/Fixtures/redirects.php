<?php

declare(strict_types=1);

namespace SimplePie\Tests\Integration\Fixtures;

require_once __DIR__ . '/response_utilities.php';

if ($_SERVER['REQUEST_URI'] === '/perm2') {
    redirect('/perm1', 308);
} elseif ($_SERVER['REQUEST_URI'] === '/perm1') {
    redirect('/perm0', 301);
} elseif ($_SERVER['REQUEST_URI'] === '/perm0') {
    redirect('/temp2', 308);
} elseif ($_SERVER['REQUEST_URI'] === '/temp2') {
    redirect('/temp1', 307);
} elseif ($_SERVER['REQUEST_URI'] === '/temp1') {
    redirect('/temp0', 302);
} elseif ($_SERVER['REQUEST_URI'] === '/temp0') {
    redirect('/permA', 307);
} elseif ($_SERVER['REQUEST_URI'] === '/permA') {
    redirect('/permB', 301);
} elseif ($_SERVER['REQUEST_URI'] === '/permB') {
    redirect('/permC', 308);
} elseif ($_SERVER['REQUEST_URI'] === '/permC') {
    redirect('/final', 308);
} elseif ($_SERVER['REQUEST_URI'] === '/final') {
    output('OK');
} else {
    output('Not found', 404);
}
