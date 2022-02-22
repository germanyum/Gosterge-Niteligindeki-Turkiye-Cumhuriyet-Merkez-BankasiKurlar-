<?php
function istek(){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://www.tcmb.gov.tr/kurlar/today.xml');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$sonuc = curl_exec($ch);
curl_close($ch);
file_put_contents('Data.xml', $sonuc);
}

function verial(){
$xml = @simplexml_load_file("Data.xml");
$jsondata=json_encode($xml);
$zaman=date("d.m.Y",strtotime("-1 days"));
try {
	if(file_exists('data.xml')==1){
		if($xml->attributes()->Tarih==$zaman)
		{
			return $jsondata;
		}
		else{
			 
			istek();
			return verial();
		}
	}
	else{
		istek();
		return verial();
	}
	
} catch (\Throwable $th) {
	 		echo ("0");
}

}

echo verial();

?>