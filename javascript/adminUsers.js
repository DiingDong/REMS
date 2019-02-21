var userID, order="";
        
loadUsers();

//Realiza una funcion cuando se presiona el boton respectivo 
document.getElementById("cr_submit").addEventListener("click", createUser);
document.getElementById("up_submit").addEventListener("click", updateUser);
document.getElementById("re_submit").addEventListener("click", removeUser);

document.getElementById("se_submit").addEventListener("click", setSearch);

function loadUsers(){
    var xhttp = new XMLHttpRequest();            
    xhttp.onreadystatechange = function(){                 
        if (this.readyState == 4 && this.status == 200){    
            document.getElementById("usersTable").innerHTML=this.responseText;   
        }
    };
    xhttp.open("GET", "php/loadAdminUsers.php?order="+order, true); 
    xhttp.send();
}

function setSearch(){
    order=document.getElementById("se_input").value;
    loadUsers();
}

function setUpdateData(id,user,name,lastname,email,celNum){
    userID=id;
    //Llena al formulario con los datos del usuario
    document.getElementById("up_name").value=name;  
    document.getElementById("up_lastname").value=lastname;
    document.getElementById("up_user").value=user;
    document.getElementById("up_email").value=email;
    document.getElementById("up_celNum").value=celNum;

    document.getElementById("up_errorHelp").innerHTML="";
}

function setRemoveData(id){
    userID=id;

    document.getElementById("re_submit").style.display="initial";//unlocks button
    document.getElementById("re_errorHelp").innerHTML="Are you sure?";
}
   
function createUser(){
    var name=document.getElementById("cr_name").value;  //Obtiene datos en el formulario
    var lastname=document.getElementById("cr_lastname").value;
    var user=document.getElementById("cr_user").value;
    var email=document.getElementById("cr_email").value;
    var pass=document.getElementById("cr_pass").value;
    var passVer=document.getElementById("cr_passVer").value;
    var celNum=document.getElementById("cr_celNum").value;
    
    var xhttp = new XMLHttpRequest();            
    xhttp.onreadystatechange = function(){                  //Realizara esta funcion despues de comunicarse con el php
        if (this.readyState == 4 && this.status == 200){ 
            if(this.responseText=="success"){                   //Verifica que la respuesta del echo del php sea "success"
                document.getElementById("cr_errorHelp").innerHTML="User "+user+" created";
                document.getElementById("cr_name").value="";        //Borra los campos del formulario
                document.getElementById("cr_lastname").value="";
                document.getElementById("cr_user").value="";
                document.getElementById("cr_email").value="";
                document.getElementById("cr_pass").value="";
                document.getElementById("cr_passVer").value="";
                document.getElementById("cr_celNum").value="";  

                order="";
                loadUsers();                          
            }else{
                document.getElementById("cr_errorHelp").innerHTML=this.responseText;
            }                   
        }
    };  //Envia datos a php
    xhttp.open("GET", "php/createUser.php?user="+user+"&pass="+pass+"&passVer="+passVer+
        "&name="+name+"&lastname="+lastname+"&email="+email+"&celNum="+celNum, true); 
    xhttp.send();
}

function updateUser(){
    var name=document.getElementById("up_name").value;
    var lastname=document.getElementById("up_lastname").value;
    var user=document.getElementById("up_user").value;
    var email=document.getElementById("up_email").value;
    var pass=document.getElementById("up_pass").value;
    var passVer=document.getElementById("up_passVer").value;
    var celNum=document.getElementById("up_celNum").value;
    
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if(this.responseText=="success"){
                loadUsers();
                document.getElementById("up_errorHelp").innerHTML="User edited";
            }else{
                document.getElementById("up_errorHelp").innerHTML=this.responseText;   
            }   
        }
    }; 
    xhttp.open("GET", "php/updateUser.php?userID="+userID+"&user="+user+"&pass="+pass+"&passVer="+passVer+
        "&name="+name+"&lastname="+lastname+"&email="+email+"&celNum="+celNum, true);
    xhttp.send();
}

function removeUser(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if(this.responseText=="success"){
                document.getElementById("re_errorHelp").innerHTML="User removed";
                
                document.getElementById("re_submit").style.display="block";//blocks button
                loadUsers();
            }else{
                document.getElementById("re_errorHelp").innerHTML=this.responseText;
            }                   
        }
    };
    xhttp.open("GET", "php/removeUser.php?id="+userID, true);   
    xhttp.send();
}