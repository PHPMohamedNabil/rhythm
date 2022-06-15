<?php

namespace App\DataTables;

use App\Models\Page;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PagesDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action',function($data){
                      return view('admin.pages.btn_edit',['data'=>$data]);
            })->addColumn('published',function($data){
                 return view('admin.pages.publish',['data'=>$data]);
            })->editColumn('created_at',function($data){
                   return date('Y-m-d',strtotime($data->created_at));

            })->editColumn('updated_at',function($data){
                    return date('Y-m-d h:i',strtotime($data->updated_at));
            })->addColumn('user',function($data){
                if($data->user)
                {
                    return $data->user->username;
                }
                return null;
            })->addColumn('category',function($data){
                if($data->category)
                {
                    return $data->category->name;
                }
                return null;
            })
            ->addColumn('checkbox',function($data){
                 return view('admin.pages.check_all',['data'=>$data]);
            });

    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Page $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Page $model)
    {
        return $model::with('user','category')->where('is_history',0);
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
       
        return $this->builder()
                    ->setTableId('pages-table')
                    ->columns($this->getColumns())
                    ->parameters([ 'dom' => 'Blfrtip','buttons' => ['reload'],
                    ])
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
    'title'          =>'<input type="checkbox" id="checkall" name="check_all"/>',
    'data'           => 'checkbox',
    'name'           => 'checkbox',
    'orderable'      => false,
    'searchable'     => false,
    'exportable'     => false,
    'printable'      => true,
    'width'          => '10px',
],
            Column::make('id')->width('20px'),
            Column::make('title'),
            Column::make('published'),
            Column::make('created_at')->width('90px'),
            ['data'=>'user','name'=>'user.username','title'=>'Author','width'=>'50px'],  
             ['data'=>'category','name'=>'category.name','title'=>'Category','width'=>'50px'],  
            Column::make('action'),
        ];

    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Pages_' . date('YmdHis');
    }
}
