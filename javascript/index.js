var count=10;

loadPosts();

document.getElementById("submit").addEventListener("click", createPost);
document.getElementById("clear").addEventListener("click", clearFields);

$('#postsList').scroll(function() {//detecta scroll
    if ($(this)[0].scrollHeight - $(this).scrollTop() == $(this).outerHeight()){        
        loadPosts();        
    }
});

function loadPosts(){
    var xhttp = new XMLHttpRequest();            
    xhttp.onreadystatechange = function(){                 
        if (this.readyState == 4 && this.status == 200){
            document.getElementById("postsList").innerHTML=this.responseText; 
            count=count+10;
        }
    };
    xhttp.open("GET", "php/loadPosts.php?count="+count, true); 
    xhttp.send();
}

function createPost(){
    var subject=document.getElementById("subject").value;
    var message=document.getElementById("message").value;
    
    var xhttp = new XMLHttpRequest();            
    xhttp.onreadystatechange = function(){   
        if (this.readyState == 4 && this.status == 200){    
            if(this.responseText=="success"){
                document.getElementById("subject").value="";
                document.getElementById("message").value="";    
                
                count=10;
                loadPosts();                          
            }else{
                alert(this.responseText);
            }                   
        }
    };  //Envia datos a php
    xhttp.open("GET", "php/createPost.php?subject="+subject+"&message="+message, true); 
    xhttp.send();
}

function clearFields(){
    document.getElementById("subject").value="";
    document.getElementById("message").value=""; 
}