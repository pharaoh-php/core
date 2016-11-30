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
     * @covers ::getStartTime
     * @covers ::isProfilerEnabled
     */
    public function testConstructor()
    {
        $profile = true;
        $name    = 'PharaohTest';
        $config  = $this->createMock(ConfigInterface::class);

        $pharaoh = new PharaohForTest($config, $name, $profile);

        $this->assertEquals($profile, $pharaoh->isProfilerEnabled());
        $this->assertFalse($pharaoh->isBooted());
        $this->assertLessThan(microtime(true), $pharaoh->getStartTime());
    }

    /**
     * @covers ::__clone
     * @covers ::getStartTime
     * @covers ::isProfilerEnabled
     *
     * @uses \Pharaoh\Pharaoh::__construct
     */
    public function testClone()
    {
        $profile = true;
        $name    = 'PharaohTest';
        $config  = $this->createMock(ConfigInterface::class);

        $pharaoh = new PharaohForTest($config, $name, $profile);

        $clone = clone $pharaoh;

        $this->assertEquals($profile, $clone->isProfilerEnabled());
        $this->assertFalse($clone->isBooted());
        $this->assertLessThan(microtime(true), $clone->getStartTime());
        $this->assertLessThan($clone->getStartTime(), $pharaoh->getStartTime());
    }

    /**
     * @covers ::getConfigDirectory
     *
     * @uses \Pharaoh\Pharaoh::__construct
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

    /**
     * @covers ::getCacheDirectory
     *
     * @uses \Pharaoh\Pharaoh::__construct
     */
    public function testGetCacheDirectory()
    {
        $profile = true;
        $name    = 'PharaohTest';
        $config  = $this->createMock(ConfigInterface::class);

        $cacheDir = 'CacheDirectory';

        $config
            ->expects($this->once())
            ->method('getCacheDirectory')
            ->will($this->returnValue($cacheDir))
        ;

        $pharaoh = new PharaohForTest($config, $name, $profile);

        $this->assertEquals($cacheDir, $pharaoh->getCacheDirectory());
    }

    /**
     * @covers ::getLogDirectory
     *
     * @uses \Pharaoh\Pharaoh::__construct
     */
    public function testGetLogDirectory()
    {
        $profile = true;
        $name    = 'PharaohTest';
        $config  = $this->createMock(ConfigInterface::class);

        $logDir = 'LogDirectory';

        $config
            ->expects($this->once())
            ->method('getLogDirectory')
            ->will($this->returnValue($logDir))
        ;

        $pharaoh = new PharaohForTest($config, $name, $profile);

        $this->assertEquals($logDir, $pharaoh->getLogDirectory());
    }
}
