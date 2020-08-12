$(document).ready(function()  {

function send_com1()
{
     var koment=document.getElementById('createcomment').value;
      $.ajax({
            type:"POST", 
            url:"send_com.php",
            data: {komentarz:koment,film:idf},
            success: function() {
            location.reload(true);
        },
       
        });
}


$('#send_comment').on('click', function(){

  send_com1();
});
});