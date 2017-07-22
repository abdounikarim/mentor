<?php
/**
 * Created by PhpStorm.
 * User: aigie
 * Date: 22/07/2017
 * Time: 11:43
 */

namespace MentorBundle\Services;


class Pagination
{
    public function paginate($page, $route, $itemCount, $itemPerPage)
    {
        return [
            'page' => $page,
            'route' => $route,
            'pages_count' => ceil($itemCount / $itemPerPage),
            'route_params' => array()
        ];
    }
}
