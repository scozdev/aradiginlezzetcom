<?php 

try {

	$db=new PDO("mysql:host=localhost;dbname=yemek;charset=utf8",'root','asd123asd');
	//echo "veritabanı bağlantısı başarılı";
}

catch (PDOExpception $e) {

	echo $e->getMessage();
}


 ?>