<?php 
    require_once('nav.php');
    require_once('../controller/customerController.php');
    $obj =  new CustomerController();
     $ans=$obj->searchOrder($_REQUEST['order_id']);
    $order=$obj->showProduct($_REQUEST['order_id']);
     var_dump($ans);
    
?>
<div class="container-xl px-4 mt-4">
    <div class="row mb-4">
        <div class="col-md-2">
            <a  href="customer.php " >
                <img src="../attachment/icon_img/back.png" class="backButton img-fluid">
            </a>
        </div>
        <div class="col-md-9 d-flex align-items-center justify-content-center mt-5">
            <h1 class="title text-center ">Order Deatils</h1>
        </div>
    </div>
    <div class="card card-2 mb-5">
                <div class="card-header title"><h2><?php echo $ans['name']; ?></h2></div>
                <div class="card-body mb-2">
                    
                        
                        <!-- Form Row-->
                        <div class="row gx-3 mb-5">
                            <!-- username -->
                            <div class="col-md-6 ">
                                <label class="small mb-1 lb" >Order No.</label><br>
                                <label class="small mb-1 tx" ><?php echo $ans['order_no'] ?></label>
                                
                            </div>
                            <!-- password-->
                            <div class="col-md-6">
                                <label class="small mb-1 lb" >Password</label><br>
                                <label class="small mb-1 tx" ><?php echo $ans['password'] ?></label>
                                
                            </div>
                        </div>
                        <div class="row gx-3 mb-5">
                            <!--phone-->
                            <div class="col-md-6">
                                <label class="small mb-1 lb" >Phone</label><br>
                                <label class="small mb-1 tx" ><?php echo $ans['phone'] ?></label>
                                
                            </div>
                            <!-- Address-->
                            <div class="col-md-6">
                                <label class="small mb-1 lb" >Address</label><br>
                                <label class="small mb-1 tx" ><?php echo $ans['address'] ?></label>
                                
                            </div>
                        </div>
                        
                </div>
            </div>
        <div class="col-md-2">
            <a  href="customerDetails.php?user_id= <?php  echo $order[0]['id'] ?> " >
                <img src="../attachment/icon_img/back.png" class="backButton img-fluid">
            </a>
        </div>
        <div class="col-md-10 d-flex align-items-center justify-content-center mt-5">
            <h1 class="title">Related Products</h1>
        </div>
    </div>
        <div class="card card-2 mb-4 text-center">
            <div class="card-body">
                <div class="table-responsive">
        
        <table class="table  table-dashboard data-table " id="myTable">
          <thead class="bg-table ">
            <tr >
              <th class="text-center">SN</th>
              <th class="text-center"></th>
              <th class="text-center">Name</th>
              <th class="text-center">Quantity</th>
              <th class="text-center">Price</th>
              
            </tr>
          </thead>
          <tbody class="bg-white">                   
            <?php
                $i=1;
                foreach ($order as $key1 => $value1) { ?>
            <tr>
                <?php     
                    foreach ($value1 as $key2 => $value2) { 
                       if($key2!='user_id'){
                        if($key2=='od_id'){ 
                         echo"<td >".($i++)."</td>"; 
                        }
                        elseif ($key2 == 'image') {
                                     echo "<td><img src='../attachment/upload/$value1[$key2] 'class='img-responsive img-thumbnail product-img  img-fluid'  ></td>";
                        }
                        else{ 
                            echo"   <td >".$value2."</td>"; 
                
                        }
                    }
                    } 
                
                } ?>
            </tr>
            
          </tbody>
          
        </table>
    </div>
                </div>
            </div>
    
</div>
<script>

$(document).ready(function () {
    $('#myTable').DataTable();

});
</script> 
<?php 
    require('footer.php');
?>
