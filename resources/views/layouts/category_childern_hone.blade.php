
<li> 
    @if (count($child_category->categories)>0)
         <a class="nav-link-collapse collapsed" data-toggle="collapse" href="#collapseMulti{{$child_category->id}}">{{ $child_category->name }}</a>
    @else
          <a class="nav-link-collapse" href="{{route('categories_view',$child_category->id)}}">{{ $child_category->name }}</a>
    @endif
       @if ($child_category->categories)
          <ul class="sidebar-third-level collapse" id="collapseMulti{{$child_category->id}}">
            
               @foreach ($child_category->childrenCategories as $childCategory)
                  @include('layouts.category_childern_hone', ['child_category' => $childCategory,'third'=>'yes'])
               @endforeach
         
        </ul>
       @endif
</li>
