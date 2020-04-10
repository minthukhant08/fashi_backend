@extends('layout.master')
@section('content')
  <div class="content-wrapper">
    <div class="card">
          <div class="card-header">
            <h3 class="card-title">Promotion Listing</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div style="padding-bottom:10px;">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add" ><i class="fas fa-plus"></i></button>
            </div>
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Name</th>
              <th>Amount</th>
              <th style="width:300px;" align="right">Actions</th>
            </thead>
            <tbody>
              @foreach ($promotions as $promotion)
                <tr>
                  <td>{{$promotion->id}}</td>
                  <td>{{$promotion->name}}</td>
                  <td>{{$promotion->amount}}</td>
                  <td align="right">
                    <div class="btn-group">
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update" onclick="getData('{{$promotion}}');">Update</button>
                      <a href="{{url('promotion/delete/'. $promotion->id)}}" type="button" class="btn btn-danger">Delete</a>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
            <tfoot>

            </tfoot>
          </table>
          <table width="100%">
            <tr >
              <td style="padding-top:10px;"> {{ $promotions->links() }} </td>
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
              <h4 class="modal-title">Create New Promotion</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form role="form" id="add_form">
           <div class="card-body">
             <div class="form-group">
               <input id="name" name ="name" class="form-control" placeholder="Name" autocomplete="off">
             </div>
             <div class="form-group">
               <input id="amount" name ="amount" class="form-control" placeholder="Amount" autocomplete="off">
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
                  <h4 class="modal-title">Update Promotion</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <form role="form" id="update_form">
               <div class="card-body">
                 <div class="form-group">
                   <input id="update_name" name="update_name" class="form-control" placeholder="Name" autocomplete="off">
                   <input id="update_id" type="hidden">
                 </div>
                 <div class="form-group">
                   <input id="update_amount" name ="update_amount" class="form-control" placeholder="Amount" autocomplete="off">
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
      var amount = $('#amount').val();
      $.ajax({
    		url : '/promotion',
    		type: 'post',
    		data : {
          name: name,
          amount: amount
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
          },
          amount:{
            required: true,
            number: true
          }
        },
        messages: {
          name: {
            required: "Please enter promotion Name",

          },
          amount:{
            required: "Please enter promotion amount",
            number: "Please enter number only"
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
      var amount = $('#update_amount').val();
      var id = $('#update_id').val();
      $.ajax({
    		url : '/promotion/' + id,
    		type: 'put',
    		data : {
          name: name,
          amount:amount
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
         },
         update_amount:{
           required: true,
           number:true
         }
       },
       messages: {
         update_name: {
           required: "Please enter promotion name",
         },
         update_amount:{
           required: "Please enter promotion amount",
           number: "Please enter number only"
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
    $('#update_amount').val(obj.amount);
  }

  </script>
@endsection
