<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use DB;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
         $videos =  Video::first();
         return view('Video.add',compact('videos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Video.add');
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
        
       
            # code...
        
        $request->validate([
            'link' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i']
        ]);
        
        //  $videos = DB::table('video')
        // ->where("language",$request->language)->get();

        
        // dd($videos);
       $data = video::where('language',$request->language)->first();
       if ($data) {
        $videos = Video::find($request->hidden_id);
        $videos->language = $request->language;
        $videos->link = $request->link;
        $videos->save();
        return redirect()->route('video.index', compact('videos'))->with('success','Video updated successfully');
       }
       else{
              

        $videos= new video;
        $videos->language = $request->language;
        $videos->link = $request->link;
        $videos->save();
        return redirect()->route('video.index', compact('videos'))->with('success','Video Created successfully');

       }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video , $id)
    {
        //
         $videos = Video::find($id);
        return view('Video.edit',compact('videos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video, $id)
    {
        // //
        // $request->validate([
        //     'link' => ['required','regex:/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i']
        // ]);

        // $videos = Video::find($id);
        // $videos->link = $request->link;
        // $videos->save();
        // return redirect()->route('video.index')->with('success','Video updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video,$id)
    {
        //
        $videos = Video::find($id);
        $videos->delete();
        return redirect()->route('video.index')->with('success','Video deleted successfully');

    }

    // public function Getlanguage(Request $request)
    // {
    //        // dd($request->all());
    //     $videos = Video::where('language',$request->video_id)->get();
             
    //     return view('Video.view', compact('videos'));

        
    // }

    //  public function searchlanguage(Request $request)
    // {
    //     $videos = DB::table('videos')
    //     ->where("language",$request->language)
    //     ->pluck("language","link");
    // }
     public function addvideo(Request $request)
     {
       $data = video::where('language',$request->language)->pluck('link')->first();
       // dd($data);
       $msg;
       if ($data) {
           # code...
        $msg = "0";

        return response()->json($data);
       }
       else{
        // $data = '';
        $msg ="1";
        return response()->json(['html'=>$data]);

       }

     }
}
