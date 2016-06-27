<?php
use Epoque\GitHub;


class Daemon
{
    private static $config = [
        'user'  => '',
        'token' => ''
    ];


    /**
     * init
     * 
     * Configures the Dameon object according to a given spec,
     * setting all non-specified data to defaults or empty.
     * 
     * @param assoc_array $spec 
     */
    
    public static function init($spec=[])
    {
        foreach (self::$config as $key => $v) {
            self::$config[$key] = '';
        }
        
        self::config($spec);
    }

    
    /**
     * config
     * 
     * Configures the Dameon object according to a given spec.
     * 
     * @param assoc_array $spec 
     */
    
    public static function config($spec=[])
    {  
        foreach (self::$config  as $key => $v) {
            if (array_key_exists($key, $spec)) {
                self::$config[$key] = $spec[$key];
            }
        }
    }
}

