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

var html ='<div class="form-group row"><label for="default_price" class="col-sm-2 col-form-label"></label><div class="col-sm-2"><input placeholder="Material" type ="text" name="material[]" class="form-control"></div><div class="col-sm-2"><input placeholder="Pack Size" type ="text" name="pack_size[]" class="form-control"></div><div class="col-sm-2"><input placeholder="Demension" type ="text" name="dimension[]" class="form-control"></div><div class="col-sm-2"><input placeholder="Price" type ="text" name="price[]" class="form-control"></div><div class="col-sm-2"><span class="btn btn-danger removebtn" onclick="removebtndata(this)"> X</span></div></div>';
$("#addvariation").click(function(){
$(this).parent().parent().after(html);
});
removebtndata=(res)=>{
    $(res).parent().parent().remove();

}


var ziphtml=' <div class="form-group row"><label for="default_price" class="col-sm-2 col-form-label"></label><div class="col-sm-4"><input type="text" name="zipcode[]" class="form-control" placeholder="Enter the zip code"></div><div class="col-sm-4"><input type="text" name="deliverycharges[]" class="form-control" placeholder="Delivery Charges"></div><div class="col-sm-2"><span class="btn btn-danger" onclick="removezip(this)">X</span></div></div>';

$("#addzipcode").click(function(){
    $(this).parent().parent().after(ziphtml);
    });

removezip=(resd)=>{
    $(resd).parent().parent().remove();

}

selecteddropdown=()=>{
    var category_id=$('#parent_iddd :selected').val();
    if(category_id !='' || category_id !=null || category_id !=0){
        $.ajax({
            type:'POST',
            url:'/getsubcategory',
            data:{
                parent_id:category_id
            },
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            success:function(data){
            // alert(data);
            $("#subcat_id").html(data);
            }
        });
       
    }
}
$(function(){
    setTimeout(selecteddropdown,1000);
    setTimeout(function(){
        $('select[id="subcat_id"]').val(subcategoryid);
    },1500);
});
