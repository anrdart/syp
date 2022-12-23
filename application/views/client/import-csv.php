<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Import Data CSV dengan PHP</title>

	<!-- Style untuk Loading -->
	<style>
		#loading {
			background: whitesmoke;
			position: absolute;
			top: 140px;
			left: 82px;
			padding: 5px 10px;
			border: 1px solid #ccc;
		}
	</style>

	<script>
		$(document).ready(function() {
			// Sembunyikan alert validasi kosong
			$("#kosong").hide();
		});
	</script>
</head>

<body>
	<!-- Content -->
	<div style="padding: 0 15px;">

		<h3>Form Import Data</h3>
		<hr>

		<!-- Buat sebuah tag form dan arahkan action nya ke file ini lagi -->
		<form method="post" action="" enctype="multipart/form-data">
			<a href="Format.csv" class="btn btn-default">
				<span class="glyphicon glyphicon-download"></span>
				Download Format
			</a><br><br>

			<!--
				-- Buat sebuah input type file
				-- class pull-left berfungsi agar file input berada di sebelah kiri
				-->
			<input type="file" name="file" class="pull-left">

			<button type="submit" name="preview" class="btn btn-success btn-sm">
				<span class="glyphicon glyphicon-eye-open"></span> Preview
			</button>
			<a href="<?= base_url('client') ?>" class="btn btn-danger btn-sm">
				<span class="glyphicon glyphicon-remove"></span> Cancel
			</a>
		</form>

		<hr>

		<!-- Buat Preview Data -->
		<?php
		// Jika user telah mengklik tombol Preview
		if (isset($_POST['preview'])) {
			$nama_file_baru = 'data.csv';

			// Cek apakah terdapat file data.xlsx pada folder tmp
			if (is_file('./third_party/dompcsv/tmp/' . $nama_file_baru)) // Jika file tersebut ada
				unlink('./third_party/dompcsv/tmp/' . $nama_file_baru); // Hapus file tersebut

			$nama_file = $_FILES['file']['name']; // Ambil nama file yang akan diupload
			$tmp_file = $_FILES['file']['tmp_name'];
			$ext = pathinfo($nama_file, PATHINFO_EXTENSION); // Ambil ekstensi file yang akan diupload

			// Cek apakah file yang diupload adalah file CSV
			if ($ext == "csv") {
				// Upload file yang dipilih ke folder tmp
				move_uploaded_file($tmp_file, './' . $nama_file_baru);

				// Load librari PHPExcel nya
				require_once 'third_party/dompcsv/PHPExcel/PHPExcel.php';

				$inputFileType = 'CSV';
				$inputFileName = 'third_party/dompcsv/tmp/data.csv';

				$reader = PHPExcel_IOFactory::createReader($inputFileType);
				$excel = $reader->load($inputFileName);

				// Buat sebuah tag form untuk proses import data ke database
				echo "<form method='post' action='import.php'>";

				// Buat sebuah div untuk alert validasi kosong
				echo "<div class='alert alert-danger' id='kosong'>
					Semua data belum diisi, Ada <span id='jumlah_kosong'></span> data yang belum lengkap diisi.
					</div>";

				echo "<table class='table table-bordered'>
					<tr>
						<th colspan='5' class='text-center'>Preview Data</th>
					</tr>
					<tr>
						<th>#</th>
						<th>Nama Client</th>
						<th>Email</th>
						<th>Nomor Whatsapp</th>
						<th>Jenis Keluhan</th>
						<th>Psikolog</th>
						<th>Tanggal Konsultasi</th>
						<th>Jam Konsultasi</th>
					</tr>";

				$numrow = 1;
				$kosong = 0;
				$worksheet = $excel->getActiveSheet();
				foreach ($worksheet->getRowIterator() as $row) {
					if ($numrow > 1) {
						$a = 1;
						// START -->
						// Skrip untuk mengambil value nya
						$cellIterator = $row->getCellIterator();
						$cellIterator->setIterateOnlyExistingCells(false); // Loop all cells, even if it is not set

						$get = array(); // Valuenya akan di simpan kedalam array,dimulai dari index ke 0
						foreach ($cellIterator as $cell) {
							array_push($get, $cell->getValue()); // Menambahkan value ke variabel array $get
						}
						// <-- END

						// Ambil data value yang telah di ambil dan dimasukkan ke variabel $get
						$a++;
						$nama = $get[1]; // Ambil data nama
						$email = $get[2]; // Ambil data jenis kelamin
						$whatsapp = $get[3]; // Ambil data telepon
						$id_keluhan = $get[4]; // Ambil data alamat
						$id_psikolog = $get[5]; // Ambil data alamat
						$tanggal_konsultasi = $get[6]; // Ambil data alamat
						$jam_konsultasi = $get[7]; // Ambil data alamat

						// Cek jika semua data tidak diisi
						if ($nama == "" && $email == "" && $whatsapp == "" && $id_keluhan == "" && $id_psikolog == "" && $tanggal_konsultasi == "" && $jam_konsultasi == "")
							continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

						// Validasi apakah semua data telah diisi
						$nama_td = ($nama == "") ? " style='background: #E07171;'" : "";
						$email_td = ($email == "") ? " style='background: #E07171;'" : "";
						$whatsapp_td = ($whatsapp == "") ? " style='background: #E07171;'" : "";
						$id_keluhan_td = ($id_keluhan == "") ? " style='background: #E07171;'" : "";
						$id_psikolog_td = ($id_psikolog == "") ? " style='background: #E07171;'" : "";
						$tanggal_konsultasi_td = ($tanggal_konsultasi == "") ? " style='background: #E07171;'" : "";
						$jam_konsultasi_td = ($jam_konsultasi == "") ? " style='background: #E07171;'" : "";

						// Jika salah satu data ada yang kosong
						if ($nama == "" && $email == "" && $whatsapp == "" && $id_keluhan == "" && $id_psikolog == "" && $tanggal_konsultasi == "" && $jam_konsultasi == "") {
							$kosong++; // Tambah 1 variabel $kosong
						}

						echo "<tr>";
						echo "<td" . $nama_td . ">" . $nama . "</td>";
						echo "<td" . $email_td . ">" . $email . "</td>";
						echo "<td" . $whatsapp_td . ">" . $whastapp . "</td>";
						echo "<td" . $id_keluhan_td . ">" . $id_keluhan . "</td>";
						echo "<td" . $id_psikolog_td . ">" . $id_psikolog . "</td>";
						echo "<td" . $tanggal_konsultasi_td . ">" . $tanggal_konsultasi . "</td>";
						echo "<td" . $jam_konsultasi_td . ">" . $jam_konsultasi . "</td>";
						echo "</tr>";
					}

					$numrow++; // Tambah 1 setiap kali looping
				}

				echo "</table>";

				// Cek apakah variabel kosong lebih dari 1
				// Jika lebih dari 1, berarti ada data yang masih kosong
				if ($kosong > 1) {
		?>
					<script>
						$(document).ready(function() {
							// Ubah isi dari tag span dengan id jumlah_kosong dengan isi dari variabel kosong
							$("#jumlah_kosong").html('<?php echo $kosong; ?>');

							$("#kosong").show(); // Munculkan alert validasi kosong
						});
					</script>
		<?php
				} else { // Jika semua data sudah diisi
					echo "<hr>";

					// Buat sebuah tombol untuk mengimport data ke database
					echo "<button type='submit' name='import' class='btn btn-primary'><span class='glyphicon glyphicon-upload'></span> Import</button>";
				}

				echo "</form>";
			} else { // Jika file yang diupload bukan File CSV
				// Munculkan pesan validasi
				echo "<div class='alert alert-danger'>
					Hanya File CSV (.csv) yang diperbolehkan
					</div>";
			}
		}
		?>
	</div>
</body>

</html>