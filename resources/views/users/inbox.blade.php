@extends('layouts.app')

@section('content')
<div class="container">
  <?php $count = 1 ?>
  @if ($user->notifications->count() > 0)
    <div class="card">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4"> Inbox </h3>
        <div class="card-body">
          @foreach ($user->notifications as $notification)
            <?php $count ++ ?>
            <div class="media d-block d-md-flex">
              <img class="d-flex rounded-circle avatar z-depth-1-half mb-3 mx-auto"
                src="{{ asset('img/admin.jpg') }}" height="110" width="110"
                alt="Avatar">
              <div class="media-body text-center text-md-left ml-md-3 ml-0" data-toggle="modal"
              data-target="#basicExampleModal{{ $count }}">
                <h5 class="mt-0 font-weight-bold blue-text">{{ $notification->subject }}</h5>
                {{ $notification->body }}
              </div>
              <a href="#" class="btn btn-danger" onclick="
    var x = confirm(' delete message ');
    if (x) {
      event.preventDefault();
                               document.getElementById('remove-form{{ $count }}').submit();
    }
"> <i class="fa fa-trash"></i> Remove </a>
<form id="remove-form{{ $count }}" action="/removenote" method="POST" style="display: none;">
    {{ csrf_field() }}
<input type="hidden" name="note_id" value="{{ $notification->id }}">
</form>
            </div>
            <hr>

<!-- Modal -->
<div class="modal fade" id="basicExampleModal{{ $count }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">{{ $notification->subject }}</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        {{ $notification->body }}
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

          @endforeach
        </div>
    </div>
    @else
      <small>
        you have no new notification
      </small>
  @endif
</div>
@endsection
<style>
  body {
    background-color: #e6e6e6;
  }
</style>
