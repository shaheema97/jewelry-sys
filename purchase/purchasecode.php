<script>
    //function to filter items according to the selected category
    $("#purchitemcat").change(function(){
        //get the id
        var cat_id=$("#purchitemcat").val();
        console.log(cat_id);
        //get the data using ajax
        $.get("../files/ajax.php?type=get_item_bycat",{catid:cat_id},function(data){
            console.log(data);

        //convert json to 
        var d=JSON.parse(data);

        //remove any existing data from the item dropdown
        $("#purchitemname").html("");

        //cos we have list of items to be displayed, we use a loop
        $.each(d,function(i,x){
            console.log(i);//loop number
            console.log(x);//data
            $("#purchitemname").append("<option value='"+d[i].item_id+"'> "+d[i].item_name+" </option>");
        });
        });
    });

    //dynamic table
    $("#purchitemmadd").click(function(){
        
        additems();
        clear_rows();


    });

    function   additems(){

        
      var itemcat=$("#purchitemcat").val();
      var itemname=$("#purchitemname").val();
      var itemsize=$("#purchitemsize").val();
      var itemweight=$("#purchitemweight").val();
      var itemunit=$("#purchitemsizeunit").val();
      var itemdes=$("#purchitemdes").val();
      var itemqty=$("#purchitemqty").val();
      var itempurity=$("#purchitempurity").val();
      
    
      if(itemcat =="" || itemname =="" || itemsize=="" || itemweight=="" || itemunit=="" || itemqty=="" || itempurity==""){
                alert("Please fill all fields");
                //problem--the existing data in the text boxes also removes
        }else{
      
      $("#itembody").append("<tr><td><input type='hidden' value='"+itemcat+"' name='p_itencat[]' >"+itemcat+"</td><td><input type='hidden' value='"+itemname+"' name='p_itemname' >"+itemname+"</td><td><input type='hidden' value='"+itemsize+"' name='p_itemsize[]' >"+itemsize+"</td><input type='hidden' name='p_itemsunit' value='"+itemunit+"'><td><input type='hidden' value='"+itempurity+"' name='p_item_purity' >"+itempurity+"K</td><td><input type='hidden' value='"+itemweight+"' name='p_itemweight' >"+itemweight+"g</td><td><input type='hidden' value='"+itemqty+"' name='p_itemqty[]' >"+itemqty+"</td><input type='hidden' value='"+itemdes+"' name='p_itemmdesc[]' ><td><button type='button'  onclick='delete_row(this)' class='badge badge-danger' style='float: none;margin: 5px;'><span class='icofont icofont-ui-delete'></span></button></td><tr>");
        }

    }

    function clear_rows(){

      $("#purchitemcat").val("");
      $("#purchitemname").val("");
      $("#purchitemsize").val("");
      $("#purchitemweight").val("");
      $("#purchitemsizeunit").val("");
      $("#purchitemdes").val("");
      $("#purchitemqty").val("");
      $("#purchitempurity").val("");
      $("#purchitemcat").focus();
    }

    function delete_row(x){
        $(x).parent().parent().remove();
        //first parent->tr
        //second parent->td

    }

    $(".itemlist").delegate(".weight","keypres",function(){
        var itemweight=$(this);
        if(isNaN(itemweight.val())){
            alert("Please enter valid data");
            }
        });

        $(".itemlist").delegate(".size","keyup",function(){
        var size=$(this);
        if(isNaN(size.val())){
           console.log("Please enter valid data");
            $("#msg1").append("<p>Please enter valid data</p>");
            // $("#msg1").hide(1000);
                $(".size").val("");
                }
        });



    
</script>





btn-cancel
btn-edit
btn-save
btn-delete

function showbutton(){
        $("#btn-save").append("<button type='button'  onclick='' class='badge badge-success' style='float:none;margin: 5px;'>Save</button></span>");
    
    }