@extends('layouts.app')

@section('content')
    <div class="container">
        <!-- Card -->
        <div class="card mx-xl-5">

            <!-- Card body -->
            <div class="card-body">

                <!-- Default form subscription -->
                <form method="POST" action="{{ route('users.update', [$user->id]) }}">
                    <input type="hidden" name="_method" value="put">
                    {{ csrf_field() }}
                    <p class="h4 text-center py-4">Edit form</p>

                    <!-- Default input name -->
                    <label for="name" class="grey-text font-weight-light">Your name</label>
                    <input type="text" id="name" class="form-control" name="name" value="{{ $user->name }}">

                    <div class="form-group">
                        <label for="email" class="grey-text font-weight-light">Your email</label>
                        <input type="email" id="email" class="form-control" name="email" value="{{ $user->email }}" required>
                    </div>

                    <!-- Default input phone -->
                    <label for="phone" class="grey-text font-weight-light"> Phone number </label>
                    <input type="tel" id="phone" class="form-control" name="phone" value="{{ $user->phone }}">

                    <!-- Default input email -->
                    <label for="city" class="grey-text font-weight-light">Town/city</label>
                    <input type="text" id="city" class="form-control" name="city" value="{{ $user->city }}">

            </div>
            <div class="text-center py-4 mt-3">
                <button class="btn btn-success" type="submit"> Save <i class="fa fa-save ml-2"></i></button>
            </div>
            </form>
            <!-- Default form subscription -->

        </div>
        <!-- Card body -->

    </div>
    <!-- Card -->
    </div>
@endsection
