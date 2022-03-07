@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['Pages.end'=>''])!!}
@endsection
@section('content')
<style type="text/css">
  .buttons-reload{
    margin-top: 15px !important;
  }
</style>

    <div class="card">
       <div class="card-header">
          <div class="col-md-8">
            @can('create',App\Models\Page::class)
            <a class="mb-3 btn btn-outline-primary" href="{{route('page.create')}}">Create Page</a>
            @endcan
          </div>
       </div>
       <div class="card-body">
        @can('delete',$page)
         <form action="" onsubmit="return false;">
           <div class="form-inline">
              <button class="btn btn-info mr-2" onclick="return fireBulk();">Bulk Actions</button>
            <select name="" id="select" class="form-control col-2">
              <option value="">-with selected</option>
              <option value="trash">Move to Trash</option>
              <option value="delete">Delete permanently</option>
            </select>
           </div>
         </form>
         @endcan
          <div class="table-responsive dataTables_wrapper dt-bootstrap4">
            {!! $dataTable->table(['class'=>'table table-hover table-bordered w-100']) !!}
          </div>
       </div>
    </div>

@endsection


@section('js')
  {!! $dataTable->scripts() !!}

  <script type="text/javascript">
    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


  const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

    
   
     $(document).on('change', '#checkall',function(e){
        // alert(123);
         if($('#checkall').is(':checked'))
         {
           $('.check_item').prop('checked', this.checked);
         }
         else{
           $('.check_item').prop('checked', this.checked);
         }
     });


     function fireBulk()
     {
          action = $('#select').val(); 

      swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: `you will fire bulk action ${action}`,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, do it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
      return actionType();

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'no action is done :)',
      'error'
    )
    return false;
  }
  
})

     }


     function actionType()
     { 
       let boxes = $("[name='check_data[]']:checked");
       let count = boxes.length;
       let action = $('#select').val(); 
       let Ids   =[]; 

       boxes.each(function(){
          
          Ids.push(parseInt(this.value));
                
       });
       console.log(Ids,action);
          if(count >=1 && action !='')
          {
            $.post("{{route('bulk_action')}}",{ids:Ids,action:action,type:'page'},function(response){

                 console.log(response);
                  if(response.data == 'done')
                  {
                    Swal.fire('',`Bulck data ${action} Done ${count}`,'success');
                    reload();
                  }
                  else
                  {
                     Swal.fire('Bad Request Try Again !!');

                  }
              });
          }
          else
          {
              Swal.fire('Bulck Action Not Found Data Not Selected','','error');
          }
     }
    

    function reload()
    {
      return $('.buttons-reload').click();
    }


  @if(session('msg'))
     Swal.fire(
  'Good job!',
  '{{session("msg")}}',
  'success'
)

  @endif

    


  
 function delCate(category_name,catid)
 {
      event.preventDefault();

     var form = $(`#del${catid}`);

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: `you will Move the Page ${category_name} To Archive`,
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, Move it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
        form.submit();
      return true;

  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your  Page data is safe :)',
      'error'
    )
    return false;
  }
  
})
 }

 @if(session('del'))
   swalWithBootstrapButtons.fire(
      'Move To Archive!',
      'Your Page {{session("del")}} Moved to Archive.',
      'success'
    )
 @endif

 var debounce =false;
 
$(document).on('change', '.published', function() {
     let Id        = $(this).data('id');
     let Published_data = $(this);
     let Published = parseInt($(this).data('published'));
       
       //console.log(Published,$(this).data('published',50));
      // return false;
    if($('#pub'+Id).is(':checked'))
    {
      Published_data.data('published',1);
    }
    else{
       Published_data.data('published',0);
    }

     if(debounce)
     {
         clearTimeout(debounce);
     } 

     debounce = setTimeout(function(){
          $.post('{{route("publishe_status")}}',{id:Id,published:Published},function(data){           
             
           Published_data.data('published',data.status);
          
           console.log(data.status);

      });
     },300);
     
     
});


</script>
<script src="https://cdn.datatables.net/buttons/1.0.3/js/dataTables.buttons.min.js"></script>
<script src="/vendor/datatables/buttons.server-side.js"></script>
@endsection