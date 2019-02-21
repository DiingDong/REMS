function verifyImage(input, output){
    var extension=input.value.split(".").pop().toLowerCase();
    
    if(jQuery.inArray(extension,  ["gif","png","jpg","jpeg"])==-1){//verify extension
        alert("Invalid image file");
        input.value="";
        $('#'+output).attr('src', '#')
    }else{//show selected image
        if (input.files && input.files[0]){
            var reader = new FileReader();

            reader.onload=function(e){
                $('#'+output)
                .attr('src', e.target.result)
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
}