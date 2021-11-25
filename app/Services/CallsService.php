<?php

namespace App\Services;

use App\Http\GuzzleHttpClient;
use App\Services\IpStackService;
use App\Services\PhoneContinentService;
use Exception;

//methods for getting calls data

class CallsService
{

    /**
     * @throws Exception
     */
    public function validate($uploadedFile): void
    {
        $extension = pathinfo($uploadedFile['name'], PATHINFO_EXTENSION);

        if ($extension !== 'csv') {
            throw new Exception('The file must have the extension csv');
        }
    }


    /**
     * @throws Exception
     */
    public function getCallsReport(array $uploadedFile): array
    {
        $this->validate($uploadedFile);

        $fileOpen = fopen($uploadedFile['tmp_name'], "r");
        $reportData = [];
        if ($fileOpen !== false) {
            $httpClient = new GuzzleHttpClient();
            $ipStackService = new IpStackService($httpClient);
            $phoneContinentService = new PhoneContinentService();
            while (($fileData = fgetcsv($fileOpen, 2000)) !== false) {


//                $fileData[0] - client id
//                $fileData[2] - duration of the call
//                $fileData[3] - phone
//                $fileData[4] - ip

                $reportData[$fileData[0]]['totalNumber']++;
                $reportData[$fileData[0]]['totalDuration'] += $fileData[2];
                $ipContinentCode = $ipStackService->getContinentCode($fileData[4]);

                //validate continent phone codes
                if ($ipContinentCode && $phoneContinentService->validate($fileData[3], $ipContinentCode)) {
                    $reportData[$fileData[0]]['sameContinentNumber']++;
                    $reportData[$fileData[0]]['sameContinentDuration'] += $fileData[2];
                }else{
                    $reportData[$fileData[0]]['sameContinentNumber'] = 0;
                    $reportData[$fileData[0]]['sameContinentDuration'] = 0;
                }
            }
            fclose($fileOpen);
        }

        return $reportData;
    }



}