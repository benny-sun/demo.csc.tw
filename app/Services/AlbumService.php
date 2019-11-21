<?php

namespace App\Services;

use App\Repositories\AlbumRepository;

class AlbumService
{

    protected $albumRepo;

    public function __construct(AlbumRepository $albumRepo) {
        $this->albumRepo = $albumRepo;
    }

    public function getOutputs($id) {

        if ($this->isEmptyAlbum($id)) abort(404);

        return [
            'items'         =>      $this->albumRepo->getCatelogPages($id),
            'catelogs'      =>      $this->albumRepo->getMenu(),
            'cover_info'    =>      $this->albumRepo->getCoverInfo($id),
            'header'        =>      $this->albumRepo->getHeader(),
            'footer'        =>      $this->albumRepo->getFooter(),
            'url_id'        =>      $id
        ];
    }

    private function isEmptyAlbum($id) {
        if (count($this->albumRepo->getCatelogPages($id)) == 0) {
            return true;
        } else {
            return false;
        }
    }

}