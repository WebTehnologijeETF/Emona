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
                          <li><a href = "#">Prijavi se</a>
							<ul id="emona1">
                                <?php
                                echo "<li><form class = 'login' method = 'post' action = 'index.php'></li>";
								print "<li><input type='tekst' class ='korisnickoIme' name ='korisnickoIme' placeholder='Korisničko ime'></input></li>";
                                print "<li><input type='tekst' class ='sifra' name ='sifra' placeholder='Šifra'</input></li>";
                    
                                print "<li><input type='submit' class ='prijava' name ='prijava' value ='Prijavi se'></input></li>";
                    
                                print "<li><input type='submit' class ='odjava' name ='odjava' value ='Odjavi se'></input></li>";
                                print "<li><input type='submit' class ='promjenaSifra' name ='promjenaSifra' value ='Zaboravili ste sifru'></input></li>";
                                print "<li></form></li>";
                                
                                ?>

							</ul>
						</li>
					</ul>
					
				</nav>
			</header>
			
            <div id="sredina">
			<div class = "background">
			<div class = "maincontent">
			<div class = "content">
					<?php
                         if(isset($_REQUEST['posalji'])){
                         
                          $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                          $veza->exec("set names utf8");
                       
                          $poruka = $_POST['porukaKomentar'];
                          $ime = $_POST['ime'];
                          $email = $_POST['email'];
                          $vijest = $_REQUEST['vijest'];
                          $datum = date("Y-m-d h:i:sa");
                         
                          $komentar = $veza->prepare("INSERT INTO komentar (vijest, tekst, autor,vrijeme, email) values (:vijest, :tekst, :autor, :vrijeme, :email)");
                          $komentar -> bindParam(':vijest', $vijest);
                          $komentar -> bindParam(':tekst', $poruka);
                          $komentar -> bindParam(':autor', $ime);
                          $komentar -> bindParam(':vrijeme', $datum);
                          $komentar -> bindParam(':email', $email);
                          $komentar->execute(); 
                        
                         }
                       
                        $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                         $veza->exec("set names utf8");
                         $komentar = $veza->query("select * from komentar where vijest = ".$_REQUEST['vijest']." order by vrijeme desc");
                         
                         if (!$komentar) {
                              $greska = $veza->errorInfo();
                              print "SQL greška: " . $greska[2];
                              exit();
                         }

                       
                         print "<div class='komentari'>";
                         print "<h1>Unesite Vaš komentar</h1>";
                         print "<form method = 'post' action = 'komentari.php?vijest=".$_REQUEST['vijest']."'class = 'formKomentari'>";
                         print "<table>";
                         print "<tr>";
                         print "<td><label>Ime:</label></td>";
                         print "<td><input type = 'text' id ='ime'name ='ime' ></input></td>";
                         print "</tr>";
                         print "<tr>";
                         print "<td><label>Email: </label></td>";
                         print "<td><input type = 'email' id = 'email' name = 'email'></input></td>";
                         print "</tr>";
                         print "<tr>";
                         print "<td><label>Komentar:<label> </td>";
                         print "<td><textarea id='porukaKomentar' name='porukaKomentar'></textarea></td>";
                         print "</tr>";
                         print "<tr>";
                         print "<td></td>";
                         print "<td><input type = 'submit' id = 'posalji' name = 'posalji' value = 'Pošalji komentar'></input></td>";
                         print "</tr>";
                         print "</table>";
                         print "</form>";
                         print "</div>";

                       

                         foreach ($komentar as $vrijednost) {

                              print "<div class='komentari'>";
                              print "<h3 class='naslov'>Autor: ".$vrijednost['autor']."</h3>";
		                      print "<p>Komentar: ".$vrijednost['tekst']."</p>"; 
                              print "<br>"; 
                              
                              if($vrijednost['email'] != null){
                                   print "<a href = 'mailto:".$vrijednost['email']."'class='emailKomentar'>Email:  ".$vrijednost['email']."</a>";
                                   print "<br>";
                                   print "<small class='infoKomentar'>".$vrijednost['vrijeme']."</small>"; 
                                   
                                   
                              }else
                              print "<small class='infoKomentar1'>".$vrijednost['vrijeme']."</small>"; 
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

