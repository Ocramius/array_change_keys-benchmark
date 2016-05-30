#!/usr/bin/env bash

composer install
./vendor/bin/phpbench run --report=all
