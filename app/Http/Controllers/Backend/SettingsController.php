<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Psy\Exception\Exception;

class SettingsController extends Controller
{

    use ImageUploadTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $settings = Setting::all();
        return view('backend.pages.settings.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $setting = Setting::find($id);
        $types = Setting::getTypes();
        $mains = Setting::getMains();
        return view('backend.pages.settings.edit',compact('setting','types','mains'));
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

            $setting = Setting::find($id);

            if($setting->type == "Image"){
                if($request->value){
                    $value = $this->imageUpload($request->value,"settings",$setting->tag);
                }
            }else{
                $value = $request->value;
            }

            $setting->value = $value;

            if($setting->save()){
                return back()->with('type',"success")->with('message',"Succesful updated");
            }else{
                return back()->with('type',"danger")->with('message',"Error updated");
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
