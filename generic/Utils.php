<?php 
namespace generic;

use DateTime;

class Utils {

    /**
     * @param string $date
     * @param string $format
     * @return false|DateTime
     */
    public static function convertDate($date, $format = 'Y-m-d') {

        $d = DateTime::createFromFormat($format, $date);
    
        if (!$d || $d->format($format) != $date) {
            return false;
        }
    
        return $d;
    }

    /**
     * @param string $date
     * @return DateTime
     */
    public static function detectDate($date){
        $formats = [
            "Y-m-d",
            "Y/m/d",
            "d-m-Y",
            "d/m/Y"
        ];

        foreach ($formats as $k => $v) {
            $format = self::convertDate($date, $v);
            if($format == false){
                continue;
            }
            return $format;
        }
    }

}

?>