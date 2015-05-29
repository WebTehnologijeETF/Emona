     <div id="sredina">
		    <div class = "background">	
			    <div class = "maincontent">
				<div class = "content">
					<article class = "topcontentKontakt">
						<header>
						<h1>Kontaktirajte nas</h1>
                        <p>Polja označena sa "*" su obavezna</p>
						
					</header>
					
					<form class = "form" name = "contact">
						<table>
							<tr>
								<td><label>Ime i prezime *:</label></td>
								<td><input type = "text" id = "name" placeholder = "Ime i prezime.." onblur="validateName()"/>
								<span id = "nameSpan1" class = "error">Unesite ime i prezime</span>
								<span id = "nameSpan2" class = "error">Format nije tačan(npr.: Dženana Bričić)</span>
								</td>
								
							</tr>
							
							<tr>
								<td><label>Email *: </label></td>
								<td><input type="email" name="email" onblur="validateEmail()"/>
								<span id = "emailSpan" class = "error">Email je obavezan</span>
								
								</td>
							</tr>
						
						
							<tr>
								<td><label>Grad:</label></td>
								<td><input type = "text" id = "grad" placeholder = "Naziv grada.."> </td>
							</tr>
							<tr>
								<td><label>Opcina:</label></td>
								<td><input type = "text" id = "opcina" placeholder = "Naziv opcine.."> </td>
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
								<td><input onfocus = validateTitle() id = "title" type = "text" name = "title" placeholder = "Naslov.."></td>
							</tr>
						
						
							<tr>
								<td><label>Detaljnije informacije:</label></td>
								<td><textarea onfocus = validateTextArea() id = "textbox" rows = "8" cols = "50" placeholder = "Detaljne informacije.."> </textarea></td>
							</tr>
						</table>
						
						<div>
							<input type = "submit" id ="posalji" value = "Pošalji upit" onclick="validateForm()">
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
</div>