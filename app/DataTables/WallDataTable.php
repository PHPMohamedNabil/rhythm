<?php

namespace App\DataTables;

use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use App\Models\Wall;


class WallDataTable extends DataTable
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
                   return view('admin.wall.edit_btn',['data'=>$data]);
            })->editColumn('is_important',function($data){
                    return view('admin.wall.imporatnt_btn',['data'=>$data]);
            })->editColumn('created_at',function($data){
                   return date('Y-m-d',strtotime($data->created_at));
            })->addColumn('user',function($data){
                   if($data->user)
                   {
                     return $data->user->username;
                   }
                   return null;
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\wall $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Wall $model)
    {
        return $model::with('user');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('wall-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Blfrtip')
                    ->orderBy(1)
                    ->parameters([ 'dom' => 'Blfrtip','buttons' => ['export', 'print', 'reset', 'reload'],
                    ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('title'),
            Column::make('is_important'),
            ['data'=>'user','name'=>'user.name','title'=>'Author'],
            Column::make('created_at'),
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
        return 'wall_' . date('YmdHis');
    }
}
