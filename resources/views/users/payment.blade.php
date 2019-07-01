@extends('layouts.app')

@section('content')
   <div class="row">
       <div class="col-md-6">
           <!-- Card -->
           <div class="card">
               <div class="card-body">
                   <!-- Title -->
                   <h4 class="card-title"><a> Tarifs</a></h4><br>
                   <table class="table table-hover">
                       @foreach($tarifs as $tarif)
                           <tr>
                               <td> {{$tarif->name}} </td>
                               <td> {{$tarif->min}} mail</td>
                               <td> To </td>
                               <td> {{$tarif->max }} mail</td>
                               <td> {{$tarif->unit_price}} CFA per mail </td>
                           </tr>
                       @endforeach
                   </table>

               </div>

           </div>
           <!-- Card -->
       </div>
       <div class="col-md-6">
           <div class="card">
               <div class="card-body">

                   <!-- Title -->
                   <h4 class="card-title"><a> Invoice </a></h4>
                   <!-- Text -->
                   <p class="card-text"> you have selected <span class="contacts"> {{ $contacts->count() }} </span> contacts billed at <span class="bill"> {{ $price }} </span> per sms </p>
                   <br>
                   <p class="btn btn-danger btn-lg">Total amount : <span class="amount"></span> CFA </p>
                   <a id="makePaymaent" class="btn btn-primary"> make payment </a>

               </div>

           </div>
           <!-- Card -->
       </div>
   </div>
   <div class="modal fade" id="payment" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
       <div class="modal-dialog modal-notify modal-success" role="document">
           <!--Content-->
           <div class="modal-content">
               <!--Header-->
               <div class="modal-header">
                   <p class="heading lead"> Select payment channel </p>

                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true" class="white-text">&times;</span>
                   </button>
               </div>
               <!--Body-->
               <div class="modal-body">
                  <div class="row">
                      <div class="col-md-6">
                          <div class="card" id="mtn">
                              <div id="mtn" class="view overlay">
                                  <img class="card-img-top" src="{{ asset("img/mtn.jpg") }}" alt="Card image cap">
                                  <a>
                                      <div class="mask rgba-white-slight"></div>
                                  </a>
                              </div>
                          </div>
                      </div>
                      <div class="col-md-6">
                          <div class="card" id="orange">
                              <div class="view overlay">
                                  <img id="orange" class="card-img-top" src="{{ asset("img/orange.jpg") }}" alt="Card image cap">
                                  <a>
                                      <div class="mask rgba-white-slight"></div>
                                  </a>
                              </div>
                          </div>
                      </div>
                  </div>
               </div>

           </div>
           <!--/.Content-->
       </div>
   </div>
   <!-- Central Modal Medium Success-->
   <!--mtn payment Modal -->
   <div class="modal fade" id="mtnpayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel"> Enter account number </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <form class="text-center" style="color: #757575;">
                       <div class="md-form">
                           {{ csrf_field() }}
                           <input type="hidden" name="contacts" value="{{ $contacts }}">
                           <input type="hidden" name="message_id" value="{{ $message_id  }}">
                           <input type="tel" name="mtnNumber" class="form-control">
                           <label for="phone"> momo number </label>
                       </div>
                   </form>
               </div>
               <div class="modal-footer">
                   <a id="mtnpay" class="btn btn-primary"> Submit </a>
               </div>
           </div>
       </div>
   </div>
   <!--mtn payment Modal -->
   <div class="modal fade" id="orangepayment" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                   <h5 class="modal-title" id="exampleModalLabel"> Enter account number </h5>
                   <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                       <span aria-hidden="true">&times;</span>
                   </button>
               </div>
               <div class="modal-body">
                   <form class="text-center" style="color: #757575;">
                       <div class="md-form">
                           <input type="tel" name="orangeNumber" class="form-control">
                           <label for="phone"> momo number </label>
                       </div>
                   </form>
               </div>
               <div class="modal-footer">
                   <a id="orangepay" class="btn btn-primary"> Submit </a>
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
       $(document).ready(function () {
           var amount = $(".contacts").text() * $(".bill").text();
           $(".amount").text(amount);
       });
       $('#makePaymaent').click(function () {
           $('#payment').modal('show');
       });
       $('#mtn').click(function () {
           $("#mtnpayment").modal("show");
       });
       $('#orange').click(function () {
           $("#orangepayment").modal("show");
       });
       $("#mtnpay").click(function () {
            $.ajax({
               type:"post",
               url:"/send",
               data:{
                   '_token': $("input[name=_token]").val(),
                   'momoNumber': $("input[name=mtnNumber]").val(),
                   'amount': $(".amount").text(),
                   'channel': 'mtn',
                   'contacts': $("input[name=contacts]").val(),
                   'message_id': $("input[name=message_id]").val(),
                   'recipients': $(".contacts").text(),               
               },
                success:function (data) {
                    window.location.href = "/transactions";
                }
           });
       });
       $("#orangepay").click(function () {
           alert($("input[name=orangeNumber]").val());
       });
   </script>
@endsection
