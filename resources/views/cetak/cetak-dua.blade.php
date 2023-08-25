<!DOCTYPE html>
<html>

<head>
	<title>Tahap 1</title>
	<style type="text/css">
		#body td {
			text-align: center;
		}

		.d-flex {
			display: flex;
		}

		table {
			border-collapse: collapse;
		}

		table,
		th,
		td {
			border: 1px solid black;
		}

		th,
		td {
			padding: 10px;
		}
	</style>
</head>

<body>
	<!-- <table id="kop" width="100%" border="1">
		<tr>
			<td rowspan="2" width="8%">
				<img src="" style="width: 2cm">
			</td>
			<td width="72%" style="font-size: 20px;font-weight: bold;text-align: center;">
				CATATAN PERKEMBANGAN PASIEN TERINTEGRASI
			</td>
			<td width="20%" rowspan="2" style="vertical-align: bottom; text-align: right;">
				<span>Label</span>
			</td>
		</tr>
		<tr>
			<td>
				Poliklinik: 
			</td>
		</tr>
	</table>
	<table id="body" width="100%" border="1">
		<tr>
			<td width="5%" style="font-weight: bold;">
				TGL<br>&<br>JAM
			</td>
			<td width=5%" style="font-weight: bold;">
				Profesional Pemberi Asuhan
			</td>
			<td width="35%">
				<b>HASIL ASESMEN PASIEN DAN PEMBERI PELAYANAN</b><br>
				<i>(Tulis dengan format SOAP/ADME, disertai sasaran. Tulis Nama, beri Paraf pada akhir catatan)</i>
			</td>
			<td width="25%">
				<b>INSTRUKSI PPA TERMASUK PASCA BEDAH</b><br>
				<i>(Instruksi Ditulis dengan Rinci dan Jelas)</i>
			</td>
			<td width="30%">
				<b>REVIEW & VERIFIKASI DPJP</b><br>
				<i>(Tulis Nama, beri Paraf, Tgl., Jam)<br>(DPJP harus membaca / mereview seluruh Rencana Asuhan)</i>
			</td>
		</tr>
	</table> -->
	<!-- 
	<table width="100%" border="1" style="font-size: 12px;">
		<tr>
			<td class="d-flex">
				<p>Agama </p>
			</td>

			<td>
				<p><input type="checkbox"> Kristen</p>
			</td>
			<td>
				<p><input type="checkbox"> Kristen</p>
			</td>
			<td>
				<p><input type="checkbox"> Kristen</p>
			</td>
		</tr>

		<tr>
			<td class="d-flex">
				<p>Agama </p>
			</td>

			<td>
				<p><input type="checkbox"> Kristen</p>
			</td>
		</tr>


	</table> -->


	<table width="100%" border="1" style="font-size: 12px;">
		<tr>
			<td>
				<div style="margin-left: 900px;">
					<p>Nama :</p>
					<p>No.RM :</p>
					<p>Jenis Kelamin :</p>
					<p>Tenggal Lahir :</p>
				</div>
				<h1 style="font-size: 20px;font-weight: bold;text-align: center;">
					FORMULIR EDUKAKSI PASIEN DAN KELUARGA TERINTEGRAASI RAWAT JALAN
				</h1>
				<h3 style="margin-left: 200px;">PENGKAJIAN KEBUTUHAN EDUKASI</h3>

				<div class="d-flex">
					<p>Agama </p>
					<p style="margin-left: 165px;">:<input type="checkbox"> Islam</p>
					<p><input type="checkbox"> Kristen</p>
					<p><input type="checkbox"> Hindu</p>
					<p><input type="checkbox"> Budha</p>
					<p><input type="checkbox"> Lainnya...</p>
				</div>

				<div class="d-flex">
					<p>Nilai-Nilai Kepercayaan </p>
					<p style="margin-left: 83px;">:<input type="checkbox"> Tidak</p>
					<p><input type="checkbox"> Ada, sebutkan..................</p>
				</div>

				<div class="d-flex">
					<p>Keyakinan Pasien dan Keluarga</p>
					<p style="margin-left: 47px;">:<input type="checkbox"> Tidak</p>
					<p><input type="checkbox"> Ada, sebutkan..................</p>
				</div>

				<div class="d-flex">
					<p>Tingkat Pendidikan </p>
					<p style="margin-left: 108px;">:<input type="checkbox"> SD</p>
					<p><input type="checkbox"> SMP</p>
					<p><input type="checkbox"> SMA</p>
					<p><input type="checkbox"> D3</p>
					<p><input type="checkbox"> S1</p>
					<p><input type="checkbox"> Lainnya...</p>
				</div>

				<div class="d-flex">
					<p>Suku dan Budaya</p>
					<p style="margin-left: 117px;">:<input type="checkbox"> Betawi</p>
					<p><input type="checkbox"> Sunda</p>
					<p><input type="checkbox"> Jawa</p>
					<p><input type="checkbox"> Padang</p>
					<p><input type="checkbox"> Lainnya...</p>
				</div>

				<div class="d-flex">
					<p>Bahasa Sehari-hari </p>
					<p style="margin-left: 110px;">:<input type="checkbox"> Indonesia</p>
					<p><input type="checkbox"> Inggris</p>
					<p><input type="checkbox"> Daerah...</p>
					<p style="margin-left: 100px;"><input type="checkbox"> Bahasa Lainnya...</p>
				</div>

				<div class="d-flex">
					<p>Kemampuan Belajar</p>
					<p style="margin-left: 103px;">:<input type="checkbox">Mampu</p>
					<p><input type="checkbox">Tidak Mampu</p>
				</div>

				<div class="d-flex">
					<p>Kemampuan Baca dan Tulis</p>
					<p style="margin-left: 67px;">:<input type="checkbox">Baik</p>
					<p><input type="checkbox">Kurang</p>
				</div>

				<div class="d-flex">
					<p>Bahasa Isyarat</p>
					<p style="margin-left: 133px;">:<input type="checkbox">Tidak</p>
					<p><input type="checkbox">Ya</p>
				</div>

				<div class="d-flex">
					<p>Perlu Penerjemah</p>
					<p style="margin-left: 120px;">:<input type="checkbox">Tidak</p>
					<p><input type="checkbox">Ya, bahasa............</p>
				</div>


				<div class="d-flex">
					<p>Hambatan Emosional dan Motivasi</p>
					<p style="margin-left: 36px;">:<input type="checkbox">Tidak</p>
					<p><input type="checkbox">Ya, sebutkan............</p>
				</div>

				<div class="d-flex">
					<p>Keterbatasan Fisik dan Kognitif</p>
					<p style="margin-left: 51px;">:<input type="checkbox"> Tidak</p>
					<p><input type="checkbox"> Tuna Rungu</p>
					<p><input type="checkbox"> Tuna Wicara</p>
					<p><input type="checkbox"> Tuna Netra</p>
					<p><input type="checkbox"> Disabilitas</p>
					<p><input type="checkbox"> Lainnya...</p>
				</div>
				<div class="d-flex">
					<p style="margin-left: 210px;"><input type="checkbox"> Retardasi Mental</p>
					<p><input type="checkbox"> Kesulitan belajar</p>
					<p><input type="checkbox"> Gangguan Bicara</p>
				</div>

				<div class="d-flex">
					<p>Kesediaan Menerima Edukasi</p>
					<p style="margin-left: 63px;">:<input type="checkbox">Bersedia</p>
					<p><input type="checkbox">Tidak Bersedia</p>
				</div>

				<div class="d-flex">
					<p>Pilihan Tipe Pembelajaran</p>
					<p style="margin-left: 80px;">:<input type="checkbox">Verbal</p>
					<p><input type="checkbox">Tulisan</p>
				</div>

				<div class="d-flex ">
					<p>Perencanaan Kebutuhan Edukasi : </p>
				</div>
			</td>
		</tr>
	</table>

	<table width="100%" border="1">
		<tr>
			<th rowspan="3">No</th>
			<th rowspan="3">Tanggal</th>
			<th rowspan="3">Materi Edukasi</th>
			<th rowspan="3">Metode Edukasi</th>
			<th rowspan="3">Sarana Edukasi</th>
		</tr>
		<tr>
			<th>Edukator</th>
			<th>Sasaran</th>
			<th rowspan="2">Verivikasi Posst Edukasi</th>
			<th rowspan="2">Tanggal Re-Edukasi</th>
			<th rowspan="2">TTD Re-Edukator</th>
		</tr>
		<tr>
			<th>Nama/Profesi & TTD</th>
			<th>Nama & TTD</th>
		</tr>
		<tr>
			<td colspan="10" style="font-weight: bold ;text-align: center;">PENDAFTARAN</td>
		</tr>
		<tr>
			<td>1</td>
			<td></td>
			<td>
				<ul style="list-style: none;">
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> General Consent</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Jadwal Praktek Dokter</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Biaya</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Poli dan Nama Dokter</p>
						</div>
					</li>
				</ul>
			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Individu</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diskusi Kelompok</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Ceramah</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Demontrasi</p>
						</div>
					</li>
				</ul>

			</td>

			<td>
				<ul style="list-style: none;">
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Leaflet</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Audio Visual</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Lainnya...</p>
					</div>
				</ul>
			</td>

			<td>

			</td>

			<td>

			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Tidak Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox">Sudah Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Menjelaskan</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Mendemontrasikan</p>
						</div>
					</li>
				</ul>
			</td>

			<td></td>

			<td></td>
		</tr>

		<tr>
			<td colspan="10" style="font-weight: bold ;text-align: center;">PERAWAT/BIDAN</td>
		</tr>

		<tr>
			<td>2</td>
			<td></td>
			<td>
				<ul style="list-style: none;">
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Tanda-tanda vital</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Pengkajian Awal</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Pengkajian Lanjutan</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Penggunaan alat yang aman</p>
						</div>
					</li>
				</ul>
			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Individu</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diskusi Kelompok</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Ceramah</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Demontrasi</p>
						</div>
					</li>
				</ul>

			</td>

			<td>
				<ul style="list-style: none;">
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Leaflet</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Audio Visual</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Lainnya...</p>
					</div>
				</ul>
			</td>

			<td>

			</td>

			<td>

			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Tidak Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox">Sudah Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Menjelaskan</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Mendemontrasikan</p>
						</div>
					</li>
				</ul>
			</td>

			<td></td>

			<td></td>
		</tr>

		<tr>
			<td>3</td>
			<td></td>
			<td>
				<h4 style="font-weight: bold; margin-left: 10px;">Khusus Bidan</h4>
				<ul style="list-style: none;">
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Persiapan Persalinan</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> KB</p>
						</div>
					</li>
				</ul>
			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Individu</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diskusi Kelompok</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Ceramah</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Demontrasi</p>
						</div>
					</li>
				</ul>

			</td>

			<td>
				<ul style="list-style: none;">
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Leaflet</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Audio Visual</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Lainnya...</p>
					</div>
				</ul>
			</td>

			<td>

			</td>

			<td>

			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Tidak Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox">Sudah Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Menjelaskan</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Mendemontrasikan</p>
						</div>
					</li>
				</ul>
			</td>

			<td></td>

			<td></td>
		</tr>

		<tr>
			<td colspan="10" style="font-weight: bold ;text-align: center;">DOKTER</td>
		</tr>

		<tr>
			<td>4</td>
			<td></td>
			<td>
				<ul style="list-style: none;">
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diagnosa Medis</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diit</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Dishcarge Planning</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Alternatif Pengobatan</p>
						</div>
					</li>
				</ul>
			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Individu</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diskusi Kelompok</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Ceramah</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Demontrasi</p>
						</div>
					</li>
				</ul>

			</td>

			<td>
				<ul style="list-style: none;">
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Leaflet</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Audio Visual</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Lainnya...</p>
					</div>
				</ul>
			</td>

			<td>

			</td>

			<td>

			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Tidak Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox">Sudah Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Menjelaskan</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Mendemontrasikan</p>
						</div>
					</li>
				</ul>
			</td>

			<td></td>

			<td></td>
		</tr>

		<tr>
			<td>5</td>
			<td></td>
			<td>
				<p>Edukasi/Penjelasan Inform Consent, Jelaskan.....</p>
			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Individu</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diskusi Kelompok</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Ceramah</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Demontrasi</p>
						</div>
					</li>
				</ul>

			</td>

			<td>
				<ul style="list-style: none;">
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Leaflet</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Audio Visual</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Lainnya...</p>
					</div>
				</ul>
			</td>

			<td>

			</td>

			<td>

			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Tidak Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox">Sudah Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Menjelaskan</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Mendemontrasikan</p>
						</div>
					</li>
				</ul>
			</td>

			<td></td>

			<td></td>
		</tr>

		<tr>
			<td colspan="10" style="font-weight: bold ;text-align: center;">DOKTER ANASTESI</td>
		</tr>

		<tr>
			<td>6</td>
			<td></td>
			<td>
				<ul style="list-style: none;">
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Rencana Tindakan</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Jenis Anastesi</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Kelebihan dan Kelemahan Teknik Anastesi Yang Akan Diberikan</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Manajemen Nyari</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Komplikasi/Efek Samping</p>
						</div>
					</li>
				</ul>
			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Individu</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diskusi Kelompok</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Ceramah</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Demontrasi</p>
						</div>
					</li>
				</ul>

			</td>

			<td>
				<ul style="list-style: none;">
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Leaflet</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Audio Visual</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Lainnya...</p>
					</div>
				</ul>
			</td>

			<td>

			</td>

			<td>

			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Tidak Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox">Sudah Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Menjelaskan</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Mendemontrasikan</p>
						</div>
					</li>
				</ul>
			</td>

			<td></td>

			<td></td>
		</tr>

		<tr>
			<td colspan="10" style="font-weight: bold ;text-align: center;">NUTRISIONIS</td>
		</tr>

		<tr>
			<td>7</td>
			<td></td>
			<td>
				<ul style="list-style: none;">
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diet dan Nutrisi</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Batasan Diet</p>
						</div>
					</li>
				</ul>
			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Individu</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diskusi Kelompok</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Ceramah</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Demontrasi</p>
						</div>
					</li>
				</ul>

			</td>

			<td>
				<ul style="list-style: none;">
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Leaflet</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Audio Visual</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Lainnya...</p>
					</div>
				</ul>
			</td>

			<td>

			</td>

			<td>

			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Tidak Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox">Sudah Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Menjelaskan</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Mendemontrasikan</p>
						</div>
					</li>
				</ul>
			</td>

			<td></td>

			<td></td>
		</tr>

		<tr>
			<td colspan="10" style="font-weight: bold ;text-align: center;">FISIOTERAPIS</td>
		</tr>

		<tr>
			<td>8</td>
			<td></td>
			<td>
				<ul style="list-style: none;">
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"> Tehnik Rehabilitasi..........</p>
						</div>
					</li>
					<li style="margin-top: 5px;">
						<div class="d-flex">
							<p style="margin-left: -40px;"> Penggunaan Alat..........</p>
						</div>
					</li>
				</ul>
			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Individu</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Diskusi Kelompok</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Ceramah</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Demontrasi</p>
						</div>
					</li>
				</ul>

			</td>

			<td>
				<ul style="list-style: none;">
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Leaflet</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Audio Visual</p>
					</div>
				</ul>
				<ul>
					<div class="d-flex">
						<p style="margin-left: -40px;"><input type="checkbox"> Lainnya...</p>
					</div>
				</ul>
			</td>

			<td>

			</td>

			<td>

			</td>

			<td>
				<ul style="list-style: none;">
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Tidak Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox">Sudah Mengerti</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Menjelaskan</p>
						</div>
					</li>
					<li>
						<div class="d-flex">
							<p style="margin-left: -40px;"><input type="checkbox"> Mampu Mendemontrasikan</p>
						</div>
					</li>
				</ul>
			</td>

			<td></td>

			<td></td>
		</tr>

	</table>

</body>

</html>