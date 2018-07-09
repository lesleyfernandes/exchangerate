@if ($errors->any())
  <div class="row align-items-center justify-content-center py-2">
      <div class="alert alert-danger col-md-6" role="alert">
          @foreach ($errors->all() as $error)
            {{ $error }}<br />
          @endforeach
      </div>
  </div>
@endif