<option value="{{$child_category->id}}" {{$child_category->id == $page->category_id ?'selected=""':''}}>{{$category->name}}{{$pref}}{{$child_category->name}}</option>
@if ($child_category->categories->count())
    @php $pref.= $child_category->name.'/' @endphp
        @foreach ($child_category->categories as $childCategory)
            
           
            @include('admin.pages.category_page_edit', ['child_category' => $childCategory,'pref'=>$pref,'edit'=>true])
    

        @endforeach
@endif