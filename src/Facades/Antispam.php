<?php

/*
 * This file is part of the hedeqiang/antispam.
 *
 * (c) hedeqiang<antispam>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Hedeqiang\Antispam\Facades;

use Illuminate\Support\Facades\Facade;

class Antispam extends Facade
{
    /**
     * Return the facade accessor.
     *
     * @return string
     */
    public static function getFacadeAccessor()
    {
        return 'antispam';
    }

    /**
     * Return the facade accessor.
     *
     * @return \Hedeqiang\Antispam\Antispam
     */
    public static function green()
    {
        return app('antispam');
    }
}
