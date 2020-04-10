@extends('layout.master')
@section('content')
  <div class="content-wrapper">
    <div class="card">
          <div class="card-header">
            <h3 class="card-title">Order Listing</h3>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <table id="example2" class="table table-bordered table-hover dataTable" role="grid" aria-describedby="example2_info">
            <thead>
            <tr role="row">
              <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="Rendering engine: activate to sort column descending">ID</th>
              <th>Date</th>
              <th>Amount</th>
              <th>Bank</th>
              <th>Bank Account</th>
              <th style="width:100px;" align="right">Actions</th>
            </thead>
            <tbody>
              @foreach ($orders as $order)
                <tr>
                  <td>{{$order->id}}</td>
                  <td>{{$order->order_date}}</td>
                  <td>{{number_format($order->total_amount)}} MMK</td>
                  <td>{{$order->bank_type}}</td>
                  <td>{{$order->bank_account}}</td>
                  <td align="right" >
                    <div class="btn-group">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal-update" onclick="getData('{{$order->orderdetails}}');">Detail</button>
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
              <td style="padding-top:10px;"> {{ $orders->links() }} </td>
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
            <div class="modal-dialog modal-lg">
              <div class="modal-content" style="padding:20px;">
                <div class="modal-header">
                  <h4 class="modal-title">Order Detail</h4>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                  </button>
                </div>
                <table>
                  <th>Image</th>
                  <th>Name</th>
                  <th>Price</th>
                  <th>Quantity</th>
                  <th>Total</th>
                  <tbody id="orderdetails" >
                  </tbody>
                </table>
               <!-- /.card-body -->
               <div class="modal-footer">
                 <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
               </div>
             </form>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>


  <script type="text/javascript">

  function getData(para) {
    var obj = JSON.parse(para);
    var resp;
    $('#orderdetails').empty();
    for (var i in obj) {
        var item = obj[i];
        $.ajax({
      		url : '/product/' + obj[i].product_id,
      		type: 'get',
      	}).done(function(response){ //
          var row = "<tr><td><img style='width:100px;' src='"+window.location.origin+ response.image +"'/></td><td>"+response.name+"</td><td>"+thousandseparator(obj[i].price) +" MMK</td><td>"+obj[i].quantity+"</td><td>"+thousandseparator(obj[i].amount)+" MMK</td></tr>";
          $("#orderdetails").append(row);
      	});

    }
  }

  </script>
@endsection
