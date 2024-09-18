<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/fontawesome-free/css/all.min.css">
  <!-- Tempusdominus Bbootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/jqvmap/jqvmap.min.css">
  {{-- Toastr CSS --}}
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/toastr/toastr.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('public/backend') }}/plugins/dropify.css">
  
  <style type="text/css">
    .table-hover tbody tr:hover {
      color: #ebf0f4 !important;
      background-color: #252B48!important;
    }
    .table-bordered{
      border: 1px solid #060606;
    }
    .table-bordered td, .table-bordered th {
      border: 1px solid #0d0f11;
    }
    .table thead th {
      vertical-align: bottom;
      border-bottom: 1px solid #0b0c0d;
    }
  </style>
  @stack('css')

</head>
<body class="hold-transition sidebar-mini layout-fixed">
    @guest

    @else
<div class="wrapper">

  <!-- Navbar -->
  @include('layouts.admin-partial.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @include('layouts.admin-partial.sidebar')
  @endguest

  <!-- Content Wrapper. Contains page content -->
  @yield('admin_content')
  <!-- /.content-wrapper -->
  
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('public/backend') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('public/backend') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('public/backend') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/bootstrap/js/bootstrap.ll.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('public/backend') }}/plugins/chart.js/Chart.min.js"></script>

<!-- JQVMap -->
<script src="{{ asset('public/backend') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('public/backend') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('public/backend') }}/plugins/moment/moment.min.js"></script>

<script src="{{ asset('public/backend') }}/plugins/fontawesome-free/js/all.min.js"></script>

<script src="{{ asset('public/backend') }}/plugins/daterangepicker/daterangepicker.js"></script>
{{-- Toastr Js --}}
<script src="{{ asset('public/backend') }}/plugins/toastr/toastr.min.js"></script>
{{-- sweetalert2 JS --}}
<script src="{{ asset('public/backend') }}/plugins/sweetalert/sweetalert.all.min.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('public/backend') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('public/backend') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('public/backend') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('public/backend') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('public/backend') }}/dist/js/demo.js"></script>
<!-- DataTables -->
<script src="{{ asset('public/backend') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('public/backend') }}/plugins/dropify.min.js"></script>
<script type="text/javascript">
  //Dropify image
    $('.dropify').dropify();

  $(function () {
    $('.textarea').summernote()
  });
  //DataTable
  $(function () {
    $("#example1").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });
    {{-- /* Toastr script */ --}}
    @if(Session::has('message'))
    toastr.options ={
      "progressBar" : true,
      "closeButton" : true,
    }
      var type="{{Session::get('alert-type','info')}}"
      switch(type){
      case 'info':
          toastr.info("{{ Session::get('message') }}");
          break;
      case 'success':
          toastr.success("{{ Session::get('message') }}");
          break;
      case 'warning':
          toastr.warning("{{ Session::get('message') }}");
          break;
      case 'error':
          toastr.error("{{ Session::get('message') }}");
          break;
      }
    @endif

    {{-- /*Logout Sweetalert script */ --}}
    $(document).on("click","#logout",function(e){
      e.preventDefault();
      var link = $(this).attr("href");
          swal({
              title: 'Are you Want to logout?',
              text: "",
              icon: 'warning',
              buttons: true,
              dangerMode:true,
          })
          .then((willDelete) => {
              if(willDelete){
                  window.location.href = link;
              }else{
                  swal("Not logout!");
              }
          });
      });
</script>
@stack('js')
</body>
</html>
