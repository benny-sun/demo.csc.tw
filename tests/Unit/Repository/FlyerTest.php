<?php

namespace Tests\Unit\Repository;

use Tests\TestCase;
use App\Repositories\FlyerRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class FlyerTest extends TestCase
{

    use DatabaseTransactions;

    /**
     * @group Unit/Repository/Flyer
     */
    public function testGetInfo()
    {
        $repo = $this->app->make(FlyerRepository::class);
        $actual = $repo->getInfo();
        dd($actual);
    }
}
