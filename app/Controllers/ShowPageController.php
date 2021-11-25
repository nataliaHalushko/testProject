<?php

namespace App\Controllers;

use App\Services\CallsService;
use Exception;

//show page with calls

class ShowPageController extends Controller
{

    public function getUploadForm()
    {
        $this->getView('form.php');
    }

    /**
     * @throws Exception
     */
    public function getReport()
    {

        if(!file_exists($_FILES['file']['tmp_name'])) {
            throw new Exception('The file is missing.');
        }
        $callsService = new CallsService();
        $report = $callsService->getCallsReport($_FILES['file']);

        $this->getView('report.php', ['report' => $report]);
    }
}
