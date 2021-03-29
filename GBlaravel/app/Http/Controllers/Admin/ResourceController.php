<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ResourceRequest;
use App\Models\Resource;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.news.parse', [
            'resources' => Resource::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function store(ResourceRequest $request, Resource $resourсe)
    {
        $request->validated();

        $arr = $request->all();
        if(Resource::where('title', $arr['title'])->orWhere('url', $arr['url'])->first()){
            return redirect()->route('admin.resources.index')->with('error', "Ресурс ".$arr['title']." уже существует.");
        }        
        $resourсe->fill($arr)->save();
        return redirect()->route('admin.resources.index')->with('success', "Ресурс добавлен!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    public function destroy(Resource $resource)
    {      
        $resource->delete();
        return redirect()->route('admin.resources.index')->with('success', "Ресурс удален!");
    }
}
