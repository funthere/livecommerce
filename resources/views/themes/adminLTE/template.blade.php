<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>{{ $judul or 'Judul'}} | {{ $global_params['nama_toko'] or 'nama_toko' }}</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- CSRF -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- Bootstrap 3.3.5 -->
  <link rel="stylesheet" href="{{ asset('backend/bootstrap/css/bootstrap.min.css') }}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/font-awesome/4.4.0/css/font-awesome.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/ionicons/2.0.1/css/ionicons.min.css') }}">
  <!-- datatables -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/dataTables.bootstrap.css') }}">
  <!-- select2 -->
  <link rel="stylesheet" href="{{ asset('backend/plugins/select2/select2.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('backend/dist/css/AdminLTE.min.css') }}">
  <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
        page. However, you can choose any other skin. Make sure you
        apply the skin class to the body tag so the changes take effect.
  -->

  <style>
    figure img {
        margin-top: 10px;
        margin-bottom: 10px;
    }

    .user-label {
        width: 30px;
        height: 30px;
        text-align: center;
        background-color: rgba(85, 85, 85, 0.25);
        border-radius: 50%;
        margin-top: -5px;
        margin-bottom: -5px;
        padding: 5px;
    }
  </style>
  <link rel="stylesheet" href="{{ asset('backend/dist/css/skins/skin-yellow.min.css') }}">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<!--
