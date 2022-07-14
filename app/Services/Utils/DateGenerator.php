<?php

namespace App\Services\Utils;

use Carbon\Carbon;

class DateGenerator
{
    static $current = null;

    public static function step(): \Generator
    {
        self::$current = (self::$current ?? Carbon::now()->subWeek())->copy()->addMinute();
        yield self::$current;
    }
}
