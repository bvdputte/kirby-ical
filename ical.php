<?php
class iCal {

    public static function buildIcalUrl($params) {
        $link = "/" . option('bvdputte.ical.routeSlug');
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
            $dtstart = "";
            if (isset($params["starttime"])) {
                $dtstart = $params["start"] . " " . $params["starttime"];
            } else {
                $dtstart = $params["start"] . " 00:00:00";
            }
            $dtstart = date("Ymd\THis\Z", strtotime($dtstart));
            $vevent .= "DTSTART:".$dtstart."\r\n";
        }
        if (isset($params["end"])) {
            $dtend = "";
            if (isset($params["endtime"])) {
                $dtend = $params["end"] . " " . $params["endtime"];
            } else {
                $dtend = $params["end"] . " 23:59:59";
            }
            $dtend = date("Ymd\THis\Z", strtotime($dtend));
            $vevent .= "DTEND:".$dtend."\r\n";
        }
        if (isset($params["summary"])) {
            $vevent .= "SUMMARY:". $params["summary"] ."\r\n";
        }

        $vevent .= "END:VEVENT"."\r\n".
            "END:VCALENDAR";

        return $vevent;
    }

}