 <!-- Session Flash Start-->
@foreach (['danger', 'warning', 'success', 'info'] as $key)
 @if(Session::has($key))
  <div class="col-md-12">
  <div class="row">
     <div  style="margin-bottom:3%;" class="alert alert-{{ $key }} alert-dismissible" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <p>{{ Session::get($key) }}</p>
    </div>
  </div>
  </div>
 @endif
@endforeach
<!-- Session Flash End-->
<!-- Form Validation Error  -->

@if ($errors->any())
<div class="col-md-12">
<div class="row">
    <div style="margin-bottom:3%;" class="alert alert-danger alert-dismissible show" role="alert">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <ul>
          @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div>
  </div>
</div>
@endif 
<!-- Form Validation Error  -->