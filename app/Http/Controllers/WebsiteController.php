<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Header;
use App\Honor;
use App\About;
use App\AboutBackground;
use App\Welcome;
use App\Partner;
use App\AlbumCover;

class WebsiteController extends Controller
{
    public function index() {
        
        $sliders = Header::select('title', 'describe', 'path')
                            ->where('visible', '=', 1)
                            ->orderBy('order', 'asc')
                            ->get();

        $cases = Honor::select('title', 'describe')
                        ->where('visible', '=', 1)
                        ->orderBy('order', 'asc')
                        ->get();

        $abouts = About::select('title', 'describe')
                        ->where('visible', '=', 1)
                        ->orderBy('order', 'asc')
                        ->get();

        $about_bg = AboutBackground::select('path')->first();

        $welcome = Welcome::select('path')
                            ->where('visible', '=', 1)
                            ->orderBy('order', 'asc')
                            ->get();

        $partners = Partner::select('path', 'title')
                            ->where('visible', '=', 1)
                            ->orderBy('order', 'asc')
                            ->get();

        $albumcover = AlbumCover::where('visible', '=', 1)
                                ->orderBy('order', 'asc')
                                ->get();
        
        /*
         * 2017/12/15
         * 產品沒上傳的話不導向到型錄
         */
        foreach ($albumcover as $row) {
            
            $row['light_box'] = '';
            $subitem = count(AlbumCover::find($row->id)->Catelog);
            if (! $subitem) {
                $row['url'] = 'uploads/'.$row->img;
                $row['light_box'] = 'data-lightbox="image-1"';
            } else {
                $row['url'] = 'catelogs/'.$row->id;
            }

        }

        $output = [
            'sliders' => $sliders,
            'cases' => $cases,
            'abouts' => $abouts,
            'about_bg' => $about_bg,
            'welcome' => $welcome,
            'partners' => $partners,
            'albumcover' => $albumcover
        ];

        return view('layout.official', $output);
    }
}
