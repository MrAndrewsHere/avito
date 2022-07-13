<?php

namespace App\Traits;
trait HasFactory
{
    /**
     * Get a new factory instance for the model.
     *
     * @param callable|int|null $count
     */
    public static function factory($count = null)
    {
        return factory(get_called_class(), is_numeric($count) ? $count : (is_callable($count) ? $count() : null));
    }
}
