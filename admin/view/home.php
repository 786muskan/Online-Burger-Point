<?php 
	require("nav.php");
	include('../controller/homeController.php');
	$obj =  new HomeController();
	$Orow=$obj->countOrder();
	$Prow=$obj->countProduct();
	$Crow=$obj->countCustomer();
	$data=$obj->showOrderItem();
	$rec=$obj->categoryCount();
	$res=$obj->ProductsCount();
	
	$arr[0]=['Categories', 'orders'];
	for ($i=0; $i < count($rec); $i++) { 
			$cal=($rec[$i]['order_count'])/(count($rec))*100;
			$arr[$i+1]=[$rec[$i]['name'],$cal];
		
	}
	$color=array('#B993D6','#8CA6DB','#D3959B','#BFE6BA','#00d2ff');
	$arr2[0]=['Product','Sales',[ 'role'=> 'style' ]];
	for ($i=0; $i <count($res) ; $i++) { 
		$sales=(int)$res[$i]['total_sales'];
		$arr2[$i+1]=[$res[$i]['name'],$sales,$color[$i]];
	}
	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<script  src="https://www.gstatic.com/charts/loader.js"></script>
	<title></title>
</head>
<body>
	<div class="container-fluid ">
		<div class="card card-2 ">
			<div class="card-body ">
				<div class="row row-space ">
					<div class="col ">
				        <div class=" card card-stats ">
						    <div class="card-body  text-dark p-5 rounded2 c1 text-center ">
						        <span class="h2 " ><?php echo $Crow[0];?></span>
						        <span class="h2 ">Customer</span>
						    </div>
				        </div>
				    </div>
				    <div class="col ">
				        <div class="card card-stats ">
						    <div class="card-body c2 text-dark  p-5 rounded2 text-center">
						        <span class="h2 " ><?php echo $Prow[0];?></span>
						        <span class="h2 ">Product</span>
						    </div>
				        </div>
				    </div>
				    <div class="col ">
				        <div class="card card-stats ">
						    <div class="card-body c3 text-dark  p-5 rounded2 text-center">
						        <span class="h2 " ><?php echo $Orow[0];?></span>
						        <span class="h2 ">Order</span>
						    </div>
				        </div>
				    </div>
				    
				</div>
				<!-- row -->
				<div class="row row-space">
					
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
				<h1 align="center " class="mb-5">Orders And Famous Products</h1>
						<div id="piechart_3d"></div>

 							<script type="text/javascript">
						      google.charts.load("current", {packages:["corechart"]});
						      google.charts.setOnLoadCallback(drawChart);
						      function drawChart() {
						      	var d=<?php echo json_encode($arr);?>;
						        var data = google.visualization.arrayToDataTable(d);

						        var options = {
						          title: 'Sales Group by Categories',
						          is3D: true,
						          width: 500, 
            					height: 300,
						        };

						        var chart = new google.visualization.PieChart(document.getElementById('piechart_3d'));
						        chart.draw(data, options);
						      }
						    </script>
						
					</div>
				
					
					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
						<h1 align="center " class="mb-5">Product and Sales</h1>
						<div id="columnchart_values" style="width: 800px; height: 400px;"></div>
 							<script type="text/javascript">
						      google.charts.load("current", {packages:["corechart"]});
						      google.charts.setOnLoadCallback(drawChart);
						      function drawChart() {
						      	var d=<?php echo json_encode($arr2);?>;
						        var data = google.visualization.arrayToDataTable(d);
						        var view = new google.visualization.DataView(data);

						        view.setColumns([0, 1,
                       { calc: "stringify",
                         sourceColumn: 1,
                         type: "string",
                         role: "annotation" },
                       2]);
						        var options = {
								        title: "Sales of Products, in Number(Top 5)",
								        width: 400,
								        height: 400,
								        bar: {groupWidth: "80%"},
								        legend: { position: "none" },
								         annotations: {
		                    	textStyle: {
		                        fontSize: 14, // Increase font size here
		                        color: '#000', // Text color
		                        auraColor: 'none' // No aura
		                    	}
		                		},
								      };
						        var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
      						chart.draw(view, options);
						      }
						    </script>
						
						</div> 

						<!-- <script type="text/javascript">
	    google.charts.load("current", {packages:['corechart']});
	    google.charts.setOnLoadCallback(drawChart);
	    function drawChart() {
	      var data = google.visualization.arrayToDataTable([
	        ["Element", "Density", { role: "style" } ],
	        ["Copper", 8.94, "#b87333"],
	        ["Silver", 10.49, "silver"],
	        ["Gold", 19.30, "gold"],
	        ["Platinum", 21.45, "color: #e5e4e2"]
	      ]);

	      var view = new google.visualization.DataView(data);
	      view.setColumns([0, 1,
	                       { calc: "stringify",
	                         sourceColumn: 1,
	                         type: "string",
	                         role: "annotation" },
	                       2]);

	      var options = {
	        title: "Density of Precious Metals, in g/cm^3",
	        width: 600,
	        height: 400,
	        bar: {groupWidth: "95%"},
	        legend: { position: "none" },
	      };
	      var chart = new google.visualization.ColumnChart(document.getElementById("columnchart_values"));
	      chart.draw(view, options);
	  }   

					</script> -->             
				</div>
			</div>
		</div>
					                    
	</div>
							
		
<?php 
	require_once("footer.php");
?>