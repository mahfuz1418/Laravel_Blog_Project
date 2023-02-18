<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    //
    public function home()
    {
        return view('frontend.home',[
            "posts" => Post::latest()->paginate(5)->withQueryString(),
            "post_sliders" => Post::where('post_kind', 'top')->get(),
            "active_categories" => Category::where('category_status', 'active')->get(),
            "tags" => Tag::latest()->get(),
            "popular_posts" => Post::where('post_kind', 'popular')->limit(5)->get(),
        ]);
    }
    public function blog(Request $request)
    {
        $category_id = Category::where("category_slug", $request->slug)->first()->id;
        return view('frontend.blog',[
            "post_lists" => Post::where("post_category", $category_id)->paginate(2)->withQueryString(),
            "category_name" => Category::where("category_slug", $request->slug)->first()->category_name,
        ]);
    }
    public function search(Request $request)
    {
        // search operations
        $search_query = $request->search;
        $count_data = Post::where("post_title", "LIKE", "%$search_query%")->get();
        $search_data = Post::where("post_title", "LIKE", "%$search_query%")->paginate(2)->withQueryString();
        $count = count($count_data);

        //category show operations 
        $categories = Category::where("category_status", "active")->limit(9)->get();

        // tags show operation
        $tags = Tag::all();

        //post show operation 
        $posts = Post::where("post_kind", "popular")->limit(4)->get();
        return view('frontend.search', compact('search_data', 'search_query', 'count', 'categories', 'tags','posts'));
    }
    public function showpost(Request $request)
    {
        return view('frontend.single_page',[
            'single_post' => Post::where("id", $request->id)->first(),

        ]);
    }
}
