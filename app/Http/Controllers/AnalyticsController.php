<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AnalyticsService;

class AnalyticsController extends Controller
{

    protected $analyticsService;

    public function __construct(AnalyticsService $analyticsService) {
        $this->analyticsService = $analyticsService;
    }

    public function TopBrowsers($day = 7) {
        return $this->analyticsService->getTopBrowsers($day);
    }

    public function UserTypes($day = 7) {
        return $this->analyticsService->getUserTypes($day);
    }

    public function Visitors($day = 7) {
        return $this->analyticsService->getVisitors($day);
    }

    public function Countries($day = 7) {
        return $this->analyticsService->getCountries($day);
    }

    public function AvgTimeOnPage($day = 7) {
        return $this->analyticsService->getAvgTimeOnPage($day);
    }

}
