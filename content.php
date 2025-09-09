<?php

	@$halaman = $_GET['halaman'];

	if($halaman == "divisi")
	{
		//tampilkan halaman divisi
		//echo "Tampil Halaman Modul Divisi";
		include "modul/divisi/divisi.php";

	}
	elseif ($halaman == "pihak_bersangkutan"){
		//tammpilkan halaman pihak bersangkutan
		include "modul/pihak_bersangkutan/pihak_bersangkutan.php";
	}
	elseif($halaman == "arsip")
	{
		//tampilkan halaman arsip
		if(@$_GET['hal'] == "tambahdata" || @$_GET['hal'] == "edit" || @$_GET['hal'] == "hapus"){
			include "modul/arsip/form.php";
		}else{
			include "modul/arsip/data.php";
		}
	}
	else
	{
		//echo "Tampil Halaman Home";
		include "modul/home.php";
	}

?>