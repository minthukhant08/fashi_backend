@extends('layout.master')
@section('content')
  <div class="content-wrapper">
    <div class="card">
          <div class="card-header">
            <h3 class="card-title">Delivery Listing</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
              <th>Customer</th>
              <th>Phone</th>
              <th>Address</th>
              <th>Order ID</th>
              <th style="width:150px;">Action</th>
            </thead>
            <tbody>
              @foreach ($deliverys as $delivery)
                @if ($delivery->delivery!=null)
                  <tr>
                    <td>{{$delivery->delivery->id}}</td>
                    <td>{{$delivery->delivery->customer_name}}</td>
                    <td>{{$delivery->delivery->phone}}</td>
                    <td>{{$delivery->delivery->address}}</td>
                    <td>{{$delivery->id}}</td>
                    <td>
                      <a href="{{url('order/delete/'. $delivery->delivery->id)}}"  class="btn btn-primary" >Delivery Done</a>
                    </td>
                  </tr>
                @endif
              @endforeach
            </tbody>
            <tfoot>

            </tfoot>
          </table>
          <table width="100%">
            <tr >
              <td style="padding-top:10px;"> {{ $deliverys->links() }} </td>
            </tr>
          </table>
            {{-- <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
              <div class="row">
                <div class="col-sm-12 col-md-6"></div>
                <div class="col-sm-12 col-md-6"></div>
              </div>
              <div class="row"><div class="col-sm-12">

          </div>
        </div>

  </div> --}}

</div>

  <div class="modal fade" id="modal-add" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Create New delivery</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form role="form" id="add_form">
           <div class="card-body">
             <div class="form-group">
               <input id="name" name ="name" class="form-control" placeholder="Name">
             </div>
           </div>
           <!-- /.card-body -->
           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
             <button type="submit" class="btn btn-success" id="create">Create</button>
           </div>
         </form>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

      <div class="modal fade" id="modal-update" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h4 class="modal-title">Update delivery</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <form role="form" id="update_form">
               <div class="card-body">
                 <div class="form-group">
                   <input id="update_name" name="update_name" class="form-control" placeholder="Name">
                   <input id="update_id" type="hidden">
                 </div>
               </div>
               <!-- /.card-body -->
               <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                 <button type="submit" class="btn btn-success" id="create">Update</button>
               </div>
             </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


  <script type="text/javascript">
  $( document ).ready(function() {

    $('#add_form').submit(function(event){
      event.preventDefault();
      var name = $('#name').val();
      $.ajax({
    		url : '/delivery',
    		type: 'post',
    		data : {
          name: name
        },
        statusCode: {
           200: function (response) {
              location.reload(true);
           }
        }
    	}).done(function(response){ //
    		$('#modal-add').modal('toggle');
    	});
    })

    $('#add_form').validate({
        rules: {
          name: {
            required: true,
          }
        },
        messages: {
          name: {
            required: "Please enter delivery Name",
          }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
          error.addClass('invalid-feedback');
          element.closest('.form-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
          $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
          $(element).removeClass('is-invalid');
        }
      });


    $('#update_form').submit(function(event){
      event.preventDefault();
      var name = $('#update_name').val();
      var id = $('#update_id').val();
      $.ajax({
    		url : '/delivery/' + id,
    		type: 'put',
    		data : {
          name: name
        },
        statusCode: {
           200: function (response) {
             location.reload(true);
           }
        }
    	}).done(function(response){ //
    		$('#modal-update').modal('toggle');
    	});
    })

   $('#update_form').validate({
       rules: {
         update_name: {
           required: true,
         }
       },
       messages: {
         update_name: {
           required: "Please enter delivery Name",
         }
       },
       errorElement: 'span',
       errorPlacement: function (error, element) {
         error.addClass('invalid-feedback');
         element.closest('.form-group').append(error);
       },
       highlight: function (element, errorClass, validClass) {
         $(element).addClass('is-invalid');
       },
       unhighlight: function (element, errorClass, validClass) {
         $(element).removeClass('is-invalid');
       }
     });



  });

  function getData(para) {
    var obj = JSON.parse(para);
    $('#update_name').val(obj.name);
    $('#update_id').val(obj.id);
    console.log($('#update_id').val());
    console.log($('#update_name').val());
  }

  </script>
@endsection
