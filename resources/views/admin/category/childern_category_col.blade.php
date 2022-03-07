<li>
  <a href="{{route('category.edit',$child_category->id)}}"> {{$categories->name}}{{$pref}}{{$child_category->name}}</a>
</li>

@if ($child_category->categories->count())
    @php $pref.= $child_category->name.'/' @endphp
        @foreach ($child_category->categories as $childCategory)
            
           
            @include('admin.category.childern_category_col', ['child_category' => $childCategory,'pref'=>$pref])
    

        @endforeach
@endif