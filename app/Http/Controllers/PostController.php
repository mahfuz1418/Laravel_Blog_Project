<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\SubCategory;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('post.index', [
            "posts" => Post::all(),
            "trushposts" => Post::onlyTrashed()->get(),
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
        return view('post.create', [
            'parent_category' => Category::all(),
            'tags' => Tag::all(),
        ]);
    }
    public function getSubCategory(Request $request)
    {
        //
        $parent_id = $request->category_id;
        $subcategory_list = SubCategory::where('parent_id', $parent_id)->get();
        $subcategory_name = '';
        foreach ($subcategory_list as $subcategory) {
            $subcategory_name .= "<option value='$subcategory->id'> $subcategory->subcategory_name </option>";
        }
        return $subcategory_name;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            "*" => "required",
            "post_title" => "unique:posts,post_title,". $request->id,
            "post_slug" => "unique:posts,post_slug,". $request->id,
            "post_thumbnail" => "mimes:png,jpg",
        ]);
        if ($request->post_slug) {
            $slug = Str::slug($request->post_slug, '-');
        } else {
            $slug = Str::slug($request->post_title, '-');
        }
        $file_name = auth()->id() . '-' . time() . '.' . $request->file('post_thumbnail')->getClientOriginalExtension();
        $img = Image::make($request->file('post_thumbnail'));
        $img->save(base_path('/public/upload/post_thumbnail/' . $file_name), 80);

        // summernote text editor text and image upload start //
        $post_description = $request->post_description;
        libxml_use_internal_errors(true);
        $dom = new \DomDocument();
        $dom->loadHtml('<?xml encoding="utf-8" ?>' . $post_description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    // must include this to avoid font problem
        $images = $dom->getElementsByTagName('img');
        if (count($images) > 0) {
            foreach ($images as  $img) {
                $src = $img->getAttribute('src');
                # if the img source is 'data-url'
                if (preg_match('/data:image/', $src)) {
                    # get the mimetype
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimetype = $groups['mime'];
                    # Generating a random filename
                    $filename =
                        Str::limit($slug, 5) . '_' . auth()->id() . '_' . time() .
                        Str::random(8) . '_' . Carbon::now()->format('Y');
                    $filepath = "upload/post_description/$filename.$mimetype";
                    $image = Image::make($src)
                        ->encode($mimetype, 100)
                        ->save(public_path($filepath), 80);
                    $new_src = asset($filepath);
                    $img->removeAttribute('src');
                    $img->setAttribute('src', $new_src);
                }
            }
        }
        # modified entity ready to store in database
        $post_description = $dom->saveHTML();
        // summernote text editor text and image upload end //
        
        $id = Post::insertGetId([
            "writer" => auth()->id(),
            "post_title" => $request->post_title,
            "post_slug" => $slug,
            "post_thumbnail" => $file_name,
            "post_category" => $request->post_category,
            "post_subcategory" => $request->post_subcategory,
            "post_description" => $post_description,
            "post_status" => $request->post_status,
            "post_type" => $request->post_type,
            "post_kind" => $request->post_kind,
            "created_at" => now(),
        ]);
        $post = new Post();
        foreach ($request->tags as $tag) {
            $post->find($id)->tagsRelation()->attach($tag);
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        $parent_category = Category::all();
        $tags = Tag::all();
        return view('post.edit', compact('post','parent_category', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
        $request->validate([
            "post_title" => "required | unique:posts,post_title,".$post->id,
            "post_slug" => "unique:posts,post_slug,".$post->id,
            "post_thumbnail" => "mimes:png,jpg",
        ]);
        if ($request->post_slug) {
            $slug = Str::slug($request->post_slug, '-');
        } else {
            $slug = Str::slug($request->post_title, '-');
        }
        if ($request->hasFile('post_thumbnail')) {
            unlink(base_path('/public/upload/post_thumbnail/' . $post->post_thumbnail));
            $file_name = auth()->id() . '-' . time() . '.' . $request->file('post_thumbnail')->getClientOriginalExtension();
            $img = Image::make($request->file('post_thumbnail'));
            $img->save(base_path('/public/upload/post_thumbnail/' . $file_name), 80);
            //update thumbnail
            $post->update([
                "post_thumbnail" => $file_name,
            ]);
        }


        // text editor update
        $post_description = $request->post_description;
        $old_post_description = $post->post_description;
        if ($old_post_description !== $post_description) {
            libxml_use_internal_errors(true);
            $dom = new \DomDocument();
            $dom->loadHtml('<?xml encoding="utf-8" ?>' . $post_description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    // must include this to avoid font problem
            $images = $dom->getElementsByTagName('img');
            if (count($images) > 0) {
                foreach ($images as  $img) {
                    $src = $img->getAttribute('src');
                    if (!preg_match('/data:image/', $src)) {
                        $filename = last(explode("/", $src));
                        $oldfile = "upload/post_description/$filename";
                        $mimetype = last(explode(".", $src));
                        $newFilename =
                            Str::limit($slug, 5) . '_' . auth()->id() . '_' . time() .
                            Str::random(8) . '_' . Carbon::now()->format('Y');
                        $filepath = "upload/post_description/$newFilename.$mimetype";
                        copy($oldfile, $filepath);
                        unlink(base_path("public/" . $oldfile));
                        $new_src = asset($filepath);
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $new_src);
                    }
                    # if the img source is 'data-url'
                    if (preg_match('/data:image/', $src)) {
                        # get the mimetype
                        preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                        $mimetype = $groups['mime'];
                        # Generating a random filename
                        $filename =
                            Str::limit($slug, 5) . '_' . auth()->id() . '_' . time() .
                            Str::random(8) . '_' . Carbon::now()->format('Y');
                        $filepath = "upload/post_description/$filename.$mimetype";
                        $image = Image::make($src)
                            ->encode($mimetype, 100)
                            ->save(public_path($filepath), 80);
                        $new_src = asset($filepath);
                        $img->removeAttribute('src');
                        $img->setAttribute('src', $new_src);
                    }
                }
            }
            # modified entity ready to store in database
            $post_description = $dom->saveHTML();
            //end text editor update
            if ($request->post_subcategory) {
                $post->update([
                    "post_subcategory" => $request->post_subcategory,
                ]);
            }
            $post->update([
                "writer" => auth()->id(),
                "post_title" => $request->post_title,
                "post_slug" => $slug,
                "post_category" => $request->post_category,
                "post_status" => $request->post_status,
                "post_type" => $request->post_type,
                "post_kind" => $request->post_kind,
                "created_at" => now(),
            ]);
            $post->update([
                "post_description" => 'null',
            ]);
            $post->update([
                "post_description" => $post_description,
            ]);
        }

        if ($request->tags === null) {
            $post->tagsRelation()->detach();
        } else {
            $post->tagsRelation()->detach();
            foreach ($request->tags as $tag) {
                $post->tagsRelation()->attach($tag);
            }
        }

        return back();
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }
    public function delete($id)
    {
        $post_data = Post::onlyTrashed()->find($id);
        unlink(base_path('public/upload/post_thumbnail/' . $post_data->post_thumbnail));
        $post_description = $post_data->post_description;
        libxml_use_internal_errors(true);
        $dom = new \DomDocument();
        $dom->loadHtml('<?xml encoding="utf-8" ?>' . $post_description, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);    // must include this to avoid font problem
        $images = $dom->getElementsByTagName('img');
        if (count($images) > 0) {
            foreach ($images as  $img) {
                $src = $img->getAttribute('src');
                $filename = last(explode("/", $src));
                unlink(base_path('public/upload/post_description/' . $filename));
                # if the img source is 'data-url'
                if (preg_match('/data:image/', $src)) {
                    unlink(base_path('public/upload/post_description/' . $filename));
                }
            }
        }
        $post_data->tagsRelation()->detach();
        $post_data->forceDelete();
        return back();
    }
    public function restore($id)
    {
        Post::onlyTrashed()->find($id)->restore();
        return back();
    }
}
