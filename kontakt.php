
		<div class = "background">	
			<div class = "maincontent">
				<div class = "content">
					<article class = "topcontentKontakt">
						<header>
						<h1>Kontaktirajte nas</h1>
                        <p>Polja označena sa "*" su obavezna</p>
						
					</header>
					 <?php
            
            if(isset($_GET["slanje"])) {   
                session_start();                         
                echo "<div id = 'predSlanje'> <form action='mail.php' method='POST'> 
                <h3>Provjerite da li ste ispravno popunili kontakt formu </h3> 
                <br>";
                echo "<p><i>Ime i prezime: </i></p> 
                <p id='imeNovo'> ".$_GET['ime']."</p> 
                <br>
                <p><i>Mjesto: </i></p> <p> ".$_GET['mjesto']."</p> 
                <br>";
                echo "<p><i>Općina: </i></p> <p>".$_GET['opcina']."</p> <br> <p><i>E-Mail: </i></p> <p> ".$_GET['mail']."</p> <br>";
                echo "<p><i>Naslov: </i></p> <p> ".$_GET['naslov']."</p> <br> <p><i>Poruka: </i></p> <p>".$_GET['poruka']."</p> <br>";
                echo "<p>Da li ste sigurni da želite poslati ove podatke?</p> <input type='submit' value='Siguran sam' name='salji'> </div> "; 
                echo "<h3>Ako ste pogrešno popunili formu, možete ispod prepraviti unesene podatke </h3>";       
                $_SESSION["mailIme"] = $_GET["ime"];
                $_SESSION["mailMjesto"] = $_GET["mjesto"];
                $_SESSION["mailOpcina"] = $_GET["opcina"];
                $_SESSION["mailMail"] = $_GET["mail"];
                $_SESSION["mailNaslov"] = $_GET["naslov"];
                $_SESSION["mailPoruka"] = $_GET["poruka"];                                                                                    
            }
            
            if(isset($_REQUEST["salji"])) {
                echo "<h2>Zahvaljujemo se što ste nas kontaktirali !</h2>";
                $to = "dbricic1@etf.unsa.ba";
                $subject = $SESSION["mailNaslov"];
                $message = $SESSION["mailIme"]."\n".$SESSION["mailMjesto"]."\n".$SESSION["mailOpcina"]."\n \n \n".$SESSION["mailPoruka"];
                mail($to, $subject, $message); 
                session_destroy();
            }   
            
        ?>
					<form class = "form" name = "contact" action="mail.php" method="GET">
						<table>
							<tr>
								<td><label>Ime i prezime *:</label></td>
								<td><input class="podaci" value="<?php
		                                if (isset($_REQUEST['ime']))
                                        print $_REQUEST['ime'];
                                        ?>" id="ime" name="ime" onblur="provjeri(this)"></td>
                                
								
							</tr>
							
							<tr>
								<td><label>Email *: </label></td>
								 <td><input value="<?php
		                                if (isset($_REQUEST['mail']))
                                        print $_REQUEST['mail'];
                                        ?>" class="podaci" id="mail" name="mail" onblur="provjeri(this)"></td>
                                 
								</td>
							</tr>
						
						
							<tr>
								<td><label>Grad:</label></td>
								<td><input value="<?php
		                                if (isset($_REQUEST['mjesto']))
                                        print $_REQUEST['mjesto'];
                                        ?>" class="podaci" id="mjesto" name="mjesto"></td>
                                </tr>
							<tr>
								<td><label>Opcina:</label></td>
								<td><input value="<?php
		                                if (isset($_REQUEST['opcina']))
                                        print $_REQUEST['opcina'];
                                        ?>" class="podaci" id="opcina" name="opcina"></td>
                              </tr>
							<tr>
								<td><label>Usluga *: </label></td>
								<td><select onclick = validateService() id = "usluga">
									  <option value="usluga">Izaberi uslugu</option>
									  <option value="vjestacenje">vještačenje</option>
									  <option value="procjena">procjena</option>
									  <option value="osiguranje">naplata štete</option>
									 <option value="Ostalo">drugo</option>
									</select>
								<span id = "uslugaSpan" class = "error">Morate odabrati uslugu</span>
								</td>
							</tr>
							
							<tr>
								<td><label>Naslov: </label></td>
								 <td><input value="<?php
		                                if (isset($_REQUEST['naslov']))
                                        print $_REQUEST['naslov'];
                                        ?>" class="podaci" id="naslov" name="naslov"></td>
							</tr>
						
						
							<tr>
								<td><label>Detaljnije informacije:</label></td>
								<td> <textarea id="poruka" name="poruka"><?php
                                if (isset($_REQUEST['poruka']))
                                print $_REQUEST['poruka'];
                                ?></textarea></td>
							</tr>
						</table>
						
						<div>
							<input type = "submit" id ="posalji" value = "Pošalji upit" >
						</div>
						 
					 </form>
					</article>
					
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
			
			<aside class = "bottom-sidebar">
				<article>
					<p>Radi sati</p>
					<table>
						<tr>
							<td>ponedjeljak - petak</td>
							<td>08:00 - 16:00</td>
						</tr>
						
						<tr>
							<td>subota</td>
							<td>09:00 - 14:00</td>
						</tr>
						
						<tr>
							<td>nedjelja</td>
							<td>zatvoreno</td>
						</tr>
					</table>
					
				</article>
			</aside>
			<aside class = "middle-sidebar">
				<article>
					<p>Da li Vam ste zadovoljni našim uslugama?</p>
					<input type = "radio" name = "anketa" value = "Da"> DA
					<input type = "radio" name = "anketa" value = "Ne"> NE
					
					<button type = "submit" >Potvrdi</button>
				</article>
			</aside>
			
		<footer class = "mainfooter">
			<p>Copyright &copy; Dzenana Bricic 2015</p>
		 </footer>
		</div>	
