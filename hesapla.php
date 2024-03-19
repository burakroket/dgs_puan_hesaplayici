<?php
	//tüm errörleri gizleme
	ini_set('display_errors', 1);
	
	//formdan veri çekme
	@$sayisal_dogru = $_POST['html_sayisal_dogru'];
	@$sayisal_yanlis = $_POST['html_sayisal_yanlis'];
	@$sozel_dogru = $_POST['html_sozel_dogru'];
	@$sozel_yanlis = $_POST['html_sozel_yanlis'];
	@$onlisans_puani = $_POST['html_onlisans_puani'];
	@$alan = $_POST['html_alan'];
	@$dgs_tarih = $_POST['html_dgs_tarih'];
	
	//stringi integere dönüştürme
	settype($sayisal_dogru,"int");
	settype($sayisal_yanlis,"int");
	settype($sozel_dogru,"int");
	settype($sozel_yanlis,"int");
	settype($onlisans_puani,"int");


	//ek puan ekleme ve alan katsayıları fonksiyonu
	switch($alan) {
		case "html_alan_sayisal":
			$ek_puan = 250;
			$sayisal_katsayi = 3;
			$sozel_katsayi = 0.6;
			break;
		case "html_alan_sozel":
			$ek_puan = 120;
			$sayisal_katsayi = 0.6;
			$sozel_katsayi = 0.3;
			break;
		case "html_alan_esitagirlik":
			$ek_puan = 222;
			$sayisal_katsayi = 1.8;
			$sozel_katsayi = 1.8;
			break;
	}
	//2019 katsayı fonksiyonu
	if ($dgs_tarih == "html_dgs_oncesi") {          
		$obp = $onlisans_puani * 0.30;		
	}
	
	if ($dgs_tarih == "html_dgs_sonrasi") {          
		$obp = $onlisans_puani * 0.6;
	}  

	//4 yanlış 1 doğru eksiltir fonksiyonu
	$sayisal_net = ($sayisal_dogru - ($sayisal_yanlis / 4));
	$sozel_net = ($sozel_dogru - ($sozel_yanlis / 4));
	
	//hesaplama fonksiyonu
	@$dgs_puani = ($sayisal_net * $sayisal_katsayi) + ($sozel_net * $sozel_katsayi) + ($obp) + $ek_puan;
	
	//ekran çıktısı
	if($onlisans_puani == null)
	{
		exit ("ÖBP alanını boş bıraktığınızdan puanınız hesaplanamamıştır.<br>");
	}
	else
	{
		echo("Sayısal Testi Neti: $sayisal_net <br>");
		echo("Sözel Testi Neti: $sozel_net <br>");
	}
	
	if($alan =="html_alan_sayisal"){
		echo("Sayısal Puanınız: $dgs_puani");
	}
	elseif($alan =="html_alan_sozel"){
		echo("Sözel Puanınız: $dgs_puani");
	}
	elseif($alan =="html_alan_esitagirlik"){
		echo("Eşit Ağırlık Puanınız: $dgs_puani");
	}
?>