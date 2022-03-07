<?php 

namespace App\Http\ViewComposers;

use Illuminate\Contracts\View\View;
use App\Models\Category;

class CategoryComposer {

    /**
     * The user repository implementation.
     *
     * @var UserRepository
     */
    protected $categories;

 
    public function __construct(Category $categories)
    {
    	$categories = Category::whereNull('category_id')
        ->with('childrenCategories')
        ->get();
        // Dependencies automatically resolved by service container...
        $this->categories = $categories;
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $view->with('categories', $this->categories);
    }

}