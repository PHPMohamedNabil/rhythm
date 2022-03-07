@extends('admin.layouts.app')

@section('bread')
  {!! bread_crump(['name'=>'Home','link'=>'/'],['ShortCuts'=>route('shortcut.index'),$shortcut->title.'.end'=>''])!!}
@endsection
@section('content')

  <div class="card">
     <div class="card-header">
        Creator : {{$shortcut->user->username ?? ''}}
     </div>
     <div class="card-body">
       <form action="{{route('shortcut.update',$shortcut->id)}}" method="post">
       <div class="row"> 
           @method('PUT')
          <div class="col-md-4">
            @csrf
           <div class="form-group">
            
               <label>Title (shortcut name )</label>
               <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{old('title')?old('title'):$shortcut->title}}" />
                @error('title')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
           <div class="form-group">
               <label>Description (it is an instructions descriping the shortcut to avoid wrong dessicions)</label>
                <textarea class="form-control @error('description') is-invalid @enderror" name="description" rows="6">{{old('description')?old('description'):$shortcut->description}}</textarea>
                @error('description')
              <span class="text-danger">
                      {{$message}}          
              </span>
                @enderror
           </div>
          </div>
          <div class="col-md-4 " id="parent">
            <h5 class="text-center">Bulid A complain Text Template</h5>
            <div class="text-center">

                 @foreach($shortcut->properties as $property)
                  <div class="form-group">
                    <input type="text" name="properties[]" class="form-control comp_text" value="{{$property}}" /><button id="del_inp_btn" type="button" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button>
                  </div>
                 @endforeach

            
              <button type="button" class="btn btn-primary" id="before_inps">Create complain text</button>
            </div>

          </div>
          <div class="col-md-4">
            <textarea class="form-control" rows="5" disabled="" id="complainText">@foreach($shortcut->properties as $property)@php echo $property."\n"@endphp @endforeach</textarea>
            <button class="btn btn-info btn-block">Submit</button>
          </div>
    
       </div>
          </form>
     </div>
  </div>

@endsection

@section('js')

<script type="text/javascript">

   

   $(function(){
         load_text_from_inps();

          var number_of_inps =0;
          var comp_data =new Array;
          var comp_pos;
         $('#before_inps').on('click',function(e){
                  let parent_el = $(this).parent();

                  console.log(parent_el.after('<div class="form-group"><input type="text" name="properties[]" class="form-control comp_text" /><button id="del_inp_btn" type="button" class="btn btn-danger btn-sm"><i class="fas fa-times"></i></button></div>'));
                  number_of_inps++;
                  load_text_from_inps();
         });

         $('#parent').on('click','#del_inp_btn',function(e){
                let text_val =$(this).prev().val();
                 let complain_full_text = $('#complainText').val();

                 var split_new_line     = complain_full_text.split("\n");
                 let new_text_arr       = split_new_line.filter((el)=>{return el!=text_val});

                 
                  let final_full_text = '';
                 new_text_arr.map((val,key)=>{
                           final_full_text+=val+'\n';
                 });


                  $('#complainText').val(final_full_text);
                 $(this).parent().remove();
                 number_of_inps--;
         });
            
         $('#parent').on('keyup','.comp_text',function(e){
                  let inp_text='';
                   $(".comp_text").each(function( index ){
                    inp_text+=$( this ).val()+'\n';
                
          });
               console.log( $('#complainText').val( inp_text ));
         });

          
           function load_text_from_inps()
           {
             let inp_text='';
                   $(".comp_text").each(function( index ){
                    inp_text+=$( this ).val()+'\n';
                
             });
               return $('#complainText').val( inp_text );
           }   

         


   });
</script>
@endsection