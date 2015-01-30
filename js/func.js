$(document).ready(function() {
    
   $("#log").click(function(){
  // alert ("!!!")
   $.ajax({
                url: 'reg_user.php',
                dataType : "text",
                type :"POST",
                data: 1 ,
                success: function(){ alert("SUCCESS") },
                error: function(error){ alert('error') }
            });
}); 


});