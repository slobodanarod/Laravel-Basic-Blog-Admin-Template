<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Tag;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blog;
class BlogController extends Controller
{
    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('backend.pages.blogs.index',compact('blogs'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('backend.pages.blogs.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            //image upload
                $imageName = "blogs/no-image.png";

                if($request->file){
                    $imageName = $this->imageUpload($request->file,"blogs",$request->name);
                }
            //image upload

            $blog = new Blog();
            $blog->name = $request->name;
            $blog->status = $request->status;
            $blog->image = $imageName;
            $blog->seo_title = $request->seo_title;
            $blog->slug = Str::slug($request->seo_title);
            $blog->seo_descr = $request->seo_descr;
            $blog->seo_keyw = $request->seo_keyw;
            $blog->content = $request->content;
            if($blog->save()){
                 $tagsArr = explode(',',$request->tags);
                 $blog->tags()->detach();
                 foreach($tagsArr as $tag){
                     $newtag = Tag::firstOrCreate(['name' => $tag,'slug' => Str::slug($tag)]);
                     $blog->tags()->attach($newtag);
                 }

                $blog->categories()->detach();
                foreach($request->cat_id as $key => $cat){
                    $blog->categories()->attach($cat);
                }

                return back()->with('type','success')->with('message','Succesful');
            }else{
                return back()->with('type',"danger")->with('message',"Error added");
            }
        }catch(Exception $e){
            dd($e);
            return back()->with('type',"danger")->with('message',"We have a problem");
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blog = Blog::find($id);
        $tags = $blog->getTags();
        $categories = Category::all();
        $blog_cates = $blog->getCategories();
        return view("backend.pages.blogs.edit",compact('blog','tags','categories','blog_cates'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{

            $blog = Blog::find($id);
            $imageName = $blog->image;
            if($request->file){
                $imageName = $this->imageUpload($request->file,"blogs",$request->name);
            }
            //image upload


            $blog->name = $request->name;
            $blog->status = $request->status;
            $blog->image = $imageName;
            $blog->seo_title = $request->seo_title;
            $blog->slug = Str::slug($request->seo_title);
            $blog->seo_descr = $request->seo_descr;
            $blog->seo_keyw = $request->seo_keyw;
            $blog->content = $request->content;

            if($blog->save()){
                $tagsArr = explode(',',$request->tags);
                $blog->tags()->detach();
                foreach($tagsArr as $tag){
                    $newtag = Tag::firstOrCreate(['name' => $tag,'slug' => Str::slug($tag)]);
                    $blog->tags()->attach($newtag);
                }

                $blog->categories()->detach();
                foreach($request->cat_id as $key => $cat){
                    $blog->categories()->attach($cat);
                }

                return back()->with('type','success')->with('message','Succesful');
            }else{
                return back()->with('type',"danger")->with('message',"Error added");
            }

        }catch(Exception $e){
            dd($e);
            return back()->with('type',"danger")->with('message',"We have a problem");
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::find($id);
        $blog->tags()->detach();
        $this->deleteImage($blog->image);
        $blog->delete();
        return back();
    }
}
