@extends('dokter.master.main')
@section('content')
  <style media="screen">
    #invoice-POS{
      box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5);
      padding: 1mm 8mm;
      margin: 0 auto;
      width: 72mm;
      background: #FFF;
      ::selection {background: #f31544; color: #FFF;}
      ::moz-selection {background: #f31544; color: #FFF;}
      h1{
      font-size: 1.5em;
      color: #222;
      }
      h2{font-size: .9em;}
      h3{
      font-size: 1.2em;
      font-weight: 300;
      line-height: 2em;
      }
      p{
      color: #666;
      line-height: 1.2em;
      }

      #top, #mid,#bot{ /* Targets all id with 'col-' */
      border-bottom: 1px solid #EEE;
      }

      #top{min-height: 100px;}
      #mid{min-height: 80px;}
      #bot{ min-height: 50px; font-size: 9px;}

      #top .logo{
      /* float: left; */
      height: 60px;
      width: 60px;
      background: url(http://michaeltruong.ca/images/logo1.png) no-repeat;
      background-size: 60px 60px;
      }
      .clientlogo{
      float: left;
      height: 60px;
      width: 60px;
      background: url('public/img/logo.png') no-repeat;
      background-size: 60px 60px;
      border-radius: 50px;
      }
      .info{
      display: block;
      /* //float:left; */
      margin-left: 0;
      }
      .title{
      float: right;
      }
      .title p{text-align: right;}
      table{
      width: 100%;
      border-collapse: collapse;
      }
      td{
      /* padding: 5px 0 5px 15px;
      border: 1px solid #EEE */
      }
      .tabletitle{
      /* //padding: 5px; */
      /* font-size: 9px; */
      background: #EEE;
      }
      .service{border-bottom: 1px solid #EEE;}
      .item{width: 24mm;}
      /* .itemtext{font-size: 9px;} */

      #legalcopy{
      margin-top: 5mm;
      }
    }
    @page{
      size: 72mm;
    }
    @media print {
      #invoice-POS {
        width: 72mm;
        page-break-before: always;
        page-break-after: always;
        page-break-inside: avoid;
      }
    }
  </style>

  <section class="wrapper">
  	<div class="row mt">
  		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div id="invoice-POS">

          <div class="" style="margin-top:8px;margin-right:10px;">
            <table style="width:100%;margin-right:15px;">
              <tr>
                <td colspan="2" style="padding-bottom:10px;text-align:center">
                  RSU WAHIDIN SUDIRO HUSODO
                </td>
              </tr>

              <tr style="font-size:22px;">
                <td style="padding-bottom:15px;">
                  No. Antrian :
                </td>
                <td style="padding-bottom:15px;">
                  {{ $noUrut }}
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  Tanggal :
                </td>
              </tr>
              <tr>
                <td colspan="2" style="padding-bottom:10px;">
                  <?php
                    $tgl = '-';
                    if ($resep) {
                      $splitTgl = explode(' ',$resep->Tgl_Resep);
                      $tgl = $splitTgl[0];
                      $tgl = date("d-m-Y",strtotime($tgl));
                    }
                  ?>
                  {{ $tgl }}
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  No. Register :
                </td>
              </tr>
              <tr>
                <td colspan="2" style="padding-bottom:10px;">
                  {{ ($rekap) ? $rekap->no_Register : '' }}
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  No. Resep :
                </td>
              </tr>
              <tr>
                <td colspan="2" style="padding-bottom:10px;">
                  {{ ($resep) ? $resep->No_Resep : '' }}
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  Nama Pasien :
                </td>
              </tr>
              <tr>
                <td colspan="2" style="padding-bottom:10px;">
                  {{ ($resep) ? $resep->NamaPasien : '' }}
                </td>
              </tr>

              <tr>
                <td colspan="2">
                  Dokter :
                </td>
              </tr>
              <tr colspan="2" style="padding-bottom:30px;">
                <td>{{ $dokter->Nama_Dokter }}</td>
              </tr>
            </table>
          </div>

        </div>
  		</div>
    </div>
  </section>
@stop
@section('js')
  <script src="{!! url('js/jquery.PrintArea.js') !!}"></script>

  <script type="text/javascript">
  	$('#invoice-POS').printArea();
  	// setTimeout(function awal () {
  	// 	$('#invoice-POS').hide();
  	// }, 100);
  	setTimeout(function thanks () {
  		swal({
  			title: "Terima Kasih !",
  			type: "success",
  			timer: 2000,
  			showConfirmButton: false
  		});
  	 window.location.href = '{{ route('pembuatanObat') }}';
   }, 4000);
  </script>
@stop
