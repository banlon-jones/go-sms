@extends('layouts.app')

@section('content')
       <div class="container-fluid">
        <div class="card">
            <p class="card-header py-4"> Tarifs <a id="addTarif" class="btn btn-info btn-sm pull-right"><i class="fa fa-plus"></i> add tarif </a> </p>
            <div class="card-body">
                <div id="table" class="table-editable">
                    @if( $tarifs->count() > 0)
                    <table class="table table-responsive-md table-striped">
                        <tr>
                            <th>S/N</th>
                            <th>name</th>
                            <th> Min </th>
                            <th> Max </th>
                            <th> Service </th>
                            <th> Unit_price </th>
                            <th> Action </th>
                        </tr>
                        <?php $count = 1 ?>
                        @foreach($tarifs as $tarif)
                            <tr id="tarif{{$tarif->id}}">
                                <td>{{ $count ++ }}</td>
                                <td>{{ $tarif->name }}</td>
                                <td>{{ $tarif->min }}</td>
                                <td>{{ $tarif->max }}</td>
                                <td>{{ $tarif->service }}</td>
                                <td>{{ $tarif->unit_price }} CFA </td>
                                <td>
                                    <a id="edit" class="btn btn-success btn-sm" data-id="{{$tarif->id}}" data-name="{{$tarif->name}}"
                                       data-min="{{$tarif->min}}" data-max="{{$tarif->max}}" data-service="{{$tarif->service}}" data-price="{{$tarif->unit_price}}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                    <a id="delete" class="btn btn-danger btn-sm" data-id="{{$tarif->id}}" data-name="{{$tarif->name}}">
                                        <i class="fa fa-trash"></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                    </table>
                        @else
                        <small> no tarif set. click to add tarif </small>
                     @endif
                </div>
            </div>
        </div>
        <!-- create modal -->
    </div>
    <div class="modal fade" id="createTarif" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    create tarif
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="createTarifForm">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="md-form mb-0">
                                    <input type="text" id="name" name="name" class="form-control" required>
                                    <label for="name"> Name </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="mdb-select md-form" id="service" required>
                                    <option value="sms"> SMS </option>
                                    <option value="email"> EMAIL </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="md-form mb-0">
                                    <input type="text" id="min" name="min" class="form-control" required>
                                    <label for="min"> Min sms </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="md-form mb-0">
                                    <input type="text" id="max" name="max" class="form-control" required>
                                    <label for="max"> max sms </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="md-form mb-0">
                                    <input type="text" id="unit_price" name="unit_price" class="form-control" required>
                                    <label for="unit_price"> unit_price </label>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a id="saveTarif" class="btn btn-primary">Save changes</a>
                </div>
            </div>
        </div>
    </div>
    {{-- edit modal --}}
    <div id="edit-modal" class="modal fade" id="basicExampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form name="editTarifForm">
                        <input type="hidden" value="" id="tarif_id">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-3">
                                <div class="md-form mb-0">
                                    <input type="text" id="tarif" name="name" value="" class="form-control" required>
                                    <label for="name"> Name </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <select class="mdb-select md-form" id="serv" required>
                                    <option value="sms"
                                    > SMS </option>
                                    <option value="email"
                                    > EMAIL </option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <div class="md-form mb-0">
                                    <input type="text" id="minSms" name="min" class="form-control" value="" required>
                                    <label for="min"> Min sms </label>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="md-form mb-0">
                                    <input type="text" id="maxSms" name="maxSms" class="form-control" value="" required>
                                    <label for="max"> max sms </label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="md-form mb-0">
                                    <input type="text" id="price" name="unit_price" value="" class="form-control" required>
                                    <label for="unit_price"> unit_price </label>
                                </div>
                            </div>
                        </div>

                    </form>                                        </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="savebtn btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
       <script type="text/javascript">
           $(document).on('click','#unit_price', function(){

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
    <script type="text/javascript">
        $(document).on('click','#edit',function(){
            $("#tarif_id").val($(this).data("id"));
            $("#tarif").val($(this).data("name"));
            $("#serv").val($(this).data("service"));
            $("#minSms").val($(this).data("min"));
            $("#maxSms").val($(this).data("max"));
            $("#price").val($(this).data("price"));
            $("#edit-modal").modal("show");
       });
        $(document).on('click','.savebtn',function () {
            $.ajax({
             url: "/editTarif",
             type: "post",
             data: {
             '_token': $("input[name=_token]").val(),
             'tarif_id': $("#tarif_id").val(),
             'name': $("#tarif").val(),
             'min': $("#minSms").val(),
             'max': $("#maxSms").val(),
             'service': $("#serv").val(),
             'unit_price': $("#price").val(),
             },
             success:function (data) {
             $("#edit-modal").modal("hide");
             $("#tarif"+ data.id).replaceWith(
             "<tr id='tarif" + data.id +"'>"+
             "<td></td>"+
             "<td>" + data.name +"</td>"+
             "<td>" + data.min +"</td>"+
             "<td>" + data.max +"</td>"+
             "<td>" + data.service +"</td>"+
             "<td>" + data.unit_price + "CFA" +"</td>"+
             "<td>"+
             "<a id='edit' class='btn btn-success btn-sm'"+" data-id='"+ data.id + "'"+" data-name='"+ data.name+"'"+
             " data-min='"+data.min+"'"+" data-max='"+ data.max+"'"+" data-service='"+data.service+"'"+" data-price='"+data.unit_price+"'>"+
             "<i class='fa fa-pencil'></i>"+
             "</a>"+
             "<a id='delete' class='btn btn-danger btn-sm' data-id='"+data.id+"' data-name='"+data.name+"'>"+
             "<i class='fa fa-trash'></i>"+
             "</a>"+
             "</td>"+
             "</tr>"
             );
             }
             });
        });
        $('#addTarif').click(function () {
            $('#createTarif').modal('show');
        });
        $('#saveTarif').click(function () {
            //check if min value is greater than max value
            if($('#min').val() >= $('#max').val()){
                alert("min value can not be greater than or equal to max value !!");
            }else{
                $.ajax({
                    url: '/checkTarif',
                    type: 'post',
                    data: {
                        '_token': $("input[name=_token]").val(),
                        'service': $("#service").val(),
                        'min': $('#min').val(),
                        'max': $('#max').val(),
                    },
                    success: function (data) {
                        if(data.error){
                            alert(data.error);
                        }else {
                            $.ajax({
                                type:'post',
                                url:'/createTarif',
                                data: {
                                    '_token': $("input[name=_token]").val(),
                                    'name': $("input[name=name]").val(),
                                    'min': $("input[name=min]").val(),
                                    'max': $("input[name=max]").val(),
                                    'service': $("#service").val(),
                                    'unit_price': $("input[name=unit_price]").val(),
                                },
                                error: function(){
                                    alert("error occured");
                                },
                                success:function (data) {
                                    $('#createTarif').modal('hide');
                                    $("table").append(
                                        "<tr id='tarif" + data.id +"'>"+
                                        "<td>" + data.id +"</td>"+
                                        "<td>" + data.name +"</td>"+
                                        "<td>" + data.min +"</td>"+
                                        "<td>" + data.max +"</td>"+
                                        "<td>" + data.service +"</td>"+
                                        "<td>" + data.unit_price + "CFA" +"</td>"+
                                        "<td>"+
                                        "<a id='edit' class='btn btn-success btn-sm'"+" data-id='"+ data.id + "'"+" data-name='"+ data.name+"'"+
                                        " data-min='"+data.min+"'"+" data-max='"+ data.max+"'"+" data-service='"+data.service+"'"+" data-price='"+data.unit_price+"'>"+
                                        "<i class='fa fa-pencil'></i>"+
                                        "</a>"+
                                        "<a id='delete' class='btn btn-danger btn-sm' data-id='"+data.id+"' data-name='"+data.name+"'>"+
                                        "<i class='fa fa-trash'></i>"+
                                        "</a>"+
                                        "<td>"+
                                        "</tr>"
                                    );
                                    toastr.success('Tarif successfully created');
                                }
                            });
                        }
                    }
                });

            }
        });

    </script>
    <script type="text/javascript">
        $(document).on('click','#delete',function() {
            var tarif = $(this).data("id");
            if(confirm("Are you sure you want to delete  ?")){
                $.ajax({
                    url: '/deleteTarif',
                    type: 'post',
                    data:{
                        '_token':$('input[name=_token]').val(),
                        'tarif':$(this).data("id"),
                    },
                    success: function (data) {
                        $("#tarif" + tarif ).remove();
                        toastr.success('Tarif successfully deleted');
                    }
                });
            }else {
                return false;
            }
        });
    </script>


@endsection
