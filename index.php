<?php  session_start();
   if(isset($_REQUEST['prijava'])){
                         
                         $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                         $veza->exec("set names utf8");
                         $korisnickoIme = $_POST['korisnickoIme'];
                         $sifra = $_POST['sifra'];
                         $sifra = md5($sifra);
                         $komentar = $veza->prepare("select * from korisnik where korisnickoIme= :korisnickoIme and sifra = :sifra");
                         $komentar -> bindParam(':korisnickoIme', $korisnickoIme);
                         $komentar -> bindParam(':sifra', $sifra);
                         $komentar->execute(); 
                         if (!$komentar) {
                                $greska = $veza->errorInfo();
                                print "SQL greškoa: ". $greska[2];
                                exit();
                            }
                        $provjera = NULL;
                        foreach($komentar as $value) {
                            $provjera = $value;
                            break;
                        }
                        if($provjera == NULL) $_SESSION['nepostojeciKorisnik'] = "Nepostojeći korisnik!";
                        else{     
                                 
                            session_start();     
                                   
                            $_SESSION['korisnickoIme'] = $provjera['korisnickoIme'];
                            $_SESSION['email'] = $provjera['email'];
                            $_SESSION['id'] = $provjera['id'];
                           
                            
                        }    
                        }
if(isset($_POST['odjava'])) {
                        session_unset();
                        session_destroy();
                        session_unregister();
                    }
if(isset($_POST['promjenaSifra'])) {
                        $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                         $veza->exec("set names utf8");
                       
                         $korisnickoIme = $_POST['korisnickoIme'];   
                         $komentar = $veza->prepare("select * from korisnik where korisnickoIme= :korisnickoIme");
                         $komentar -> bindParam(':korisnickoIme', $korisnickoIme);
                          $komentar->execute(); 
                         if (!$komentar) {
                                $greska = $veza->errorInfo();
                                print "SQL greška: ". $greska[2];
                                exit();
                            }
                        $provjera = NULL;
                        foreach($komentar as $value) {
                            $provjera = $value;
                            break;
                        }
                        if($provjera == NULL) $_SESSION['promjenaSifre'] = "Nepostojeći korisnik!";
                        else{     
                                
                              $sifra = rand();
                              $mail = $provjera['email'];
                               $msg = $sifra;
                               $msg = wordwrap($msg,70);
                               mail($mail,"Promjena sifre",$msg);      
                      
                        }
                     
                    }
if(isset($_POST['dodaj']) && isset($_SESSION['korisnickoIme'])){
                            
                            $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                            $veza->exec("set names utf8");
                            $datum = date("Y-m-d h:i:sa");
                              $rezultat = $veza->prepare("INSERT INTO vijest (vrijeme, naslov, autor,tekst) values (:vrijeme, :naslov, :autor, :tekst)");
                          $rezultat -> bindParam(':vrijeme', $datum);
                          $rezultat -> bindParam(':naslov',$_POST['naslov']);
                          $rezultat -> bindParam(':autor', $_POST['autor']);
                          $rezultat -> bindParam(':tekst', $_POST['vijest']);
                          
                          $rezultat->execute(); 
                          if (!$rezultat) {
                            $greska = $veza->errorInfo();
                            print "SQL greška kod unosa novosti: ".$greska[2];
                            exit();
                            } 
                            $veza = NULL;
  }

