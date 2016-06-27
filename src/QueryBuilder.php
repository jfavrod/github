<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Epoque\GitHub;

/**
 * Description of QueryBuilder
 *
 * @author jason favrod <jason@epoquecorportation.com>
 */
abstract class QueryBuilder
{
    /**
     * buildQuery
     * 
     * @param type $url
     * @param type $params
     */

    public static function buildQuery(&$url='', &$params=[]) {
        if (!empty($params)) {
            foreach ($params as $param => $value) {
                $url .= "?$param=$value";
            }
        }
    }
    
}
