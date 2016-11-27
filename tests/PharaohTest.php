<?php

namespace Pharaoh\Tests;

use Pharaoh\Tests\Fixtures\PharaohForTest;

class PharaohTest extends \PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $profile = true;
        $name = 'PharaohTest';
        $config = $this->createMock('Pharaoh\Config\ConfigInterface');

        $pharaoh = new PharaohForTest($config, $name, $profile);

        $this->assertEquals($profile, $pharaoh->isProfilerEnabled());
        $this->assertFalse($pharaoh->isBooted());
        $this->assertLessThanOrEqual(microtime(true), $pharaoh->getStartTime());
    }
}
