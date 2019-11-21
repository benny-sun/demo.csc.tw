<?php

namespace App\Admin\Controllers;

use App\Maildata;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;

class MaildataController extends Controller
{
    use ModelForm;

    /**
     * Index interface.
     *
     * @return Content
     */
    public function index()
    {
        return Admin::content(function (Content $content) {

            $content->header('header');
            $content->description('description');

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

            $content->header('header');
            $content->description('description');

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

            $content->header('header');
            $content->description('description');

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
        return Admin::grid(Maildata::class, function (Grid $grid) {
            
            $grid->name('稱呼');
            $grid->contact('聯絡方式');
            $grid->job('職業')->label('warning');
            $grid->message('詢問內容')->display(function($message) {
                return str_limit($message, 28, '...');
            });
            $grid->ip('ip')->label();
            $grid->created_at('訊問時間');

            $grid->disableCreation();
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
        return Admin::form(Maildata::class, function (Form $form) {

            $form->display('name', '稱呼');
            $form->display('contact', '聯絡方式');
            $form->display('job', '職業');
            $form->textarea('message', '詢問內容')->rows(12);
            $form->display('ip', 'ip');
            $form->display('created_at', '訊問時間');

        });
    }
}

