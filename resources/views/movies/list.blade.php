@extends('template.layout')

@section('content')

<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
	<h2 class="text-center">Movie Listing</h2>
@foreach($movies as $movie)
  <!-- Start list Div-->
  <div class="media">
    <div class="icons">
    	<?php $deleteurl = 'movies/'.$movie->id; ?>
        <?php $formld = 'delete-'.$movie->id.'form'; ?>
        <form action="{{ $deleteurl }}" id="{{ $formld }}" method="post">
        	<input type="hidden" name="_method" value="delete" />
    		<input type="hidden" name="_token" value="{{ csrf_token() }}">
        </form>
       <a href="javascript:void(0)" onclick="deleteconfirm('<?php echo $formld;?>');">
       	<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
       </a>
       <?php $url = 'movies/'.$movie->id.'/edit'; ?>
       <a href="{{ $url }}">
       	<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>
       </a>
    </div>
    @foreach($movie->images as $mov )
    	<img style="width: 184;height: 274;" src="images/{{ $mov->image_name }}" class="mr-3" alt="Default Image" >
    	@break
    @endforeach
    <div class="media-body list">
        <h2 class="mt-0"><a href="movies/{{ $movie->id }}">{{ @$movie->name }}</a></h2>
        <ul>
          <li>Genre : {{ @$movie->genre->name }}</li>
          <li>Release Date : {{ @$movie->release_date }}</li>
        </ul>
    </div>
  </div>
  <!-- Start list Div-->
@endforeach

</div>

@endsection
<script type="text/javascript">
	function deleteconfirm(fromId) {
		swal({
		    title: "Are you sure to delete?",
		    text: "You will not be able to recover this movie!",
		    type: "warning",
		    showCancelButton: true,
		    confirmButtonColor: "#DD6B55",
		    confirmButtonText: "Yes, delete it!",
		  }).then(result => {
		  	console.log(result.value);
		     if (result.value) {
		     	document.getElementById(fromId).submit();
		     }
		  });
	}
	
</script>


