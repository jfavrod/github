<?php
namespace Epoque\GitHub;


class Daemon
{
    private static $config = [
        'user'       => '',
        'token'      => '',
        'user-agent' => 'Googlebot/2.1 (+http://www.google.com/bot.html)'
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
            if ($key === 'user-agent')
                self::$config[$key] = 'Googlebot/2.1 (+http://www.google.com/bot.html)';
            else
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
    
    
    /**
     * query
     * 
     * Prepare and send a query to the GitHub API.
     * 
     * @param string $url The API URL to use.
     */
    
    public static function query($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_USERAGENT, self::$config['user-agent']);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($curl, CURLOPT_USERPWD, self::$config['user'].':'.self::$config['token']);
        curl_setopt($curl, CURLOPT_URL, $url);

        $result = curl_exec($curl);
        $result = trim(rtrim(ltrim($result, '['), ']'));
        $result = trim(rtrim(ltrim($result, '{'), '}'));
        $result = explode('},{', $result);
        $result[count($result)-1] = $result[count($result)-1] . '}';
        
        return $result;
    }
}

