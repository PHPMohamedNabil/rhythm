<ul style="list-style: none;">
        <li >
            <a data-toggle="collapse" href="#collapseExample{{ $categories->id }}" role="button" style="color:#000;" aria-expanded="false" aria-controls="collapseExample">{{$categories->name}}</a>
        </li>
        
<div class="collapse" id="collapseExample{{ $categories->id }}">
  <div class="card card-body">
        @foreach ($categories->childrenCategories as $childCategory)
            @include('admin.category.childern_category_col', ['child_category' => $childCategory,'pref'=>'/','edit'=>false])
        @endforeach
    </div>
</div>

</ul>
