<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class UserDataTable extends DataTable
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
            ->eloquent($query)->addColumn('role',function(User $user){
                if($user->role)
                {
                    return $user->role->name;
                }
                return null;
            })->addColumn('action',function(User $user){
                $route=route('user.edit',$user->id);
                return "<a class=\"btn btn-success btn-sm\" href=\"$route\"><i class=\"fas fa-edit\"></i></a>";
            });
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model::with('role');
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
         return $this->builder()
                    ->setTableId('user-table')
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
            ['data'=>'id','name'=>'id','title'=>'Id'],
            ['data'=>'username','name'=>'username','title'=>'Username'],
            ['data'=>'name','name'=>'name','title'=>'Name'],
            ['data'=>'role','name'=>'role.name','title'=>'Role'],  
            Column::make('action')->width('20px')         
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
