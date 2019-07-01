@extends('layouts.app')

@section('content')
  <div class="container">
    <card>
      <h3 class="text-center"> messages </h3>
      @if ($messages->count() > 0)
        <table class="table table-hover">
          <thead>
          <tr class="text-center">
            <th scope="col">No.</th>
            <th>Header</th>
            <th style="width: 15em"> body</th>
            <th>type</th>
            <th style="width: 10em">sent_at</th>
            <th>actions</th>
          </tr>
          </thead>
            <?php $count = 1; ?>
          <tbody>
          @foreach ($messages as $message)
            <tr>
              <td>{{ $count ++ }}</td>
              <td>{{ $message->header }}</td>
              <td>{{ $message->body }}</td>
              <td>{{ $message->type }}</td>
              <td>{{ $message->created_at }}</td>
              <td class="btn-group-sm">
                <a href="/messages/{{ $message->id }}/edit" class="btn btn-info btn-sm"><i class="fa fa-pencil"></i> edit</a>
                <button class="btn btn-sm btn-danger"
                        onclick="
                                var x = confirm(' delete message ? ');
                                if (x) {
                                event.preventDefault();
                                document.getElementById('delete-form{{ $count }}').submit();
                                }">
                  <i class="fa fa-trash"> </i> delete </button>
                <form id="delete-form{{ $count }}" action="{{ route('messages.destroy',[$message->id]) }}" method="POST" style="display: none;">
                  <input type="hidden" name="_method" value="delete">
                  {{ csrf_field() }}
                </form>
                <button class="btn btn-success btn-sm send" data-id="{{$message->id}}" data-type="{{$message->type}}"><i class="fa fa-paper-plane"> </i> send </button>
              </td>
            </tr>

          @endforeach
          </tbody>
        </table>
      @else
        <h5 class="text-center"> No message to display </h5>
      @endif

    </card>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="contactsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">select recipients</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
        <div class="modal-body">
          <form method="post" action="/invoice" id="contacts">
            {{ csrf_field() }}
            <div>
              <input type="hidden" name="message_id" id="message_id" value="" required>
              <span>groups</span>
              <select class="mdb-select md-form" multiple name="group_ids[]">
                <option value="" disabled selected>Choose group</option>
                @foreach ($groups as $group)
                  <option value="{{$group->id}}"> {{ $group->name }} </option>
                @endforeach
              </select>
            </div>
            <div>
              <span>contacts</span>
              <select class="mdb-select md-form" multiple name="contacts[]">
                <option value="" disabled selected>Choose contacts</option>
                @foreach ($contacts as $contact)
                  <option value="{{$contact->country_code.$contact->phone}}"> {{ $contact->name }}</option>
                @endforeach
              </select>
            </div>
            <button class="btn btn-danger btn-sm" id="confirm"><i class="fa fa-paper-plane-o"> </i> Send </button>
          </form>
        </div>

      </div>
    </div>
  </div>
  <div class="modal fade" id="emailModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">select recipients</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
        <div class="modal-body">
          <form method="post" action="/invoiceEmail" id="contacts">
            {{ csrf_field() }}
            <div>
              <input type="hidden" name="message_id" id="email_id" value="" required>
              <span>groups</span>
              <select class="mdb-select md-form" multiple name="group_ids[]">
                <option value="" disabled selected>Choose group</option>
                @foreach ($groups as $group)
                  <option value="{{$group->id}}"> {{ $group->name }} </option>
                @endforeach
              </select>
            </div>
            <div>
              <span>contacts</span>
              <select class="mdb-select md-form" multiple name="contacts[]">
                <option value="" disabled selected>Choose contacts</option>
                @foreach ($contacts as $contact)
                  <option value="{{$contact->email}}"> {{ $contact->name }}</option>
                @endforeach
              </select>
            </div>
            <button class="btn btn-danger btn-sm" id="confirm"><i class="fa fa-paper-plane-o"> </i> Send </button>
          </form>
        </div>

      </div>
    </div>
  </div>


  <script type="text/javascript">
      $(document).on('click','.send',function () {
          if($(this).data("type") == 'sms'){
              $('#message_id').val($(this).data('id'));
              $("#contactsModal").modal("show");
          }else {
              $('#email_id').val($(this).data('id'));
              $("#emailModal").modal("show");
          }
      });
  </script>

@endsection
