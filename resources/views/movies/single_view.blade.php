@extends('template.layout')
@section('content')
<!-- Container (Contact Section) -->
<div id="contact" class="container-fluid bg-grey">
<div class="row">
  <div class="col-sm-6">
    <h1 class="view-page-title">{{ @$movie->name }}</h1>
  </div>
  <div class="col-sm-6">
    <ul class="view-page-list">
          <li>Genre : {{ @$movie->genre->name }} </li>
          <li>Release Date : {{ @$movie->release_date }}</li>
    </ul>
  </div>
</div>
<div class="movie-image-slider">
  <div id="carousel" class="carousel slide" data-ride="carousel">
    <div class="carousel-inner">
      <?php $i = 0; ?>
      @foreach(@$movie->images as $image)
      <div class="item @if ($i === 0) active @endif <?php $i++; ?>">
        <img src="{{ url('images').'/'.$image->image_name }}">
      </div>
      @endforeach
    </div>
  </div>
  <div class="clearfix">
    <div id="thumbcarousel" class="carousel slide" data-interval="false">
      <div class="carousel-inner">
        <div class="item active">
          <?php $j = 0; ?>
          @foreach(@$movie->images as $image)
            <div data-target="#carousel" data-slide-to="{{ $j }}" class="thumb"><img src="{{ url('images').'/'.$image->image_name }}"></div>
            <?php $j++; ?>
          @endforeach
        </div>
      </div>
      <!-- /carousel-inner --> 
      <a class="left carousel-control" href="#thumbcarousel" role="button" data-slide="prev"> <i class="fa fa-angle-left" aria-hidden="true"></i> </a> <a class="right carousel-control" href="#thumbcarousel" role="button" data-slide="next"><i class="fa fa-angle-right" aria-hidden="true"></i> </a> </div>
    <!-- /thumbcarousel --> 
    
  </div>
</div>
</div>
@endsection