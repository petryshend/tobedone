<?php

namespace ToBeDoneBundle\Tests\Utils;

use ToBeDoneBundle\Utils\Utils;

class UtilsTest extends \PHPUnit_Framework_TestCase
{
    /** @var Utils */
    private $SUT;

    public function setUp()
    {
        $this->SUT = new Utils();
    }

    public function testHello()
    {
        $this->assertEquals('hello', $this->SUT->hello());
    }
}