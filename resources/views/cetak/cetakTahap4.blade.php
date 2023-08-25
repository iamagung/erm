<!DOCTYPE html>
<html>
<head>
	<title>Tahap 1</title>
</head>
<body>
	<?php
	if($customer->JenisKel=='P'){
		$kelamin = 'Perempuan';
	}else{
		$kelamin = 'Laki-laki';
	}
	?>
	<table width="100%">
		<tr>
			<td rowspan="3" width="10%">
				<img src="{!! asset($iden->favicon) !!}" style="width: 2cm">
			</td>
			<td width="45%">
				<table width="100%">
					<tr>
						<td>Nama Pasien</td>
						<td>{!! $syarat->Nama_Pasien !!}</td>
					</tr>
					<tr>
						<td>Jenis Kelamin</td>
						<td>{!! $kelamin !!}</td>
					</tr>
					<tr>
						<td>Poliklinik</td>
						<td>{!! $syarat->NamaPoli !!}</td>
					</tr>
				</table>
			</td>
			<td width="45%">
				<table width="100%">
					<tr>
						<td>No RM</td>
						<td>{!! $syarat->no_RM !!}</td>
					</tr>
					<tr>
						<td>Tgl Lahir</td>
						<td>{!! date('d-m-Y',strtotime($customer->TglLahir)) !!}</td>
					</tr>
					<tr>
						<td>&nbsp;</td>
						<td></td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
	<table width="100%">
		<tr>
			<td colspan="2" style="font-size: 20px;font-weight: bold;text-align: center;border: 1px solid #000">FORMULIR EDUKASI PASIEN/ KELUARGA<br/>PENGKAJIAN EDUKASI PASIEN</td>
		</tr>
		<tr>
			<td colspan="2" style="font-weight: bold;text-align: center;border: 1px solid #000">Kemampuan dan Kemauan Edukasi</td>
		</tr>
		<tr>
			<td width="50%" style="border: 1px solid #000">
				<table width="100%">
					<tr>
						<td width="50%">Nama Panggilan</td>
						<td width="50%">{!! $syarat->nama_panggilan !!}</td>
					</tr>
					<tr>
						<td width="50%">Agama</td>
						<td width="50%">{!! $syarat->agama_edu !!}</td>
					</tr>
					<tr>
						<td width="50%">Nilai-nilai yang dianut</td>
						<td width="50%">{!! $syarat->anutan !!}</td>
					</tr>
					<tr>
						<td width="50%">Pendidikan</td>
						<td width="50%">{!! $syarat->pendidikan_edu !!}</td>
					</tr>
				</table>
			</td>
			<td style="border: 1px solid #000">
				<table width="100%">
					<tr>
						<td>Kesulitan Komunikasi</td>
					</tr>
					<tr>
						<td>
							<?php
							$check=['checked',''];
							$display = 'display:none';
							if($syarat->komunikasi=='' || $syarat->komunikasi=='Tidak ada'){
								$check=['checked',''];
							}else{
								$display='';
								$check=['','checked'];
							}
							?>
							<input type="radio" {{ $check[0] }} disabled name="">Tidak Ada
							<input type="radio" {{ $check[1] }} disabled name="">Ada
							<i style="{{ $display  }};font-weight: bold;"> ({{ $syarat->komunikasi }})</i>
						</td>
					</tr>
					<tr>
						<td>Bahsa yang dipakai</td>
					</tr>
					<tr>
						<td>
							<?php
							$check=['','','',''];
							$display = 'display:none';
							$isi='';
							if($syarat->bahasa_edu!=''){
								$st = explode("+", $syarat->bahasa_edu);
								for ($i=0; $i < count($st)-1; $i++) { 
									if($st[$i]=='Indonesia'){
										$check[0]='checked';
									}else if($st[$i]=='Mandarin'){
										$check[1]='checked';
									}else if($st[$i]=='Inggris'){
										$check[2]='checked';
									}else{
										$display='';
										$isi = $st[$i];
										$check[3]='checked';
									}
								}
							}
							?>
							<input type="checkbox" {{ $check[0] }} disabled name="">Indonesia
							<input type="checkbox" {{ $check[1] }} disabled name="">Mandarin
							<input type="checkbox" {{ $check[2] }} disabled name="">Inggris
							<input type="checkbox" {{ $check[3] }} disabled name="">Lainnya
							<i style="{{ $display  }};font-weight: bold;"> ({{ $isi }})</i>
						</td>
					</tr>
					<tr>
						<td>Penterjemah</td>
					</tr>
					<tr>
						<td>
							<?php
							$check=['','checked',''];
							$display = 'display:none';
							if($syarat->penterjemah=='perlu'){
								$check=['checked','',''];
							}else if($syarat->penterjemah=='tidak perlu' || $syarat->penterjemah==''){
								$check=['','checked',''];
							}else{
								$check=['','','checked'];
								$display = '';
							}
							?>
							<input type="radio" {{ $check[0] }} disabled name="">Perlu
							<input type="radio" {{ $check[1] }} disabled name="">Tidak Perlu
							<input type="radio" {{ $check[2] }} disabled name="">Lainnya
							<i style="{{ $display  }};font-weight: bold;"> ({{ $syarat->penterjemah }})</i>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="border-left: 1px solid #000;border-right: 1px solid #000;border-top: 1px solid #000">
				<i>Indentifikasi dan berikan tanda (v) pada hambatan yang dapat mempengaruhi proses dan hasil edukasi</i>
			</td>
		</tr>
		<tr>
			<td colspan="2" style="border-left: 1px solid #000;border-right: 1px solid #000">
				<?php
				$check=['','','','','','','','','',''];
				$display = 'display:none';
				$isi='';
				if($syarat->hambatan_edu!=''){
					$st = explode("+", $syarat->hambatan_edu);
					for ($i=0; $i < count($st)-1; $i++) { 
						if($st[$i]=='Tidak ada hambatan edukasi'){
							$check[0]='checked';
						}else if($st[$i]=='Gangguan Penglihatan'){
							$check[1]='checked';
						}else if($st[$i]=='Gangguan proses pikir'){
							$check[2]='checked';
						}else if($st[$i]=='Motivasi belajar'){
							$check[3]='checked';
						}else if($st[$i]=='Gangguan pendengaran'){
							$check[4]='checked';
						}else if($st[$i]=='Hambatan bahasa'){
							$check[5]='checked';
						}else if($st[$i]=='Batasan jasmani dan kognitif'){
							$check[6]='checked';
						}else if($st[$i]=='Gangguan emosional'){
							$check[7]='checked';
						}else if($st[$i]=='Kemampuan membaca'){
							$check[8]='checked';
						}else{
							$display='';
							$isi = $st[$i];
							$check[9]='checked';
						}
					}
				}
				?>
				<table width="100%">
					<tr>
						<td>
							<input disabled type="checkbox" {!! $check[0] !!} name="hambatan[]" value="Tidak ada hambatan edukasi"> Tidak ada hambatan edukasi
							<br/><input disabled type="checkbox" {!! $check[1] !!} name="hambatan[]" value="Gangguan Penglihatan"> Gangguan Penglihatan
							<br/><input disabled type="checkbox" {!! $check[2] !!} name="hambatan[]" value="Gangguan proses pikir"> Gangguan proses pikir
							<br/><input disabled type="checkbox" {!! $check[3] !!} name="hambatan[]" value="Motivasi belajar"> Motivasi belajar
						</td>
						<td>
							<input disabled type="checkbox" {!! $check[4] !!} name="hambatan[]" value="Gangguan pendengaran"> Gangguan pendengaran</label>
							<br/><input disabled type="checkbox" {!! $check[5] !!} name="hambatan[]" value="Hambatan bahasa"> Hambatan bahasa
							<br/><input disabled type="checkbox" {!! $check[6] !!} name="hambatan[]" value="Batasan jasmani dan kognitif"> Batasan jasmani dan kognitif
						</td>
						<td>
							<input disabled type="checkbox" {!! $check[7] !!} name="hambatan[]" value="Gangguan emosional"> Gangguan emosional
							<br/><input disabled type="checkbox" {!! $check[8] !!} name="hambatan[]" value="Kemampuan membaca"> Kemampuan membaca
						</td>
					</tr>
					<tr>
						<td colspan="3">
							<input disabled type="checkbox" {!! $check[9] !!} id="hambatan" name="hambatan[]" value="lainnya"> Hambatan lainnya
							<i style="{{ $display  }};font-weight: bold;"> ({{ $isi }})</i>
						</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<?php
			$check=['checked',''];
			if($syarat->kesediaan=='' || $syarat->kesediaan=='Ya'){
				$check=['checked',''];
			}else{
				$check=['','checked'];
			}
			?>
			<td colspan="2" style="border-left: 1px solid #000;border-right: 1px solid #000;border-bottom: 1px solid #000">
				Kesedian pasien / keluarga * untuk menerima informasi yang diberikan 
				<input type="radio" disabled {!! $check[0] !!} name="kesediaan" value="Ya" checked> Ya
				<input type="radio" disabled {!! $check[1] !!} value="Tidak" name="kesediaan"> Tidak
			</td>
		</tr>
		<tr>
			<th colspan="2" style="border: 1px solid #000">
				Kebutuhan Edukasi
			</th>
		</tr>
		<tr>
			<td colspan="2" style="border: 1px solid #000">
				<ul>
					<li><i>Identifikasi dan berikan (v) pada kebutuhan edukasi yang dibutuhkan pasien dan keluarganya</i></li>
					<li><i>Pada keadaan dimana pasien memerlukan edukasi suatu bidang yang khusus. Dokter penanggung jawab pasien akan menentukan kebutuhan program edukasi yang sesuai</i></li>
				</ul>
			</td>
		</tr>
		<tr>
			<?php
			$check=['','','','','','','','','','','','','',''];
			$display = 'display:none';
			$isi='';
			if($syarat->program!=''){
				$st = explode("+", $syarat->program);
				for ($i=0; $i < count($st)-1; $i++) { 
					if($st[$i]=='1'){
						$check[0]='checked';
					}else if($st[$i]=='2'){
						$check[1]='checked';
					}else if($st[$i]=='3'){
						$check[2]='checked';
					}else if($st[$i]=='4'){
						$check[3]='checked';
					}else if($st[$i]=='5'){
						$check[4]='checked';
					}else if($st[$i]=='6'){
						$check[5]='checked';
					}else if($st[$i]=='7'){
						$check[6]='checked';
					}else if($st[$i]=='8'){
						$check[7]='checked';
					}else if($st[$i]=='9'){
						$check[8]='checked';
					}else if($st[$i]=='10'){
						$check[9]='checked';
					}else if($st[$i]=='11'){
						$check[10]='checked';
					}else if($st[$i]=='12'){
						$check[11]='checked';
					}else if($st[$i]=='13'){
						$check[12]='checked';
					}else{
						$display='';
						$isi = $st[$i];
						$check[13]='checked';
					}
				}
			}
			?>
			<td colspan="2" style="border: 1px solid #000">
				<table width="100%" border="1">
					<tr>
						<th width="50%">Program Edukasi</th>
						<th width="50%">Bidang Disiplin</th>
					</tr>

					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="1" {!! $check[0] !!}>Kondisi medis dan diagnosa</label></td>
						<td>Medis</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="2" {!! $check[1] !!}>Rencana perawatan dan pengobatan</label></td>
						<td>Medis</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="3" {!! $check[2] !!}>Pegisian Informed Consent</label></td>
						<td>Medis</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="4" {!! $check[3] !!}>Perawatan luka</label></td>
						<td>Keperawatan</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="5" {!! $check[4] !!}>Perawatan lanjutan setelah pasien pulang</label></td>
						<td>Keperawatan</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="6" {!! $check[5] !!}>Penggunaan alat medis</label></td>
						<td>Keperawatan</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="7" {!! $check[6] !!}>Manajemen nyeri</label></td>
						<td>Keperawatan</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="8" {!! $check[7] !!}>Teknik cuci tangan</label></td>
						<td>Keperawatan</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="9" {!! $check[8] !!}>Resiko pasien jatuh</label></td>
						<td>Keperawatan</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="10" {!! $check[9] !!}>Diet/ nutrisi</label></td>
						<td>Dokter Gizi/ Ahli Gizi</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="11" {!! $check[10] !!}>Penggunaan obat secara aman dan efektif</label></td>
						<td>Farmasi</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="12" {!! $check[11] !!}>Interaksi obat dan makanan</label></td>
						<td>Farmasi</td>
					</tr>
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="13" {!! $check[12] !!}>Teknik rehabilitasi</label></td>
						<td>Rehabilitasi Medis</td>
					</tr>					
					<tr>
						<td><label><input disabled type="checkbox" name="program[]" value="lainnya" {!! $check[13] !!} id="edukasi">Edukasi lainnya</label></td>
						<td><i style="{!! $display !!};font-weight: bold;">({!! $isi !!})</i></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<th colspan="2" style="border: 1px solid #000">
				<b>CATATAN EDUKASI</b>
			</th>
		</tr>
		<tr>
			<td colspan="2" style="border: 1px solid #000">
				<?php
            $edu = DB::table('edukasi_rm')->where('rekapMedik_id',$syarat->id_rekapMedik)->get();
            if(count($edu)!=0){
                ?>
                <table width="100%" border="1">
                    <tr>
                        <th style="width: 15%">Edukator (Bidang edukasi)</th>
                        <th style="width: 10%">Yang diedukasi</th>
                        <th style="width: 10%">Metode</th>
                        <th style="width: 40%">Materi</th>
                        <th style="width: 30%">Response</th>
                    </tr>
                    <?php
                    foreach ($edu as $key) {
                        ?>
                        <tr>
                            <td>{{$key->edukator}} ({{$key->disiplin}})</td>
                            <td>
                                <ul>
                                <?php
                                $metode = explode("+", $key->edukasi_ke);
                                for($i=0;$i<count($metode)-1;$i++){
                                    echo "<li>".$metode[$i]."</li>";
                                }
                                ?>
                                </ul>
                            </td>
                            <td>
                                <ul>
                                <?php
                                $metode = explode("+", $key->metode_edukasi);
                                for($i=0;$i<count($metode)-1;$i++){
                                    echo "<li>".$metode[$i]."</li>";
                                }
                                ?>
                                </ul>
                            </td>
                            <td>{{$key->materi_edukasi}}</td>
                            <td>
                                <ul>
                                <?php
                                $metode = explode("+", $key->response_edukasi);
                                for($i=0;$i<count($metode)-1;$i++){
                                    echo "<li>".$metode[$i]."</li>";
                                }
                                ?>
                                </ul>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
                <?php
            }
            ?>
			</td>
		</tr>
	</table>
</body>
<?php
if($download==''){
?>
<script type="text/javascript">
	window.print();
</script>
<?php
}
?>
</html>