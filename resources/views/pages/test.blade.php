@extends('layouts.app')

@section('content')
  
      <div class="row">
            <div class="col-md-12">
                
                        <div class="jumbotron">
                              <div>
                                          <h1>fill out the form</h1>
                              </div>
                        </div>
                        
                 
                 
            </div>
      </div>
      <div class="row">
          <div class="col-md-12">
                <div class="form-group">
                    <form name="myform" action="submit" method="post" enctype="multipart/form-data">
                       
                        <div class="form-group">
                                <label for="fname">First Name</label>
                                <input type="text" class="form-control" id="fname" placeholder="First name" name="fname">
                                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                              </div>
                              <div class="form-group">
                                <label for="lname">Last Name</label>
                                <input type="text" class="form-control" id="lname" placeholder="Last name" name="lname">
                              </div>
                              <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Check me out</label>
                              </div>
                              <div class="form-group">
                                  <label for="profile_picture">Select photo to upload</label>
                                  <input type="file" class="form-control" placeholder="choose profile picture" name="porfile_picture">
                              </div>
                              <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                            
                    </form>
                </div>
          </div>    
      </div>

@endsection