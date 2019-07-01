@extends('layouts.app')

@section('content')
<div class="container">
  <div class="card mb-3">
  <div class="card-header"><h3><i class="fa fa-users"></i> {{ $group->name }}</h3></div>
  <div class="card-body">
    <p class="card-title"> {{ $group->description }} <a class="upload btn btn-primary btn-sm pull-right"> upload contacts to group </a></p>
  </div>
  </div>
</div>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-5">
      <div class="card">
        <table class="table table-striped" id="members">
          <h3 class="text-center"> members </h3>
      @if ($group->contacts->count() > 0)
          <thead>
            <tr>
              <th scope="col">#</th>
              <th scope="col">Name</th>
              <th scope="col">Phone</th>
              <th scope="col">action</th>
            </tr>
          </thead>
          <tbody>
            <?php $count = 1; ?>
        @foreach ($group->contacts as $contact)
              <tr class="contact{{$contact->id}}">
                <td scope="row">{{ $count ++ }}</td>
                <td> {{ $contact->name }} </td>
                <td>{{ $contact->phone }}</td>
                <td>
                  <a class="remove btn btn-warning btn-sm" data-contact="{{$contact->id}}" data-group_id="{{$group->id}}"><i class="fa fa-times"></i> remove </a>
                </td>
              </tr>
        @endforeach
          </tbody>
      @else
        <small class="text-center"> this Group has no contacts </small>
        <small class="text-center"> click "Add" on desired contact from 'contact list' on the right panel </small>
      @endif
      </table>
    </div>
    </div>
    <div class="col-md-7">
      <div class="card">
        <table class="table table-striped table-responsive">
          <h3 class="text-center"> contacts </h3>
      @if ($contacts->count() > 0)
          <thead>
            <tr>
              <th>Name</th>
              <th>Phone</th>
              <th>Email</th>
              <th>action</th>
            </tr>
          </thead>
          <tbody>
            <?php $numb =1 ; ?>
        @foreach ($contacts as $contact)
              <tr>
                <td>{{ $contact->name }}</td>
                <td>{{ $contact->phone }}</td>
                <td>{{ $contact->email }}</td>
                <td>
                  <a class="add btn btn-success btn-sm" data-contact="{{$contact->id}}" data-group_id="{{$group->id}}"> add </a>
                </td>
              </tr>
        @endforeach
          </tbody>
      @else
        <small class="text-center"> user has no contacts </small>
        <small class="text-center"> click " add/upload " to create contact list <a href="/contacts/create" class="btn btn-success"> add/upload </a>  </small>
      @endif
      </table>
    </div>
    </div>
    </div>
  </div>
</div>
<!--add contacts modal -->
<div class="modal fade" id="addcontacts" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Upload Contact</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="text-center">
          <p style="color: red"> {{ $errors->first('contacts') }} </p>
        </div>
        <form method="post" action="/upload_to_group" id="uploadContacts" enctype="multipart/form-data">
         {{ csrf_field() }}
          <input type="hidden" name="group_id" value="{{$group->id}}">
          <input type="file" name="contacts" class="form-control">
          <button  id="upload" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> upload </button>
          <a href="/download_contact_template" class="btn btn-secondary btn-sm pull-right"> download contact template </a>
        </form>
      </div>

    </div>
  </div>
</div>

<script>

  $(document).on('click','.upload',function () {
      $("#addcontacts").modal("show");
  });
  $(document).on('click','#uplaod', function () {
      document.getElementById("uploadContacts").submit();
  });
  $(document).on('click','.add', function () {
      $.ajax({
          type:"post",
          url:"/addcontact",
          data:{
              '_token': $("input[name=_token]").val(),
              'group_id': $(this).data("group_id"),
              'contact_id':$(this).data("contact"),
          },
          success: function (data) {
              if( data.id == null ){
                  toastr.success('Error contact already');
              }else {
                  $("#members").append(
                      "<tr id='contact" + data.id +"'>"+
                      "<td>"+"</td>"+
                      "<td>"+ data.name +"</td>"+
                      "<td>"+ data.phone +"</td>"+
                      "<td>"+
                      "<a class='remove btn btn-warning btn-sm' data-contact='"+data.id+"' data-group_id='"+ data.id+"'><i class='fa fa-times'></i>remove </a>"+
                      "</td>"+
                      "</tr>"
                  );
                  toastr.success('contact successfully added');
              }

          }
      });
  });
  $(document).on('click','.remove', function () {
      var contact = $(this).data("contact");
      $.ajax({
          type:"post",
          url:"/removecontact",
          data:{
              '_token': $("input[name=_token]").val(),
              'group_id': $(this).data("group_id"),
              'contact_id':$(this).data("contact"),
          },
          success: function (data) {
              $(".contact" + contact ).remove();
              toastr.success('contact successfully removed');
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
