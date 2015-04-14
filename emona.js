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
	else if(contact.usluga.selectedIndex == 3){
		naslov.value = "Upit o naplati štete";
		naslov.disabled = false;
		textbox.disabled = false;
		return true;
		
	}
	else if(contact.usluga.selectedIndex == 4){
		naslov.value = "";
		naslov.disabled = false;
		textbox.disabled = false;
		return true;
		
	}
		
	else {
		naslov.value = "Odaberite uslugu";
		naslov.disabled = true;
		textbox.disabled = true;	
		return false;
	}
}

function validateTitle(){
	var naslov = document.getElementById("title");
	if(naslov.value == "" && contact.usluga.selected == null){
		naslov.value = "Odaberite uslugu"
		naslov.disabled = true;	
		textbox.disabled = true;
		return false;
		
	}
	else if(contact.usluga.selected == 1){
		naslov.disabled = false;	
		textbox.disabled = false;
		return true;
	}
	else if(contact.usluga.selected == 2){
		naslov.disabled = false;	
		textbox.disabled = false;
		return true;
	}
	else if(contact.usluga.selected == 3){
		naslov.disabled = false;	
		textbox.disabled = false;
		return true;
	}
	else if(contact.usluga.selected == 4){
		naslov.disabled = false;	
		textbox.disabled = false;
		return true;
	}
	else {
		return true;
	}
}

function validateForm(){
	if(!(validateName() && validateEmail() && validateTitle() && validateService)){
		alert("Niste ispravno unijeli tražene podatke");
	}
	else{
		alert("Upit je uspješno poslan")
	}
}


