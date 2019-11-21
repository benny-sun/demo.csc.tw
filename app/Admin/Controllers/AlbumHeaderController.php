<?php

namespace App\Admin\Controllers;

use App\AlbumHeader;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Image;

class AlbumHeaderController extends Controller
{
    use ModelForm;

    protected $header = '頁首&頁尾';
    protected $description = '管理';
    protected $store_path = 'images/album/catelog/header';
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
        return Admin::grid(AlbumHeader::class, function (Grid $grid) {

            $grid->status('頁首或頁尾')->display(function ($status){
                $output = [1 => '頁首', 2 => '頁尾'];
                $color = [1 => 'success', 2 => 'warning'];
                return "<span class='label label-$color[$status]'>$output[$status]</span>";
            });

            $grid->title('左上Title')->image('', 200,100);
            $grid->logo('左下Logo')->image('', 200,100);
            $grid->xs_img('封面/封底')->image('', 200,100);
            $grid->visible('可見')->switch(static::$states);
            $grid->updated_at('上次更新');

            $grid->disableExport();
            $grid->disablePagination();
            $grid->disableFilter();
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
        return Admin::form(AlbumHeader::class, function (Form $form) {

            $form->select('status', '產品類型')
                    ->options([1 => '頁首', 2 => '頁尾'])
                    ->rules('required');
            $form->image('title', '左上Title')->move($this->store_path)->uniqueName();
            $form->image('logo', '左下Logo')->move($this->store_path)->uniqueName();
            $form->image('img', '封面/封底')->move($this->store_path)->uniqueName()->rules('required');
            $form->switch('visible', '可見')->states(static::$states)->value(1);
            $form->hidden('xs_img');

            $form->saving(function($form) {
                $xs_path = $this->store_path.'/xs/';
                if ($form->img) {
                    $form->xs_img = $xs_path . $this->saveXsImg($form->img, $xs_path);
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