BODY TAG OPTIONS:
=================
Apply one or more of the following classes to get the
desired effect
|---------------------------------------------------------|
| SKINS         | skin-blue                               |
|               | skin-black                              |
|               | skin-purple                             |
|               | skin-yellow                             |
|               | skin-red                                |
|               | skin-green                              |
|---------------------------------------------------------|
|LAYOUT OPTIONS | fixed                                   |
|               | layout-boxed                            |
|               | layout-top-nav                          |
|               | sidebar-collapse                        |
|               | sidebar-mini                            |
|---------------------------------------------------------|
-->
<body class="hold-transition skin-yellow sidebar-mini">
<div class="wrapper">

  <!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
    <a href="index2.html" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini">{{ $global_params['nama_toko'] or 'LC'}}</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg">{!! $global_params['nama_toko'] or '<b>Live</b>Commerce' !!}</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
          <ul class="nav navbar-nav">
            <!-- User Account Menu -->
            <li class="dropdown user user-menu">
              <!-- Menu Toggle Button -->
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <!-- The user image in the navbar-->
                <div class="user-label">
                  <span>{{ auth()->user()->getInitial() }}</span>
                </div>
                <!-- <img src="/backend/dist/img/user2-160x160.jpg" class="user-image" alt="User Image"> -->

                <!-- hidden-xs hides the username on small devices so only the image appears. -->
              </a>
              <ul class="dropdown-menu">
                <!-- The user image in the menu -->
                <li class="user-header">
                  <img src="/backend/dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                  <p>
                    {{ auth()->user()->nama }}
                  </p>
                </li>
                <!-- Menu Body -->
                <!-- <li class="user-body">
                  <div class="row">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </div>
                </li>
                 -->
                <!-- Menu Footer-->
                <li class="user-footer">
                  <div class="pull-left">
                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                  <div class="pull-right">
                    <a href="/logout" class="btn btn-default btn-flat">Logout</a>
                  </div>
                </li>
              </ul>
            </li>
            <li><a href="/auth/logout"><i class="fa fa-lock"></i> <span class="hidden-sm">Logout</span></a></li>
          </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- search form (Optional) -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->

      <!-- Sidebar Menu -->
      <ul class="sidebar-menu">
        <!-- Optionally, you can add icons to the links -->
        <li class="@if(request()->is('admin'))active @endif"><a href="{{ asset('admin') }}"><i class="fa fa-home"></i> <span>Home</span></a></li>
        <li class="@if(request()->is('admin/metode_pembayaran*'))active @endif treeview">
          <a href="{{ asset('admin/pesanan') }}"><i class="fa fa-credit-card"></i> <span>Metode Pembayaran</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="@if(request()->is('admin/pesanan'))active @endif"><a href="{{ asset('admin/metode_pembayaran') }}"><i class="fa fa-list"></i>List</a></li>
            <li class="@if(request()->is('admin/metode_pembayaran/create'))active @endif"><a href="{{ asset('admin/metode_pembayaran/create') }}"><i class="fa fa-plus"></i>Tambah</a></li>
          </ul>
        </li>
        <li class="@if(request()->is('admin/customer*'))active @endif treeview">
          <a href="{{ asset('admin/customer') }}"><i class="fa fa-male"></i> <span>Customer</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="@if(request()->is('admin/customer'))active @endif"><a href="{{ asset('admin/customer') }}"><i class="fa fa-list"></i>List</a></li>
            <li class="@if(request()->is('admin/customer/create'))active @endif"><a href="{{ asset('admin/customer/create') }}"><i class="fa fa-plus"></i>Tambah</a></li>
          </ul>
        </li>
        <li class="@if(request()->is('admin/brand*'))active @endif treeview">
          <a href="{{ asset('admin/brand') }}"><i class="fa fa-tag"></i> <span>Merk</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="@if(request()->is('admin/brand'))active @endif"><a href="{{ asset('admin/brand') }}"><i class="fa fa-list"></i>List</a></li>
            <li class="@if(request()->is('admin/brand/create'))active @endif"><a href="{{ asset('admin/brand/create') }}"><i class="fa fa-plus"></i>Tambah</a></li>
          </ul>
        </li>
        <li class="@if(request()->is('admin/kategori*'))active @endif treeview">
          <a href="{{ asset('admin/kategori') }}"><i class="fa fa-list"></i> <span>Kategori Produk</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="@if(request()->is('admin/kategori'))active @endif"><a href="{{ asset('admin/kategori') }}"><i class="fa fa-list"></i>List</a></li>
            <li class="@if(request()->is('admin/kategori/create'))active @endif"><a href="{{ asset('admin/kategori/create') }}"><i class="fa fa-plus"></i>Tambah</a></li>
          </ul>
        </li>
        <li class="@if(request()->is('admin/produk*') || request()->is('admin/foto_produk*'))active @endif treeview">
          <a href="{{ asset('admin/produk') }}"><i class="fa fa-dropbox"></i> <span>Produk</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="@if(request()->is('admin/produk'))active @endif"><a href="{{ asset('admin/produk') }}"><i class="fa fa-list"></i>List</a></li>
            <li class="@if(request()->is('admin/produk/create'))active @endif"><a href="{{ asset('admin/produk/create') }}"><i class="fa fa-plus"></i>Tambah</a></li>
            @if(request()->is('admin/produk/*/edit') || request()->is('admin/foto_produk*'))
            <li class="@if(request()->is('admin/foto_produk/create'))active @endif"><a href="{{ asset('admin/foto_produk/create?produk_id='.$produk->id) }}"><i class="fa fa-plus"></i>Tambah Foto <i class="fa fa-image pull-right"></i></a></li>
            @endif
          </ul>
        </li>
        <li class="@if(request()->is('admin/pesanan*'))active @endif treeview">
          <a href="{{ asset('admin/pesanan') }}"><i class="fa fa-shopping-cart"></i> <span>Pesanan</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="@if(request()->is('admin/pesanan'))active @endif"><a href="{{ asset('admin/pesanan') }}"><i class="fa fa-list"></i>Semua</a></li>
            <li class="@if(request()->is('admin/pesanan/baru'))active @endif"><a href="{{ asset('admin/pesanan/baru') }}"><i class="fa fa-inbox"></i>Baru</a></li>
            <li class="@if(request()->is('admin/pesanan/dibayar'))active @endif"><a href="{{ asset('admin/pesanan/dibayar') }}"><i class="fa fa-money"></i>Sudah Dibayar</a></li>
            <li class="@if(request()->is('admin/pesanan/berhasil'))active @endif"><a href="{{ asset('admin/pesanan/berhasil') }}"><i class="fa fa-star"></i>Berhasil</a></li>
            <li class="@if(request()->is('admin/pesanan/batal'))active @endif"><a href="{{ asset('admin/pesanan/batal') }}"><i class="fa fa-frown-o"></i>Batal</a></li>
          </ul>
        </li>
        <li class="@if(request()->is('admin/pembayaran*'))active @endif treeview">
          <a href="{{ asset('admin/pembayaran') }}"><i class="fa fa-money"></i> <span>Pembayaran</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="@if(request()->is('admin/pembayaran'))active @endif"><a href="{{ asset('admin/pembayaran') }}"><i class="fa fa-list"></i>List</a></li>
            <li class="@if(request()->is('admin/pembayaran/create'))active @endif"><a href="{{ asset('admin/pembayaran/create') }}"><i class="fa fa-plus"></i>Tambah</a></li>
          </ul>
        </li>
        <li class="@if(request()->is('admin/setting*'))active @endif treeview">
          <a href="{{ asset('admin/setting') }}"><i class="fa fa-cog"></i> <span>Setting</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="@if(request()->is('admin/setting'))active @endif"><a href="{{ asset('admin/setting') }}"><i class="fa fa-list"></i>List</a></li>
            <li class="@if(request()->is('admin/setting/create'))active @endif"><a href="{{ asset('admin/setting/create') }}"><i class="fa fa-plus"></i>Tambah</a></li>
          </ul>
        </li>
        <li class="@if(request()->is('admin/pesan*'))active @endif treeview">
          <a href="{{ asset('admin/pesan') }}"><i class="fa fa-envelope-o"></i> <span>Pesan</span> <i class="fa fa-angle-left pull-right"></i></a>
          <ul class="treeview-menu">
            <li class="@if(request()->is('admin/pesan'))active @endif"><a href="{{ asset('admin/pesan') }}"><i class="fa fa-list"></i>List</a></li>
          </ul>
        </li>
        <li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>
      </ul>
      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        {{ $judul or 'Page Header' }}
        <small>{!! $deskripsi or 'Optional description' !!}</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ $breadcrumb1Url or '#' }}"><i class="fa {{ $breadcrumb1Icon or 'fa-dashboard' }}"></i> {{ $breadcrumb1 or 'Home Admin' }}</a></li>
        @if($breadcrumbLevel >= 2)<li class="{{ $breadcrumb2Class or 'active' }}"><a href="{{ $breadcrumb2Url or 'javascript:;' }}" ><i class="fa {{ $breadcrumb2Icon or 'fa-dashboard' }}"></i> {{ $breadcrumb2 or 'Here' }}</a></li>@endif
        @if($breadcrumbLevel >= 3)<li class="{{ $breadcrumb3Class or 'active' }}"><a href="{{ $breadcrumb3Url or 'javascript:;' }}" >{{ $breadcrumb3 or 'Here' }}</a></li>@endif
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      @yield('content')

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="pull-right hidden-xs">
      Anything you want
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2015 <a href="#">Company</a>.</strong> All rights reserved.
  </footer>

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->

