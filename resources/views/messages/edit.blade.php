@extends('layouts.app')

@section('content')
<div class="container">
  <!-- Material form subscription -->
<div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong> <i class="fa fa-pencil"></i> edit message </strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">
        <!-- Form -->
        <form method="post" action="/messages/{{ $message->id }}" style="color: #757575;">
          <input type="hidden" name="_method" value="put">
          {{ csrf_field() }}
            <input type="hidden" id="message" value="{{$message->id}}"/>
            <div class="md-form mt-3">
                <input type="text" id="header" class="form-control" name="header" value="{{ $message->header }}">
                <label for="header"> Header/subject </label>
            </div>
            <div class="form-group">
                <label for="body"> Message </label>
                <textarea class="form-control rounded-1" id="body" rows="10" placeholder="Message" name="body">{{ $message->body }}</textarea>
            </div>
            <!-- Material switch -->

              <div class="btn-group-sm pull-right">
                <button class="btn btn-sm btn-success" type="submit"><i class="fa fa-save"></i> Save </button>
                <a class="btn btn-sm btn-danger" id="sendsms"><i class="fa fa-paper-plane-o"> </i> Send </a>
              </div>
            </form>
        <!-- Form -->

    </div>

</div>
<!-- Material form subscription -->
    <script type="text/javascript">
        $(document).on('click',"#sendsms",function(){
        data="";
       $.ajax({
        url: '/update_message',
        type: 'POST',
        data:{
        '_token': $('input[name=_token]').val(),
        message_id:$('#message').val(),
        header:$('#header').val(),
        body: $('#body').val(),

        },
        success: function(data){
        $('#message_id').val(data.id);
        $('#contactsModal').modal('show');
        }
        });
        });
    </script>

    <script type="text/javascript">
        $(document).ajaxStart(function () {
            $("#preloader").replaceWith(
                "<div id='loader-wrapper' style='background: rgba(255,255,255,0.74);'>"+
                "<div id='loader'></div>"+
                "<p style='color: red; text-align: center; font-size: 25px'>loading ...</p>"+
                "</div>"
            );
        })
            .ajaxStop(function () {
                $("#loader-wrapper").replaceWith(
                    "<div id='preloader'></div>"
                );
            });
    </script>
</div>
    <!-- contact modal -->
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
                        <input type="hidden" name="message_id" id="message_id" required>
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
                    <button class="btn btn-danger" id="confirm"><i class="fa fa-paper-plane-o"> </i> Send </button>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
