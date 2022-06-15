
{{$child_p_count}}
@if ($childCategory->categories->count())
    
        @foreach ($childCategory->categories as $childCategory)
            
           
           @include('admin.category.childern_category_col_count', ['child_p_count'=>$child_p_count,''=>$childCategory])
    

        @endforeach
@endif