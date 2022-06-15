@extends('layouts.app')

@section('search_non_main')
<div class="row">
    <div class="col-md-12 search-div" style="margin-left:86px;">
              <form method="get" class="" action="{{route('p_search')}}">
                        <div class="input-group">
                            <input type="search" class="form-control" placeholder="Search for Page?" autocomplete="off" id="search_query" name="page_name">
                          <button class=" btn btn-info btn-sm ml-3" type="submit" style="margin-top: 0px;">Search</button>
                        </div>
                    </form>

             </div>
</div>
@endsection
@section('content')
 <div class="container">
     <div class="row">
         <div class="col-md-12">
             <div class="card">
                 <div class="card-title ml-4 mt-2">
                     <h4>Commen Links</h4>
                 </div>
                 <div class="card-body">
                   <div class="table-responsive dataTables_wrapper dt-bootstrap4">
                     {!! $dataTable->table(['class'=>'w-100 table-hover table table-bordered']) !!}
                   </div>
                 </div>
             </div>
         </div>
     

    </div>
</div>
@endsection

@section('js')
{!! $dataTable->scripts() !!}
 <script type="text/javascript">
  

     function copyToClipboard(text) {
         const elem = document.createElement('textarea');
         elem.value = text;
         document.body.appendChild(elem);
         elem.select();
         document.execCommand('copy');
         document.body.removeChild(elem);
}

 </script>
@endsection
