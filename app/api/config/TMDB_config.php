<?php

namespace app\api\config;

abstract class TMDB_config
{
    private static $tmdbApiKey   = 'f98bb1dfa8a65870fe4fc9567cd30456';
    private static $tmdbBaseUrl  = 'https://api.themoviedb.org/3/';
    private static $tmdbImageUrl = 'https://image.tmdb.org/t/p/';

    public static function getTmdbApiKey()
    {
        return self::$tmdbApiKey;
    }

    public static function getTmdbBaseUrl()
    {
        return self::$tmdbBaseUrl;
    }

    public static function getTmdbImageUrl()
    {
        return self::$tmdbImageUrl;
    }
}
