<?php

namespace App\Http\Controllers;

use App\Movie;
use App\Genre;
use App\Image;
use File;
use App\Http\Requests\StoreMovie;
use App\Services\ImageService;
use App\Services\ImageDeleteService;

use Illuminate\Support\Facades\Input;
use Lang;

//use ImageIntervention;
//use Intervention\Image\ImageManagerStatic as ImageIntervention;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $imageservices;

    public function __construct(ImageService $imageservices,ImageDeleteService $imagedeleteervices, Movie $movie)
    {
        $this->imageservices = $imageservices;
        $this->imagedeleteervices = $imagedeleteervices;
        $this->movie = $movie;
    }

    public function index()
    {
        $movies = Movie::with('images')->with('genre')->get();
        return view('movies.list',compact('movies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genres = Genre::all();
        return view('movies.add_movie',compact('genres'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovie $request)
    {
        $this->movie = Movie::create($request->only(['name', 'release_date','genre_id']));
        //Code for multiple image uploading start
        if($files = $request->file('images')){
            foreach($files as $file){
                $name = time().$file->getClientOriginalName();
                $this->imageservices->handleUploadedImage($file,$name);
                //Insert image name in table
                $this->movie->images()->create(array('image_name'=>$name));
            }
        }

        if ($this->movie->id) {
            return back()->with('success',Lang::get('message.add_y',array('item' => 'Movie')));
        }else{
            return back()->with('danger',Lang::get('message.went_wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        if (isset($movie->id)) {
            $movie = Movie::with('images')->with('genre')->whereId($movie->id)->first();
            return view('movies.single_view',compact('movie'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        $genres = Genre::all();
        $movie = Movie::with('images')->with('genre')->whereId($movie->id)->first();
        return view('movies.edit',compact('movie','genres'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(StoreMovie $request, Movie $movie)
    {
        $movie->create($request->only(['name', 'release_date','genre_id']));
        //Code for multiple image uploading start
        if($files=$request->file('images')){
            foreach($files as $file){
                $name = time().$file->getClientOriginalName();
                $this->imageservices->handleUploadedImage($file,$name);
                //Insert image name in table
                $movie->images()->create(array('image_name'=>$name));
            }
        }

        if ($movie->id) {
            return back()->with('success',Lang::get('message.update_y',array('item' => 'Movie')));;
        }else{
            return back()->with('danger',Lang::get('message.went_wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        if (isset($movie->id)) {

            $images = Image::whereMovieId($movie->id)->get();
            foreach ($images as $image) {
                //services for delete image
                $this->imagedeleteervices->handleDeleteImage($image);
            }
            $delete = Movie::whereId($movie->id)->delete();
            if ($delete) {
                return redirect()->back()->with('success',Lang::get('message.delete_y',array('item' => 'Movie')));;
            }else{
                return back()->with('danger',Lang::get('message.went_wrong'));
            }
        }
    }
}
