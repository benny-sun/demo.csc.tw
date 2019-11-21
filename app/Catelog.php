<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Catelog extends Model
{
    use SoftDeletes;

    public function album() {
        return $this->belongsTo('App\AlbumCover', 'album_covers_id');
    }
}
