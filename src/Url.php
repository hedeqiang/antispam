<?php

/*
 * This file is part of the hedeqiang/antispam.
 *
 * (c) hedeqiang<antispam>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Hedeqiang\Antispam;

/**
 * Trait HasHttpRequest.
 */
class Url
{
    const ENDPOINT_TEMPLATE = 'http://as.dun.163.com/%s/%s'; // 国内地址

    const ENDPOINT_LIVE_AUDIO_TEMPLATE = 'http://as-liveaudio.dun.163.com/%S/%S';  // 直播语音接口地址

    const ENDPOINT_TEXT_URL_VERSION = 'v3'; // 文本检测版本号
    const TEXT_VERSION = 'v3.1'; // 文本接口版本号
    const ENDPOINT_TEXT_FEEDBACK_URL_VERSION = 'v1'; // 文本机器结果反馈接口 版本号
    const ENDPOINT_TEXT_FEEDBACK_VERSION = 'v1'; // 文本机器结果反馈版本号
    const ENDPOINT_TEXT_KEYWORD_URL_VERSION = 'v1'; // 自定义文本关键词 URL 版本号
    const ENDPOINT_TEXT_KEYWORD_VERSION = 'v1'; // 自定义文本关键词接口 版本号

    const ENDPOINT_IMAGE_URL_VERSION = 'v4'; // 图片检测版本号
    const IMAGE_VERSION = 'v4'; // 图片接口版本号

    const ENDPOINT_AUDIO_URL_VERSION = 'v3'; // 音频检测版本号
    const AUDIO_VERSION = 'v3.3';  // 点播语音接口版本号

    const ENDPOINT_LIVE_AUDIO_URL_VERSION = 'v2'; // 直播音频检测版本号
    const LIVE_AUDIO_VERSION = 'v2.1';

    const ENDPOINT_VIDEO_URL_VERSION = 'v3'; //视频检测版本号
    const VIDEO_VERSION = 'v3.1';

    const ENDPOINT_LIVE_VIDEO_URL_VERSION = 'v3'; //视频检测版本号
    const LIVE_VIDEO_VERSION = 'V3.1';

    //const ENDPOINT_FORMAT = 'json';

    const INTERNAL_STRING_CHARSET = 'auto';
}
