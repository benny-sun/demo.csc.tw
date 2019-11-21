<?php

namespace App\Repositories;

use App\Repositories\AlbumInterface;
use App\AlbumHeader;
use App\AlbumCover;
use App\Catelog;

class AlbumRepository implements AlbumInterface
{
    
    protected $header, $footer, $cover, $pages;
    public function __construct(AlbumHeader $header, AlbumCover $cover, Catelog $pages) {
        $this->header = $header;
        $this->footer = $header;
        $this->cover = $cover;
        $this->pages = $pages;
    }

    public function getCatelogPages($id) {
        $result = $this->pages
                        ->where([['album_covers_id', $id],['visible', 1]])
                        ->orderBy('order')
                        ->get();

        if (count($result) == 0) {
            abort(404);
        } else {
            return $result;
        }
    }
        
    public function getMenu() {
        return $this->cover
                    ->join('catelogs', 'catelogs.album_covers_id', '=', 'album_covers.id')
                    ->select('album_covers.id', 'album_covers.title', 'album_covers.order')
                    ->where('album_covers.visible', 1)
                    ->groupBy('album_covers.id')
                    ->orderBy('album_covers.order')
                    ->get();
    }

    public function getCoverInfo($id) {
        return $this->cover->find($id);
    }

    public function getHeader() {
        return $this->header
                    ->where([['visible', 1], ['status', 1]])
                    ->first();
    }

    public function getFooter() {
        return $this->header
                    ->where([['visible', 1], ['status', 2]])
                    ->first();
    }

}