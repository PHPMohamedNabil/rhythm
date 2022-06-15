<li>
  <a href="{{route('category.edit',$child_category->id)}}"> {{$categories->name}}{{$pref}}{{$child_category->name}} ( {{$child_category->PageCount}} )</a>
</li>

@if ($child_category->categories->count())
    @php $pref.= $child_category->name.'/' @endphp
    @php $child_p_count=$child_category->PageCount @endphp
        @foreach ($child_category->categories as $childCategory)
            
           
            @include('admin.category.childern_category_col', ['child_category' => $childCategory,'pref'=>$pref,'child_p_count'=>$childCategory->PageCount])
    

        @endforeach
@endif