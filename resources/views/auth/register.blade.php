@extends('layouts.login_nav')

@section('content')
<div class="container">
    <!-- Card -->
    <div class="card mx-xl-5">

        <!-- Card body -->
        <div class="card-body">

            <!-- Default form subscription -->
            <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <p class="h4 text-center py-4">Signup form</p>

                <!-- Default input name -->
                <label for="name" class="grey-text font-weight-light">Your name</label>
                <input type="text" id="name" class="form-control" name="name" required>
                <!-- Default input email -->
                <br>
                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                    <label for="defaultFormCardEmailEx" class="grey-text font-weight-light">Your email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                        @if ($errors->has('email'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                        @endif

                </div>

                <!-- Default input email -->
                <label for="phone" class="grey-text font-weight-light">Phone number </label>
                <input type="tel" id="phone" class="form-control" name="phone" required>
                <br>

                <!-- Default input email -->
                <label for="city" class="grey-text font-weight-light">Town/city</label>
                <input type="text" id="city" class="form-control" name="city" required>
                <br>
                <div class="form-group">
                    <label> upload profile picture</label>
                    <input type="file" class="form-control" name="profile_pic" required>
                </div>
                <div class="form-group">
                    NB: upload any legal issued document dat can be used to verify your account such as(ID card, passport snapshot)
                    <input type="file" class="form-control" name="verification_doc" required>
                </div>
                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                    <label class="grey-text font-weight-light">Password</label>

                    <div>
                        <input id="password" type="password" class="form-control" name="password" required>

                        @if ($errors->has('password'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <label for="password-confirm" class="grey-text font-weight-light">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                </div>
                <div class="form-check">
                    <p id="terms">Click to read Terms and conditions </p>
                    <input type="checkbox" class="form-check-input" id="materialChecked2" required>
                    <label class="form-check-label" for="materialChecked2">Agree to Terms&conditions</label>
                </div>

                <div class="text-center py-4 mt-3">
                    <button class="btn btn-success" type="submit">Save<i class="fa fa-save ml-2"></i></button>
                </div>
            </form>
            <!-- Default form subscription -->

        </div>
        <!-- Card body -->

    </div>
    <!-- Card -->
</div>
<div class="modal fade" id="terms_conditions" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Terms & Conditions</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @lang('terms.terms')
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary btn-sm"> I agree </button>
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).on('click','#terms', function(){
            $('#terms_conditions').modal('show');
        });
    </script>
@endsection
