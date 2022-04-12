/*-----
// here is code started for company/Parent Module
--*/
//function is used to fetching the data
$(function () {
    if (typeof parenttableroute != 'undefined') {
        var table = $('#parent-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: parenttableroute,
            columns: [
                {data: 'parent_name', name: 'parent_name'},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
    });
}
});

//here is defined function for save company data to our database
$("#ClickToSaveCompany").click(function(){
    var CompanyNameId=$("#CompanyNameId").val().trim();
        $("#error_comapny_name").css('display','none');
            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
            jQuery.ajax({
               url: saveCompanyRoute,
               method: 'post',
               data: {
                  name: CompanyNameId
               },
               beforeSend: function() {
                $("#error_comapny_name").css('display','flex');
                $("#error_comapny_name").css('color','green');
                $("#error_comapny_name").html('Loading...');
               },
               success: function(result){
                var res=JSON.parse(result);
                if(res.success==1){
                  $('#parent-table').DataTable().draw();
                  $("#closeParentModel").click();
                  $(".companyalert").css('display', 'flex');
                  $("#successmsg").html(res.message);
                  $("#error_comapny_name_edit").css('display','none');
                }
                else{
                    $("#error_comapny_name").css('display','flex');
                    $("#error_comapny_name").css('color','red');
                    $("#error_comapny_name").html(res.message);
                }
               }});
          
    
    
});



$("#ClickToEditCompany").click(function(){
    var CompanyNameId=$("#company_name_edit").val().trim();
    var company_edit_id=$("#companynameid_edit").val().trim();
        $("#error_comapny_name").css('display','none');
            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
            jQuery.ajax({
               url: UpDateCompany,
               method: 'post',
               data: {
                  name: CompanyNameId,
                  idd:company_edit_id
               },
               beforeSend: function() {
                $("#error_comapny_name_edit").css('display','flex');
                $("#error_comapny_name_edit").css('color','green');
                $("#error_comapny_name_edit").html('Updating...');
               },
               success: function(result){
                var res=JSON.parse(result);
                if(res.success==1){
                  $('#parent-table').DataTable().draw();
                  $("#closeParentModelEdit").click();
                  $(".companyalert").css('display', 'flex');
                  $("#error_comapny_name_edit").css('display','none');
                  $("#successmsg").html(res.message);
                }
                else{
                    $("#error_comapny_name_edit").css('display','flex');
                    $("#error_comapny_name_edit").css('color','red');
                    $("#error_comapny_name_edit").html(res.message);
                }
               }});
          
    
    
});

dataclick=(id)=>{
  $("#company_iid").val(id);
}
//here is function to delete the data.
$("#companyidd").click(function(){
    var CompanyNameId=$("#company_iid").val().trim();
            $.ajaxSetup({
               headers: {
                   'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
               }
           });
            jQuery.ajax({
               url: DeleteRoute,
               method: 'post',
               data: {
                  idd: CompanyNameId
               },
               beforeSend: function() {
                $("#deletedataidd").click();
                $("#successmsg").html('Deleting...');
               },
               success: function(result){
                var res=JSON.parse(result);
                if(res.success==1){
                  $('#parent-table').DataTable().draw();
                  $(".companyalert").css('display', 'flex');
                  $("#successmsg").html(res.message);
                }
                else{
                    $(".companyalert").css('display','flex');
                    $("#successmsg").html(res.message);
                }
               }});
          
    
    
});


dataedit = (id, name)=> {
    $("#company_name_edit").val(name.replaceAll("-"," "));
    $("#companynameid_edit").val(id);
}


/*-----
// here is code started for Brands Module
--*/

//here is code to fetching the data for brands

$(function () {
    if (typeof brandroute != 'undefined') {
      //  $('#brand-table').dataTable().clear().draw();
        var table = $('#brand-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: brandroute,
            columns: [
                {data: 'brand_name', name: 'brand_name', searchable: true, orderable: true},
                {data: 'parent_name', name: 'parent_name',searchable: true,  orderable: true},
                {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
    },
    
    );
   
   
 
}
});

//here is function for binding the parent data to datalist
    var tags = [
    "Delhi",
    "Ahemdabad",
    "Punjab",
    "Uttar Pradesh",
    "Himachal Pradesh",
    "Karnatka",
    "Kerela",
    "Maharashtra",
    "Gujrat",
    "Rajasthan",
    "Bihar",
    "Tamil Nadu",
    "Haryana"
      ];
 
      /*list of available options*/
     var n= tags.length; //length of datalist tags   
 
     function ac(value) {
        document.getElementById('datalist').innerHTML = '';
         //setting datalist empty at the start of function
         //if we skip this step, same name will be repeated
          
         l=value.length;
         //input query length
     for (var i = 0; i<n; i++) {
         if(((tags[i].toLowerCase()).indexOf(value.toLowerCase()))>-1)
         {
             //comparing if input string is existing in tags[i] string
 
             var node = document.createElement("option");
             var val = document.createTextNode(tags[i]);
              node.appendChild(val);
 
               document.getElementById("datalist").appendChild(node);
                   //creating and appending new elements in data list
             }
         }
     }

