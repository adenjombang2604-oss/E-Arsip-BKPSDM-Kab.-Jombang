<div class="card mt-3">
  <div class="card-header bg-info text-white">
    Data Rekap Arsip Perceraian
  </div>
  <div class="card-body">
  	<a href="?halaman=arsip&hal=tambahdata" class="btn btn-info mb-3">Tambah Data</a>
	<table class="table table-berderd table-hovered table-striped">
		<tr>
			<th>No</th>
			<th>No SK</th>
			<th>Tanggal SK</th>
			<th>Rekomendasi</th>
			<th>Berita</th>
			<th>Tahun</th>
			<th>Pihak Bersangkutan</th>
			<th>File</th>
			<th>Aksi</th>
		</tr>
		<?php
			$tampil = mysqli_query($koneksi, "
					  SELECT 
					  	tbl_arsip1.*,
					  	tbl_divisi1.nama_divisi,
					  	tbl_pihakbersangkutan1.nama_pihak, tbl_pihakbersangkutan1.nip_bersangkutan
					  FROM 
					  	tbl_arsip1, tbl_divisi1, tbl_pihakbersangkutan1
					  WHERE 
					  	tbl_arsip1.id_divisi = tbl_divisi1.id_divisi
					  	and tbl_arsip1.nip_pihak = tbl_pihakbersangkutan1.nip_pihak
					  ");
			$no = 1; 
			while($data = mysqli_fetch_array($tampil)) :

		?>
		<tr>
			<td><?=$no++?></td>
			<td><?=$data['no_sk'] ?></td>
			<td><?=$data['tanggal_sk'] ?></td>
			<td><?=$data['rekomendasi'] ?></td>
			<td><?=$data['berita'] ?></td>
			<td><?=$data['nama_divisi'] ?></td>
			<td><?=$data['nama_pihak'] ?> / <?=$data['nip_bersangkutan'] ?></td>
			<td>
				<?php
					//uji apakah file ada atau tidak
					if(empty($data['file'])){
					echo " - ";
					}else{
				?>
					<a href="file/<?=$data['file']?>" target="_blank"> lihat file </a>
				<?php
					}
				?>
			</td>
			<td>
				<a href= "?halaman=arsip&hal=edit&id=<?=$data['id_arsip']?>" class="btn btn-success">Edit </a>
				<a href= "?halaman=arsip&hal=hapus&id=<?=$data['id_arsip']?>" class="btn btn-danger" 
					onclick="return confirm('Apakah Yakin Ingin Menghapus Data Ini?')">Hapus </a>
			</td>
		</tr>
	<?php endwhile; ?>
	</table>
  </div>
</div>