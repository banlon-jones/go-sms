@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h3 class="card-header py-4"> Contacts <button class="btn btn-info btn-sm pull-right" id="upload"> upload more contacts </button> </h3>
        <div class="card-body">
            <div id="table" class="table-editable">
                <table class="table table-responsive-md table-striped text-center">
                    <tr>
                        <th class="text-center">S/N</th>
                        <th class="text-center">name</th>
                        <th class="text-center"> Country_code </th>
                        <th class="text-center"> phone </th>
                        <th class="text-center" style="width: 35em;"> email </th>
                        <th class="text-center" style="width: 35em;"> Action </th>
                    </tr>
<?php $count = 1; ?>
                    <!-- This is our table line -->
                    @foreach ($contacts as $contact)
                        <tr class="contact{{$contact->id}}" id="contact">
                            <td>{{ $count ++}}</td>
                            <td>
                                  {{ $contact->name }}
                            </td>
                            <td>{{ $contact->country_code }}</td>
                            <td>{{ $contact->phone }}</td>
                            <td>{{ $contact->email }}</td>
                            <td>
                                <a id="edit" class="btn btn-success btn-sm" data-id="{{$contact->id}}" data-name="{{ $contact->name }}" data-country_code="{{$contact->country_code}}" data-phone="{{ $contact->phone }}"
                                data-email="{{ $contact->email }}"><i class="fa fa-pencil"></i> Edit</a>
                                <a id="delete" data-id="{{$contact->id}}" class="btn btn-danger btn-sm"><span class="fa fa-trash-o"></span> Delete </a>
                            </td>
                        </tr>

                    @endforeach
            <!-- Edit Modal -->
                <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="edit_form" name="contact-form">
                                    <input type="hidden" id="contact_id" value="">
                                    {{ csrf_field() }}
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="md-form mb-0">
                                                <input type="text" id="name" name="name" class="form-control" value="">
                                                <label for="name"> Name </label>
                                            </div>
                                         </div>
                                        <div class="col-md-2">
                                            <div class="md-form mb-0">
                                                <input type="text" id="country_code" name="country_code" class="form-control" value="">
                                                <label for="country_code"> Country Code </label>
                                            </div>
                                         </div>
                                        <div class="col-md-3">
                                            <div class="md-form mb-0">
                                                <input type="text" id="phone" name="phone" class="form-control" value="">
                                                <label for="phone"> Phone </label>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="md-form mb-0">
                                                <input type="text" id="email" name="email" class="form-control" value="">
                                                <label for="email"> Email </label>
                                            </div>
                                        </div>
                                    </div>

                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <a id="save" class="btn btn-primary">Save changes</a>
                            </div>
                        </div>
                    </div>
                </div>

                <script type="text/javascript">
                    $(document).on('click','#edit',function () {
                        $('#contact_id').val($(this).data("id"));
                        $('#name').val($(this).data("name"));
                        $("#country_code").val($(this).data("country_code"));
                        $("#phone").val($(this).data("phone"));
                        $("#email").val($(this).data("email"));
                        $("#editModal").modal("show");
                    });
                    $("#save").click(function () {
                        $.ajax({
                            url: "/contact/edit",
                            type: "post",
                            data: {
                                '_token': $("input[name=_token]").val(),
                                'contact_id':$("#contact_id").val(),
                                'name': $("#name").val(),
                                'country_code': $("#country_code").val(),
                                'phone': $("#phone").val(),
                                'email': $("#email").val()
                            },
                            success:function (data) {
                                $("#editModal").modal("hide");

                                $(".contact"+ data.id).replaceWith(
                                    "<tr id='tarif" + data.id +"'>"+
                                    "<td></td>"+
                                    "<td>" + data.name +"</td>"+"<form method='POST' style='display: none;'>"+
                                    "<input type='hidden' name='_method' value='delete'>"+

                                    "</form>"+
                                    "<td>" + data.country_code +"</td>"+
                                    "<td>" + data.phone +"</td>"+
                                    "<td>" + data.email +"</td>"+
                                    "<td>"+
                                    "<a id='edit' class='btn btn-success btn-sm'"+" data-id='"+ data.id + "'"+" data-name='"+ data.name+"'"+
                                    " data-country_code='"+data.country_code+"'"+" data-phone='"+ data.phone+"'"+" data-email='"+data.email+"'>"+
                                    "<i class='fa fa-pencil'></i>"+"edit"+
                                    "</a>"+
                                    "<a id='delete' class='btn btn-danger btn-sm' data-id="+data.id+"><span class='fa fa-trash-o'></span> Delete </a>"+
                                    "</td>"+
                                    "</tr>"
                                );
                                toastr.success('contact successfully updated');
                                //$("#contact-").replaceWith();
                            }
                        });
                    });
                </script>
                    <script type="text/javascript">
                        $(document).on('click', '#delete', function() {
                           if(confirm("Are you sure you want to delete contact ?")){
                                let contact_id = $(this).data('id');
                                alert($('input[name=_token]').val());
                                $.ajax({
                                    url: "/contacts/"+contact_id,
                                    type: 'post',
                                    data:{
                                        '_method': "delete",
                                        '_token':$('input[name=_token]').val(),
                                    },
                                    success: function (data) {
                                        $(".contact"+ contact_id).remove();
                                        toastr.success('contact successfully deleted');
                                    }
                                });
                            }else {
                                return false;
                            }
                        });
                    </script>

                <!-- Modal -->
                    <div class="modal fade" id="upload-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                        <div class="modal-dialog" role="document">
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
                                    <form method="post" action="/importcontacts" name="uploadContacts" enctype="multipart/form-data">
                                        {{ csrf_field() }}
                                        <input type="file" name="contacts" class="form-control">
                                        <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-upload"></i> upload </button>
                                    </form>
                                    <a href="/download_contact_template" class="btn btn-secondary btn-sm pull-right"> download contact template </a>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <script type="text/javascript">
                        $("#upload").click(function () {
                            $("#upload-modal").modal("show");
                        });
                    </script>
                </table>
            </div>
        </div>
    </div>

    <!-- Editable table -->
</div>
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
