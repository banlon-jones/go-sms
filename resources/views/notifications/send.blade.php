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
                <a class="btn btn-success" data-toggle="modal" data-target="#basicExampleModal"> Send <i class="fa fa-paper-plane"></i> </a>
              </div>
            </form>
        <!-- Form -->
<div class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel"> Select recipients</h5>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
    <div class="modal-body">
      <form method="post" action="/sendnote">
        {{ csrf_field() }}
        <input type="hidden" value="{{ $notification->id }}" name="note_id">
        <select class="mdb-select md-form colorful-select dropdown-primary" multiple searchable="Search here.." name="recipients[]">
          <option value="" disabled selected>Choose recipient</option>
          @foreach ($users as $user)
            <option value="{{ $user->id }}"> {{ $user->name }} </option>
          @endforeach
        </select>
        <label>Label example</label>
        <button class="btn-save btn btn-primary btn-sm">Save</button>
      </form>
    </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      <button type="button" class="btn btn-primary">Save changes</button>
    </div>
  </div>
</div>
</div>
</div>
@endsection
