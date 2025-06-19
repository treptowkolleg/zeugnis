<?php

use App\Kernel;

define("project_root", dirname(__DIR__));

require project_root ."/vendor/autoload.php";

$app = new Kernel();