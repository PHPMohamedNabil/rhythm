<?php

namespace App\DataTables;

use App\Models\Category;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CategoryDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */

  //  protected $routes =['edit','delete'];

    public function dataTable($query)
    { 
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($data){
                            
                            return view('admin.category.editbtn',['data'=>$data]);
                    })->editColumn('name',function($data){
                        return view('admin.category.name_col',['categories'=>$data]);
                    })->setRowClass('details-control');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CategoryDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Category $model)
    {
        return $model::whereNull('category_id')
        ->with('childrenCategories');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('categorydatatable-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
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
            'id',
            'name',
            'action'
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Category_' . date('YmdHis');
    }

    public function action()
    {
        return '<a href="#">ads</a>';
    }


}
