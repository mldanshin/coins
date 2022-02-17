<?php

return [
    "mail" => [
        'subject' => 'From the site "' . env('APP_NAME', '') . '", danshin-comment report',
        'replay_to' => [
            'address' => 'mail@danshin.net', //leave it blank if you don't want to receive reports
        ]
    ],
    'limit_comment' => 2 //integer bettwen 1 and 1000
];
