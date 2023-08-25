@extends('dokter.master.main')
@section('content')
<style media="screen">
  .invoice-POS{
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

  #top{min-height: 50px;}
  #mid{min-height: 50px;}
  #bot{ min-height: 50px; font-size: 9px;}

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
    .invoice-POS {
      width: 72mm;
      page-break-before: always;
      page-break-after: always;
      page-break-inside: avoid;
    }
    .pagebreak112 {
      page-break-before: always;
      } /* page-break-after works, as well */
    }
  </style>
  <style media="screen">
    .info{
      font-size: 15px;
    }
    .info2{
      font-size: 13px;
    }
    .info div{
      font-weight: bold;
    }
    #top{
      text-align: center;
    }
    .invoice-POS{
      padding: 10px;
    }
    #tbl-top{
      font-size: 11px;
    }
    .content2{
      padding-left: 3px;
    }
    .ttd{
      font-size: 11px;
    }
  </style>
  <style media="print">
    .info div{
      text-align: center;
      font-weight: bold;
    }
    #top{
      text-align: center;
    }
    #top .info div.infoinfo{
      text-align: center;
    }
    .invoice-POS{
      padding: 10px;
    }
    #tbl-top{
      font-size: 11px;
    }
    #tbl-top tr td.fontsmall{
      font-size: 9px;
    }
    .content2{
      padding-left: 3px;
    }
    .ttd{
      font-size: 11px;
    }
  </style>
  <section class="wrapper">
    <div class="row mt">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

        <div class="cetakan_resep">
          <!-- for($lembar=0;$lembar<2;$lembar++) -->
          <div class="invoice-POS">
            <!-- <div class="pagebreak112"></div> -->
            <div id="top">
              <div class="info">
                <div class="infoinfo" style="text-align: center;page-break-before: always">
                  RSU WAHIDIN SUDIRO HUSODO
                </div>
              </div>
              <div class="info2" style="text-align: center;">
                RESEP OBAT
              </div>
            </div>

            <div class="" style="margin-top:8px;margin-right:10px;">
              <table style="width:100%;margin-right:15px;" id="tbl-top">
                <tr>
                  <td colspan="3" style="font-size: 13px;">
                    No. <b> {{ ($resep) ? $resep->No_Resep : '' }}</b>
                  </td>
                  <td style="font-size: 12px;text-align:center;">
                    Alergi
                  </td>
                </tr>
                <tr>
                  <td></td>
                  <td></td>
                  <td class="text-right" style="font-size: 11px;" colspan="2">
                    {{ ($resep) ? $resep->isAlergi : '' }}{{ ($resep) ? ($resep->isAlergi=='ADA ALERGI') ? ', '.$resep->NamaAlergi : '' : '' }}
                  </td>
                </tr>
              </table>
              <table style="width:100%;margin-right:15px;" id="tbl-top">
                <tr>
                  <td style="font-size: 12px;width:30%;">
                    Tanggal
                  </td>
                  <td></td>
                  <td class="content2" style="font-size: 12px;" colspan="2"> : {{ date("d F Y") }}</td>
                </tr>
                <tr>
                  <td style="font-size: 12px;">
                    Poli
                  </td>
                  <td></td>
                  <td class="content2" style="font-size: 12px;" colspan="2">
                    : {{ $dokter->Nama_Poli }}
                  </td>
                </tr>
                <tr>
                  <td style="font-size: 12px;">
                    Nama Dokter
                  </td>
                  <td></td>
                  <td class="content2" style="font-size: 12px;" colspan="2"> : {{ $dokter->Nama_Dokter }}</td>
                </tr>
                <tr>
                  <td style="font-size: 12px;">
                    No. SIP
                  </td>
                  <td></td>
                  <td class="content2" style="font-size: 12px;" colspan="2">
                    : {{ $dokter->poli_id }}
                  </td>
                </tr>
                <tr>
                  <td style="font-size: 12px;">
                    Ansuransi
                  </td>
                  <td></td>
                  <td class="content2" style="font-size: 12px;" colspan="2">
                    : {{ $reg->NamaAsuransi }}
                  </td>
                </tr>
              </table>
            </div>

            <div class="ttd" style="margin:10px 0;font-size: 12px;">
              Ttd. Dokter :
              @if($dokter->ttd!='')
              @if(file_exists('ttd/'.$dokter->ttd))
              <img src="{{ asset('ttd/'.$dokter->ttd) }}" alt="Tanda tangan" style="width:3cm">
              @else
              @endif
              @endif
            </div>

            <style media="screen">
              #tabel-obat{
                margin-bottom: 25px;
                font-style: italic;
              }
              #tabel-obat tr td div.ket{
                margin-left: 40px;
                font-size: 12px;
                text-transform: capitalize;
              }
              #tabel-obat tr td.borbot{
                border-bottom: 1px solid #000;
              }
              #tabel-obat tr td.hrfkcl{
                font-size: 14px;
              }
              .col1{
                width: 10%;
              }
              .col2{
                width: 70%;
              }
              .col3{
                width: 20%;
              }
              .b_obat{
                padding-left: 10px;
              }
              .b_mf{
                padding-left: 25px;
              }
              .spacer td{
                padding-top: 20px;
              }
            </style>
            <style media="print">
              #tabel-obat{
                margin-bottom: 25px;
                font-style: italic;
              }
              #tabel-obat tr td div.ket{
                margin-left: 40px;
                font-size: 12px;
                text-transform: lowercase;
              }
              #tabel-obat tr td.borbot{
                border-bottom: 1px solid #000;
              }
              #tabel-obat tr td.hrfkcl{
                font-size: 14px;
              }
              .col1{
                width: 10%;
              }
              .col2{
                width: 70%;
              }
              .col3{
                width: 20%;
              }
              .b_obat{
                padding-left: 10px;
              }
              .b_mf{
                padding-left: 25px;
              }
              .spacer td{
                padding-top: 20px;
              }
            </style>
            <div class="">
              <table id="tabel-obat" style="width:100%; margin-right:10px;">
                @if (count($racikanPasien)>0)
                @foreach ($racikanPasien as $key)
                @if ($key->asal == 'resep')
                <tr class="spacer">
                  <td class="col1 hrfkcl">{{ $key->No_R }}</td>
                  <td class="col2 hrfkcl">{{ $key->a1_nama }}</td>
                  <td class="col3 hrfkcl">No. {{ $key->a1_jml }}</td>
                </tr>
                <tr>
                  <td colspan="3" class="hrfkcl">
                    @if (!empty($key->a1_signa) && !empty($key->a1_signa2))
                    S {{ $key->a1_signa }} dd {{ $key->a1_signa2 }}
                    @else
                    {{ $key->a1_signakhusus }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <td colspan="3"> <div class="ket">
                    {{ $key->a1_ket }}
                  </div> </td>
                </tr>
                <tr>
                  <td class="borbot" colspan="2"></td>
                  <td></td>
                </tr>
                @else
                <tr class="spacer">
                  <td colspan="3" class="hrfkcl">{{ $key->No_R }}</td>
                </tr>
                @for ($i=1; $i <= 8; $i++)
                @if (!empty($key->{'b2_nama'.$i}))
                <tr>
                  <td colspan="2" class="b_obat hrfkcl">{{ $key->{'b2_nama'.$i} }}</td>
                  <td class="hrfkcl">{{ $key->{'b2_jml'.$i} }}</td>
                </tr>
                @endif
                @endfor
                <tr>
                  <td colspan="2" class="b_mf hrfkcl">{{ $key->b2_mf }}</td>
                  <td class="hrfkcl">{{ $key->b2_mfjumlah }}</td>
                </tr>
                <tr>
                  <td colspan="3" class="b_mf hrfkcl">
                    @if (!empty($key->b2_signa1) || !empty($key->b2_signa2))
                    S {{ number_format($key->b2_signa1,0) }} dd {{ number_format($key->b2_signa2,0) }}
                    @else
                    {{ $key->b2_signakhusus }}
                    @endif
                  </td>
                </tr>
                <tr>
                  <td colspan="3"> 
                    <div class="ket">
                      {{ $key->b2_ket }}
                    </div>
                  </td>
                </tr>
                <tr>
                  <td class="borbot" colspan="2"></td>
                  <td></td>
                </tr>
                @endif
                @endforeach
                @endif
              </table>
            </div>

            <style media="screen">
              #table table tr td{
                font-size: 11px;
              }
              #table table tr td.bor{
                border: 1px solid #000;
                width: 12%;
                text-align: center;
                padding: 3px;
              }
              #table table tr td.padleft{
                padding-left: 15px;
              }
              #table table tr td.tt{
                padding: 20px 0;
              }
            </style>
            <style media="print">
              #table table tr td.bor{
                border: 1px solid #000;
                width: 10%;
                text-align: center;
                padding: 3px;
              }
              #table table tr td.padleft{
                padding-left: 15px;
              }
              #table table tr td.tt{
                padding: 20px 0;
              }
              #table table tr td.colSm{
                font-size: 13px;
              }
            </style>
            <div id="bot" style="margin-right:8px;">
              <div id="table">
                <table style="width:100%; margin-right:10px;">
                  <tr>
                    <td class="colSm">Nama</td>
                    <td class="colSm">:</td>
                    <td class="colSm">{{ $rekap->Nama_Pasien }}</td>
                    <td class="bor colSm">V</td>
                    <td class="bor"></td>
                  </tr>
                  <tr>
                    <td class="colSm">Tgl Lahir</td>
                    <td class="colSm">:</td>
                    <td class="colSm">{{ date("d-m-Y",strtotime($reg->Tgl_Lahir)) }}</td>
                    <td class="bor colSm">H</td>
                    <td class="bor"></td>
                  </tr>
                  <tr>
                    <td class="colSm">No. RM</td>
                    <td class="colSm">:</td>
                    <td class="colSm">{{ $rekap->no_RM }}</td>
                    <td class="bor colSm">D</td>
                    <td class="bor"></td>
                  </tr>
                  <tr>
                    <td class="colSm">BB</td>
                    <td class="colSm">:</td>
                    <td class="colSm">{{ ($resep) ? number_format($resep->BB,0) : '' }} {{ ($resep) ? $resep->SatuanBB : '' }}</td>
                    <td class="bor colSm">L</td>
                    <td class="bor"></td>
                  </tr>
                  <tr>
                    <td class="colSm">TB</td>
                    <td class="colSm">:</td>
                    <td class="colSm">{{ ($resep) ? number_format($resep->TB,0) : '' }} cm</td>
                    <td class="bor colSm">S</td>
                    <td class="bor"></td>
                  </tr>
                  <tr>
                    <td colspan="5"></td>
                  </tr>
                </table>
                <table style="width:100%; margin-right:10px;">
                  <tr>
                    <td class="padleft colSm">Pasien/Keluarga</td>
                    <td class="padleft colSm">Apoteker</td>
                  </tr>
                  <tr>
                    <td class="tt"></td>
                    <td class="tt"></td>
                  </tr>
                  <tr>
                    <td class="padleft">____________</td>
                    <td class="padleft">____________</td>
                  </tr>
                </table>
              </div>

              {{-- <div id="legalcopy">
                <p class="legal text-center"><br>
                  <strong>-- Terima kasih! --</strong>
                </p>
              </div> --}}

            </div>

            <div class="clearfix" style="margin-bottom:10px;"></div>

          </div>
          <!-- endfor -->
        </div>
      </div>
    </div>
  </section>
  @stop
  @section('js')
  <script src="{!! url('js/jquery.PrintArea.js') !!}"></script>

  <script type="text/javascript">
  // $('.cetakan_resep').printArea();
  // setTimeout(function awal () {
  // 	$('.invoice-POS').hide();
  // }, 100);
  // 
  $(document).ready(function(){
    cetak1();
  });

  function cetak1(){
    $('.cetakan_resep').printArea();
    setTimeout(function(){
      if ('{{ $printed }}'=='Y') {
        cetak2();
      }else {
        window.location.href = '{{ route('cetakAntrian',['no_resep'=>$resep->No_Resep]) }}';
      }
    }, 2000);
  }

  function cetak2(){
    $('.cetakan_resep').printArea();
    setTimeout(function thanks () {
      if ('{{ $printed }}'=='Y') {
        swal({
         title: "Terima Kasih !",
         type: "success",
         timer: 2000,
         showConfirmButton: false
       });
        window.location.href = '{{ route('pembuatanObat') }}';
      }else {
        window.location.href = '{{ route('cetakAntrian',['no_resep'=>$resep->No_Resep]) }}';
      }
    }, 2000);
  }
</script>
@stop
