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
        $url = 'https://api.github.com/user/repos';
        
        self::buildQuery($url, $params);
        $queryResult = Daemon::query($url);
        
        foreach ($queryResult as $repo) {
            array_push($repos, json_decode('{'.$repo.'}'));
        }
        
        return $repos;
    }
}
