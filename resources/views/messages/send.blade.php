@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card">
      <div class="card-header">
          <h3 class="card-title"> select recipients </h3>
      </div>
      <div class="card-body">
        <form method="post" action="/send">
          <input type="hidden" name="message_id" value="{{ $message_id }}">
          {{ csrf_field() }}
          <p> Groups </p>
          <select class="mdb-select md-form" multiple name="groups[]">
              <option value="" disabled selected>Select groups </option>
              @foreach ($groups as $key => $group)
                <option value="{{ $group->id }}">{{ $group->name }}</option>
              @endforeach
          </select>
          <button class="btn-save btn btn-primary btn-sm">Save</button>
          <p> contacts </p>
          <select class="mdb-select md-form" multiple name="contacts[]">
              <option value="" disabled selected>Select contacts </option>
              @foreach ($contacts as $key => $contact)
                <option value="{{$contact->id}}"> {{ $contact->name }}</option>
              @endforeach
          </select>
          <div class="text-center">
            <button type="submit" class="btn btn-success btn-sm"> send <i class="fa fa-paper-plane"></i></button>
          </div>
        </form>
      </div>
  </div>
</div>
@endsection
