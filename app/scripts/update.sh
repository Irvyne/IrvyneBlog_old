#!/bin/bash
php composer.phar self-update &&
php composer.phar update &&
php app/console assetic:dump
