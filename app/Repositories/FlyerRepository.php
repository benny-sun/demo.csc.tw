<?php

namespace App\Repositories;

use App\Flyer;

class FlyerRepository
{

    protected $flyer;

    public function __construct(Flyer $flyer)
    {
        $this->flyer = $flyer;
    }

    public function getInfo()
    {
        return $this->flyer
            ->select('title', 'describe', 'path', 'link')
            ->where('visible', 1)
            ->orderBy('order')
            ->get();
    }
}
