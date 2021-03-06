<?php

namespace App\Admin\Controllers;

use App\Honor;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class HonorController extends Controller
{
    use ModelForm;

    protected $header = '實際案例';
    protected $description = '管理';
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
        return Admin::grid(Honor::class, function (Grid $grid) {

            $grid->order('順序')->orderable();
            $grid->title('主標');
            $grid->describe('次標');
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
        return Admin::form(Honor::class, function (Form $form) {

            $form->text('title', '主標')->rules('required');
            $form->text('describe', '次標')->rules('required');
            $form->switch('visible', '可見')->states(static::$states)->value(1);
            
        });
    }
}
