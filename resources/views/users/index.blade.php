@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4">users </h3>
        <div class="card-body">
            <div id="table" class="table-editable">
                <table id="users_table" class="table table-responsive-md table-striped text-center">
                    <tr>
                        <th class="text-center">S/N</th>
                        <th class="text-center">User name</th>
                        <th class="text-center">Email</th>
                        <th class="text-center"> Phone </th>
                        <th class="text-center">City</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">action</th>
                    </tr>
<?php $count = 1; $con = 0; ?>
                    <!-- This is our clonable table line -->
                    @foreach ($users as $user)
                        <tr class="user{{  $user->id }}">
                            <td class="pt-3-half" id="count">{{ $count ++ }}</td>
                            <td class="pt-3-half">
                                <a href="/users/{{ $user->id }}">  {{ $user->name }} </a>
                            </td>
                            <td class="pt-3-half">{{ $user->email }}</td>
                            <td class="pt-3-half">{{ $user->phone }}</td>
                            <td class="pt-3-half">{{ $user->city }}</td>
                            <td>
                                @if ($user->status == 0)
                                    {{ 'unverified'}}
                                    @else
                                    {{ 'verified' }}
                                @endif
                            </td>
                            <td class="btn-group">
                                <a href="/users/{{ $user->id }}/edit" class="btn btn-primary btn-sm"><i class="fa fa-pencil"></i> Edit</a>

                                @if ($user->status == 0)
                                    <a href="/users/{{$user->id}}" class="btn btn-success btn-sm"> Validate </a>
                                @else
                                    <a onclick="
                                document.getElementById('validation').submit();
                                        " class="btn btn-danger btn-sm"> Suspend </a>
                                    <form id="validation" method="post" action="/users/{{ $user->id }}/suspend" style="display: none">
                                        {{csrf_field()}}
                                        <input type="hidden" name="status" value="0">
                                    </form>

                                @endif

                            </td>
                        </tr>
                        <script type="text/javascript">
                            $("#delete{{ $user->id }}").click(function() {
                                if(confirm("Are you sure you want to delete user ?")){
                                   $.ajax({
                                        url: '{{ route('users.destroy',[$user->id]) }}',
                                        type: 'post',
                                        data:{
                                            '_method':$('input[name=_method]').val(),
                                            '_token':$('input[name=_token]').val(),
                                        },
                                        success: function (data) {
                                            $(".user"+{{ $user->id}}).remove();
                                            toastr.success('user successfully deleted');
                                        }
                                    });
                                }else {
                                    return false;
                                }
                            });
                        </script>
                    @endforeach

                </table>
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
    <!-- Editable table -->
</div>
@endsection
