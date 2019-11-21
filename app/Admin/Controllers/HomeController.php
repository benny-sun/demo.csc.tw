<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Widgets\Box;
use Encore\Admin\Widgets\Table;
use Illuminate\Http\Request;
use Route;

class HomeController extends Controller
{
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('訪客分析');
            $content->description('網站資料');

            $content->row(function (Row $row) {

                $row->column(4, function (Column $column) {
                    $column->append(new Box('瀏覽器', view('admin.charts.pie-browsers')));
                });
                
                $row->column(4, function (Column $column) {
                    $column->append(new Box('訪客量', view('admin.charts.line-vistors')));
                });

                $row->column(4, function (Column $column) {
                    $column->append(new Box('新舊訪客', view('admin.charts.pie-user')));
                });

                $row->column(4, function (Column $column) {
                    $column->append(new Box('國家 / 地區', view('admin.charts.pie-countries')));
                });

                
                $row->column(4, function (Column $column) {
                    $week = Request::create('/api/analytics/avg-time-on-page/7', 'GET');
                    $month = Request::create('/api/analytics/avg-time-on-page/30', 'GET');
                    $season = Request::create('/api/analytics/avg-time-on-page/120', 'GET');
                    $year = Request::create('/api/analytics/avg-time-on-page/365', 'GET');

                    $headers = ['期間', '平均停留時間 (秒)'];
                    $rows = [
                        ['週', Route::dispatch($week)->original],
                        ['月', Route::dispatch($month)->original],
                        ['季', Route::dispatch($season)->original],
                        ['年', Route::dispatch($year)->original]
                    ];
                    $table = new Table($headers, $rows);
                    $column->append(new Box('訪客停留時間', $table));
                });

            });

        });
    }
}
