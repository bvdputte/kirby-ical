<?php
class iCal {

    public static function buildIcalUrl($params) {
        $link = option('bvdputte.ical.routeSlug');
        foreach($params as $paramKey => $paramValue) {
            $link .= "/" . $paramKey . ":" . urlencode($paramValue);
        }
        return $link;
    }

    public static function render($params) {
        $uid = date('Ymd') . 'T' . date('His') . '-' . rand();
        
        $vevent = "BEGIN:VCALENDAR"."\r\n".
            "VERSION:2.0"."\r\n".
            "PRODID:-//bvdputte/kirby-ical-plugin//NONSGML v1.0//EN"."\r\n".
            "BEGIN:VEVENT"."\r\n".
            "UID:".$uid."\r\n".
            "DTSTAMP:".date("Ymd\THis\Z")."\r\n";

        if (isset($params["start"])) {
            if (isset($params["starttime"])) {
                $start = self::_makedatetimestamp($params["start"], $params["starttime"]);
            } else {
                $start = self::_makedatetimestamp($params["start"]);
            }
            $vevent .= "DTSTART:".$start."\r\n";
        }
        if (isset($params["end"])) {
            if (isset($params["endtime"])) {
                $end = self::_makedatetimestamp($params["end"], $params["endtime"]);
            } else {
                $end = self::_makedatetimestamp($params["end"]);
            }
            $vevent .= "DTEND:".$end."\r\n";
        }
        if (isset($params["summary"])) {
            $vevent .= "SUMMARY:". $params["summary"] ."\r\n";
        }

        $vevent .= "END:VEVENT"."\r\n".
            "END:VCALENDAR";

        return $vevent;
    }

    private static function _makedatetimestamp($date, $time = "00:00:00") {
        return date("Ymd\THis\Z", strtotime($date . " " . $time));
    }

}