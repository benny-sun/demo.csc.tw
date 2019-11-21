<?php

namespace App\Admin\Controllers;

use App\Contact;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class ContactController extends Controller
{
    use ModelForm;

    protected $header = '聯絡我們';
    protected $description = '信箱管理';
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
        return Admin::grid(Contact::class, function (Grid $grid) {

            $grid->email('信箱')->editable();
            $grid->active('啟動')->switch(static::$states);
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
        return Admin::form(Contact::class, function (Form $form) {

            $form->text('email', '信箱')->rules('required');
            $form->switch('active', '啟動')->states(static::$states)->value(1);
            
            $form->disableReset();

        });
    }

    public function mails() {
        return Admin::content(function (Content $content) {
            
            $content->header($this->header);
            $content->description($this->description);

            $content->body($this->mailgrid());

        });
    }

    protected function mailgrid() {
        return Admin::grid(Maildata::class, function (Grid $grid) {
            
            $grid->name('稱呼');
            $grid->contact('聯絡方式');
            $grid->job('職業');
            $grid->message('詢問內容');

            // $grid->disableCreation();
            $grid->disableExport();
            $grid->disablePagination();
            $grid->disableFilter();
            $grid->disableRowSelector();

        });
    }
}
