<?php

declare(strict_types=1);

use App\Money;

require_once '../vendor/autoload.php';

$one = Money::init(200, 'UAH');
$two = Money::init(500, 'USD');
$three = $one->add($two);

echo "<pre>";
var_dump($three);
echo "<pre>";