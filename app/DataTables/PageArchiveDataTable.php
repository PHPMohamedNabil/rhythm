<?php

namespace App\DataTables;

use App\Models\Page;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PageArchiveDataTable extends DataTable
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
                      return view('admin.pages.archive_btn',['data'=>$data]);
            })->editColumn('deleted_at',function($data){
                   return date('Y-m-d h:i',strtotime($data->deleted_at));
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
        return $model->onlyTrashed();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
       
        return $this->builder()
                    ->setTableId('pages-table-trashed')
                    ->columns($this->getColumns())
                    ->parameters([ 'dom' => 'Bfrtip','buttons' => ['export','pdf'],
                    ])
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
            Column::make('deleted_at'),
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
