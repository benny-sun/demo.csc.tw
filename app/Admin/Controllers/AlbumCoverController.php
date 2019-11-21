<?php

namespace App\Admin\Controllers;

use App\AlbumCover;

use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Content;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\ModelForm;
use Carbon\Carbon;
use DB;

class AlbumCoverController extends Controller
{
    use ModelForm;

    protected $header = '產品封面';
    protected $description = '管理';
    protected $store_path = 'images/album/covers';
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
        return Admin::grid(AlbumCover::class, function (Grid $grid) {

            $grid->order('順序')->orderable();
            $grid->img('封面')->image('', 200,100);
            $grid->title('主標')->display(function($title) {
                return str_limit($title, 14, '...');
            });
            $grid->subtitle('次標')->display(function($subtitle) {
                return str_limit($subtitle, 10, '...');
            });
            $grid->logo('小Logo')->image('', 200,100);
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
        return Admin::form(AlbumCover::class, function (Form $form) {

            $form->image('img', '封面')->move($this->store_path.'/img')->uniqueName()->rules('required');
            $form->text('title', '主標')->rules('required');
            $form->text('subtitle', '次標')->rules('required');
            $form->image('logo', '小Logo')->move($this->store_path.'/logo')->uniqueName()->rules('required');
            $form->switch('visible', '可見')->states(static::$states)->value(1);
            $form->hidden('filename');
            $form->hidden('filesize');
            $form->saving(function($form) {
                if ($form->img) {
                    $form->filename = $form->img->getClientOriginalName();
                    $form->filesize = $form->img->getClientSize();
                }
            });

            $form->disableReset();
        });
    }
    
    private function addMenu($title) {

        /* ---取得型錄分類(大類id=22)最後一筆的排序--- */
        $query = DB::table('admin_menu')->select('order')->where('parent_id', '=', 22)->orderBy('order', 'desc')->first();
        $order = $query->order + 1;

        /* ---新增到選單列表及角色列表--- */
        $id = DB::table('admin_menu')->insertGetId([
            'parent_id' => 22,
            'order' => $order,
            'title' => $title,
            'icon' => 'fa-bookmark-o',
            'uri' => 'album/covers',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('admin_role_menu')->insert([
            'role_id' => 2,
            'menu_id' => $id
        ]);
    }
}
