<script>
    $(document).ready(function(){
        @foreach($roles as $role)
        $("#roleStatus{{$role->id}}").change(function(){
            var status=$("#roleStatus{{$role->id}}").val();
            var roleID=$("#roleID{{$role->id}}").val();
            $.ajax({
                url:'{{url("admin/banRoles")}}',
                data: 'status='+status+'&roleID='+roleID,
                type: 'get',
                success:function (response) {
                    console.log(response);
                }
            });
        });
        @endforeach
    });
</script>
