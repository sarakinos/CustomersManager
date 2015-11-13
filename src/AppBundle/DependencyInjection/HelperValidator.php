<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 27/10/2015
 * Time: 7:56 μμ
 */

namespace AppBundle\DependencyInjection;

class HelperValidator
{
    public function checkId($id)
    {
        if ($id<0) {
            return false;
        }
        return true;
    }
}
