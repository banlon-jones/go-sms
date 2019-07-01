@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <p class="card-header py-4"> Roles <a class="addRole btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> add role </a> </p>
            <div class="card-body">
                <div id="table" class="table-editable">
                    @if( $roles->count() > 0 )
                        <table class="table table-responsive-md table-bordered">
                            <tr>
                                <th>S/N</th>
                                <th>name</th>
                                <th> Description </th>
                                <th> privileges </th>
                                <th> Action </th>
                            </tr>
                            <?php $count = 1 ?>
                            @foreach($roles as $role)
                                <tr id="role{{$role->id}}">
                                    <td>{{ $count ++ }}</td>
                                    <td>{{ $role->name }}</td>
                                    <td>{{ $role->description }}</td>
                                    <td>
                                        @foreach ($role->privileges as $privilege)
                                            {{ $privilege->name }}<hr>
                                        @endforeach
                                    </td>
                                    <td>
                                        <a class="edit btn btn-success btn-edit btn-sm" data-privileges="{{$role->privileges()->get()->pluck('id')}}" data-id="{{$role->id}}" data-name="{{$role->name}}" data-desc="{{$role->description}}"><i class="fa fa-pencil"></i> edit </a>
                                    </td>
                                </tr>
                            @endforeach

                        </table>
                    @else
                        <small> no role set. click to add role </small>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="addRole" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="createRole" action="create_role" method="post">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-4">
                                <div class="md-form mb-0">
                                    <input type="text" name="name" value="" class="form-control" required>
                                    <label for="name"> Name </label>
                                </div>
                            </div>

                            <div class="col-md-8">
                                <div class="md-form mb-0">
                                    <input type="text"name="description" class="form-control" value="" required>
                                    <label for="max"> description </label>
                                </div>
                            </div>
                        </div>
                        <select class="mdb-select md-form" multiple name="privileges[]">
                            <option value="" disabled selected>Choose privilege</option>
                            @foreach ($privileges as $privilege)
                                <option value="{{$privilege->id}}"> {{ $privilege->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="editRole" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Edit role </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="editRole" action="edit_role" method="post">
                        <input type="hidden" name="role" id="role" value="">
                        {{csrf_field()}}
                        <div class="row">
                            <div class="col-md-5">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name" value="" class="form-control" required>
                                    <label for="name"> Name </label>
                                </div>
                            </div>

                            <div class="col-md-7">
                                <div class="md-form mb-0">
                                    <input type="text" id="desc" name="description" class="form-control" value="" required>
                                    <label for="max"> description </label>
                                </div>
                            </div>
                        </div>
                        <select class="mdb-select md-form" multiple name="privileges[]" id="privileges">
                            <option value="" disabled selected>Choose privilege</option>
                            @foreach ($privileges as $privilege)
                                <option value="{{$privilege->id}}" data-id="{{$privilege->id}}"> {{ $privilege->name }}</option>
                            @endforeach
                        </select>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>
            </div>
        </div>
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
<script>
    $(document).on('click','.addRole', function () {
        $("#addRole").modal("show");
    });
    $(document).on('click','.edit', function () {
        $("#desc").val($(this).data("desc"));
        $("#name").val($(this).data("name"));
        $("#role").val($(this).data("id"));
        $("#privileges").val($(this).data('privileges'));
        $('#editRole').modal("show");
    })
</script>
@endsection
