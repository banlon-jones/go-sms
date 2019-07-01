@extends('layouts.app')

@section('content')
    <div class="container">
      <section class="card">
        <div class="card-header white-text">
          <h4 class="black-text"><i class="fa fa-plus"></i> Add contact </h4>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary btn-sm pull-right" data-toggle="modal" data-target="#exampleModalLong"><span class="fa fa-upload"></span>
          Upload Contact
          </button>
        </div>
        <div class="card-body">
            <form id="contact-form" name="contact-form" action="{{ route('contacts.store') }}" method="POST">
              {{ csrf_field() }}
                <div class="row">
                    <div class="col-md-3">
                      <div class="md-form mb-0">
                            <input type="text" id="name" name="name_1" class="form-control">
                            <label for="name">Name</label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="country_code" name="country_code" class="form-control">
                            <label for="country_code"> Country Code </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                      <div class="md-form mb-0">
                          <input type="text" id="phone" name="phone_1" class="form-control">
                            <label for="phone"> Phone </label>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="md-form mb-0">
                            <input type="text" id="email" name="email_1" class="form-control">
                            <label for="email"> Email </label>
                        </div>
                    </div>
                  </div>
                <br>
                <div class="text-center">
                  <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-save"></i> Save </button>
                </div>
          </form>
                  <!-- Modal -->
                  <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
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
                            <input type="file" name="contacts" class="form-control btn-sm"><br>
                            <button type="submit" class="btn btn-success  btn-sm"><i class="fa fa-upload"></i> upload </button>
                          </form>
                          <a href="/download_contact_template" class="btn btn-secondary btn-sm pull-right"> download contact template </a>
                        </div>

                      </div>
                    </div>
                  </div>

            <script>
            </script>
        </div>
    </div>
</section>
<!--Section: Contact v.2-->

@endsection
