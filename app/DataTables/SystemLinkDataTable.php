<?php

namespace App\DataTables;

use App\Models\SystemLink;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class SystemLinkDataTable extends DataTable
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
            ->eloquent($query)->addColumn('action',function($row){
                return '<a href="'.$row->url.'" target="_blank"><i class="fas fa-external-link-alt"></i></a>';
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\ShortCut $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(SystemLink $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('systemlink-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax();
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('link_name'),
            Column::make('url'),
            Column::make('action')->width('20px'),
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'SystemLink' . date('YmdHis');
    }
}
