<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Str;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;


class LivewireDatatables extends LivewireDatatable
{   
    public $model =Category::class;
     

    public function colums()
    {
        return [
             NumberColumn::name('id')->label('ID')->sortBy('id'),
             Column::name('name')->label('Name'),
             DataColumn::name('created_at')->label('creationDate')
        ];
    }
    /*public function render()
    {
        return view('livewire.livewire-datatables');
    }*/
}
