@if (\Session::has('success'))
  <div class="row align-items-center justify-content-center py-2">
      <div class="alert alert-success col-md-6" role="alert">
          {{ \Session::get('success') }}<br />
      </div>
  </div>
@endif