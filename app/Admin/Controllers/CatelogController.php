<?php

namespace App\Admin\Controllers;

use App\Catelog;
use App\AlbumCover;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Request;
use Image;

class CatelogController extends Controller
{
    use ModelForm;

    protected $header = '型錄';
    protected $description = '管理';
    protected $store_path = 'images/album/catelog';
    protected static $states = [
        'on'  => ['value' => 1, 'text' => '是', 'color' => 'success'],
        'off' => ['value' => 0, 'text' => '否', 'color' => 'danger'],
    ];

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header($this->header);
            $content->description($this->description);

            $content->body($this->grid());
        });
    }

    /**
     * Edit interface.
     *
     * @param $id
     * @return Content
     */
    public function edit($id)
    {
        return Admin::content(function (Content $content) use ($id) {

            $content->header($this->header);
            $content->description($this->description);

            $content->body($this->form()->edit($id));
        });
    }

    /**
     * Create interface.
     *
     * @return Content
     */
    public function create()
    {
        return Admin::content(function (Content $content) {

            $content->header($this->header);
            $content->description($this->description);

            $content->body($this->form());
        });
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        return Admin::grid(Catelog::class, function (Grid $grid) {


            $grid->column('album.title', '類型')->display(function($title) {
                return str_limit($title, 10, '...');
            })->label();
            $grid->order('順序')->editable();
            $grid->title('標題')->editable();
            $grid->xs_main_img('大圖')->image('', 200,100);
            $grid->xs_sub_img('小圖')->image('', 200,100);
            $grid->visible('可見')->switch(static::$states);
            $grid->updated_at('上次更新');
            $grid->model()
                    ->join('album_covers as album', 'album.id', '=', 'catelogs.album_covers_id')
                    ->select('catelogs.*')
                    ->orderBy('album.order')
                    ->orderBy('catelogs.order');
            
            $grid->filter(function($filter){

                $filter->disableIdFilter();
            
                $filter->equal('album.id', '類型')
                        ->select(AlbumCover::orderBy('order')
                        ->pluck('title', 'id'));
            
            });
            
            
            $grid->disableExport();
            $grid->disableRowSelector();

        });
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        return Admin::form(Catelog::class, function (Form $form) {

            $form->select('album_covers_id', '產品類型')
                ->options(AlbumCover::orderBy('order')->pluck('title', 'id'))
                ->rules('required');
            $form->select('templates', '版型')
                ->options([
                    1 => '版型1(左右排版，說明+1半圖+1小圖)',
                    2 => '版型2(左右排版，說明+1半圖)',
                    3 => '版型3(左右排版，2半圖)',
                    4 => '版型4(全幅排版，說明+1全圖)',
                ])
                ->rules('required');
            $form->text('title', '主標');
            $form->text('subtitle', '次標');
            $form->textarea('content', '內文')->rows(12);
            $form->image('main_img', '大圖')->move($this->store_path)->uniqueName()->rules('required');
            $form->image('sub_img', '小圖')->move($this->store_path)->uniqueName();
            $form->image('detail', '尺寸圖')->move($this->store_path . '/detail')->uniqueName();
            $form->switch('visible', '可見')->states(static::$states)->value(1);
            $form->hidden('xs_main_img');
            $form->hidden('xs_sub_img');
            $form->hidden('order');

            $form->saving(function($form) {

                $xs_path = $this->store_path.'/xs/';
                if ($form->main_img) {
                    $form->xs_main_img = $xs_path . $this->saveXsImg($form->main_img, $xs_path);
                    if ($form->sub_img) {
                        $form->xs_sub_img = $xs_path . $this->saveXsImg($form->sub_img, $xs_path);
                    }
                }

                if (Request::method() === 'POST') {
                    $aid = $form->album_covers_id;
                    $order = Catelog::where('album_covers_id', '=', $aid)->orderBy('order')->pluck('order')->pop();
                    $form->order = $order + 1;
                }
                
            });

        });
    }

    /*
     * 2017/12/10
     * 目的: 儲存縮圖 
     * return 縮圖檔名
     * 
     * @src 圖片來源
     * @path 儲存的路徑
     * 
     */
    private function saveXsImg($src, $path) {
        $filename = $this->uniqueName();
        $path = 'uploads/'.$path;
        if (!file_exists($path)) {
            mkdir($path, 0600, true);
        }
        /* 製造縮圖 */
        $img = Image::make($src->getPathname());
        $img->resize(200, null, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path . $filename);

        return $filename;
    }

    /*
     * 2017/12/10
     * 目的: 產生亂數檔名
     */
    private function uniqueName() {
        return md5(uniqid()).'.jpg';
    }
}
