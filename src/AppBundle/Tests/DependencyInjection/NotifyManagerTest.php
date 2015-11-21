<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 19/11/2015
 * Time: 8:48 μμ
 */

namespace AppBundle\Tests\DependencyInjection;

require_once(__DIR__ . "/../../../../app/AppKernel.php");

class NotifyManagerTest extends \PHPUnit_Framework_TestCase
{
    protected $_container;
    public function __construct()
    {
        $kernel = new \AppKernel("test", true);
        $kernel->boot();
        $this->_container = $kernel->getContainer();
        parent::__construct();
    }
    protected function get($service)
    {
        return $this->_container->get($service);
    }

    public function testArgumentCheck()
    {
        $notifyManager = $this->get('notify_manager');
        $this->assertTrue($notifyManager->notifyBy());
    }

}
