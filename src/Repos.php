<?php

namespace Epoque\GitHub;
use Epoque\GitHub\Daemon;
use Epoque\GitHub\QueryBuilder;


/**
 * Description of Repos
 *
 * @author jason favrod <jason@epoquecorportation.com>
 */

class Repos extends QueryBuilder
{   
    /**
     * enumerate
     * 
     * Return a list of user repositories.
     * 
     * @param assoc_array $params Key value pairs for optional API
     * parameters.
     * 
     * @return array Contains the repos as StdObjects.
     */
    
    public static function enumerate($params=[])
    {
        $repos = [];
        $url = Daemon::$config['url'].'user/repos';
        
        self::buildQuery($url, $params);
        $queryResult = Daemon::query($url);
        
        foreach ($queryResult as $repo) {
            array_push($repos, json_decode('{'.$repo.'}'));
        }
        
        return $repos;
    }


    /**
     * branches
     * 
     * Return an array of branches of the given repo.
     * 
     * @param string $repo The name of the given repo.
     * @param array
     * 
     * @return array Contains the branches as StdObjects.
     */
    
    public static function branches($repo, $params=[])
    {
        $branches = [];
        $url = Daemon::$config['url'] . 'repos/';
        $url .= Daemon::$config['user'] . "/$repo/branches";
        
        self::buildQuery($url, $params);
        $queryResult = Daemon::query($url);
        
        foreach ($queryResult as $branch) {
            array_push($branches, json_decode("{ $branch }"));
        }
        
        return $branches;
    }


    public static function commits($repo='', $params=[])
    {
        $commits = [];
        $url = Daemon::$config['url'] . 'repos/';
        $url .= Daemon::$config['user'] . "/$repo/commits";
        
        self::buildQuery($url, $params);
        $queryResult = Daemon::query($url);
        
        return $queryResult;
    }
}
