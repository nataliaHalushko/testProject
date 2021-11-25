<?php

require_once dirname(__DIR__) . '/vendor/autoload.php';

use App\Controllers\ShowPageController;


    switch (strtok($_SERVER["REQUEST_URI"],'?')) {
        case '/':
            (new ShowPageController)->getUploadForm();
            break;
        case '/calls-report':
            (new ShowPageController)->getReport();
            break;
        default:
            echo 'Error: not found';
    }
