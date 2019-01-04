<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        
    </title>
</head>
<body >

    <div id="pagination_data">
       <?php echo $output; ?>
    </div>
</table>

   

    <script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

<script>

$( document ).ready(function() {
   
     load_data();
    function load_data(page){
        $.ajax({
            url:"{{ URL::to('/players_testajax') }}",
            method:"POST",
            data:{page:page},
            success:function(data){
                $('#pagination_data').html(data);
            }
        })
    }

    $(document).on('click','.pagination_link',function(){
        var page = $(this).attr("id");
        load_data(page);
    })
   
      
});

    
   
</script>
</body>
</html>


    

    


   



      