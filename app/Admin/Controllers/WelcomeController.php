<?php

namespace App\Admin\Controllers;

use App\Welcome;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class WelcomeController extends Controller
{
    use ModelForm;

    protected $header = 'Welcome Logo圖';
    protected $description = '管理';
    protected $store_path = 'images/site/welcome';
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
        return Admin::grid(Welcome::class, function (Grid $grid) {

            $grid->order('順序')->orderable();
            $grid->filename('檔名');
            $grid->path('Logo圖')->image('', 200,100);
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
        return Admin::form(Welcome::class, function (Form $form) {

            $form->image('path', '形象圖')->move($this->store_path)->uniqueName()->rules('required');
            $form->switch('visible', '可見')->states(static::$states)->value(1);
            $form->hidden('filename');
            $form->hidden('filesize');
            $form->saving(function($form) {
                if ($form->path) {
                    $form->filename = $form->path->getClientOriginalName();
                    $form->filesize = $form->path->getClientSize();
                }
            });

            $form->disableReset();

        });
    }
}
