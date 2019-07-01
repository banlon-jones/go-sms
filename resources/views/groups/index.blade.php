@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <h3 class="card-header font-weight-bold py-4"> Groups <a class="addgroup pull-right btn btn-success btn-sm"><i class="fa fa-plus"></i> add group </a></h3>
            <div class="card-body">
                <div id="table" class="table-editable">
                    <table class="table table-responsive-md table-striped">
                        <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">name</th>
                            <th class="text-center"> description </th>
                            <th class="text-center" style="width: 35em;"> Action </th>
                        </tr>
                    <?php $count = 1; ?>
                    <!-- This is our clonable table line -->
                        @foreach ($groups as $group)
                            <tr class="group{{$group->id}}">
                                <td class="pt-3-half">{{ $count ++ }}</td>
                                <td class="pt-3-half">{{ $group->name }}</td>
                                <td class="pt-3-half">{{ $group->description }}</td>
                                <td class="btn-group">
                                    <a href="/addcontacts/{{ $group->id }}" class="btn btn-secordary btn-sm"> Add contacts </a>
                                    <a class="edit btn btn-info btn-sm" data-id="{{$group->id}}" data-name="{{$group->name}}" data-desc="{{$group->description}}"><i class="fa fa-pencil"></i> Edit</a>
                                    <a class="delete btn btn-danger btn-sm" data-id="{{$group->id}}" data-name="{{$group->name}}"><span class="fa fa-trash-o"></span> Delete </a>
                                </td>
                            </tr>
                        @endforeach

                    </table>
                </div>
            </div>
        </div>
        <!-- Editable table -->
    </div>
    <!-- create modal -->
    </div>
    <div class="modal fade" id="addGroup" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Add group
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="createTarifForm">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name" class="form-control" required>
                                    <label for="name"> Name </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="md-form mb-0">
                                    <input type="text" id="description" name="description" class="form-control" required>
                                    <label for="name"> Desciption </label>
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
    <!-- create modal -->
    </div>
    <div class="modal fade" id="editform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    Edit group
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="createTarifForm">
                        <input type="hidden" id="group_id" value="">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="md-form mb-0">
                                    <input type="text" id="group_name" class="form-control" value="" required>
                                    <label for="name"> Name </label>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="md-form mb-0">
                                    <input type="text" id="group_description" name="description" value="" class="form-control" required>
                                    <label for="name"> Desciption </label>
                                </div>
                            </div>

                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="edit" class="btn btn-primary">Save changes</a>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).on('click','.addgroup',function () {
            $('#addGroup').modal('show');
        });
        $(document).on('click','#save',function(){
            var data =[];
            $.ajax({
                type:"post",
                url:"/addgroup",
                data:{
                    '_token': $("input[name=_token]").val(),
                    'name' : $("input[name=name]").val(),
                    'description': $('input[name=description]').val(),
                },
                success: function (group) {
                    $('#addGroup').modal('hide');
                    $("table").append(
                        "<tr class='group" + group.id +"'>"+
                        "<td>" + "" +"</td>"+
                        "<td>" + group.name +"</td>"+
                        "<td>" + group.description  +"</td>"+
                        "<td>"+
                        "<a href='/addcontacts/"+group.id+"' class='btn btn-secordary btn-sm'> Add contacts </a>"+
                        "<a class='edit btn btn-info btn-sm'"+" data-id='"+group.id+"' data-name='"+group.name+"' data-desc='"+ group.description+"'><i class='fa fa-pencil'></i> Edit</a>"+
                        "<a class='delete btn btn-danger btn-sm' data-id='"+group.id+"' data-name='"+group.name+"'><span class='fa fa-trash-o'></span> Delete </a>"+
                        "<td>"+
                        "</tr>"
                    );
                    toastr.success('group successfully created');

                }

            });
        });
        $(document).on('click','.edit',function () {
            $('#group_id').val($(this).data("id"));
            $("#group_name").val($(this).data("name"));
            $("#group_description").val($(this).data('desc'));
            $('#editform').modal('show');
        });
        $(document).on('click','#edit',function(){
            var data =[];
            $.ajax({
                type:"post",
                url:"/editgroup",
                data:{
                    '_token': $("input[name=_token]").val(),
                    'id': $('#group_id').val(),
                    'name' : $("#group_name").val(),
                    'description': $("#group_description").val(),
                },
                success: function (group) {
                    $('#editform').modal('hide');
                    $(".group"+ group.id).replaceWith(
                        "<tr class='group" + group.id +"'>"+
                        "<td>" + "" +"</td>"+
                        "<td>" + group.name +"</td>"+
                        "<td>" + group.description +"</td>"+
                        "<td>"+
                        "<a href='/addcontacts/"+group.id+"' class='btn btn-secordary btn-sm'> Add contacts </a>"+
                        "<a id='edit' class='edit btn btn-info btn-sm'"+" data-id='"+group.id+"' data-name='"+group.name+"' data-desc='"+ group.description+"'><i class='fa fa-pencil'></i> Edit</a>"+
                        "<a class='delete btn btn-danger btn-sm' data-id='"+group.id+"' data-name='"+group.name+"'><span class='fa fa-trash-o'></span> Delete </a>"+
                        "<td>"+
                        "</tr>"
                    );
                    toastr.success('group successfully updated');
                }

            });
        });
        $(document).on('click','.delete',function () {
            var id = $(this).data("id");
            if (confirm( "Are you sure you want to delete "+ $(this).data("name") + " group")){
                $.ajax({
                    type: "post",
                    url: "/deletegroup",
                    data:{
                        '_token': $("input[name=_token]").val(),
                        "id": $(this).data("id"),
                    },
                    success: function () {
                        $(".group"+ id).remove();
                        toastr.success("group deleted !!");
                    }
                });
            }
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
