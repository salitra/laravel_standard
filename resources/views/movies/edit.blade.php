@extends('template.layout')
@section('content')

<div id="contact" class="container-fluid bg-grey">
  @include('template.flash')
  <h2 class="text-center">Edit movie</h2>
  <div class="row">
    <div class="col-sm-12 slideanim">
      <?php $submit_url = url("movies")."/".$movie->id ?>
      <form method="post" action="{{ $submit_url }}" enctype="multipart/form-data">
        <input type="hidden" name="_method" value="PUT">
       @csrf
        <div class="row">
          <div class="col-sm-6 form-group">
            <input class="form-control" id="name" name="name" placeholder="Name" type="text" value="{{old('name',$movie->name)}}">
          </div>
          <div class="col-sm-6 form-group">
            <input class="form-control" id="releaseDate " name="release_date" placeholder="Release Date" type="date" value="{{ old('release_date',date('Y-m-d',strtotime($movie->release_date))) }}">
          </div>
        </div>
         <div class="row">
          <div class="col-sm-6 form-group">
            <input class="form-control" id="image" name="images[]" placeholder="Image" type="file" multiple>
          </div>
          <div class="col-sm-6 form-group">
            <select class="form-control" id="genre" name="genre_id">
              @foreach ($genres as $genre)
                <option value="{{ $genre->id }}" <?php if(old('genre_id',$movie->genre_id) == $genre->id){ echo "selected"; } ?> >{{ $genre->name }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12 form-group">
            <button class="btn btn-default pull-right" type="submit">Update</button>
          </div>
        </div>
      </form>

    </div>
  </div>

  <h2>Images</h2>
    <div class="images-for-delete">
      
      <div class="item ">
        <?php $j = 0; ?>
        @foreach(@$movie->images as $image)
          <div  class="image-div" id="{{ $image->id }}">
            <span class="glyphicon glyphicon-trash" onclick="delete_image('{{ $image->id }}')" aria-hidden="true"></span>
            <img src="{{ url('images').'/'.$image->image_name }}">
          </div>
          <?php $j++; ?>
        @endforeach
      </div>
    </div>
</div>     
@endsection
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
  function delete_image(id){
    swal({
        title: "Are you sure to delete this ?",
        text: "You will not be able to recover this image!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        confirmButtonText: "Yes, delete it!",
      }).then(result => {
        console.log(result.value);
         if (result.value) {
          var hitUrl = '{{ url("movies/delete-image") }}';
          $.ajax({
              type: "POST",
              url: hitUrl,
              data:{id:id},
              success: function (data) {
                  console.log(data.result);
                  $("#"+id).hide();
              },
              error: function (data) {
                  console.log('Error:', data);
              }
          });
         }
      });
  }
  
</script>