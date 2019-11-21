<?php

namespace App\Http\Controllers;

use App\Services\FlyerService;

class FlyerController extends Controller
{

    protected $flyerService;

    public function __construct(FlyerService $flyerService)
    {
        $this->flyerService = $flyerService;
    }

    public function index()
    {
        return view('layout.flyer', [
            'cover' => $this->flyerService->getCover(), // 封面
            'collection' => $this->flyerService->getContents(), // 內頁
            'coverBack' => $this->flyerService->getCoverBack(), // 封底
        ]);
    }
}
