@extends('layouts.app')

@section('content')
<div class="container">
<card>
  <h3> @lang('messages.notification_title') <a href="/notifications/create" class="btn btn-danger pull-right"> Compose message </a>  </h3>

  @if ($notifications->count() > 0)
    <table class="table table-bordered">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col" style="width: 30em;">subject</th>
        <th scope="col"> created at</th>
        <th scope="col">actions</th>
      </tr>
    </thead>
    <?php $count = 1; ?>
    <tbody>
      @foreach ($notifications as $notification)
        <tr>
          <td>{{ $count ++ }}</td>
          <td> {{ $notification->subject }} </td>
          <td> {{ $notification->created_at }} </td>
          <td>
            <a href="/notifications/{{ $notification->id }}/edit" class="@lang('messages.edit_button')"><i class="fa fa-pencil"></i> @lang('messages.edit') </a>
            <button class="@lang('messages.delete_button')"
            onclick=" var x = confirm(' delete message ? ');
                                  if (x) {
                                    event.preventDefault();
                                 document.getElementById('delete-form{{ $count }}').submit();
                                  }">
            <i class="fa fa-trash"> </i> @lang('messages.delete') </button>
            <form id="delete-form{{ $count }}" action="{{ route('notifications.destroy',[$notification->id]) }}" method="POST" style="display: none;">
                <input type="hidden" name="_method" value="delete">
                {{ csrf_field() }}
            </form>
            <a class="@lang('messages.send_button')" href="/sendnote/{{ $notification->id }}/send"><i class="fa fa-paper-plane"> </i> @lang('messages.send') </a>
          </td>
        </tr>
      @endforeach
    </tbody>
  </table>
@else
<h5 class="text-center"> No notifications message to display </h5>
    @endif

</card>
</div>
<div class="fixed-action-btn" style="bottom: 45px; right: 24px;">
  <a class="btn-floating btn-lg red">
    <i class="fa fa-pencil"></i>
  </a>

  <ul class="list-unstyled">
    <li><a href="/inbox" class="btn-floating red"><i class="fa fa-inbox"></i></a></li>
    <li><a href="/groups" class="btn-floating yellow darken-1"><i class="fa fa-users"></i></a></li>
    <li><a href="/transactions" class="btn-floating blue"><i class="fa fa-money"></i></a></li>
    <li><a href="/notifications/create" class="btn-floating red"><i class="fa fa-pencil"></i></a></li>
  </ul>
</div>
@endsection
