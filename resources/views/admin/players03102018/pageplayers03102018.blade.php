<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        
    </title>
</head>
<body >

       <?php echo $output; ?>
   
</table>

    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

<script>

$( document ).ready(function() {
   
   function fetch_gamer_data(gamer_id){
            
            var total_pages=document.getElementById("total_pages").value;
            //alert(total_pages);
            var url = "{{ URL::to('/players_testajax') }}";
           
            var xhr=new XMLHttpRequest();
                xhr.onreadystatechange=function(){
                    if(xhr.readyState==4 && xhr.status==200){

                       var page_div =document.getElementById('pagination_data');
                          page_div.innerHTML=xhr.responseText;   
                    }
                }
            if(gamer_id<=0 || gamer_id >= (parseInt(total_pages)+1))return false;
            else{
                xhr.open('GET',url+"?id="+gamer_id,true);
                xhr.send();
            }
            
    }
    
    var page = 1;
    $(document).on('click','.pagination_link',function(){
        var page = $(this).attr("id");
          fetch_gamer_data(page);
    })

     var next = 1;
     
     $(document).on('click','.next',function(){
            fetch_gamer_data(++next);
     })
     
     $(document).on('click','.previous',function(){

          if(next){
            fetch_gamer_data(--next);
          }
          if(page){
            fetch_gamer_data(--page);
          }
            
     })
});

</script>
</body>
</html>


    

    


   



      