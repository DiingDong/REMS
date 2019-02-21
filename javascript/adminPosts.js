var userID, order="";

loadPosts();

document.getElementById("cr_submit").addEventListener("click", createPost);
document.getElementById("re_submit").addEventListener("click", removePost);

document.getElementById("se_submit").addEventListener("click", setSearch);

function loadPosts(){
    var xhttp = new XMLHttpRequest();            
    xhttp.onreadystatechange = function(){                 
        if (this.readyState == 4 && this.status == 200){
            document.getElementById("postsTable").innerHTML=this.responseText;
        }
    };
    xhttp.open("GET", "php/loadAdminPosts.php?order="+order, true); 
    xhttp.send();
}

function setSearch(){
    order=document.getElementById("se_input").value;
    loadPosts();
}

function setRemoveData(id){
    postID=id;

    document.getElementById("re_submit").style.display="initial";//unlocks button
    document.getElementById("re_errorHelp").innerHTML="Are you sure?";
}

function createPost(){
    var subject=document.getElementById("cr_subject").value;
    var message=document.getElementById("cr_message").value;
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if(this.responseText == "success"){
                document.getElementById("re_errorHelp").innerHTML="Post added";
                document.getElementById("cr_subject").value="";
                document.getElementById("cr_message").value="";

                order="";
                loadPosts();
            }else{
                document.getElementById("re_errorHelp").innerHTML=this.responseText;
            }                   
        }
    };
    xhttp.open("GET", "php/createPost.php?subject="+subject+"&message="+message, true);   
    xhttp.send();
}

function removePost(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if(this.responseText == "success"){
                document.getElementById("re_errorHelp").innerHTML="Post removed";

                document.getElementById("re_submit").style.display="block";//blocks button
                loadPosts();
            }else{
                document.getElementById("re_errorHelp").innerHTML=this.responseText;
            }                   
        }
    };
    xhttp.open("GET", "php/removePost.php?postID="+postID, true);   
    xhttp.send();
}