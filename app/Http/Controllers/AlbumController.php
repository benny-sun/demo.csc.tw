<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AlbumService;

class AlbumController extends Controller
{

    protected $albumService;

    public function __construct(AlbumService $albumService) {
        $this->albumService = $albumService;
    }

    public function index($id) {

        return view('includes.album.contents', $this->albumService->getOutputs($id));

    }
}
