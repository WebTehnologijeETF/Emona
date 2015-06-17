var brojac = 1;
var ukupno = 6;
/*function functionCover(x){
	var Image = document.getElementById('cover');
	brojac = brojac + x;
	if(brojac > ukupno) brojac = 1;
	if(brojac < 1) brojac = ukupno;
	Image.src = "cover" + brojac + ".jpg";
	
}
window.setInterval(function functionCoverA(){
	var Image = document.getElementById('cover');
	brojac = brojac + 1;
	if(brojac > ukupno) brojac = 1;
	if(brojac < 1) brojac = ukupno;
	Image.src = "cover" + brojac + ".jpg";
	
},3000);*/

function kliknuto(godina, link) {
	var id = "emona"+godina
	if (document.getElementById(id).style.display === 'none') {
		document.getElementById(id).style.display = 'block'
		link.innerHTML = link.innerHTML
	}
	else{
		document.getElementById(id).style.display = 'none'
		link.innerHTML =  link.innerHTML
	}
	
	return false
}

function checkName(name){
	var reg = /[A-Z]\D{2,}\s[A-Z]\D{2,}/;
	return reg.test(name);
}
function validateName(){
	var spans = document.getElementsByTagName("span");
	var name = document.contact.name;
	if(name.value === ""){
		spans[0].setAttribute("style", "visibility:visible");
		name.style.backgroundColor = "#F80000";
		return false;
	}
	else if(!checkName(name.value)){
		spans[0].setAttribute("style", "visibility:hidden");
		spans[1].setAttribute("style", "visibility:visible");
		name.style.backgroundColor = "#F80000";
		return false;
	}
	else{
		spans[1].setAttribute("style", "visibility:hidden");
		name.style.backgroundColor = "white";
		return true;
	}
		
}

function validateEmail(){
	var spans = document.getElementsByTagName("span");
	var email = document.contact.email;
	if(email.value === ""){
		spans[2].setAttribute("style", "visibility:visible");
		email.style.backgroundColor = "#F80000";
		return false;
	}
	else{
		spans[2].setAttribute("style", "visibility:hidden");
		email.style.backgroundColor = "white";
		return true;
	}
}
function validateService(){
	
	var naslov = document.getElementById("title");
	var textbox = document.getElementById("textbox");
	
	if(contact.usluga.selectedIndex == 1){
		naslov.value = "Upit o vještačenju";
		naslov.disabled = false;
		textbox.disabled = false;
		return true;
		
	}
	else if(contact.usluga.selectedIndex == 2){
		naslov.value = "Upit o procjeni";
		naslov.disabled = false;
		textbox.disabled = false;
		return true;
		
	}
	else if(contact.usluga.selectedIndex == 3  ){
		naslov.value = "Upit o naplati štete";
		naslov.disabled = false;
		textbox.disabled = false;
		return true;
		
	}
	else if(contact.usluga.selectedIndex == 4){
		naslov.value = "Upit o";
		naslov.disabled = false;
		textbox.disabled = false;
		return true;
		
	}
	else if(contact.usluga.selectedIndex == 0){
		naslov.value = "Odaberite uslugu";
		naslov.disabled = true;
		textbox.disabled = true;
		posalji.disabled = true;
		return false;
		
	}
	else {
		naslov.value = "Odaberite uslugu";
		naslov.disabled = true;
		textbox.disabled = true;	
		return false;
	}
	return false;
}

function validateTitle(){
	var naslov = document.getElementById("title");
	if(naslov.value == "" && contact.usluga.selected == null){
		naslov.value = "Odaberite uslugu"
		naslov.disabled = true;	
		textbox.disabled = true;
		return false;
	}
    else{
        return true;
    }

}
function validateTextArea(){
	var naslov = document.getElementById("title");
	if(naslov.value == "" && contact.usluga.selected == null){
		naslov.value = "Odaberite uslugu"
		naslov.disabled = true;	
		textbox.disabled = true;
		return false;
		
	}
    else{
        return true;
    }
}
function provjeriMjestoOpcina() {
                var ajax = new XMLHttpRequest();
                ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200) {
                        var odgovor = JSON.parse(ajax.responseText);
                        if (odgovor.hasOwnProperty('greska')) {
                            alert(odgovor.greska);
                        }
                    }
                    if (ajax.readyState == 4 && ajax.status == 404)
                          document.innerHTML = stranica.toString();
                }
                var Imegrada = document.getElementById("grad").value;
                var Imeopcine = document.getElementById("opcina").value;
                if (Imegrada.length === 0) { 
                     alert("Polje za unos mjesta je prazno!");
                     return false;
                }
                if (Imeopcine.length === 0) { 
                     alert("Polje za unos opcine je prazno!");
                     return false;
                }
                ajax.open("GET", "http://zamger.etf.unsa.ba/wt/mjesto_opcina.php?opcina=" + Imeopcine+"&mjesto=" + Imegrada, true);
                ajax.send();
                return false;
                

            }
function validateForm(){
      provjeriMjestoOpcina();
	if(!(validateName() && validateEmail() && validateTitle() && validateService())){
   
		alert("Niste ispravno unijeli tražene podatke");
	}   
	else{
		alert("Upit je uspješno poslan")
	}
   
}


