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

use Pharaoh\Tests\Fixtures\PharaohForTest;

class PharaohTest extends \PHPUnit_Framework_TestCase
{
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
}
