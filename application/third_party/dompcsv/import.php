<?php
// Load file koneksi.php
include "koneksi.php";

if(isset($_POST['import'])){ // Jika user mengklik tombol Import
	// Load librari PHPExcel nya
	require_once 'PHPExcel/PHPExcel.php';

	$inputFileType = 'CSV';
	$inputFileName = 'tmp/data.csv';

	$reader = PHPExcel_IOFactory::createReader($inputFileType);
	$excel = $reader->load($inputFileName);

	$numrow = 1;
	$worksheet = $excel->getActiveSheet();
	foreach ($worksheet->getRowIterator() as $row) {
		// Cek $numrow apakah lebih dari 1
		// Artinya karena baris pertama adalah nama-nama kolom
		// Jadi dilewat saja, tidak usah diimport
		if($numrow > 1){
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
			if($nama == "" && $email == "" && $whatsapp == "" && $id_keluhan == "" && $id_psikolog == "" && $tanggal_konsultasi == "" && $jam_konsultasi == "")
				continue; // Lewat data pada baris ini (masuk ke looping selanjutnya / baris selanjutnya)

			// Tambahkan value yang akan di insert ke variabel $query
			// Buat query Insert
			$query = "INSERT INTO client VALUES('".$nama."','".$email."','".$whatsapp."','".$id_keluhan."','".$id_psikolog."','".$tanggal_konsultasi."','".$jam_konsultasi."')";
			mysqli_query($connect, $query);
		}

		$numrow++; // Tambah 1 setiap kali looping
	}
}

header('location: index.php'); // Redirect ke halaman awal
?>
