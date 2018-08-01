<?php

require 'ical.php';

Kirby::plugin('bvdputte/ical', [
    'options' => [
        "routeSlug" => "ical",
        "downloadText" => "Add to calendar"
    ],
    'routes' => function ($kirby) {
        return [
            [
                'pattern' => $kirby->option("bvdputte.ical.routeSlug") . "/(:all)",
                'action'  => function ($evinfo) {
                    $params = [];
                    foreach(explode("/",$evinfo) as $param){
                        $currentParam = explode(":", $param);
                        $params[$currentParam[0]] = urldecode($currentParam[1]);
                    }

                    header('Content-Type: text/calendar; charset=utf-8');
                    header('Content-Disposition: attachment; filename="cal.ics"');
                    echo iCal::render($params);
                    die;
                }
            ]
        ];
    },
    'tags' => [
        'ical' => [
            'attr' => [
                'start',
                'starttime',
                'end',
                'endtime',
                'summary',
                'description',
                'url',
                'linktext'
            ],
            'html' => function($tag) {
                $params = $tag->attrs();
                unset($params["linktext"]);

                if ( $tag->attr("linktext") != "") {
                    $linktext = $tag->attr("linktext");
                } else {
                    $linktext = option('bvdputte.ical.downloadText');
                }

                return "<a href=" . iCal::buildIcalUrl($params) . ">" . $linktext . "</a>";
            }
        ]
    ],
]);
