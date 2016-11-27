<?php

namespace Pharaoh\Tests\Fixtures;

use Pharaoh\Pharaoh;

class PharaohForTest extends Pharaoh
{

    public function isBooted()
    {
        return $this->booted;
    }
}
