<?php

namespace App\Repositories;

interface AlbumInterface
{

    public function getCatelogPages($id);
    public function getMenu();
    public function getCoverInfo($id);
    public function getHeader();
    public function getFooter();

}