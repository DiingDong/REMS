var order="";

loadListings();

//Realiza una funcion cuando se presiona el boton respectivo 
document.getElementById("se_submit").addEventListener("click", setSearch);

function loadListings(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){                 
        if (this.readyState == 4 && this.status == 200){    
            document.getElementById("listingsTable").innerHTML=this.responseText;  
        }
    };
    xhttp.open("GET", "php/loadListings.php?order="+order, true); 
    xhttp.send();
}

function setSearch(){
    order=document.getElementById("se_input").value;
    loadListings();
}