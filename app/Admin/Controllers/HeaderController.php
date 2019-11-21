<?php

namespace App\Admin\Controllers;

use App\Header;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Image;

class HeaderController extends Controller
{
    use ModelForm;

    protected $header = '形象大圖';
    protected $store_path = 'images/site/sliders';
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
            $content->description('管理');

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

            $page = Header::where('id', $id)->first()->order;

            $content->header($this->header);
            $content->description('第 '.$page.' 張');

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
            $content->description('新增');

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
        return Admin::grid(Header::class, function (Grid $grid) {

            $grid->order('順序')->orderable();
            $grid->title('主標');
            $grid->describe('次標');
            $grid->path_small('形象圖')->image('', 200,100);      
            $grid->visible('可見')->switch(static::$states);
            $grid->updated_at('上次更新');
            $grid->model()
                ->orderBy('order', 'asc')
                ->orderBy('created_at', 'desc');
            
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
        return Admin::form(Header::class, function (Form $form) {
            
            $form->text('title', '主標')->rules('required');
            $form->text('describe', '次標')->rules('required');
            $form->switch('visible', '可見')->states(static::$states)->value(1);
            $form->image('path', '形象圖')->move($this->store_path)->uniqueName()->rules('required');
            $form->hidden('path_small');
            $form->hidden('filename');
            $form->hidden('filesize');
            $form->saving(function($form) {
                $store_path_sm = 'uploads/'.$this->store_path.'/small/';
                if ($form->path) {
                    
                    $form->filename = $form->path->getClientOriginalName();
                    $form->filesize = $form->path->getClientSize();
                    $form->path_small = $this->store_path.'/small/' . $this->uniqueName($form->path);

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
        return md5(uniqid()).'.'.$file->getClientOriginalExtension();
    }
}
