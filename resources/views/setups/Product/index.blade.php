@extends('layout.master')
@section('content')
  <div class="content-wrapper">
    <div class="card">
          <div class="card-header">
            <h3 class="card-title">Product Listing</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div style="padding-bottom:10px;">
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#modal-add" ><i class="fas fa-plus"></i></button>
            </div>
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
              <th style="width:200px;" align="right">Actions</th>
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
                      <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-update" onclick="getData('{{$product}}');">Update</button>
                      <a href="{{url('product/delete/'. $product->id)}}" type="button" class="btn btn-danger">Delete</a>
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

  <div class="modal fade" id="modal-add" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Create New product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form role="form" id="add_form" nctype="multipart/form-data">
           <div class="card-body">
             <div class="form-group">
               <div class="row">
                 <div class="col-sm-6" style="position:relative;">
                   <input style="display:none;" type="file" name="add_img" id="add_img" />
                   <img id = "image_add_preview" src="http://placehold.it/100x100" alt="" style="width:100%; height:300px;">
                  <a class="btn btn-block btn-default" style="position:absolute;bottom:0px;left:0px;" id="upload_image_add">
                     <i class="fas fa-upload"></i>
                   </a>
                 </div>
                 <div class="col-sm-6">
                   <div class="form-group">
                     <input id="name" name ="name" class="form-control" placeholder="Name">
                   </div>
                   <div class="form-group">
                     <select class="form-control" id="size" name="size">
                      <option selected value="">Select Size</option>
                      <option value="XS">XS</option>
                      <option value="SM">SM</option>
                      <option value="MD">MD</option>
                      <option value="LG">LG</option>
                      <option value="XL">XL</option>
                    </select>
                   </div>
                   <div class="form-group">
                     <select class="form-control" id="brand" name="brand">
                        <option selected value="">Select Brand</option>
                        @foreach ($brands as $brand)
                          <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                      </select>
                   </div>
                   <div class="form-group">
                     <select class="form-control" id="category" name="category">
                        <option selected value="">Select Category</option>
                        @foreach ($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                   </div>
                   <div class="form-group">
                     <select class="form-control" id="promotion" name="promotion">
                        <option selected value="">Select Promotion</option>
                        @foreach ($promotions as $promotion)
                          <option value="{{$promotion->id}}">{{$promotion->name}}</option>
                        @endforeach
                      </select>
                   </div>
                   <div class="form-group">
                     <input id="price" name ="price" class="form-control" type="number" placeholder="Price">
                   </div>
                   <div class="form-group">
                     <input id="quantity" name ="quantity" class="form-control" type="number" placeholder="Quantity">
                   </div>
                 </div>
               </div>
             </div>
             <div class="form-group">
               <textarea class="form-control" rows="3" placeholder="Description" name="description" id="description"></textarea>
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
        <div class="modal-dialog modal-dialog-centered modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update New product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form role="form" id="update_form" nctype="multipart/form-data">
           <div class="card-body">
             <div class="form-group">
               <div class="row">
                 <div class="col-sm-6" style="position:relative;">
                   <input style="display:none;" type="file" name="update_img" id="update_img" />
                   <img id = "image_update_preview" src="http://placehold.it/100x100" alt="" style="width:100%; height:300px;">
                  <a class="btn btn-block btn-default" style="position:absolute;bottom:0px;left:0px;" id="upload_image_update">
                     <i class="fas fa-upload"></i>
                   </a>
                 </div>
                 <div class="col-sm-6">
                   <div class="form-group">
                     <input id="update_name" name ="update_name" class="form-control" placeholder="Name">
                     <input type="hidden" name="update_id" id="update_id">
                   </div>
                   <div class="form-group">
                     <select class="form-control" id="update_size" name="update_size">
                      <option selected value="">Select Size</option>
                      <option value="XS">XS</option>
                      <option value="SM">SM</option>
                      <option value="MD">MD</option>
                      <option value="LG">LG</option>
                      <option value="XL">XL</option>
                    </select>
                   </div>
                   <div class="form-group">
                     <select class="form-control" id="update_brand" name="update_brand">
                        <option selected value="">Select Brand</option>
                        @foreach ($brands as $brand)
                          <option value="{{$brand->id}}">{{$brand->name}}</option>
                        @endforeach
                      </select>
                   </div>
                   <div class="form-group">
                     <select class="form-control" id="update_category" name="update_category">
                        <option selected value="">Select Category</option>
                        @foreach ($categories as $category)
                          <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                      </select>
                   </div>
                   <div class="form-group">
                     <select class="form-control" id="update_promotion" name="update_promotion">
                        <option selected value="">Select Promotion</option>
                        @foreach ($promotions as $promotion)
                          <option value="{{$promotion->id}}">{{$promotion->name}}</option>
                        @endforeach
                      </select>
                   </div>
                   <div class="form-group">
                     <input id="update_price" name ="update_price" class="form-control" type="number" placeholder="Price">
                   </div>
                   <div class="form-group">
                     <input id="update_quantity" name ="update_quantity" class="form-control" type="number" placeholder="Quantity">
                   </div>
                 </div>
               </div>
             </div>
             <div class="form-group">
               <textarea class="form-control" rows="3" placeholder="Description" name="update_description" id="update_description"></textarea>
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
    $('#upload_image_add').click(function(){
      $('#add_img').click();
    });

    $("#add_img").change(function () {
        readURL(this);
    });

    $('#add_form').submit(function(event){
      event.preventDefault();
      var form = new FormData();
      console.log($('#add_img')[0].files[0]);
      form.append('img', $('#add_img')[0].files[0]);
      form.append('name', $('#name').val());
      form.append('size', $('#size').val());
      form.append('quantity', $('#quantity').val());
      form.append('description', $('#description').val());
      form.append('price', $('#price').val());
      form.append('category', $('#category').val());
      form.append('promotion', $('#promotion').val());
      form.append('brand', $('#brand').val());
      $.ajax({
    		url : '/product',
    		type: 'post',
    		data : form,
        contentType: false,
        processData: false,
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
          size:{
            required: true,
          },
          quantity:{
            required: true,
          },
          price:{
            required: true,
          },
          description:{
            required: true,
          },
          category:{
            required: true,
          },
          add_img:{
            required: true,
          }
        },
        messages: {
          name: {
            required: "Please enter product name",
          },
          size:{
            required: "Please select product size",
          },
          quantity:{
            required: "Please enter product quantity",
          },
          price:{
            required: "Please enter product price",
          },
          description:{
            required: "Please enter product description",
          },
          category:{
            required: "Please select product category",
          },
          add_img:{
            required: "Please select product picture"
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
      var id = $('#update_id').val();
      var form = new FormData();
      console.log($('#update_img')[0].files[0]);
      form.append('img', $('#update_img')[0].files[0]);
      form.append('name', $('#update_name').val());
      form.append('size', $('#update_size').val());
      form.append('quantity', $('#update_quantity').val());
      form.append('description', $('#update_description').val());
      form.append('price', $('#update_price').val());
      form.append('category', $('#update_category').val());
      form.append('promotion', $('#update_promotion').val());
      form.append('brand', $('#update_brand').val());
      console.log($('#update_name').val());
      $.ajax({
    		url : '/product/' + id,
    		type: 'post',
    		data : form,
        contentType: false,
        processData: false,
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
       name: {
         required: true,
       },
       size:{
         required: true,
       },
       quantity:{
         required: true,
       },
       price:{
         required: true,
       },
       description:{
         required: true,
       },
       category:{
         required: true,
       },
       add_img:{
         required: true,
       }
     },
     messages: {
       name: {
         required: "Please enter product name",
       },
       size:{
         required: "Please select product size",
       },
       quantity:{
         required: "Please enter product quantity",
       },
       price:{
         required: "Please enter product price",
       },
       description:{
         required: "Please enter product description",
       },
       category:{
         required: "Please select product category",
       },
       add_img:{
         required: "Please select product picture"
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
    $('#update_size').val(obj.size);
    $('#update_quantity').val(obj.quantity);
    $('#update_category').val(obj.category_id);
    $('#update_promotion').val(obj.promotion_id);
    $('#update_brand').val(obj.brand_id);
    $('#update_price').val(obj.price);
    $('#update_description').val(obj.description);
    $('#image_update_preview').attr('src', window.location.origin + obj.image);
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
