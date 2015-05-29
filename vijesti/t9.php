
<script type="text/javascript">

function fja(broj) {

	var ajax = new XMLHttpRequest();

	ajax.onreadystatechange = function() {// Anonimna funkcija
        
	if (ajax.readyState == 4 && ajax.status == 200)
            document.getElementById("polje").innerHTML = ajax.responseText;
        
	if (ajax.readyState == 4 && ajax.status == 404)
            document.getElementById("polje").innerHTML = "Greska: nepoznat URL";
    }

	ajax.open("GET", "komentari.php?vijest=" + broj, true);
	ajax.send();
}

</script>


<?php
	session_start();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Tutorijal 9</title>
  </head>
  <body>
    <h1>Vijesti</h1>
    <?php
	if(isset($_POST['logout'])) {
		session_unset();
		header('Location: t9.php');
	}
	if(isset($_POST['Login'])){
	$user = htmlEntities($_POST['user'], ENT_QUOTES);
	$pass = htmlEntities($_POST['pass'], ENT_QUOTES);
	$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8","wt8user", "wt8pass");
	$veza->exec("set names utf8");
	$upit = $veza->prepare("SELECT * FROM korisnici WHERE username=? and password=?");
	$rez = $upit->execute(array($user,$pass));
	$rez2 = $upit->fetch(PDO::FETCH_ASSOC);
	if($rez2['username'] ===  $_POST['user']){
		$_SESSION['korisnik'] = $_POST['user'];	
		}
	}
     if(isset($_SESSION['korisnik'])) {
	     if(isset($_POST['noviKomentar'])) {
		$vijest = htmlEntities($_POST['skrivenaVijest'], ENT_QUOTES);
		$tekst = htmlEntities($_POST['tekstKomentara'], ENT_QUOTES);
		$autor = htmlEntities($_SESSION['korisnik'], ENT_QUOTES);
		$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8","wt8user", "wt8pass");
		$veza->exec("set names utf8");
		$upit = $veza->prepare("INSERT INTO komentar SET vijest=?, tekst=?, autor=?");
		$rez = $upit->execute(array($vijest,$tekst,$autor));
	
	     }
	     if(!isset($_GET['vijest']))
	     {
		     print "<form action=\"t9.php\" method=\"POST\">";
		     print "Dobrodosao,".$_SESSION['korisnik'].". ";
		     print "<input type=\"submit\" name=\"logout\" value=\"Logout\"><p>";
		     print "</form>";
		     $veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8","wt8user", "wt8pass");
		     $veza->exec("set names utf8");
		     $upit = $veza->query("select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijeme2, autor from vijest order by vrijeme desc");
		     while ($vijest = $upit->fetch(PDO::FETCH_ASSOC)) {
			  $vijestID = $vijest['id'];
			  $upit2 = $veza->query("select COUNT(*) broj from komentar where vijest=".$vijestID);
			  $komentar = $upit2->fetch(PDO::FETCH_ASSOC);
			  print "<h1>".$vijest['naslov']."</h1>";
			  print "<small>Autor:".$vijest['autor']."</small><br>";
			  print "<p>".$vijest['tekst']."</p>";	
			  if($komentar['broj'] > 0) {
				print "<p><a href=\"\" onClick=\"fja(".$vijest['id']."); return false;\">".$komentar['broj']." komentara.</a></p>";
				print "<div id=polje>";
				print "</div>";
				print "<br>";
			  }
			  else {
				print "<p>Nema komentara.</p>";
			  }
			  print "<form action=t9.php method=POST>";
			  print "Komentar:";
			  print "<input type=\"text\" name=\"tekstKomentara\">";
			  print "<input type=\"hidden\" name=\"autor\" value='".$_SESSION['korisnik']."'>";
			  print "<p><input type=\"submit\" value=\"Postavi komentar\" name=\"noviKomentar\">";
			  print "<input type=\"hidden\" value=".$vijest['id']." name=\"skrivenaVijest\">";
			  print "</form>";
			  print "<small>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</small>";
		     }
		}
		else {
		$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8","root");
		$veza->exec("set names utf8");
		$upit = $veza->query("select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijeme2, autor from vijest where id=".$_GET['vijest']);
		$vijest = $upit->fetch(PDO::FETCH_ASSOC);
		print "<h1>".$vijest['naslov']."</h1>";
		print "<small>".$vijest['autor']."</small><br>";
		print "<p>".$vijest['tekst']."</p>";
			//komentari
			  $upit2 = $veza->query("select id, tekst, autor from komentar where vijest=".$_GET['vijest']);
			  while($komentar = $upit2->fetch(PDO::FETCH_ASSOC)) {
				print "<p>ID: ".$komentar['id']."</p>";
			  	print "<small>Autor: ".$komentar['autor']."</small><br>";
			  	print "<p> Komentar: ".$komentar['tekst']."</p>";
			 }
		}
	}
	else {
	print "<form action=t9.php method=POST>";
	print "Username:";
	print "<input type=\"text\" name=\"user\">";
	print "<p>Password:";
	print "<input type=\"password\" name=\"pass\">";
	print "<p><input type=\"submit\" value=\"Login\" name=\"Login\">";
	print "</form>";
		if(isset($_POST['noviKomentar'])) {
		$vijest = htmlEntities($_POST['skrivenaVijest'], ENT_QUOTES);
		$tekst = htmlEntities($_POST['tekstKomentara'], ENT_QUOTES);
		$autor = htmlEntities("Anonimac", ENT_QUOTES);
		$veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8","wt8user", "wt8pass");
		$veza->exec("set names utf8");
		$upit = $veza->prepare("INSERT INTO komentar SET vijest=?, tekst=?, autor=?");
		$rez = $upit->execute(array($vijest,$tekst,$autor));
	
	     }
		if(!isset($_GET['vijest']))
	     {
		     $veza = new PDO("mysql:dbname=wt8;host=localhost;charset=utf8","wt8user", "wt8pass");
		     $veza->exec("set names utf8");
		     $upit = $veza->query("select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijeme2, autor from vijest order by vrijeme desc");
		     while ($vijest = $upit->fetch(PDO::FETCH_ASSOC)) {
			  $vijestID = $vijest['id'];
			  $upit2 = $veza->query("select COUNT(*) broj from komentar where vijest=".$vijestID);
			  $komentar = $upit2->fetch(PDO::FETCH_ASSOC);
			  print "<h1>".$vijest['naslov']."</h1>";
			  print "<small>Autor:".$vijest['autor']."</small><br>";
			  print "<p>".$vijest['tekst']."</p>";	

			  if($komentar['broj'] > 0) {
				print "<p><a onClick=fja(".$vijest['id'].") komentara.</a></p>";
			  }

			  else {
				print "<p>Nema komentara.</p>";
			  }
			  print "<form action=t9.php method=POST>";
			  print "Komentar:";
			  print "<input type=\"text\" name=\"tekstKomentara\">";
			  print "<input type=\"hidden\" name=\"autor\" value=\"Anonimac\">";
			  print "<p><input type=\"submit\" value=\"Postavi komentar\" name=\"noviKomentar\">";
			  print "<input type=\"hidden\" value=".$vijest['id']." name=\"skrivenaVijest\">";
			  print "</form>";
			  print "<small>".date("d.m.Y. (h:i)", $vijest['vrijeme2'])."</small>";
		     }
		}
	}
    ?>
  </body>
</html>
