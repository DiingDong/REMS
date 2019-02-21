var listingID, order="";

loadListings();

//Realiza una funcion cuando se presiona el boton respectivo 
document.getElementById("cr_submit").addEventListener("click", createListing);
document.getElementById("up_submit").addEventListener("click", updateListing);
document.getElementById("re_submit").addEventListener("click", removeListing);

document.getElementById("se_submit").addEventListener("click", setSearch);

function loadListings(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){                 
        if (this.readyState == 4 && this.status == 200){    
            document.getElementById("listingsTable").innerHTML=this.responseText;  
        }
    };
    xhttp.open("GET", "php/loadAdminListings.php?order="+order, true); 
    xhttp.send();
}

function setSearch(){
    order=document.getElementById("se_input").value;
    loadListings();
}

function setUpdateData(id,
    status, address, price, listing_member, end_date, 
    due_per_month, property_type, listing_side, selling_side, area, 
    zone, community, bedrooms, full_baths, half_baths, 
    year_built, listing_office, directions, legal, view,
    pet_friendly, list_price, sold_price, image){

    var radio;

    listingID=id;
    document.getElementById("up_errorHelp").innerHTML="";
    
    radio=document.getElementsByName('up_status');
        if (status==1){
            radio[0].checked=true;
        }else{
            radio[1].checked=true;
        } 
    document.getElementById("up_address").value=address;
    document.getElementById("up_price").value=price;
    document.getElementById("up_listing_member").value=listing_member;
    document.getElementById("up_end_date").value=end_date;

    document.getElementById("up_due_per_month").value=due_per_month;  
    document.getElementById("up_property_type").value=property_type; 
    document.getElementById("up_listing_side").value=listing_side;
    document.getElementById("up_selling_side").value=selling_side;
    document.getElementById("up_area").value=area;

    document.getElementById("up_zone").value=zone;
    document.getElementById("up_community").value=community;
    document.getElementById("up_bedrooms").value=bedrooms;
    document.getElementById("up_full_baths").value=full_baths;
    document.getElementById("up_half_baths").value=half_baths;

    document.getElementById("up_year_built").value=year_built;
    document.getElementById("up_listing_office").value=listing_office;
    document.getElementById("up_directions").value=directions;
    document.getElementById("up_legal").value=legal;
    document.getElementById("up_view").value=view;

    radio=document.getElementsByName('up_pet_friendly');
    if (pet_friendly==1){
        radio[0].checked=true;
    }else{
        radio[1].checked=true;
    } 
    document.getElementById("up_list_price").value=list_price;
    document.getElementById("up_sold_price").value=sold_price;
    document.getElementById("up_show_image").src=image;
}

function setRemoveData(id){
    listingID=id;

    document.getElementById("re_submit").style.display="initial";//unlocks button
    document.getElementById("re_errorHelp").innerHTML="Are you sure?";
}
        
function createListing(){
    var select, radio;

    radio=document.getElementsByName('cr_status'); var status="";
        for (var i=0, length=radio.length; i<length; i++){
            if (radio[i].checked){
                status=radio[i].value;
                break;
            }
        }
    var address=document.getElementById("cr_address").value;
    var price=document.getElementById("cr_price").value;
    var listing_member=document.getElementById("cr_listing_member").value;
    var end_date=document.getElementById("cr_end_date").value;;
    

    var due_per_month=document.getElementById("cr_due_per_month").value;  
    select=document.getElementById("cr_property_type"); var property_type=select[select.selectedIndex].value;
    var listing_side=document.getElementById("cr_listing_side").value;
    var selling_side=document.getElementById("cr_selling_side").value;
    var area=document.getElementById("cr_area").value;

    var zone=document.getElementById("cr_zone").value;
    var community=document.getElementById("cr_community").value;
    var bedrooms=document.getElementById("cr_bedrooms").value;
    var full_baths=document.getElementById("cr_full_baths").value;
    var half_baths=document.getElementById("cr_half_baths").value;

    var year_built=document.getElementById("cr_year_built").value;
    var listing_office=document.getElementById("cr_listing_office").value;
    var directions=document.getElementById("cr_directions").value;
    var legal=document.getElementById("cr_legal").value;
    select=document.getElementById("cr_view"); var view=select[select.selectedIndex].value;

    radio=document.getElementsByName('cr_pet_friendly'); var pet_friendly="";
        for (var i=0, length=radio.length; i<length; i++){
            if (radio[i].checked){
                pet_friendly=radio[i].value;
                break;
            }
        }
    var list_price=document.getElementById("cr_list_price").value;
    var sold_price=document.getElementById("cr_sold_price").value;  
    var image=document.getElementById("cr_image").files[0];

    var fd = new FormData();
    fd.append('status', status); fd.append('address', address); fd.append('price', price); fd.append('listing_member', listing_member); fd.append('end_date', end_date);
    fd.append('due_per_month', due_per_month); fd.append('property_type', property_type); fd.append('listing_side', listing_side); fd.append('selling_side', selling_side); fd.append('area', area);
    fd.append('zone', zone); fd.append('community', community); fd.append('bedrooms', bedrooms); fd.append('full_baths', full_baths); fd.append('half_baths', half_baths);
    fd.append('year_built', year_built); fd.append('listing_office', listing_office); fd.append('directions', directions); fd.append('legal', legal); fd.append('view', view);
    fd.append('pet_friendly', pet_friendly); fd.append('list_price', list_price); fd.append('sold_price', sold_price); fd.append('image', image);

    var xhttp = new XMLHttpRequest();           
    xhttp.onload = function(){                 
        if (this.readyState == 4 && this.status == 200){    
            if(this.responseText=="success"){
                document.getElementById("cr_errorHelp").innerHTML="Listing added";

                /*document.getElementById("cr_address").value="";
                document.getElementById("cr_price").value="";
                document.getElementById("cr_listing_member").value="";

                document.getElementById("cr_due_per_month").value="";  
                document.getElementById("cr_property_type").value=""; 
                document.getElementById("cr_listing_side").value="";
                document.getElementById("cr_selling_side").value="";
                document.getElementById("cr_area").value="";

                document.getElementById("cr_zone").value="";
                document.getElementById("cr_community").value="";
                document.getElementById("cr_bedrooms").value="";
                document.getElementById("cr_full_baths").value="";
                document.getElementById("cr_half_baths").value="";

                document.getElementById("cr_year_built").value="";
                document.getElementById("cr_listing_office").value="";
                document.getElementById("cr_directions").value="";
                document.getElementById("cr_legal").value="";
                document.getElementById("cr_view").value="";

                document.getElementById("cr_list_price").value="";
                document.getElementById("cr_sold_price").value="";
                document.getElementById("cr_image").value="";    
                document.getElementById("cr_show_image").src="";  */            

                order="";
                loadListings();                          
            }else{
                document.getElementById("cr_errorHelp").innerHTML=this.responseText;
            }                   
        }
    };
    xhttp.open("POST", "php/createListing.php",true);
    xhttp.send(fd);//Enviar datos
}

