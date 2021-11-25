<?php

namespace App\Services;

// Methods for work with continent phone codes

class PhoneContinentService
{

    /**
     * @var string
     */
    private string $countryInfoUrl = 'http://download.geonames.org/export/dump/countryInfo.txt';

    /**
     * @var array
     */
    private array $phoneCodes = [];

    public function __construct()
    {
        $this->getContinentPhoneCodes();
    }

   //validate phone continent codes
    public function validate(string $phone, string $codeOfContinent): bool
    {
        //get codes
        $phoneCodes =  array_key_exists($codeOfContinent, $this->phoneCodes) ? $this->phoneCodes[$codeOfContinent] : [];

        foreach ($phoneCodes as $phoneCode) {

            if (substr($phone, 0, strlen($phoneCode)) === $phoneCode) {

                return true;
            }
        }

        return false;
    }


    private function getContinentPhoneCodes()
    {
        foreach (file($this->countryInfoUrl) as $line) {

            if ($line[0] != '#') {
                $line = explode("\t", $line);
                $phoneCodes = str_replace(['+', '-', ' '], '', $line[12]);
                $continentCode = $line[8];
                    foreach (explode('and', $phoneCodes) as $phoneCode) {

                        $this->phoneCodes[$continentCode][] = $phoneCode;
                    }


            }
        }
    }



}