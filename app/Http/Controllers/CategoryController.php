<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('categories.index', [
            'categories' => Category::paginate(5)->withQueryString(),
            'subcategories' => SubCategory::paginate(5)->withQueryString(),
            'trashcategories' => Category::onlyTrashed()->get(),
            'trashsubcategories' => SubCategory::onlyTrashed()->get(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        Category::all();
        return view('categories.create', [
            'parent_categories' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required | unique:categories,category_name',
            'slug' => 'unique:categories,category_slug',
            'image' => 'required|mimes:png,jpg',
        ]);


        if ($request->slug) {
            $slug = Str::slug($request->slug, '-');
        } else {
            $slug = Str::slug($request->name, '-');
        }
        if ($request->parent_id != 0) {
            $file_name = auth()->id() . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'));
            $img->save(base_path('/public/upload/subcategory_image/' . $file_name), 80);
            SubCategory::insert([
                'parent_id' => $request->parent_id,
                'subcategory_name' => $request->name,
                'subcategory_slug' => $slug,
                'subcategory_image' => $file_name,
                'subcategory_status' => $request->status,
                'created_at' => now(),
            ]);
            return back()->withSuccess('Sub Category successfully created');
        } else {
            $file_name = auth()->id() . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'));
            $img->save(base_path('/public/upload/category_image/' . $file_name), 80);
            Category::insert([
                'category_name' => $request->name,
                'category_slug' => $slug,
                'category_image' => $file_name,
                'category_status' => $request->status,
                'created_at' => now(),
            ]);
            return back()->withSuccess('Category successfully created');
        }
    }

    /** 
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
        $subcategories = SubCategory::all();
        return view('categories.show', compact('category'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {

        return view('categories.edit', compact('category'));
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
        $request->validate([
            'name' => 'required | unique:categories,category_name,'.$category->id,
            'slug' => 'unique:categories,category_slug,'.$category->id, 
            'image' => 'mimes:png,jpg',
        ]);
        if ($request->slug) {
            $slug = Str::slug($request->slug, '-');
        } else {
            $slug = Str::slug($request->name, '-');
        }
        $category->update([
            'category_name' => $request->name,
            'category_slug' => $slug,
            'category_status' => $request->status,
            'updated_at' => now(),
        ]);
        if ($request->hasFile('image')) {
            unlink(base_path('public/upload/category_image/' . $category->category_image));
            $file_name = auth()->id() . '-' . time() . '.' . $request->file('image')->getClientOriginalExtension();
            $img = Image::make($request->file('image'));
            $img->save(base_path('public/upload/category_image/' . $file_name), 80);
            $category->update([
                'category_image' => $file_name,
            ]);
        }
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    // sub category delete
    public function destroy(Category $category)
    {
        //
        $id = $category->id;
        $subcategories = SubCategory::where('parent_id', $id)->get();
        foreach ($subcategories as  $subcategory) {
            $subcategory->delete();
        }
        $category->delete();
        return back();

    }
    public function restore($id)
    {
        //
        Category::onlyTrashed()->find($id)->restore();
        return back();
    }
    //category delete from trash
    public function delete($id)
    {
        $category = Category::onlyTrashed()->find($id);
        $id = $category->id;
        $image_name = $category->category_image;
        $subcategories = SubCategory::onlyTrashed()->where('parent_id', $id)->get();
        foreach ($subcategories as $subcategory) {
            unlink(base_path('public/upload/subcategory_image/'.$subcategory->subcategory_image));
            $subcategory->forceDelete();
        }
        unlink(base_path('public/upload/category_image/'.$image_name));
        Category::onlyTrashed()->find($id)->forceDelete();
        return back();
    }

    // subcategory delete 
    public function subdestroy($id)
    {
        //
        SubCategory::find($id)->delete();
        return back();

    }
    // sub category delete from trash
    public function subdelete($id)
    {
        $subcategory = SubCategory::onlyTrashed()->find($id);
 
        $subcategory->forceDelete();
        unlink(base_path('public/upload/subcategory_image/'.$subcategory->subcategory_image));
        return back();
    }
    public function subrestore($id)
    {
        $parent_id = SubCategory::onlyTrashed()->find($id)->parent_id;
        $find_parent_category = Category::withTrashed()->find($parent_id)->deleted_at;
        if ($find_parent_category == null) {
            SubCategory::onlyTrashed()->find($id)->restore();
            return back();
        } else {
            return back()->with('parent_error', 'Your parent catergory on trash!');
        }
    }
}
