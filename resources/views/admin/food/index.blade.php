@extends('layouts.admin')
@section('admin_content')
@push('css')
@endpush
 <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="card content-header" style="padding: 10px;">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3 class="m-0 text-dark">Food Manage</h3>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('food') }}">Food</a></li>
              <li class="breadcrumb-item active">All Food</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Main row -->
        <div class="card">
          <div class="card-header bg-dark">
             <button type="submit" class="btn btn-success btn-sm float-right" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fa fa-plus"></i> Add New</button>
            <h3 class="card-title">Food Manage List</h3>
          </div>
          <div class="ml-2 mr-2 mt-4">
            <div class="row">
              <div class="col-4">
                <select class="form-control submitable" name="subcategory_id" id="subcategory">
                  <option value="">All</option>
                  @foreach($subcategory as $row)
                    <option value="{{ $row->id }}">{{ $row->subcategory_name }}</option>
                  @endforeach
                </select>
              </div>
              
            </div>
          </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                <div class="row">
                  <div class="col-lg-12">
                    <table id="" class="table table-sm table-bordered table-hover dataTable dtr-inline " role="grid" aria-describedby="example2_info">
                      <thead>
                        <tr role="row">
                          <th>Sl</th>
                          <th>Category</th>
                          <th>Subcategory</th>
                          <th>Food Name</th>
                          <th>Image</th>
                          <th>Price</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr role="row">
                          
                        </tr>
                      </tbody>
                      <tfoot>
                        <tr role="row">
                          <th>Sl</th>
                          <th>Category</th>
                          <th>Subcategory</th>
                          <th>Food Name</th>
                          <th>Image</th>
                          <th>Price</th>
                          <th>Status</th>
                          <th>Action</th>
                        </tr>
                      </tfoot>
                    </table>
                    <form id="delete_form" action="" method="post">
                      @method('DELETE')
                      @csrf
                    </form>
                  </div>
                </div> 
              </div>
            </div>
          </div>
        </div> 
      </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!--Add Modal -->
  <div class="modal fade loading_button" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="exampleModalLabel">Food Insert</h4>
          <button type="button" class="btn-close" style="border:none; background: none;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white"></i></button>
        </div>
        <div class="modal-body">
         <form action="{{ route('store.food') }}" method="post" id="add_form">
          @csrf
            <div class="form-group">
              <label for="exampleInputEmail1">Select Category<span class="text-danger">*</span></label>
             	<select class="form-control"name="subcategory_id" required>
                <option>--Select category--</option>
             		@foreach($category as $row)
                  @php
                    $subcategory=DB::table('subcategories')->where('category_id',$row->id)->get();
                  @endphp
               		<option value="{{ $row->id }}" disabled="" class="text-danger">{{ $row->category_name }}</option>
                  @foreach($subcategory as $row)
                    <option value="{{ $row->id }}">--{{ $row->subcategory_name }}</option>
                  @endforeach
             		@endforeach
             	</select>
            </div>
            <div class="form-group">
              <label for="name">Food Name<span class="text-danger">*</span></label>
              <input type="text" class="form-control" id="name" name="food_name" required>
            </div>
            <div class="row">
              <div class="form-group col-6">
                <label for="price">Price<span class="text-danger">*</span></label>
                <input type="text" class="form-control" id="price" name="price" required>
              </div>
              <div class="form-group col-6">
                <label for="discount_price">Discount Price</label>
                <input type="text" class="form-control" id="discount_price" name="discount_price">
              </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">Description<span class="text-danger">*</span></label>
              <textarea class="form-control textarea" name="description"></textarea>
            </div>
            <div class="row">
               <div class="form-group col-4">
                  <label for="status">Status<span class="text-danger">*</span></label>
                  <select class="form-control"name="status" required>
                    <option value="1">Publish</option>
                    <option value="0">Unpublish</option>
                  </select>
                </div>
                <div class="form-group col-4">
                  <label for="status">Top Recipes<span class="text-danger">*</span></label>
                  <select class="form-control"name="top" required>
                    <option value="1">Show</option>
                    <option value="0">Hide</option>
                  </select>
                </div>
                <div class="form-group col-4">
                  <label for="status">Slider<span class="text-danger">*</span></label>
                  <select class="form-control" name="slider" required>
                    <option value="1">Slider</option>
                    <option value="0">Hide</option>
                  </select>
                </div>
            </div>
             <div class="form-group">
              <label for="exampleInputEmail1">Image<span class="text-danger">*</span></label>
              <input type="file" class="dropify" name="image" required/>
            </div>
            <button type="submit" class="btn btn-success float-right submit_button"><span class="loader d-none">....</span> Submit</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  {{-- Edit Modal --}}
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h4 class="modal-title" id="exampleModalLabel">Food Update</h4>
          <button type="button" class="btn-close" style="border:none; background: none;" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark text-white"></i></button>
        </div>
        <div class="modal-body" id="edit_part">
         
        </div>
      </div>
    </div>
  </div>
  @push('js')
  <script>

    //index data showing
    $(function food(){
       table=$('.dataTable').dataTable({
        "processing":true,
        "serverSide":true,
        "search":true,
        "ajax":{
          "url":"{{ route('food') }}",
          "data":function(e) {
            e.subcategory_id=$("#subcategory").val();
            e.status=$("#status").val();
          }
        },
        columns:[
          {data:'DT_RowIndex' , name:'DT_RowIndex'},
          {data:'category_name' , name:'category_name'},
          {data:'subcategory_name' , name:'subcategory_name'},
          {data:'food_name' , name:'food_name'},
          {data:'image' , name:'image'},
          {data:'price' , name:'price'},
          {data:'status' , name:'status'},
          {data:'action' , name:'action'},
        ]
      });
    });
    //add Form Submit subcategory
    $('#add_form').submit(function(e){
      e.preventDefault();
      $('.loader').removeClass('d-none');
      var url=$(this).attr('action');
      var request=$(this).serialize();
      $('.submit_button').prop('type','button');
      $.ajax({
        url:url,
        type:'post',
        data:new FormData(this),
        contentType:false,
        cache:false,
        processData:false,
        success:function(data){
          toastr.success(data);
          $('#add_form')[0].reset();
          $('.loader').addClass('d-none');
          $('.submit_button').prop('type','submit');
          $('.dataTable').DataTable().ajax.reload();
          $('#addModal').modal('hide');
          $(".dropify-clear").trigger("click");
        }
      });
    });
    //edit request send
    $('body').on('click','.edit',function(){
      var id=$(this).data('id');
      var url="{{ url('admin/food/edit') }}/"+id;
      $.ajax({
        url:url,
        type:'get',
        success:function(data){
          $('#edit_part').html(data);
        }
      })
    });
    //delete specific category
    $(document).ready(function(){
      $(document).on("click","#food_delete",function(e){
        e.preventDefault();
        var url = $(this).attr('href');
        $("#delete_form").attr('action',url);
        swal({
          title: 'Are you went to Delete?',
          text: "Once deleted, you will not be able to recover this imaginary file!",
          icon: 'warning',
          buttons: true,
          dangerMode:true,
        })
        .then((willDelete)=>{
          if (willDelete){
             $("#delete_form").submit();
          }else{
            swal('Safe Data!')
          }
        });
      });
      //Data passed through here
      $("#delete_form").submit(function(e){
        e.preventDefault();
         var url = $(this).attr('action');
         var request = $(this).serialize();
         $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
              toastr.error(data);
              $('#delete_form')[0].reset();
              $('.dataTable').DataTable().ajax.reload();
            }
         });
      });
    });
    //submitable class call for evrey change
    $(document).on('change','.submitable',function(e){
      $('.dataTable').DataTable().ajax.reload();
    });

  </script>
  @endpush
@endsection
 