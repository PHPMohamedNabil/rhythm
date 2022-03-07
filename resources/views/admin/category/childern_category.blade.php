
@if($edit)

@if($child_category->id == $cate->id)
          @php unset($child_category->id) @endphp
@else
<option value="{{$child_category->id}}" {{$child_category->id == $cate->category_id ?'selected=""':''}}>{{$category->name}}{{$pref}}{{$child_category->name}}</option>
@endif

@if ($child_category->categories->count())
 @php $pref.= $child_category->name.'/' @endphp
        @foreach ($child_category->categories as $childCategory)
           
           
            @include('admin.category.childern_category', ['child_category' => $childCategory,'pref'=>$pref,'edit'=>true])
    

        @endforeach
@endif


@else

<option value="{{$child_category->id}}">{{$category->name}}{{$pref}}{{$child_category->name}}</option>
@if ($child_category->categories->count())
  @php $pref.= $child_category->name.'/' @endphp
        @foreach ($child_category->categories as $childCategory)
           
           
            @include('admin.category.childern_category', ['child_category' => $childCategory,'pref'=>$pref])
    

        @endforeach
@endif

@endif