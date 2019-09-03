@extends('template.layout')

@section('content')
<div id="contact" class="container-fluid bg-grey">
	@include('template.flash')
  <h2 class="text-center">Add new movie</h2>
  <div class="row">
    <div class="col-sm-12 slideanim">
    	<form method="post" action="{{ action('MovieController@store') }}" enctype="multipart/form-data">
    	 @csrf
	      <div class="row">
	        <div class="col-sm-6 form-group">
	          <input class="form-control" id="name" name="name" placeholder="Name" type="text" value="{{old('name')}}">
	        </div>
	        <div class="col-sm-6 form-group">
	          <input class="form-control" id="releaseDate " name="release_date" placeholder="Release Date" type="date" value="{{old('release_date')}}">
	        </div>
	      </div>
	       <div class="row">
	        <div class="col-sm-6 form-group">
	          <input class="form-control" id="image" name="images[]" placeholder="Image" type="file" multiple>
	        </div>
	        <div class="col-sm-6 form-group">
	          <select class="form-control" id="genre" name="genre_id">
	            @foreach ($genres as $genre)
	            <option value="{{ $genre->id }}">{{ $genre->name }}</option>
				@endforeach
	          </select>
	        </div>
	      </div>
	      <div class="row">
	        <div class="col-sm-12 form-group">
	          <button class="btn btn-default pull-right" type="submit">Add</button>
	        </div>
	      </div>
	    </form>

    </div>
  </div>
</div>
@endsection