<?php

namespace App\Services;

use App\Repositories\FlyerRepository;

class FlyerService
{

    protected $flyerRepo;

    public function __construct(FlyerRepository $flyerRepo)
    {
        $this->flyerRepo = $flyerRepo;
        $this->info = $this->flyerRepo->getInfo();
        $this->cover = $this->info->shift();
        $this->coverBack = $this->info->pop();
    }

    public function getContents()
    {
        return $this->info;
    }

    public function getCover()
    {
        return $this->cover;
    }

    public function getCoverBack()
    {
        return $this->coverBack;
    }
}
