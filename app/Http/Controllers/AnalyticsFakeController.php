<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class AnalyticsFakeController extends Controller
{

    protected $fakeData;

    public function __construct() {
        $this->fakeData = json_decode(Storage::disk('local')->get('analytics/fakeData.json'), true);
    }

    public function getFakeData()
    {
        return $this->fakeData;
    }

    public function TopBrowsers($day = 7) {
        return $this->fakeData['topBrowsers'][$day];
    }

    public function UserTypes($day = 7) {
        return $this->fakeData['userTypes'][$day];
    }

    public function Visitors($day = 7) {
        return $this->fakeData['visitors'][$day];
    }

    public function Countries($day = 7) {
        return $this->fakeData['countries'][$day];
    }

    public function AvgTimeOnPage($day = 7) {
        return $this->fakeData['avgTimeOnPage'][$day];
    }

}
