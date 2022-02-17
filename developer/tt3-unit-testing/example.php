<?php

include_once "./vendor/autoload.php";

use Bidpath\Tt3UnitTesting\Calculator;

echo "Fail with \"user not found\" error\n";
$result = (new Calculator())->calculate(1);
print_r($result);

echo "Success calculation by user and auction amount\n";
$result = (new Calculator())->calculate(3, 2);
print_r($result);

echo "Success calculation by user amount\n";
$result = (new Calculator())->calculate(3);
print_r($result);

echo " Success calculation by date amount\n";
$result = (new Calculator(45))->calculate(null, null, new DateTime("2022-01-01"));
print_r($result);

echo "Success calculation by file\n";
$result = (new Calculator())->calculate(null, null, null, __DIR__ . "/file_amount.txt");
print_r($result);

echo "Success calculation by random rate\n";
$calculator = new Calculator(45, 10);
$result = $calculator->calculate();
print_r($result);

echo "Fail, cannot found amount\n";
$result = (new Calculator())->calculate();
print_r($result);
