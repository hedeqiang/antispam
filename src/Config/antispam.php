<?php

/*
 * This file is part of the hedeqiang/antispam.
 *
 * (c) hedeqiang<laravel_code@163.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

return [
    'text' => [
        'secretId' => env('TEXT_SECRET_ID'),
        'secretKey' => env('TEXT_SECRET_KEY'),
        'businessId' => env('TEXT_BUSINESS_ID'),
    ],
    'image' => [
        'secretId' => env('IMAGE_SECRET_ID'),
        'secretKey' => env('IMAGE_SECRET_KEY'),
        'businessId' => env('IMAGE_BUSINESS_ID'),
    ],
    'audio' => [
        'secretId' => env('AUDIO_SECRET_ID'),
        'secretKey' => env('AUDIO_SECRET_KEY'),
        'businessId' => env('AUDIO_BUSINESS_ID'),
    ],
    'video' => [
        'secretId' => env('VIDEO_SECRET_ID'),
        'secretKey' => env('VIDEO_SECRET_KEY'),
        'businessId' => env('VIDEO_BUSINESS_ID'),
    ],
];
