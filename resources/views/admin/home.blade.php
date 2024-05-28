@extends('layouts.admin')
@section('content')
  <main>
    <!-- MAIN CONTENT -->
    <div class="main-content">

        <div class="row">
          <div class="col">
            @include('admin.partials.content-faq')
          </div>
          <div class="col">
            @include('admin.partials.content-body-right')
          </div>
        </div>
        <!-- chiusura row -->

    </div>
    <!-- /MAIN CONTENT -->


  </main>
@endsection
