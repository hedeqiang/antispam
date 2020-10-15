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
    'account' => [
        'secretId' => env('DUN_SECRET_ID'),
        'secretKey' => env('DUN_SECRET_KEY'),
    ],
    'text' => [
        'businessId' => env('DUN_TEXT_BUSINESS_ID'),
    ],
    'image' => [
        'businessId' => env('DUN_IMAGE_BUSINESS_ID'),
    ],
    'audio' => [
        'businessId' => env('DUN_AUDIO_BUSINESS_ID'),
    ],
    'video' => [
        'businessId' => env('DUN_VIDEO_BUSINESS_ID'),
    ],
];
