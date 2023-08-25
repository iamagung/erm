<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Admin - {!! $identitas->nama_web !!}</title>
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <link rel="shortcut icon" href="{!!  asset($identitas->favicon) !!}">
        <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
        <link href="{!!  asset('adminAsset/css/bootstrap-3.3.4.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!!  asset('adminAsset/css/font-awesome.min.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!!  asset('adminAsset/css/AdminLTE.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!!  asset('adminAsset/css/sweetalert.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!!  asset('adminAsset/css/custom.css') !!}" rel="stylesheet" type="text/css" />
        <link href="{!! asset('adminAsset/css/bootstrap-datetimepicker.min.css') !!}" rel='stylesheet' type='text/css' />
        <link href="{!!  asset('adminAsset/select2/css/select2.min.css') !!}" rel="stylesheet" type="text/css" />

        <link href="{!!  asset('adminAsset/css/datatables/dataTables.bootstrap.css') !!}" rel="stylesheet" type="text/css" />
        <!-- <script src="{!!  asset('adminAsset/js/jquery-1.9.1.min.js') !!}" type="text/javascript"></script> -->
        <script src="{!!  asset('adminAsset/js/jquery-mask.js') !!}" type="text/javascript"></script>
        <script src="{!!  asset('adminAsset/js/mask.js') !!}" type="text/javascript"></script>
        <link href="{{ asset('adminAsset/css/chosen.min.css') }}" rel="stylesheet" media="screen">
        @yield('css')
    </head>
    <body class="skin-black">
        <header class="header">
            <a href="{!! route('home') !!}" class="logo">Admin web</a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </a>
                <div class="navbar-right">
                    <ul class="nav navbar-nav">
                        <!-- <li>
                            <a href="url('/')" target="_blank"><i class="fa fa-road"></i><span> Lihat web</span></a>
                        </li> -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span>{!! Auth::user()->alias !!}<i class="caret"></i></span>
                            </a>
                            <ul class="dropdown-menu">
                                <li class="user-header bg-light-blue">
                                    <?php
                                        if (Auth::user()->foto_user==null) {
                                            $foto_user = "blank-profile.jpg";
                                        }else{
                                            $foto_user = Auth::user()->foto_user;
                                        }
                                        // $foto_user = "blank-profile.jpg";
                                    ?>
                                    <img src="{!! asset($identitas->favicon) !!}" class="img-circle" alt="User Image" />
                                    <p>
                                        {!!  Auth::user()->nama !!} - Admin web
                                    </p>
                                </li>
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="{!! route('profileAdmin') !!}" class="btn btn-default btn-flat">Profil</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="{!! url('logouts') !!}" class="btn btn-default btn-flat">Keluar</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="wrapper row-offcanvas row-offcanvas-left">
            <aside class="left-side sidebar-offcanvas">
                <section class="sidebar">
                    <div class="user-panel">
                        <div class="pull-left image">
                            <img src="{!! asset($identitas->favicon) !!}" class="img-circle" alt="User Image" />
                        </div>
                        <div class="pull-left info">
                            <p>Hello, {!!  Auth::user()->alias !!}</p>
                            <a href="{!! url('logouts') !!}"><i class="fa fa-key text-danger"></i> Keluar</a>
                        </div>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="@if($active == 1) active @endif"><a href="{!! route('home') !!}"><i class="fa fa-dashboard"></i> <span>Dashboard</span></a></li>
                        <li class="@if($active == 6) active @endif"><a href="{!! route('grafikKunjungan') !!}"><i class="fa fa-dashboard"></i> <span>Grafik Kunjungan</span></a></li>
                        <li class="treeview @if($active == 2) active @endif">
                            <a href="#">
                                <i class="fa fa-users"></i> <span>User</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if($active_sub == 21) active @endif"><a href="{!! route('userAdmin') !!}"><i class="fa fa-angle-double-right"></i> Admin</a></li>
                                <li class="@if($active_sub == 22) active @endif"><a href="{!! route('userDokter') !!}"><i class="fa fa-angle-double-right"></i> Dokter</a></li>
                                <li class="@if($active_sub == 23) active @endif"><a href="{!! route('userPerawat') !!}"><i class="fa fa-angle-double-right"></i> Perawat</a></li>
                            </ul>
                        </li>
                        <li class="@if($active == 3) active @endif"><a href="{!! route('dataPoli') !!}"><i class="fa fa-home"></i> <span>Poli</span></a></li>
                        <li class="treeview @if($active == 7) active @endif">
                            <a href="#">
                                <i class="fa fa-bars"></i> <span>Master Tindakan</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if($active_sub == 54) active @endif">
                                    <a href="#"><i class="fa fa-angle-double-right"></i> Tindakan Laboratorium</a>
                                </li>
                                <li class="@if($active_sub == 55) active @endif">
                                    <a href="#"><i class="fa fa-angle-double-right"></i> Tindakan Radiologi</a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview @if($active == 5) active @endif">
                            <a href="#">
                                <i class="fa fa-globe"></i> <span>Web </span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if($active_sub == 51) active @endif"><a href="{!! route('term') !!}"><i class="fa fa-angle-double-right"></i> Syarat Ketentuan</a></li>
                                <li class="@if($active_sub == 52) active @endif"><a href="{!! route('logo') !!}"><i class="fa fa-angle-double-right"></i> Logo & Format pertanyaan jawaban</a></li>
                            </ul>
                        </li>
                        <!-- <li class="@if($active == 4) active @endif"><a href="{!! route('dataRekapMedikAdmin') !!}"><i class="fa fa-list"></i> <span>Rekam Medis</span></a></li> -->
                        <li class="@if($active == 4) active @endif"><a href="{!! route('rekam_new_all') !!}"><i class="fa fa-list"></i> <span>History RM Pasien</span></a></li>
                        <?php
                        /*
                        <li class="treeview @if($active_sub == 4) active @endif ">
                            <a href="#">
                                <i class="fa fa-user"></i> <span>Modul Pengguna</span>
                                <i class="fa fa-angle-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="@if($active_sub == 41) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Editor</a></li>
                                <li class="@if($active_sub == 42) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Polres</a></li>
                                <li class="@if($active_sub == 43) active @endif"><a href=""><i class="fa fa-angle-double-right"></i> Twitter</a></li>
                            </ul>
                        </li>
                        <li>
                            <a href="">
                                <i class="fa fa-tags"></i> <span>Modul Iklan</span>
                            </a>
                        </li>
                        <!--<li><a href="?menu=kata_jorok"><i class="fa fa-paperclip"></i> <span>Modul Kata Jorok</span></a></li>-->
                        */
                        ?>
                    </ul>
                </section>
            </aside>

            <aside class="right-side">
                <div class="col-lg-12 col-md-12">
                    <?php
                    if(Session::has('no_RM')){
                        $rekap = DB::table('rekap_medik')->where('id_rekapMedik',Session::get('id_rekap'))->first();
                        $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',Session::get('no_RM'))->first();
                        // CEK USING REGISTER
                        $alergi = DB::connection('rsu')->table('tr_resep_m')->where('No_Register',$rekap->no_Register)->first();
                        if(count(array($alergi))!=0){

                        }else{
                          $alergi = DB::connection('rsu')->table('tr_resep_m')->where('No_RM',Session::get('no_RM'))->orderBy('No_Register','DESC')->first();
                        }
                        // $customer = DB::connection('rsu')->table('tm_customer')->where('KodeCust',Session::get('no_RM'))->first();
                        ?>
                        <div class="col-md-12 col-md-12" style="border: 2px solid #ddd;background: #eee;box-shadow: 0px 4px 10px #ddd;margin-top: 10px;padding: 10px">
                            <div class="col-lg-4 col-md-4" style="padding: 0px">
                                <div class="col-lg-12 col-md-12" style="padding: 0px">
                                    <label class="col-lg-4 col-md-4" style="padding: 0px">Nama Pasien</label>
                                    <label class="col-lg-8 col-md-8" style="color: #1f07d2">: {!! $rekap->Nama_Pasien !!}</label>
                                </div>
                                <div class="col-lg-12 col-md-12" style="padding: 0px">
                                    <label class="col-lg-4 col-md-4" style="padding: 0px">Jenis Kelamin</label>
                                    <label class="col-lg-8 col-md-8" style="color: #1f07d2">:
                                        <?php
                                        echo ($customer->JenisKel=='L') ? 'Laki-laki' : 'Perempuan';
                                        ?>
                                    </label>
                                </div>
                                <div class="col-lg-12 col-md-12" style="padding: 0px">
                                    <label class="col-lg-4 col-md-4" style="padding: 0px">Poliklinik</label>
                                    <label class="col-lg-8 col-md-8" style="color: #1f07d2">: {!! $rekap->NamaPoli !!}</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4" style="padding: 0px">
                                <div class="col-lg-12 col-md-12" style="padding: 0px">
                                    <label class="col-lg-4 col-md-4" style="padding: 0px">No RM</label>
                                    <label class="col-lg-8 col-md-8" style="color: #1f07d2">: {!! $rekap->no_RM !!}</label>
                                </div>
                                <div class="col-lg-12 col-md-12" style="padding: 0px">
                                    <label class="col-lg-4 col-md-4" style="padding: 0px">Tanggal lahir</label>
                                    <label class="col-lg-8 col-md-8" style="color: #1f07d2">: {!! date('d-m-Y',strtotime($customer->TglLahir)) !!}</label>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4" style="padding: 0px">
                              @if(isset($alergi))
                              @if(!empty($alergi))
                              @if($alergi->isAlergi!='TIDAK ADA ALERGI')
                              <div class="col-lg-12 co-md-12" style="padding: 0px">
                                <div class="blinking" style="text-align: center;font-size: 16pt">
                                    {{$alergi->isAlergi}}<br>({{$alergi->NamaAlergi}})
                                </div>
                              </div>
                              @else
                              @endif
                              @endif
                              @endif
                            </div>
                            <div class="clearfix"></div>
                            <a href="{!! route('content2') !!}" class="btn btn-sm btn-primary"><i class="fa fa-arrow-right"></i> Lanjutkan</a>
                            <a href="#" onclick="finish_add()" class="btn btn-sm btn-success"><i class="fa fa-save"></i> Selesai</a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <div class="clearfix" style="margin-bottom: 10px"></div>
                @yield('content')
            </aside>

            <aside class="right-side">
                <div class="col-lg-12 col-md-12" style="background: white;padding: 10px">
                    <i>Designed By <b><a href="http://natusi.co.id" target="_blank">CV. NATUSI</a></b></i> &copy;2018
                </div>
            </aside>
        </div>

        <script type="text/javascript" src="{!! asset('adminAsset/js/bootstrap-datetimepicker.min.js') !!}"></script>
        <!-- jQuery UI 1.10.3 -->
        <script src="{!!  asset('adminAsset/js/jquery-ui-1.10.3.min.js') !!}" type="text/javascript"></script>
        <!-- Bootstrap -->
        <script src="{!!  asset('adminAsset/js/bootstrap.min.js') !!}" type="text/javascript"></script>
        <!-- DATA TABES SCRIPT -->
        <script src="{!!  asset('adminAsset/js/plugins/datatables/jquery.dataTables.js') !!}" type="text/javascript"></script>
        <script src="{!!  asset('adminAsset/js/plugins/datatables/dataTables.bootstrap.js') !!}" type="text/javascript"></script>
        <!-- AdminLTE App -->
        <script src="{!!  asset('adminAsset/js/AdminLTE/app_tu.js') !!}" type="text/javascript"></script>
        <script src="{!!  asset('adminAsset/js/sweetalert.min.js') !!}" type="text/javascript"></script>
        <script src="{!!  asset('adminAsset/js/validate.js') !!}" type="text/javascript"></script>
        <script src="{{ asset('adminAsset/js/chosen.jquery.min.js') }}"></script>
        <script src="{!!  asset('adminAsset/select2/js/select2.min.js') !!}" type="text/javascript"></script>

        <script type="text/javascript">
            function finish_add(){
                swal({
                title: "Anda yakin mengakhiri pengisian?",
                text: "Data akan disimpan!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: '#00a65a',
                confirmButtonText: 'Ya, akhiri!',
                cancelButtonText: 'Batal',
                closeOnConfirm: false,
                //closeOnCancel: false
                },
                function(){
                    window.location="{!! route('unset_RM') !!}";
                });
            }

            @if(!empty(Session::get('message')))
            swal({
              title : "{{ Session::get('title') }}",
              text : "{{ Session::get('message') }}",
              type : "{{ Session::get('type') }}",
              timer: 2000,
              showConfirmButton: false
            });
            @endif

            $(function() {
                $("#example1").dataTable({
                    "bLengthChange": false,
                    "oLanguage": {
                    "sLengthMenu": "Tampilkan _MENU_ data per halaman",
                    "sSearch": "Pencarian: ",
                    "sZeroRecords": "Maaf, tidak ada data yang ditemukan",
                    "sInfo": "Menampilkan _START_ s/d _END_ dari _TOTAL_ data",
                    "sInfoEmpty": "Menampilkan 0 s/d 0 dari 0 data",
                    "sInfoFiltered": "(di filter dari _MAX_ total data)"
                    }
                });
            });
            // tooltip demo
            $('.tooltip-demo').tooltip({
                 selector: "[data-toggle=tooltip]",
                container: "body"
            })
        </script>
        <script type="text/javascript">
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.sidebar-menu').find('.active').closest('.treeview').addClass('active');
        </script>
        @yield('js')
        @yield('js_tahap2')
        @yield('js_tahap3')
        @yield('js_tahap4')
        @yield('js_modal_obat')
        @yield('js_modal_laborat')
        @yield('js_modal_radio')
    </body>
</html>
