 
 function usluge() {
    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var tabela = JSON.parse(ajax.responseText);
            napraviTabelu(tabela);
        }

        if (ajax.readyState == 4 && ajax.status == 404)
            alert(ajax.responseText);
    }

    ajax.open("GET", "http://zamger.etf.unsa.ba/wt/proizvodi.php?brindexa=16041", true);
    ajax.send();
}
function napraviTabelu(tabela) {
    var t =  "<table><tr> <th>id</th> <th>Naziv</th> <th>Opis</th>  <th>Cijena</th>";
    t += "<tr> <td><input id='id1'></td> <td><input id='naziv'</td> <td><input id='opis'></td> <td><input id='cijena'></td>";

    for (i = 0; i < tabela.length; i++)
        t += "<tr> <td>" + tabela[i].id + "</td><td>" + tabela[i].naziv + "</td> <td>" + tabela[i].opis + "</td> <td>" + tabela[i].cijena;
 
    t+='</table>';
    document.getElementById("usluge").innerHTML = t;

}
function akcija(tip) {
    var usluga = {
        id: document.getElementById('id1').value,
        naziv: document.getElementById('naziv').value,
        opis: document.getElementById('opis').value,
        cijena: parseFloat(document.getElementById('cijena').value)

    };


    var ajax = new XMLHttpRequest();
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            usluge();
        }

        if (ajax.readyState == 4 && ajax.status == 404 || ajax.readyState == 4 && ajax.status == 400)
            alert(ajax.responseText);
    }

    ajax.open("POST", "http://zamger.etf.unsa.ba/wt/proizvodi.php", true);
    ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    ajax.send("akcija="+tip+"&brindexa=16041&proizvod+"+JSON.stringify(usluga));
}
 
 
 
 function ucitaj(naziv){
                  var ajax = new XMLHttpRequest();
                  ajax.onreadystatechange = function () {
                    if (ajax.readyState == 4 && ajax.status == 200)
                        document.getElementById("sredina").innerHTML = ajax.responseText;
                    if (ajax.readyState == 4 && ajax.status == 404)
                        document.getElementById("sredina").innerHTML = naziv;
                }
                if(naziv === "onama"){
                    ajax.open("GET", "onama.html", true);
                    ajax.send();
                }
                if(naziv === "rjecnik"){
                    ajax.open("GET", "rjecnik.html", true);
                    ajax.send();
                }
                 if(naziv === "procjena"){
                    ajax.open("GET", "procjena.html", true);
                    ajax.send();
                }
                 if(naziv === "usluge"){
                    ajax.open("GET", "usluge.html", true);
                    ajax.send();
                }
                 if(naziv === "vjestacenje"){
                    ajax.open("GET", "vjestacenje.html", true);
                    ajax.send();
                }
                 if(naziv === "naplata"){
                    ajax.open("GET", "naplata.html", true);
                    ajax.send();
                }
                if(naziv === "kontakt"){
                    ajax.open("GET", "kontakt.html", true);
                    ajax.send();
                }
               
            }



