<?php 
    require_once('nav.php');
    require_once('../controller/customerController.php');
    $obj =  new CustomerController();
    $ans=$obj->showCus();
    
        

?>

<div class="container-fluid">
    <h1 class="" style="font-size: 50px;" align="center">Cusotmers</h1>
<table class="table table-sm table-dashboard data-table no-wrap mb-0 fs--1 w-100 "  id="myTable">
  <thead class="bg-table" >
    <tr >
      <th>ID</th>
      <th>Name</th>
      <th>User-Name</th>
      <th>Password</th>
      <th>Phone Number</th>
      <th>Address</th>
    </tr>
  </thead>
  <tbody class="bg-white">                   
            <?php
                        $i=1;
                foreach ($ans as $key1 => $value1) { 
            echo "<tr>";
                    
                    foreach ($value1 as $key2 => $value2) {  
                        if($key2!='type'){
                            
                            if($key2!='id'){
                                if ($key2 == 'name') {
                                // Create a link for the name
                                    echo "<td><a href='customerDetails.php?user_id=" . $value1['id'] . "'> $value1[$key2] </a></td>";
                                } 
                                else {
                                    echo "<td> $value1[$key2] </td>";
                                } 
                            }
                            else{
                                echo "<td> ".($i)."</td>";
                                $i++;
                            }
                        }
                
                        }
            echo "</tr>";
                    } 
                
            ?>
          </tbody>
  
</table>
</div>


<script>

$(document).ready(function () {
    $('#myTable').DataTable();

});
</script> 
<?php 
    require('footer.php');
?>

