<?php

namespace App\Services;

use Spatie\Analytics\Analytics;
use Spatie\Analytics\Period;

class AnalyticsService
{

    private $analytics;

    public function __construct(Analytics $analytics) {
        $this->analytics = $analytics;
    }

    public function getTopBrowsers($day) {
        $info = $this->analytics->fetchTopBrowsers(Period::days( $day ));
        $browser = array();
        $sessions = array();
        foreach($info as $item) {
            $browser[] = $item['browser'];
            $sessions[] = $item['sessions'];
        }
        return [$browser, $sessions];
    }

    public function getUserTypes($day) {
        $info = $this->analytics->fetchUserTypes(Period::days( $day ));
        $sessions = array();
        $types = array();
        $translate = [
            'New Visitor' => '新訪客',
            'Returning Visitor' => '舊訪客'
        ];
        foreach($info as $item) {
            $types[] = $translate[ $item['type'] ];
            $sessions[] = $item['sessions'];
        }
        return [$types, $sessions];
    }

    public function getVisitors($day) {
        $info = $this->analytics->fetchTotalVisitorsAndPageViews(Period::days( $day ));
        $date = array();
        $visitors = array();
        foreach($info as $item) {
            $date[] = $item['date']->formatLocalized('%Y/%d');
            $visitors[] = $item['visitors'];
        }
        return [$date, $visitors];
    }

    public function getCountries($day) {
        $period = Period::days( $day );
        $metrics = 'ga:sessions';
        $other = [
            'dimensions' => 'ga:country',
            'sort' => '-ga:sessions'
        ];
        $info = $this->analytics->performQuery($period, $metrics, $other);

        $countries = collect($info['rows'] ?? [])->map(function (array $dateRow) {
            return $dateRow[0];
        });
        $sessions = collect($info['rows'] ?? [])->map(function (array $dateRow) {
            return $dateRow[1];
        });

        return [$countries, $sessions];
    }

    public function getAvgTimeOnPage($day) {
        $period = Period::days( $day );
        $session_duration = $this->getGaSessions($period, 'ga:sessionDuration');
        $sessions = $this->getGaSessions($period, 'ga:sessions');
        $avg_time = round($session_duration/$sessions, 2);
        return $avg_time;
    }

    protected function getGaSessions($period, $metrics) {
        $info = $this->analytics->performQuery($period, $metrics);
        $result = $info->rows[0][0];
        return $result;
    }

}