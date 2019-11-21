<?php

namespace Tests\Unit\Repository;

use Tests\TestCase;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\AnalyticsFakeController;

class GoogleAnalyticsTest extends TestCase
{

    /**
     * 產生Google analytics假資料
     * @group Unit/Controllers/GoogleAnalytics
     */
    public function testToGetFakeData()
    {
        $controller = $this->app->make(AnalyticsController::class);
        $file = storage_path('app/analytics/fakeData.json');
        $data = [
            'topBrowsers' => [
                '7' => $controller->TopBrowsers(7),
                '30' => $controller->TopBrowsers(30),
                '120' => $controller->TopBrowsers(120),
                '365' => $controller->TopBrowsers(365),
            ],
            'userTypes' => [
                '7' => $controller->UserTypes(7),
                '30' => $controller->UserTypes(30),
                '120' => $controller->UserTypes(120),
                '365' => $controller->UserTypes(365),
            ],
            'visitors' => [
                '7' => $controller->Visitors(7),
                '30' => $controller->Visitors(30),
                '120' => $controller->Visitors(120),
                '365' => $controller->Visitors(365),
            ],
            'countries' => [
                '7' => $controller->Countries(7),
                '30' => $controller->Countries(30),
                '120' => $controller->Countries(120),
                '365' => $controller->Countries(365),
            ],
            'avgTimeOnPage' => [
                '7' => $controller->AvgTimeOnPage(7),
                '30' => $controller->AvgTimeOnPage(30),
                '120' => $controller->AvgTimeOnPage(120),
                '365' => $controller->AvgTimeOnPage(365),
            ],
        ];
        file_put_contents($file, json_encode($data));
    }

    /**
     * 產生假資料的Controller
     * @group Unit/Controllers/AnalyticsFake
     */
    public function testFakeController()
    {
        $controller = $this->app->make(AnalyticsFakeController::class);
        $result = $controller->TopBrowsers();
        dd($result);
    }
}
