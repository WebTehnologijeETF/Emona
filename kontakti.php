<?php
    session_start();
                         if(isset($_REQUEST['posalji'])){
                         
                          $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                          $veza->exec("set names utf8");
                       
                          $korisnickoIme = $_POST['korisnickoIme'];
                          $sifra = $_POST['sifra'];
                          $email = $_POST['email'];
                          $sifra = md5($sifra);
                         
                          $komentar = $veza->prepare("INSERT INTO korisnik (korisnickoIme, sifra, email) values (:korisnickoIme, :sifra, :email)");
                          $komentar -> bindParam(':korisnickoIme', $korisnickoIme);
                          $komentar -> bindParam(':sifra', $sifra);
                          $komentar -> bindParam(':email', $email);
                          $komentar->execute(); 
                          $veza = NULL;
                          
                         }
                       
    if(isset($_REQUEST['obrisi']) && isset($_SESSION['korisnickoIme'])){
                        $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                        $veza->exec("set names utf8");
                        $rez = $veza->query("delete from korisnik where id=".$_REQUEST['obrisi']);                            
                         if (!$rez) {
                                 $greska = $veza->errorInfo();
                                 print "SQL greška: ". $greska[2];
                                 exit();
   }   

   }
    
?>
<!doctype html>
<html>
	<head>
		
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	    <link rel="stylesheet" type="text/css" href="emona1.css">
		<script src="emona.js"></script>
        <script src="ucitaj.js"></script>
		<title>Agencija "Emona"</title>
	</head>
	<body class = "body">
	


	
		<div class = "logo">
					<a href="index.php"><img src="emona.jpg" alt = "Logo"></a>	
					<p>Agencija za vještačenje, procjenu pokretne imovine i pomćne poslove u osiguranju</p>
		</div>
		
			
			<header class = "mainHeader">
				<nav>
					<ul>
						<li><a class = "active" href = "index.php">Naslovnica</a></li>
						<li><a href = "#" onclick = "return kliknuto (2,this)">Usluge</a>
							<ul id="emona2">
								<li><a href = "#" onclick ="ucitaj('usluge')">Općenito</a></li>
								<li><a href = "#" onclick ="ucitaj('vjestacenje')">Vještačenje</a></li>
								<li><a href = "#" onclick ="ucitaj('procjena')">Procjena štete</a></li>
								<li><a href = "#" onclick ="ucitaj('naplata')">Naplata štete</a></li>
							</ul>
						</li>
						<li><a href = "#" onclick ="ucitaj('onama')">O nama</a></li>
						<li><a href = "#" onclick ="ucitaj('rjecnik')">Rječnik pojmova</a></li>
						<li><a href = "#" onclick ="ucitaj('kontakt')">Kontakt</a></li>
					</ul>
					
				</nav>
			</header>
			
            <div id="sredina">
			<div class = "background">
			<div class = "maincontent">
			<div class = "content">
					<?php
         
                        $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                         $veza->exec("set names utf8");
                         $komentar = $veza->query("select * from korisnik");
                         
                         if (!$komentar) {
                              $greska = $veza->errorInfo();
                              print "SQL greška: " . $greska[2];
                              exit();
                         }
                         
                       
                         print "<div class='komentari'>";
                         print "<h1>Unesite podatke o korisniku:</h1>";
                         print "<form method = 'post' action = 'kontakti.php' class = 'formKomentari'>";
                         print "<table>";
                         print "<tr>";
                         print "<td><label>Korisničko ime:</label></td>";
                         print "<td><input type = 'text' id ='korisnickoIme'name ='korisnickoIme' ></input></td>";
                         print "</tr>";
                         print "<tr>";
                         print "<td><label>Šifra:</label></td>";
                         print "<td><input type = 'text' id ='sifra'name ='sifra' ></input></td>";
                         print "</tr>";
                         print "<tr>";
                         print "<td><label>Email: </label></td>";
                         print "<td><input type = 'email' id = 'email' name = 'email'></input></td>";
                         print "</tr>";
                         print "<tr>";
                         print "<td></td>";
                         print "<td><input type = 'submit' id = 'posalji' name = 'posalji' value = 'Spremi korisnika'></input></td>";
                         print "</tr>";
                         print "</table>";
                         print "</form>";
                         print "</div>";

                       

                         foreach ($komentar as $vrijednost) {

                              print "<div class='komentari'>";
                               print "<h2>Podaci o korisniku: </h2>";
                              print "<h4 class='naslov'>Korisničko ime: ".$vrijednost['korisnickoIme']."</h4>";
                              print "<h4 class='naslov'>Šifra: ".$vrijednost['sifra']."</h4>";
                              print "<h4 class='naslov'>Email: ".$vrijednost['email']."</h4>";
		                      print "<a href= kontakti.php?obrisi=".$vrijednost['id'].">Obriši korisnika</a>";
                              print "</div>";
                              }
                         
                          
                         $veza = NULL;
         
                    ?>
			</div>
			</div>
			
			<aside class = "bottom-sidebar">
				<article>
					<p>Kontakt informacije</p>
					<table>
						<tr>
							<td>Tel./fax:</td>
							<td>++ 35 706 528</td>
						</tr>
						
						<tr>
							<td>GSM:</td>
							<td>061 738 272</td>
						</tr>
						
						<tr>
							<td>75320</td>
							<td>Gračanica</td>
						</tr>
						<tr>
							<td></td>
							
						</tr>
						<tr>
							<td>Ul.</td>
							<td>22. Divizije 11A</td>
						</tr>
						<tr>
							<td></td>
							<td>Bosna i Hercegovina</td>
						</tr>
						<tr>
							<td></td>
							<td></td>
						</tr>
					</table>
				</article>
			</aside>
			
			<aside class = "top-sidebar">
				<article>
					<p>Nasi partneri:</p>
					<ul>
							<li><a href="http://c2.etf.unsa.ba/course/view.php?id=119">ETF</a></li>
					</ul>
				</article>
			</aside>
			
			<aside class = "middle-sidebar">
				<article>
					<p>Da li Vam ste zadovoljni našim uslugama?</p>
					
							<input type = "radio" name = "anketa" value = "Da"> DA
							<input type = "radio" name = "anketa" value = "Ne"> NE
					
					<button type = "submit">Potvrdi</button>
				</article>
			</aside>
			
			
			
           
			<footer id = "mainfooter">
			<p>Copyright &copy; Dzenana Bricic 2015  </p>
		</footer>
		</div>	
            </div>
	</body>
</html>

