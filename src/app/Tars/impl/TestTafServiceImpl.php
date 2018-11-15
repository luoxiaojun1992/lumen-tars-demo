<?php

namespace App\Tars\impl;

use App\Tars\servant\PHPTest\PHPServer\obj\TestTafServiceServant;

class TestTafServiceImpl implements TestTafServiceServant
{
    public function test()
    {
        return 666;
    }
}
