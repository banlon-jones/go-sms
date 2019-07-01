@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card">
        <h3 class="card-header text-center font-weight-bold text-uppercase py-4"> Users </h3>
        <div class="card-body">
            <div id="table" class="table-editable">
                <table class="table table-responsive-md table-striped">
                    <tr>
                        <th>No.</th>
                        <th>User name</th>
                        <th>Email</th>
                        <th> Phone </th>
                        <th>Roles</th>
                    </tr>
                <?php $count = 1; ?>
                    <!-- This is our clonable table line -->
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $count ++ }}</td>
                            <td>
                                <a href="/users/{{ $user->id }}">  {{ $user->name }} </a>
                            </td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>
                              <form id="permission-form{{ $count }}" method="post" action="/users/{{ $user->id }}/permissions">
                                <!--Blue select-->
                                {{ csrf_field() }}
                                <select class="mdb-select md-form" name="role_id" onchange="
                                var x = confirm(' Are you sure you want to change user role ');
      													if (x) {
      														event.preventDefault();
                                                           document.getElementById('permission-form{{ $count }}').submit();
      													}
                                ">
                                    <option>Choose a role</option>
                                  @foreach( $roles as $role)
                                        <option value="{{ $role->id }}" @if($user->role_id == $role->id)
                                        selected
                                                @endif
                                        > {{ $role->name }} </option>
                                  @endforeach
                                </select>
                                <!--/Blue select-->
                              </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>

    <!-- Editable table -->
</div>
@endsection
