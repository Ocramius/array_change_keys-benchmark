#!/usr/bin/env bash

composer install
./vendor/bin/phpbench run BenchArrayChangeKeys.php --report=aggregate
