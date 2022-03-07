<?php

namespace App\DataTables;

use App\Models\ShortCut;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ShortCutDataTable extends DataTable
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
                   return view('admin.shortcut.edit_btn',['data'=>$data]);
            })->addColumn('user',function($data){
                   if($data->user)
                   {
                     return $data->user->username;
                   }
                   return null;
            })->editColumn('created_at',function($data){
                
                return date('Y-m-d',strtotime($data->updated_at));

            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ShortCut $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(ShortCut $model)
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
                    ->setTableId('shortcut-table')
                    ->columns($this->getColumns())
                    ->parameters([ 'dom' => 'Bfrtip','buttons' => ['export', 'print', 'reset', 'reload'],
                    ])
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->minifiedAjax()
                    ->dom('Bfrtip')
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
            Column::make('id'),
            Column::make('title'),
            Column::make('created_at'),
    ['data'=>'user','name'=>'user.name','title'=>'Author'],
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
        return 'ShortCut_' . date('YmdHis');
    }
}
