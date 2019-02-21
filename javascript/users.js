var order="";
        
loadUsers();

//Realiza una funcion cuando se presiona el boton respectivo 
document.getElementById("se_submit").addEventListener("click", setSearch);

function loadUsers(){
    var xhttp = new XMLHttpRequest();            
    xhttp.onreadystatechange = function(){                 
        if (this.readyState == 4 && this.status == 200){    
            document.getElementById("usersTable").innerHTML=this.responseText;   
        }
    };
    xhttp.open("GET", "php/loadUsers.php?order="+order, true); 
    xhttp.send();
}

function setSearch(){
    order=document.getElementById("se_input").value;
    loadUsers();
}