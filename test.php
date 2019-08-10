<?php
require 'init.php';

use App\Models\Person;

$person = new Person('1');

echo '<pre>';
var_dump($person);
echo '</pre>';