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
    /**
     * @param $id
     * @return boolean
     * Checks if the given id is valid
     */
    public function checkId($id)
    {
        if (!is_numeric($id)) {
            return false;
        }
        if ($id <= 0) {
            return false;
        }
        return true;
    }
}
