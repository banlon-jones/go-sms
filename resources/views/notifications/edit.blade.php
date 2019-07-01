@extends('layouts.app')

@section('content')
<div class="container">
  <!-- Material form subscription -->
<div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong> <i class="fa fa-pencil"></i> Compose notification message </strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">

        <!-- Form -->
        <form method="post" action="/notifications/{{ $notification->id }}" style="color: #757575;">
          <input type="hidden" name="_method" value="put">
          {{ csrf_field() }}
            <div class="md-form mt-3">
                <input type="text" id="header" class="form-control" name="subject" value="{{ $notification->subject }}">
                <label for="header"> Subject </label>
            </div>
            <div class="form-group">
                <label for="body"> Message </label>
                <textarea class="form-control rounded-1" id="body" rows="10" placeholder="Message" name="body">{{ $notification->body }}</textarea>
            </div>
            <!-- Material switch -->
              <div class="switch">
                message type :
                <label>
                  <input type="checkbox" name="type" value="email">
                  <span class="lever"></span> notification
                </label>
              </div>

              <div class="bt-group pull-right">
                <button class="btn btn-success" type="submit"> Save </button>
              </div>
            </form>
        <!-- Form -->

</div>
@endsection