<!-- jQuery 2.1.4 -->
<script src="{{ asset('backend/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
<!-- Bootstrap 3.3.5 -->
<script src="{{ asset('backend/bootstrap/js/bootstrap.min.js') }}"></script>
<!-- date-range-picker -->
<script src="{{ asset('backend/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('backend/plugins/datepicker/locales/bootstrap-datepicker.id.js') }}" charset="UTF-8"></script>
<!-- DataTables -->
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/dataTables.bootstrap.min.js') }}"></script>
<!-- Bootstrap Typeahead -->
<script src="{{ asset('backend/plugins/bootstrap-typeahead/bootstrap3-typeahead.min.js') }}"></script>
<!-- Select2 -->
<script src="{{ asset('backend/plugins/select2/select2.full.min.js') }}"></script>
<!-- autonumeric -->
<script src="{{ asset('backend/plugins/autoNumeric/autoNumeric-min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('backend/dist/js/app.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('backend/dist/js/demo.js') }}"></script>


<script>
  String.prototype.toRp = function(a,b,c,d,e) {
    e=function(f){return f.split('').reverse().join('')};b=e(parseInt(this,10).toString());for(c=0,d='';c<b.length;c++){d+=b[c];if((c+1)%3===0&&c!==(b.length-1)){d+='.';}}return(a?a:'Rp.\t')+e(d);
  }
  $(function() {
    $.fn.datepicker.defaults.format = "{{ config('livepos.dateformat') }}";
    $.fn.datepicker.defaults.language = "id";
    $.fn.datepicker.defaults.todayHighlight = true;

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    $.fn.modal.Constructor.DEFAULTS.backdrop = 'static';

    $.fn.liveCommerceCurrency = {aSep: '.', aDec: ',', aSign: 'Rp. ', lZero: 'deny', mDec: 0};
    $.fn.liveCommerceNumeric = {aSep: '.', aDec: ',', aSign: '', lZero: 'deny', mDec: 0};
    $.fn.liveCommerceDecimal = {aSep: '.', aDec: ',', aSign: '', lZero: 'deny'};

    $('select').select2({width: '100%'});              
    
    $('.input-mask-currency').autoNumeric('init', $.fn.liveCommerceCurrency);
    $('.input-mask-numeric').autoNumeric('init', $.fn.liveCommerceNumeric);
    $('.input-mask-decimal').autoNumeric('init', $.fn.liveCommerceDecimal);


      var slideToTop = $("<div />");
      slideToTop.html('<i class="fa fa-chevron-up"></i>');
      slideToTop.css({
        position: 'fixed',
        bottom: '40px',
        right: '25px',
        width: '40px',
        height: '40px',
        color: '#eee',
        'font-size': '',
        'line-height': '40px',
        'text-align': 'center',
        'background-color': '#222d32',
        cursor: 'pointer',
        'border-radius': '5px',
        'z-index': '99999',
        opacity: '.7',
        'display': 'none'
      });
      slideToTop.on('mouseenter', function () {
        $(this).css('opacity', '1');
      });
      slideToTop.on('mouseout', function () {
        $(this).css('opacity', '.7');
      });
      $('.wrapper').append(slideToTop);
      $(window).scroll(function () {
        if ($(window).scrollTop() >= 50) {
          if (!$(slideToTop).is(':visible')) {
            $(slideToTop).fadeIn(500);
          }
        } else {
          $(slideToTop).fadeOut(500);
        }
      });
      $(slideToTop).click(function () {
        $("body").animate({
          scrollTop: 0
        }, 500);
      });

  })
</script>

<script type="text/javascript">
  $(function(){
    $('#form_{{ $base }}').submit(function (e) {
      // e.preventDefault();
      var form = $(this);
      $('.btn-primary').prop('disabled', true); 
      $('.input-mask').each(function(i, e) {
        var v = $(this).autoNumeric('get');
        $(this).val(v);
      })
      return true;
    })
  });
</script>

@yield('script.footer')

<!-- Optionally, you can add Slimscroll and FastClick plugins.
     Both of these plugins are recommended to enhance the
     user experience. Slimscroll is required when using the
     fixed layout. -->
</body>
</html>
