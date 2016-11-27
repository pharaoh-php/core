<?php declare(strict_types=1);

/*
 * This file is part of Pharaoh.
 *
 * (c) Steve Buzonas <steve@fancyguy.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Pharaoh\Tests;

use Pharaoh\Config\ConfigInterface;
use Pharaoh\Tests\Fixtures\PharaohForTest;

/**
 * @coversDefaultClass \Pharaoh\Pharaoh
 */
class PharaohTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     */
    public function testConstructor()
    {
        $profile = true;
        $name    = 'PharaohTest';
        $config  = $this->createMock('Pharaoh\Config\ConfigInterface');

        $pharaoh = new PharaohForTest($config, $name, $profile);

        $this->assertEquals($profile, $pharaoh->isProfilerEnabled());
        $this->assertFalse($pharaoh->isBooted());
        $this->assertLessThanOrEqual(microtime(true), $pharaoh->getStartTime());
    }

    /**
     * @covers ::__clone
     */
    public function testClone()
    {
        $profile = true;
        $name    = 'PharaohTest';
        $config  = $this->createMock('Pharaoh\Config\ConfigInterface');

        $pharaoh = new PharaohForTest($config, $name, $profile);

        $clone = clone $pharaoh;

        $this->assertEquals($profile, $clone->isProfilerEnabled());
        $this->assertFalse($clone->isBooted());
        $this->assertLessThanOrEqual(microtime(true), $clone->getStartTime());
        $this->assertLessThan($clone->getStartTime(), $pharaoh->getStartTime());
    }

    /**
     * @covers ::getConfigDirectory
     */
    public function testGetConfigDirectory()
    {
        $profile = true;
        $name    = 'PharaohTest';
        $config  = $this->createMock(ConfigInterface::class);

        $configDir = 'ConfigDirectory';

        $config
            ->expects($this->once())
            ->method('getConfigDirectory')
            ->will($this->returnValue($configDir))
        ;

        $pharaoh = new PharaohForTest($config, $name, $profile);

        $this->assertEquals($configDir, $pharaoh->getConfigDirectory());
    }
}
