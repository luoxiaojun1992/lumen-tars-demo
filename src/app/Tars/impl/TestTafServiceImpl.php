<?php

namespace App\Tars\impl;

use App\Tars\servant\PHPTest\LumenTars\tarsObj\TestTafServiceServant;

class TestTafServiceImpl implements TestTafServiceServant
{
    public function test()
    {
        return 666;
    }
}
