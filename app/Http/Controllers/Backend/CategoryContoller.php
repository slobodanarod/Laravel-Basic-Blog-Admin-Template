<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Traits\ImageUploadTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
class CategoryContoller extends Controller
{

    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::with('parent')->get();
        return view('backend.pages.categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Category::getTypes();
        $categories = Category::all();
        return view('backend.pages.categories.create',compact('types','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        try{

            //image upload
            $imageName = "categories/no-image.png";

            if($request->file){
                $imageName = $this->imageUpload($request->file,"categories",$request->name);
            }

            //image upload


            $category = new Category();

            $category->name = $request->name;
            $category->type = $request->type;
            $category->status = $request->status;
            $category->image = $imageName;
            $category->parent_id = $request->parent_id;
            $category->seo_title = $request->seo_title;
            $category->slug = Str::slug($request->seo_title);
            $category->seo_descr = $request->seo_descr;
            $category->seo_keyw = $request->seo_keyw;
            $category->content = $request->content;

            if($category->save()){
                return back()->with('type',"success")->with('message',"Succesful added");
            }else{
                return back()->with('type',"danger")->with('message',"Error added");
            }

        }catch(Exception $e){
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
        $category = Category::find($id);
        $types = Category::getTypes();
        $categories = Category::all();
        return view('backend.pages.categories.edit',compact('category','categories','types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        try{

            $category = Category::findOrFail($id);

            //image upload
            $imageName = $category->image;

            if($request->file){
                $this->deleteImage($imageName);
                $imageName = $this->imageUpload($request->file,"categories",$request->name);
            }

            //image upload

            $category->name = $request->name;
            $category->type = $request->type;
            $category->status = $request->status;
            $category->image = $imageName;
            $category->parent_id = $request->parent_id;
            $category->seo_title = $request->seo_title;
            $category->slug = Str::slug($request->seo_title);
            $category->seo_descr = $request->seo_descr;
            $category->seo_keyw = $request->seo_keyw;
            $category->content = $request->content;

            if($category->save()){
                return back()->with('type',"success")->with('message',"Succesful update");
            }else{
                return back()->with('type',"danger")->with('message',"Error update");
            }

        }catch(Exception $e){
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
        //
    }
}
