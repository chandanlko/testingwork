$("#parent_iddd").change(function(){
    var id=$(this).val();
    $.ajax({
        type:'POST',
        url:'/getsubcategory',
        data:{
            parent_id:id
        },
        headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        success:function(data){
           // alert(data);
           $("#subcat_id").html(data);
        }
     });
});