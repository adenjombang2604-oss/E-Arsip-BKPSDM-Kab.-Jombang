<?php 

	//uji jika tombol simpan diklik
	if(isset($_POST['bsimpan']))
	{

		//pengujian apakah data akan diedit / simpan baru
		if ($_GET['hal'] == "edit"){
			//perintah edit data
			//ubah data
			$ubah = mysqli_query($koneksi, "UPDATE tbl_divisi1 SET nama_divisi = '$_POST[tahun_arsip]' where id_divisi = '$_GET[id]' ");
			if($ubah)
			{
				echo "<script>
						alert('Ubah Data Sukses');
						document.location='?halaman=divisi';
					  </script>";
			}
		}
		else
		{
			//perintah simpan data baru
			//simpan data
			$simpan = mysqli_query($koneksi, "INSERT INTO tbl_divisi1
											  VALUES ('', '$_POST[tahun_arsip]') ");
			if($simpan)
			{
				echo "<script>
						alert('Simpan Data Sukses');
						document.location='?halaman=divisi';
					  </script>";
			}
		}


		
	}

	//Uji jika klik tombol edit / hapus
	if(isset($_GET['hal']))
	{

		if($_GET['hal'] == "edit")
		{
			//tampilkan data yang akan diedit
			$tampil = mysqli_query($koneksi, "SELECT * FROM tbl_divisi1 where id_divisi= '$_GET[id]'");
			$data = mysqli_fetch_array($tampil);
			if ($data)
			{
				//jika data ditemukan maka data ditampung ke dalam variabel
				$vnama_divisi = $data['nama_divisi'];
			}
		}else{
			$hapus = mysqli_query($koneksi, "DELETE FROM tbl_divisi1 WHERE id_divisi='$_GET[id]'");
			if($hapus){
				echo "<script>
						alert('Hapus Data Sukses');
						document.location='?halaman=divisi';
					  </script>";
			}
		}

		

	}

?>


<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Form Data Tahun Arsip
  </div>
  <div class="card-body">
	  	<form method="post" action="">
	  <div class="form-group">
	    <label for="tahun_arsip">Tambah Tahun Arsip</label>
	    <input type="text" class="form-control" id="tahun_arsip" name="tahun_arsip" value="<?=@$vnama_divisi?>">
	  </div>
	  <button type="submit" name="bsimpan"class="btn btn-primary">Simpan</button>
	  <button type="reset" name="bbatal"class="btn btn-danger">Batal</button>
	</form>
  </div>
</div>

<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Tahun Arsip (Divisi Kinerja)
  </div>
  <div class="card-body">
	<table class="table table-berderd table-hovered table-striped">
		<tr>
			<th>No</th>
			<th>Tahun Arsip</th>
			<th>Aksi</th>
		</tr>
		<?php
			$tampil = mysqli_query($koneksi, "SELECT * from tbl_divisi1 order by id_divisi desc");
			$no = 1; 
			while($data = mysqli_fetch_array($tampil)) :

		?>
		<tr>
			<td><?=$no++?></td>
			<td><?=$data['nama_divisi'] ?></td>
			<td>
				<a href= "?halaman=divisi&hal=edit&id=<?=$data['id_divisi']?>" class="btn btn-success">Edit </a>
				<a href= "?halaman=divisi&hal=hapus&id=<?=$data['id_divisi']?>" class="btn btn-danger" 
					onclick="return confirm('Apakah Yakin Ingin Menghapus Data Ini?')">Hapus </a>
			</td>
		</tr>
	<?php endwhile; ?>
	</table>
  </div>
</div>