if(isset($_REQUEST['obrisi']) && isset($_SESSION['korisnickoIme'])){
                        $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                        $veza->exec("set names utf8");
                        $rez = $veza->query("delete from vijest where id=".$_REQUEST['obrisi']);                            
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
                         <?php
                           
                             if(!isset($_SESSION['korisnickoIme'])){
                                print "<li><a href = '#'>Prijavi se</a>";
							    print "<ul id='emona1'>";
                                
                                echo "<li><form class = 'login' method = 'post' action = 'index.php'></li>";
								print "<li><input type='tekst' class ='korisnickoIme' name ='korisnickoIme' placeholder='Korisničko ime'></input></li>";
                                print "<li><input type='tekst' class ='sifra' name ='sifra' placeholder='Šifra'</input></li>";
                                print "<li><input type='submit' class ='prijava' name ='prijava' value ='Prijavi se'></input></li>";
                                print "<li><input type='submit' class ='promjenaSifra' name ='promjenaSifra' value ='Zaboravili ste sifru'></input></li>";
             
							print"</ul>";
						print"</li>";
                                  }
                       
                             else{
                                  echo "<li><form class = 'login' method = 'post' action = 'index.php'></li>";
                                  print"<li><input type='submit' class ='odjava' name ='odjava' value ='Odjavi se'></input></li>";
                            print "<li></form></li>";
                               
                           }
                           
                            
                      ?>
                       
					</ul>
					
				</nav>
			</header>
			
            <div id="sredina">
			<div class = "background">
			<div class = "maincontent">
			<div onload = "functionCoverA()" class = "backgroundpicture">
				<img alt ="cover" id = "cover" src="cover3.jpg"></img>
				<div class = "left_holder"><img alt ="lijevo" onClick = "functionCover(-1)"  src="lijevo.png"></img></div>
				<div class = "right_holder"><img alt ="desno" onClick = "functionCover(1)" src="desno.png"></img></div>
			</div>
			<div class = "content">
					<?php
                        session_start();
                         $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                         $veza->exec("set names utf8");
                         $rezultat = $veza->query("select id, naslov, tekst, UNIX_TIMESTAMP(vrijeme) vrijemeNeko, autor from vijest order by vrijeme desc");
                         if (!$rezultat) {
                              $greska = $veza->errorInfo();
                              print "SQL greška: " . $greska[2];
                              exit();
                         }
                         if(isset($_POST['izmijeni']) && isset($_SESSION['korisnickoIme'])){
                               
                               $veza = new PDO("mysql:dbname=emona;host=localhost;charset=utf8", "dzenana", "dzenana06");
                                $veza->exec("set names utf8");
                                $izmjena = $veza->query("select * from vijest where id=".$id);                            
                                if (!$izmjena) {
                                         $greska = $veza->errorInfo();
                                         print "SQL greška: ". $greska[2];
                                         exit();
                                }    
                              
                             
                                        
                         } 
                         if(isset($_SESSION['korisnickoIme'])) {

                         print "<div class='topcontent'>";
                         print "<h2>Prijavljeni ste kao: ".$_SESSION['korisnickoIme']."</h2>";
                         
                         print "<h>Ukoliko želite da dodate novi kontakt ili da obrišete stari, kliknite na link: <h2><a href=kontakti.php>Kontakti</a></h2></h>";
                         print "</div>";
                         print "<div class='topcontent'>";
                         print "<h3>Unesite novu vijest:</h3>";
                         print "<form method = 'post' action = 'index.php' class = 'formVijesti'>";
                         print "<table class ='tabela'>";
                         print "<tr>";
                         print "<td><lable class = 'labela'>Autor vijesti: </label></td>";
                         print "<td><input type = 'text' name = 'autor' ></input></td>";
                         print "</tr>";
                         print "<tr>";
                         print "<td><lable class = 'labela'>Naslov vijesti: </label></td>";
                         print "<td><input type = 'text' name = 'naslov' ></input></td>";
                         print "</tr>";
                         print "<tr>";
                         print "<td><lable class = 'labela'>Tekst vijesti: </label></td>";
                         print "<td><textarea name = 'vijest' id = 'porukaVijest' ></textarea></td>";
                         print "</tr>";
                         print "<tr>";
                         print "<td></td>";
                         print "<td><input type = 'submit' id = 'dodaj' name = 'dodaj' value = 'Dodaj novu vijest'></input></   td>";
                        
                         print "</tr>";
                         print "</table>";
                         print "</form>";
                         print "</div>";
                        
                         }
                                
                         
                         foreach ($rezultat as $vijest) {

                              
                              print "<div class='topcontent'>";
                              print "<h3 class='naslov'>".$vijest['naslov']."</h3>";
		                      print "<p>".$vijest['tekst']."</p>";     
      
                             $rezultat1 = $veza->query("select count(*) broj from komentar where vijest=".$vijest['id']);
                             $komentar = $rezultat1->fetch(PDO::FETCH_ASSOC);
                             $id = $vijest['id'];
		                     if ($komentar['broj'] > 0){
                                
                                 print "<a href=komentari.php?vijest=".$vijest['id'].">".$komentar['broj']." komentara </a>";
                                
                             } 
		                      else{
                                     
                                     print "<p>Nema komentara</p>";
			                         print "<a class='info' href=komentari.php?vijest=".$vijest['id'].">Dodaj komentar</a>";
                                    

                            }
                             if(isset($_SESSION['korisnickoIme'])) {
                                 print "<br>";
                                 print "<a class='info' href= index.php?obrisi=".$vijest['id'].">Obriši vijest</a>";
                                 print "<br>";
                                 print "<a class='info' href= index.php?izmijeni=".$vijest['id'].">Izmijeni vijest</a>";
                                 

                             }
                             print "<p class='post-info'>".$vijest['autor'].", ". date("d.m.Y. (h:i)", $vijest['vrijemeNeko'])."</p";
		                     print "<br>";  
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
							<li><a class ="logoetf" href="http://c2.etf.unsa.ba/course/view.php?id=119">ETF</a></li>
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