function updateListing(){
    var select, radio;

    radio=document.getElementsByName('up_status'); var status="";
        for (var i=0, length=radio.length; i<length; i++){
            if (radio[i].checked){
                status=radio[i].value;
                break;
            }
        }
    var address=document.getElementById("up_address").value;
    var price=document.getElementById("up_price").value;
    var listing_member=document.getElementById("up_listing_member").value;
    var end_date=document.getElementById("up_end_date").value;;
    

    var due_per_month=document.getElementById("up_due_per_month").value;  
    select=document.getElementById("up_property_type"); var property_type=select[select.selectedIndex].value;
    var listing_side=document.getElementById("up_listing_side").value;
    var selling_side=document.getElementById("up_selling_side").value;
    var area=document.getElementById("up_area").value;

    var zone=document.getElementById("up_zone").value;
    var community=document.getElementById("up_community").value;
    var bedrooms=document.getElementById("up_bedrooms").value;
    var full_baths=document.getElementById("up_full_baths").value;
    var half_baths=document.getElementById("up_half_baths").value;

    var year_built=document.getElementById("up_year_built").value;
    var listing_office=document.getElementById("up_listing_office").value;
    var directions=document.getElementById("up_directions").value;
    var legal=document.getElementById("up_legal").value;
    select=document.getElementById("up_view"); var view=select[select.selectedIndex].value;

    radio=document.getElementsByName('up_pet_friendly'); var pet_friendly="";
        for (var i=0, length=radio.length; i<length; i++){
            if (radio[i].checked){
                pet_friendly=radio[i].value;
                break;
            }
        }
    var list_price=document.getElementById("up_list_price").value;
    var sold_price=document.getElementById("up_sold_price").value;
    var image=document.getElementById("up_image").files[0];

    var fd = new FormData(); fd.append('unitID', listingID);
    fd.append('status', status); fd.append('address', address); fd.append('price', price); fd.append('listing_member', listing_member); fd.append('end_date', end_date);
    fd.append('due_per_month', due_per_month); fd.append('property_type', property_type); fd.append('listing_side', listing_side); fd.append('selling_side', selling_side); fd.append('area', area);
    fd.append('zone', zone); fd.append('community', community); fd.append('bedrooms', bedrooms); fd.append('full_baths', full_baths); fd.append('half_baths', half_baths);
    fd.append('year_built', year_built); fd.append('listing_office', listing_office); fd.append('directions', directions); fd.append('legal', legal); fd.append('view', view);
    fd.append('pet_friendly', pet_friendly); fd.append('list_price', list_price); fd.append('sold_price', sold_price); fd.append('image', image);
    
    var xhttp = new XMLHttpRequest();            
    xhttp.onreadystatechange = function(){                  
        if (this.readyState == 4 && this.status == 200){    
            if(this.responseText=="success"){
                document.getElementById("up_errorHelp").innerHTML="Listing edited";

                loadListings();                          
            }else{
                document.getElementById("up_errorHelp").innerHTML=this.responseText;
            }                   
        }
    };  //Envia datos a php
    xhttp.open("POST", "php/updateListing.php",true);
    xhttp.send(fd);//Enviar datos
}

function removeListing(){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if(this.responseText=="success"){
                document.getElementById("re_errorHelp").innerHTML="Listing removed";

                document.getElementById("re_submit").style.display="block";//blocks button
                loadListings();
            }else{
                document.getElementById("re_errorHelp").innerHTML=this.responseText;
            }                   
        }
    };
    xhttp.open("GET", "php/removeListing.php?id="+listingID, true);   
    xhttp.send();
}