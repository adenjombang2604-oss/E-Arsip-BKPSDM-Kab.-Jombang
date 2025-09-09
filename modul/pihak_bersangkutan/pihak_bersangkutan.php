<?php 

	//Uji jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{

		//pengujian apakah data akan diedit / simpan baru
		if (@$_GET['hal'] == "edit"){
			//perintah edit data
			//ubah data
			$ubah = mysqli_query($koneksi, "UPDATE tbl_pihakbersangkutan1 SET
											nama_pihak				= '$_POST[nama_pihak]',
											nip_bersangkutan		= '$_POST[nip_bersangkutan]',
											pangkat_golongan_ruang	= '$_POST[pangkat_golongan_ruang]',
											jabatan 				= '$_POST[jabatan]',
											unit_kerja				= '$_POST[unit_kerja]'
											where nip_pihak = '$_GET[id]' ");
			if($ubah)
			{
				echo "<script>
						alert('Ubah Data Sukses');
						document.location='?halaman=pihak_bersangkutan';
					  </script>";
			}
			else
			{
				echo "<script>
						alert('Ubah Data GAGAL!!');
						document.location='?halaman=pihak_bersangkutan';
					  </script>";
			}
		}
		else
		{
			//perintah simpan data baru
			//simpan data
			$simpan = mysqli_query($koneksi, "INSERT INTO tbl_pihakbersangkutan1 
											  (nama_pihak, nip_bersangkutan, pangkat_golongan_ruang, jabatan, unit_kerja) 
											  VALUES ( 
														'$_POST[nama_pihak]', 
														'$_POST[nip_bersangkutan]', 
														'$_POST[pangkat_golongan_ruang]', 
														'$_POST[jabatan]', 
														'$_POST[unit_kerja]'
													) ") or die(mysqli_error($koneksi));
			if($simpan)
			{
				echo "<script>
						alert('Simpan Data Sukses');
						document.location='?halaman=pihak_bersangkutan';
					  </script>";
			}else
			{
				echo "<script>
						alert('Simpan Data Gagal!!');
						document.location='?halaman=pihak_bersangkutan';
					  </script>";
			}
		}


		
	}

	//Uji jika klik tombol edit / hapus
	if(isset($_GET['hal']))
	{
;
		if($_GET['hal'] == "edit")
		{
			//tampilkan data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM tbl_pihakbersangkutan1 where nip_pihak= '$_GET[id]'");
			$data = mysqli_fetch_array($tampil);
			if ($data)
			{
				//jika data ditemukan maka data ditampung ke dalam variabel
				$vnama_pihak = $data['nama_pihak'];
				$vnip_bersangkutan = $data['nip_bersangkutan'];
				$vpangkat_golongan_ruang = $data['pangkat_golongan_ruang'];
				$vjabatan = $data['jabatan'];
				$vunit_kerja = $data['unit_kerja'];

			}
		}else{
			$hapus = mysqli_query($koneksi, "DELETE FROM tbl_pihakbersangkutan1 WHERE nip_pihak='$_GET[id]'");
			if($hapus){
				echo "<script>
						alert('Hapus Data Sukses');
						document.location='?halaman=pihak_bersangkutan';
					  </script>";
			}
		}

		


	}

?>


<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Form Data Pihak Yang Bersangkutan
  </div>
  <div class="card-body">
	  	<form method="post" action="">
	  <div class="form-group">
	    <label for="nama_pihak">Nama Pihak</label>
	    <input type="text" class="form-control" id="nama_pihak" name="nama_pihak" value="<?=@$vnama_pihak?>">
	  </div>
	  <div class="form-group">
	    <label for="nip_bersangkutan">NIP Bersangkutan</label>
	    <input type="text" class="form-control" id="nip_bersangkutan" name="nip_bersangkutan" value="<?=@$vnip_bersangkutan?>">
	  </div>
	  <div class="form-group">
	    <label for="pangkat_golongan_ruang">Pangkat Golongan Ruang</label>
	    <input type="text" class="form-control" id="pangkat_golongan_ruang" name="pangkat_golongan_ruang" value="<?=@$vpangkat_golongan_ruang?>">
	  </div>
	  <div class="form-group">
	    <label for="jabatan">Jabatan</label>
	    <input type="text" class="form-control" id="jabatan" name="jabatan" value="<?=@$vjabatan?>">
	  </div>
	  <div class="form-group">
	    <label for="unit_kerja">Unit Kerja</label>
	    <input type="text" class="form-control" id="unit_kerja" name="unit_kerja" value="<?=@$vunit_kerja?>">
	  </div>

	  <button type="submit" name="bsimpan"class="btn btn-primary">Simpan</button>
	  <button type="reset" name="bbatal"class="btn btn-danger">Batal</button>
	</form>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Data Rinci Pihak Bersangkutan
  </div>
  <div class="card-body">
	<table class="table table-berderd table-hovered table-striped">
		<tr>
			<th>No</th>
			<th>Nama Pihak</th>
			<th>NIP Bersangkutan</th>
			<th>Pangkat Golongan Ruang </th>
			<th>Jabatan</th>
			<th>Unit Kerja</th>
			<th>Aksi</th>
		</tr>
		<?php
			$tampil = mysqli_query($koneksi, "SELECT * from tbl_pihakbersangkutan1 order by nip_pihak desc");
			$no = 1; 
			while($data = mysqli_fetch_array($tampil)) :

		?>
		<tr>
			<td><?=$no++?></td>
			<td><?=$data['nama_pihak'] ?></td>
			<td><?=$data['nip_bersangkutan'] ?></td>
			<td><?=$data['pangkat_golongan_ruang'] ?></td>
			<td><?=$data['jabatan'] ?></td>
			<td><?=$data['unit_kerja'] ?></td>
			<td>
				<a href= "?halaman=pihak_bersangkutan&hal=edit&id=<?=$data['nip_pihak']?>" class="btn btn-success">Edit </a>
				<a href= "?halaman=pihak_bersangkutan&hal=hapus&id=<?=$data['nip_pihak']?>" class="btn btn-danger" 
					onclick="return confirm('Apakah Yakin Ingin Menghapus Data Ini?')">Hapus </a>
			</td>
		</tr>
	<?php endwhile; ?>
	</table>
  </div>
</div>