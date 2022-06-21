<?php

namespace  App\Services;

use phpDocumentor\Reflection\Types\False_;

class DateCheck{
    public function isValid($strDate, $strFormat = "d/m/Y", $str_timezone = False): bool
    {
        $date = \DateTime::createFromFormat($strFormat, $strDate);
        if($date && (int)$date -> format('Y')<1900) {
            return false;
        }
        return $date && \DateTime::getLastErrors()["warning_count"] == 0  &&\DateTime::getLastErrors()["warning_count"] == 0;
    }
}

