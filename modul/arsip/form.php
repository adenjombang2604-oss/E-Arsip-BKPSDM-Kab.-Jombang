<?php 
	//panggil function.php untuk upload file
	include "config/function.php";

//Uji jika klik tombol edit / hapus
	if(isset($_GET['hal']))
	{
;
		if($_GET['hal'] == "edit")
		{
			//tampilkan data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT 
					  	tbl_arsip1.*,
					  	tbl_divisi1.nama_divisi,
					  	tbl_pihakbersangkutan1.nama_pihak, tbl_pihakbersangkutan1.nip_bersangkutan
					  FROM 
					  	tbl_arsip1, tbl_divisi1, tbl_pihakbersangkutan1
					  WHERE 
					  	tbl_arsip1.id_divisi = tbl_divisi1.id_divisi
					  	and tbl_arsip1.nip_pihak = tbl_pihakbersangkutan1.nip_pihak
					    and tbl_arsip1.id_arsip= '$_GET[id]'");


			$data = mysqli_fetch_array($tampil);
			if ($data)
			{
				//jika data ditemukan maka data ditampung ke dalam variabel
				$vno_sk = $data['no_sk'];
				$vtanggal_sk = $data['tanggal_sk'];
				$vrekomendasi = $data['rekomendasi'];
				$vberita = $data['berita'];
				$vid_divisi = $data['id_divisi'];
				$vnama_divisi = $data['nama_divisi'];
				$vnip_pihak = $data['nip_pihak'];
				$vnama_pihak = $data['nama_pihak'];
				$vfile = $data['file'];

			}
		}
		elseif($_GET['hal'] == 'hapus')
		{
			$hapus = mysqli_query($koneksi, "DELETE FROM tbl_arsip1 WHERE id_arsip='$_GET[id]'");
			if($hapus){
				echo "<script>
						alert('Hapus Data Sukses');
						document.location='?halaman=arsip';
					  </script>";
			}
		}

		


	}

	//Uji jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{

		//pengujian apakah data akan diedit / simpan baru
		if (@$_GET['hal'] == "edit"){
			//perintah edit data
			//ubah data

			//cek apakah user pilih file/gambar atau tidak
			if($_FILES['file']['error'] === 4) {
				$file = $vfile; 
			}else{
				$file = upload();
			}

			$ubah = mysqli_query($koneksi, "UPDATE tbl_arsip1 SET
											no_sk			= '$_POST[no_sk]',
											tanggal_sk		= '$_POST[tanggal_sk]',
											rekomendasi		= '$_POST[rekomendasi]',
											berita 			= '$_POST[berita]',
											id_divisi		= '$_POST[id_divisi]',
											nip_pihak		= '$_POST[nip_pihak]',
											file 			= '$file'
											where id_arsip = '$_GET[id]' ");
			if($ubah)
			{
				echo "<script>
						alert('Ubah Data Sukses');
						document.location='?halaman=arsip';
					  </script>";
			}
			else
			{
				echo "<script>
						alert('Ubah Data GAGAL!!');
						document.location='?halaman=arsip';
					  </script>";
			}
		}
		else
		{
			//perintah simpan data baru
			//simpan data
			$file = upload();
			$simpan = mysqli_query($koneksi, "INSERT INTO tbl_arsip1 
											  (no_sk, tanggal_sk, rekomendasi, berita, id_divisi, nip_pihak, file) 
											  VALUES ( 
														'$_POST[no_sk]', 
														'$_POST[tanggal_sk]', 
														'$_POST[rekomendasi]', 
														'$_POST[berita]', 
														'$_POST[id_divisi]',
														'$_POST[nip_pihak]',
														'$file'
													) ") or die(mysqli_error($koneksi));
			if($simpan)
			{
				echo "<script>
						alert('Simpan Data Sukses');
						document.location='?halaman=arsip';
					  </script>";
			}else
			{
				echo "<script>
						alert('Simpan Data Gagal!!');
						document.location='?halaman=arsip';
					  </script>";
			}
		}


		
	}

	

?>


<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Form Data Arsip Rekap
  </div>
  <div class="card-body">
	  	<form method="post" action="" enctype="multipart/form-data" >
	  <div class="form-group">
	    <label for="no_sk">No SK</label>
	    <input type="text" class="form-control" id="no_sk" name="no_sk" value="<?=@$vno_sk?>">
	  </div>
	  <div class="form-group">
	    <label for="tanggal_sk">Tanggal SK</label>
	    <input type="date" class="form-control" id="tanggal_sk" name="tanggal_sk" value="<?=@$vtanggal_sk?>">
	  </div>
	  <div class="form-group">
	    <label for="rekomendasi">Rekomendasi</label>
	    <input type="text" class="form-control" id="rekomendasi" name="rekomendasi" value="<?=@$vrekomendasi?>">
	  </div>
	  <div class="form-group">
	    <label for="berita">Berita</label>
	    <input type="text" class="form-control" id="berita" name="berita" value="<?=@$vberita?>">
	  </div>
	  <div class="form-group">
	    <label for="id_divisi">Tahun</label>
	    <select class="form-control" name="id_divisi">
	    	<option value="<?=@$vid_divisi?>"><?=@$vnama_divisi?></option>
	    	<?php
	    		$tampil = mysqli_query($koneksi, "SELECT * from tbl_divisi1 order by nama_divisi asc");
	    		while($data = mysqli_fetch_array($tampil)){
	    			echo "<option value = '$data[id_divisi]'> $data[nama_divisi] </option> ";
	    		}

	    	?>
	    </select>
	  </div>
	  <div class="form-group">
	    <label for="nip_pihak">Pihak Bersangkutan</label>
	    <select class="form-control" name="nip_pihak">
	    	<option value="<?=@$vnip_pihak?>"><?=@$vnama_pihak?></option>
	    	<?php
	    		$tampil = mysqli_query($koneksi, "SELECT * from tbl_pihakbersangkutan1 order by nama_pihak asc");
	    		while($data = mysqli_fetch_array($tampil)){
	    			echo "<option value = '$data[nip_pihak]'> $data[nama_pihak] </option> ";
	    		}

	    	?>
	    </select>
	  </div>

	  <div class="form-group">
	    <label for="file">Pilih File</label>
	    <input type="file" class="form-control" id="file" name="file" value="<?=@$vfile?>">
	  </div>

	  <button type="submit" name="bsimpan"class="btn btn-primary">Simpan</button>
	  <button type="reset" name="bbatal"class="btn btn-danger">Batal</button>
	</form>
  </div>
</div>