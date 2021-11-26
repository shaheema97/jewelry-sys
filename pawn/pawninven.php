<?php
    include_once ("pawnitem.php");
    $pt1=new pawnitem();
    $r=$pt1->get_all_pitem();
   
    
   

   



    include_once ("../files/top.php");
?>

 <!-- Success-color Breadcrumb card start -->
    <div class="card borderless-card">
        <div class="card-block success-breadcrumb">
            <div class="breadcrumb-header">
                <strong>Pawn Inventory</strong>
                <br>
                
            </div>
            <div class="page-header-breadcrumb">
                <ul class="breadcrumb-title">
                    <li class="breadcrumb-item">
                        <a href="#!">
                            <i class="icofont icofont-home"></i>
                        </a>
                    </li>
                    
                    <li class="breadcrumb-item"><a href="#!">Pawn inventory</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
<!-- Success-color Breadcrumb card end -->
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-block">
                        
                            <!--card head start -->
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-10">
                                            <h4>Pawn Transaction</h4>
                                    </div>
                                    <div class="col-sm-2">
                                        <a href="staff_frm.php" class="btn btn-inverse m-r-10 m-b-5">
                                        <i class="icofont icofont-plus"></i>
                                        New Pawn
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <!--card head end -->
                            <form action="pawninven.php" method="POST">
                            <div class="row">
                                <!--Start of search filter -->
                                

                                    <div class="col-sm-3 form-group">
                                                <label>Start Date:</label>
                                                <input type="date" class="form-control form-control-default" name="filter_stdt"  >
                                    </div>
                                    <div class="col-sm-3 form-group">
                                                <label>End Date:</label>
                                                <input type="date" class="form-control form-control-default" name="filter_endt" >
                                    </div>
                                    <div class="col-sm-3 form-group">
                                                <label>Category:</label>
                                                <select id="filter_cat" class="form-control" name="filter_cat" >
                                                <option value="-1"></option>
                                                        <option value="Necklace" name="prof" >Necklace</option>
                                                        <option value="Ring" name="prof">Ring</option>
                                                        <option value="Bangle" name="prof">Bangle</option>
                                                </select>
                                    </div>
                                    <div class="col-sm-3 form-group">
                                                <label>Item:</label>
                                                <select id="filter_item" class="form-control" name="filter_item">
                                                    <option value="-1"></option>
                                                    <option value="Necklace a" name="prof" >Necklace a</option>
                                                    <option value="Ring a" name="prof">Ring a</option>
                                                    <option value="Bangle a" name="prof">Bangle a</option>
                                                </select>
                                    </div>
                                    <div class="col-sm-10">
                                        
                                    </div>
                                    <!--button search-->
                                    <div class="col-sm-2 ">
                                        <button type="submit" class="btn btn-success m-r-10 m-b-5" id="search" name="search" >
                                        <i class="icofont icofont-search" ></i>
                                        Search
                                        </button>
                                    </div>
                                </form>
                                <!--End of Search filters -->
                                <!--Start of datatable -->
                                    <div class="card-block">
                                    <div class="dt-responsive table-responsive">
                                        <table  id="basic-btn" class="table table-striped table-bordered nowrap" style="width : 100% ">
                                            <thead>
                                                <tr>
                                                    <th>Ticket</th>
                                                    
                                                    <!--<th>End dt</th>-->
                                                    <th>Catogary</th>
                                                    <th>Item</th>
                                                    <th>marketval</th>
                                                    
                                                    <th>Latest/rate</th>
                                                   
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                                
                                                foreach($r as $item){
                                                    echo"
                                                    <tr>
                                                    <td>$item->pawnid</td>
                                                   
                                                    <td>".$item->itemcat->cat_name."</td>
                                                    <td>$item->pawn_item</td>
                                                    <td>$item->pawnit_mv</td>
                                                    <td>$item->item_price</td>
                                                    
                                                    ";
                                                    echo' <td >
                                                    
                                                    <button type="button" class="btn btn-primary btn-mini" data-toggle="modal" data-target="#default-Modal">Inventory</button>
                                                  
                                                    
                                                    </td>';
                                                

                                                   
                                               echo" </tr>";
                                            } ?>
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                <!--End of datatable -->
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--modal for adding items -->
    <div class="modal fade" id="default-Modal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Add item to inventory</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="col-form-label text-primary f-16">Category:</div>
                                <input type="hidden" class="form-control"><span>Ring</span>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-form-label text-primary f-16">Item Name</div>
                                <input type="hidden" class="form-control"><span>Blue Flame</span>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-form-label text-primary f-16">Purity</div>
                                <input type="hidDen" class="form-control"><span>18K</span>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="col-form-label text-primary f-16">Item Weight:</div>
                                <input type="hidden" class="form-control"><span>56.3g</span>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-form-label text-primary f-16">Stone Weight</div>
                                <input type="text" class="form-control">
                            </div>
                            <div class="col-sm-4">
                                <div class="col-form-label text-primary f-16">Nett Weight</div>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <div class="col-form-label text-primary f-16">Size:</div>
                                <select name="" id="" class="form-control">
                                    <option value=""></option>
                                </select>
                            </div>
                            <div class="col-sm-2">
                                <div class="col-form-label text-primary f-16">Unit:</div>
                                <select name="" id="" class="form-control">
                                </select>
                            </div>

                            <div class="col-sm-4">
                                <div class="col-form-label text-primary f-16">Quantity</div>
                                <input type="hidden" class="form-control"><span>1</span>
                            </div>
                            <div class="col-sm-4">
                                <div class="col-form-label text-primary f-16">Cost Price</div>
                                <input type="hidDen" class="form-control"><span>Rs.850000</span>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default waves-effect " data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary waves-effect waves-light ">Save changes</button>
                </div>
            </div>
        </div>
    </div>
<?php
    include_once ("../files/bottom_dt.php");
?>

<script>

        function fill_datatable(){

            
            
        }




        $('#search').click(function(){
           // alert(12);

            var filter_cat= $('#filter_cat').val();
            var filter_item= $('#filter_item').val();


            if(filter_cat != '' &&  filter_item !='')
            {
                $('#itemtable').DataTable().destroy();
                $.get("ajax.php?type=filterpitem",'',function(data){
                   //echo (data);
                   //console.log(data);
                    var d = JSON.parse(data);
                     alert (d);
                     });
            
                
            }
            else{
                alert('Select both fields');
                $('#itemtable').DataTable().destroy();
                fill_datatable();
            }
       });

</script>
