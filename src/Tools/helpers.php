<?php

if (!function_exists('ssfmail_env')) {
    /**
     * @param $key
     * @param null $default
     * @return mixed|null
     */
    function ssfmail_env($key, $default = null)
    {
        return \Ssf\Support\Env::get($key, $default);

    }
}