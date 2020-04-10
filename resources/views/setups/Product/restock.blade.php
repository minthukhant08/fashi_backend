@extends('layout.master')
@section('content')
  <div class="content-wrapper">
    <div class="card">
          <div class="card-header">
            <h3 class="card-title">Products To Restock</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr role="row">
              <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Image</th>
              <th>Name</th>
              <th>Brand</th>
              <th>Category</th>
              <th>Size</th>
              <th>Price</th>
              <th>Quantity</th>
              <th>Promotion</th>
              <th style="width:100px;" align="right">Actions</th>
            </thead>
            <tbody>
              @foreach ($products as $product)
                <tr>
                  <td>
                    <img  style="width:150px; height:auto;" src="{{url($product->image)}}" alt="">
                  </td>
                  <td >{{$product->name}}</td>
                  <td >{{$product->brand->name}}</td>
                  <td >{{$product->category->name}}</td>
                  <td >{{$product->size}}</td>
                  <td >{{$product->price}}</td>
                  <td >{{$product->quantity}}</td>
                  <td >{{isset($product->promotion)? $product->promotion->name : ''}}</td>
                  <td align="right">
                    <div class="btn-group">
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update" onclick="getData('{{$product}}');">Restock</button>
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
              <td style="padding-top:10px;"> {{ $products->links() }} </td>
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

      <div class="modal fade" id="modal-update" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Restock more items</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form role="form" id="update_form" nctype="multipart/form-data">
           <div class="card-body">
             <div class="form-group">
               <input type="hidden" id="update_id" name="" value="">
               <select class="form-control" id="supplier" name="supplier">
                  <option selected value="">Select Supplier</option>
                  @foreach ($suppliers as $supplier)
                    <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                  @endforeach
                </select>
             </div>
             <div class="form-group">
               <input  class="form-control" type="number" name="quantity" id="quantity" value="">
             </div>
           </div>
           <!-- /.card-body -->
           <div class="modal-footer">
             <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
             <button type="submit" class="btn btn-success" id="create">Restock</button>
           </div>
         </form>
          </div>
          <!-- /.modal-content -->
        </div>
            <!-- /.modal-dialog -->
          </div>


  <script type="text/javascript">
  $( document ).ready(function() {
    $('#upload_image_add').click(function(){
      $('#add_img').click();
    });

    $("#add_img").change(function () {
        readURL(this);
    });

    $('#update_form').submit(function(event){
      event.preventDefault();
      var id = $('#update_id').val();
      var supplier = $('#supplier').val();
      var quantity = $('#quantity').val();
      console.log(supplier);
      if (supplier!='') {
        $.ajax({
      		url : '/product/restock',
      		type: 'put',
      		data : {
            id: id,
            quantity:quantity
          },
          statusCode: {
             200: function (response) {
                location.reload(true);
             }
          }
      	}).done(function(response){ //
      		// $('#modal-update').modal('toggle');
      	});
      }
    })

   $('#update_form').validate({
     rules: {
       supplier: {
         required: true,
       },
       quantity:{
         required: true,
       }
     },
     messages: {
       quantity:{
         required: "Please enter product quantity",
       },
       supplier:{
         required: "Please select Supplier",
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
    $('#update_id').val(obj.id);

  }

  function readURL(input) {
       if (input.files && input.files[0]) {
           var reader = new FileReader();

           reader.onload = function (e) {
               $('#image_add_preview').attr('src', e.target.result);
           }

           reader.readAsDataURL(input.files[0]);

       }
   }


  </script>
@endsection
