<?php

namespace App\Admin\Controllers;

use App\AboutBackground;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Image;

class AboutBackgroundController extends Controller
{
    use ModelForm;

    protected $header = '關於我們(背景圖)';
    protected $description = '管理';
    protected $store_path = 'images/site/about/';

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
        return Admin::grid(AboutBackground::class, function (Grid $grid) {

            $grid->path_small('背景圖')->image('', 300,300);
            $grid->updated_at('上次更新');

            if (AboutBackground::count() > 0) {
                $grid->disableCreation();
            }

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
        return Admin::form(AboutBackground::class, function (Form $form) {

            $form->image('path', '背景圖')->move($this->store_path)->uniqueName()->rules('required');
            $form->hidden('path_small');
            $form->hidden('filename');
            $form->hidden('filesize');
            $form->saving(function($form) {
                $store_path_sm = 'uploads/'.$this->store_path.'small/';
                if ($form->path) {
                    
                    $form->filename = $form->path->getClientOriginalName();
                    $form->filesize = $form->path->getClientSize();
                    $form->path_small = $this->store_path . 'small/' . $this->uniqueName($form->path);

                    if (!file_exists($store_path_sm)) {
                        mkdir($store_path_sm, 0600, true);
                    }
                    /* 製造縮圖 */
                    $img = Image::make($form->path->getPathname());
                    $img->resize(200, null, function ($constraint) {
                        $constraint->aspectRatio();
                    });
                    $img->save('uploads/' . $form->path_small);
                }
            });

            $form->disableReset();

        });
    }

    private function uniqueName($file) {
        return md5(uniqid()).'.jpg';
    }
}
