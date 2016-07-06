<?php
namespace Epoque\GitHub;


class Daemon
{
    public static $defaults = [
        'url'       => 'https://api.github.com/',
        'user'       => '',
        'token'      => '',
        'user-agent' => 'Googlebot/2.1 (+http://www.google.com/bot.html)'
    ];


    public static $config = [];


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
        foreach (self::$defaults as $key => $val) {
            self::$config[$key] = $val;
        }
        
        foreach ($spec as $key => $val) {
            if (array_key_exists($key, self::$config)) {
                self::$config[$key] = $val;
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
