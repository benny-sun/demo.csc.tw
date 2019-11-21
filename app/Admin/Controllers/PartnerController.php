<?php

namespace App\Admin\Controllers;

use App\Partner;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class PartnerController extends Controller
{
    use ModelForm;

    protected $header = '合作夥伴';
    protected $description = '管理';
    protected $store_path = 'images/site/partners';
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
        return Admin::grid(Partner::class, function (Grid $grid) {

            $grid->order('順序')->orderable();
            $grid->title('合作的公司');
            $grid->path('Logo小圖')->image('', 100,100);  
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
        return Admin::form(Partner::class, function (Form $form) {

            $form->text('title', '合作的公司')->rules('required');
            $form->switch('visible', '可見')->states(static::$states)->value(1);
            $form->image('path', 'Logo小圖')->move($this->store_path)->uniqueName()->rules('required');
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
