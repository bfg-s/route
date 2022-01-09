<?php

namespace Bfg\Route;

use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;

class Channel
{
    public static function name($params = [])
    {
        $cacheFactory = app(CacheFactory::class)->get(['channels', static::class]);
        $cacheFactory = $cacheFactory ?$cacheFactory['channel'] : null;
        if ($cacheFactory && $params) {
            foreach ($params as $key => $param) {
                $cacheFactory = str_replace("{{$key}}", $param, $cacheFactory);
            }
        }
        return $cacheFactory;
    }

    public static function channelName($params = [])
    {
        return new \Illuminate\Broadcasting\Channel(static::name($params));
    }

    public static function privateName($params = [])
    {
        return new PrivateChannel(static::name($params));
    }

    public static function presenceName($params = [])
    {
        return new PresenceChannel(static::name($params));
    }
}
