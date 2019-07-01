@extends('layouts.app')

@section('content')
<div class="container" xmlns="">
  <!-- Material form subscription -->

<div class="card">

    <h5 class="card-header info-color white-text text-center py-4">
        <strong> <i class="fa fa-pencil"></i> Compose message </strong>
    </h5>

    <!--Card content-->
    <div class="card-body px-lg-5">
      <section>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item waves-effect waves-light">
            <a class="nav-link" id="home-tab" data-toggle="tab" href="#sms" role="tab" aria-controls="home" aria-selected="false"> SMS </a>
          </li>
          <li class="nav-item waves-effect waves-light">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#email" role="tab" aria-controls="profile" aria-selected="false"> Email </a>
          </li>

        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade" id="sms" role="tabpanel" aria-labelledby="home-tab">
            <!-- Form -->
            <form method="post" action="/draft_message" style="color: #757575;" name="sms_form">
              {{ csrf_field() }}
                <div class="md-form mt-3">
                    <input type="text" id="header" class="form-control" name="header">
                    <label for="header"> Header/subject </label>
                </div>
                <div class="form-group">
                    <label for="body"> Message </label>
                    <textarea class="form-control rounded-1" id="body" rows="10" placeholder="Message" name="body"></textarea>
                </div>
                <!-- Material switch -->
                      <input type="hidden" name="type" id="type" value="sms">
                  <div class="btn-group-sm pull-right">
                    <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Save as draft</button>
                    <a class="btn btn-danger btn-sm" id="sendSms"><i class="fa fa-paper-plane"></i> send </a>
                  </div>

</form>
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
<button class="btn btn-danger btn-sm" id="confirm"><i class="fa fa-paper-plane-o"> </i> Send </button>
</form>
</div>

</div>
</div>
</div>
          </div>

          <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="profile-tab">
            <!-- Form -->
            <form method="post" action="/draft_message" style="color: #757575;" name="email_form">
              {{ csrf_field() }}
                <div class="md-form mt-3">
                    <input type="text" id="subject" class="form-control" name="subject" required>
                    <label for="header"> subject </label>
                </div>
                <div class="form-group">
                    <label for="body"> Message </label>
                    <textarea class="form-control rounded-1" id="message" rows="10" placeholder="Message" name="body" required="required"></textarea>
                </div>
                <!-- Material switch -->
                      <input type="hidden" name="messageType" value="email" id="messageType">
                  <div class="bt-group pull-right">
                    <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-save"></i> Save as draft</button>
                    <a class="btn btn-danger btn-sm" id="sendEmail"><i class="fa fa-paper-plane"></i> send </a>
                  </div>


                </form>
          </div>
        </div>
          <!-- Modal -->
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


      </section>


</div>
<!-- Material form subscription -->
</div>
<script type="text/javascript">
    $(document).on('click',"#sendSms",function(){
      data="";
      $.ajax({
        url: '/message',
        type: 'POST',
        data:{
          '_token': $('input[name=_token]').val(),
          header:$('#header').val(),
          body: $('#body').val(),
          type: $('#type').val()
        },
        success: function(data){
            $('#message_id').val(data.id);
                $('#contactsModal').modal('show');
            }
      });
    });
</script>
    <script type="text/javascript">
        $(document).on('click',"#sendEmail",function(){
            data="";
            $.ajax({
                url: '/message',
                type: 'POST',
                data:{
                    '_token': $('input[name=_token]').val(),
                    header:$('#subject').val(),
                    body: $('#message').val(),
                    type: $('#messageType').val(),
                },
                success: function(data){
                    $('#email_id').val(data.id);
                    $('#emailModal').modal('show');
                }
            });
        });
    </script>
    <script type="text/javascript">
        $(document).ajaxStart(function () {
            $("#preloader").replaceWith(
                "<div id='loader-wrapper' style='background: white;'>"+
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
@endsection
