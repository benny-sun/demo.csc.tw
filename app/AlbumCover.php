<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class AlbumCover extends Model implements Sortable
{
    use SoftDeletes, SortableTrait;

    public $sortable = [
        'order_column_name' => 'order',
        'sort_when_creating' => true,
    ];

    public function Catelog() {
        return $this->hasMany('App\Catelog', 'album_covers_id');
    }

}
