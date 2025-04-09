@extends('layouts.app')

@section('content')
<div class="text-center">
    <div class="container">
      <div class="row d-flex justify-content-center">
        <div class="col-lg-6 col-10 py-2 py-lg-0 order-2 order-md-1">
          <site-create-payment/>
        </div>
        <div class="col-lg-4 col-10 order-1 order-md-2">
          <site-summary-payment/>
        </div>
      </div>
    </div>
</div>
@endsection