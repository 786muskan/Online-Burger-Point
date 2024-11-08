<?php 
    require('nav.php');
    include('../controller/product_controller.php');
        $obj =  new ProductController();
        $upload = '../attachment/upload/';

        $target_width = 500; // Define the width for the image
        $target_height = 500; // Define the height for the image
        //function
        function resizeImage($source, $destination, $width, $height) {
            list($original_width, $original_height) = getimagesize($source);
            
            $resized_image = imagecreatetruecolor($width, $height);
            
            // Check the file type
            $image_type = mime_content_type($source);
              // Use ImageMagick for AVIF images
    if ($image_type === 'avif') {
        try {
            $imagick = new Imagick($source);
            $imagick->resizeImage($width, $height, Imagick::FILTER_LANCZOS, 1);
            $imagick->setImageFormat('avif');
            $imagick->writeImage($destination);
            $imagick->destroy();
            return true;
        } catch (Exception $e) {
            return false; // Error handling
        }
    }
            var_dump($image_type);
            switch ($image_type) {
                case 'image/jpeg':
                    $original_image = imagecreatefromjpeg($source);
                    break;
                case 'image/png':
                    $original_image = imagecreatefrompng($source);
                    break;
                case 'image/gif':
                    $original_image = imagecreatefromgif($source);
                    break;
                default:
                    return false; // Invalid image type
            }

            // Resize the image
            imagecopyresampled($resized_image, $original_image, 0, 0, 0, 0, $width, $height, $original_width, $original_height);
            
            // Save the resized image
            switch ($image_type) {
                case 'image/jpeg':
                    imagejpeg($resized_image, $destination);
                    break;
                case 'image/png':
                    imagepng($resized_image, $destination);
                    break;
                case 'image/gif':
                    imagegif($resized_image, $destination);
                    break;
            }

            // Clean up
            imagedestroy($resized_image);
            imagedestroy($original_image);

            return true;
        }

        $cat_data=$obj->showCat();
        $show='';
        if(isset($_FILES['img']['name'])){
            $my_file = $_FILES['img']['name'];
            $path = $_FILES['img']['tmp_name'];
            $destination = $upload . $my_file;
            

        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['submit'])) {
            
            if(resizeImage($path, $destination, $target_width, $target_height)){
            

                    $res=$obj->insertproduct($_REQUEST['name'],$_REQUEST['cid'],$_REQUEST['ptype'],$_REQUEST['desc'],$_REQUEST['price'],$my_file,$_REQUEST['status']);
                    if($res){
                       // header("location:showCategory.php");
                        echo "<script>window.location.href = 'showProduct.php'</script>";
                    }
            }
            else{
                echo "<script>alert('Only select JPEG, JPG, PNG, GIF images');</script>";
            }
            
    }
        }
     if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
    $product_id = $_POST['product_id'];
    $my_file = $_FILES['img']['name'];
    $path = $_FILES['img']['tmp_name'];
    
    // Check if a new image is uploaded
    if ($my_file) {
        if (move_uploaded_file($path, $upload . $my_file)) {
            $obj->upProduct($product_id, $_POST['name'],  $_POST['ptype'], $_POST['desc'], $_POST['price'], $my_file, $_POST['status']);
            echo "<script>window.location.href = 'showProduct.php'</script>";
        }
    }
    } 
    
        $res=$obj->showProduct();
        //var_dump($res);
        
?>
<div class="container-fluid">
    <h1 class="" style="font-size: 50px;" align="center">Products</h1>
    <div class="table-responsive">
        <button class="btn btn-light bg-dark text-light pull-right" data-toggle="modal" data-target="#addProductModal">Add Product</button>

        <table class="table  table-dashboard data-table " id="myTable">
          <thead class="bg-table">
            <tr>
              <th>ID</th>
              <th></th>
              <th>Name</th>
              <th>Type</th>
              <th>Description</th>
              <th>Price</th>
              <th>Status</th>
              <th>Category</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody class="bg-white">                   
            <?php
                foreach ($res as $key1 => $value1) { ?>
            <tr>
                <?php     
                    foreach ($value1 as $key2 => $value2) { 
                        if($key2=='image'){ ?>
                            <td ><img src="../attachment/upload/<?php echo $value1[$key2] ?>" class="img-responsive img-thumbnail product-img"  ></td> 
                        <?php
                        }
                        else{ ?>
                            <td><?php echo $value1[$key2] ?></td> 
                <?php
                        }
                    } ?>
                <td><button class="btn  text-dark" data-toggle="modal" data-target="#updateProductModal" data-id="<?php echo $value1['id']; ?>" data-name="<?php echo $value1['name']; ?>" data-desc="<?php echo $value1['description']; ?>" data-price="<?php echo $value1['price']; ?>" data-status="<?php echo $value1['status']?>" data-type="<?php echo $value1['type']?>"><img src="../attachment/icon_img/edit.png" class="img-responsive img-fluid icon"></button></td>
                <?php
                } ?>
            </tr>
            
          </tbody>
          
        </table>
    </div>
</div><!-- Modal for Update Product -->
<div id="updateProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateProductModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="page-wrapper font-robo">
                    <div class="wrapper wrapper--w960">
                        <div class="card card-2">
                            <div class="card-body">
                                <h2 class="title">Update Product</h2>
                                <form method="POST" enctype="multipart/form-data">
                                    <!-- Hidden field for Product ID -->
                                    <input type="hidden" name="product_id" id="product_id">

                                    <div class="input-group">
                                        <label class="lb">Name:</label>
                                        <input class="input--style-2" type="text" placeholder="Name" name="name" id="update_name" required>
                                    </div>

                                    <div class="input-group">
                                        <label class="lb">Description:</label>
                                        <input class="input--style-2" type="text" placeholder="Description" name="desc" id="update_desc" required>
                                    </div>

                                    <div class="row row-space">
                                        <div class="col">
                                            <div class="input-group">
                                                <label class="lb">Image:</label>
                                                <input class="input--style-2 form-control" type="file" placeholder="Image" name="img" id="update_img">
                                                <!-- Optionally display the existing image -->
                                                <img id="current_image" class="img-responsive img-thumbnail mt-2" src="" alt="Current Image" style="display:none;">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <label class="lb">Price:</label>
                                                <input class="input--style-2" type="number" placeholder="Price" name="price" id="update_price" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row row-space">
                                        <div class="col">
                                            <div class="input-group">
                                                <label class="lb">Status:</label>
                                                <select class="form-control" name="status" id="update_status" required>
                                                    <option value="available">Active</option>
                                                    <option value="not-available">Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <label class="lb">Type:</label>
                                                <select class="form-control" name="ptype" id="update_type" required>
                                                    <option value="None">None</option>
                                                    <option value="Vegetarian">Vegetarian</option>
                                                    <option value="Non-vegetarian">Non-Vegetarian</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    

                                    <div class="p-t-30">
                                        <button class="btn btn--radius btn--black" type="submit" name="update">Update Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Add Product -->
<div id="addProductModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addProductModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="page-wrapper font-robo">
                    <div class="wrapper wrapper--w960">
                        <div class="card card-2">
                            <div class="card-body">
                                <h2 class="title">Add Product</h2>
                                <form method="POST" enctype="multipart/form-data">
                                    <div class="input-group">
                                        <label class="lb">Name:</label>
                                        <input class="input--style-2" type="text" placeholder="Name" name="name" required >
                                    </div>
                                    <div class="input-group">
                                        <label class="lb">Description:</label>
                                        <input class="input--style-2" type="text" placeholder="Description" name="desc" required >
                                    </div>
                                    <div class="row row-space">
                                        <div class="col">
                                            <div class="input-group">
                                                <label class="lb">Image:</label>
                                                <input class="input--style-2 form-control" type="file" placeholder="Image" name="img" required >
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <label class="lb">Price:</label>
                                                <input class="input--style-2" type="number" placeholder="Price" name="price" required >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row row-space">
                                        <div class="col">
                                            <div class="input-group">
                                                <label class="lb">Status:</label>
                                                <select class="form-control" name="status" required>
                                                    <option value="available" >Active</option>
                                                    <option value="not-available" >Not Active</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="input-group">
                                                <label class="lb">Type:</label>
                                                <select class="form-control" name="ptype"  id="ptype" required>
                                                    <option value="Vegetarian" >Vegetarian</option>
                                                    <option value="Non-vegetarian" >Non-Vegetarian</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="input-group ">
                                        <label class="lb">Category:</label>
                                        <select class="form-control" name="cid" id="category" required>
                                            <?php foreach ($cat_data as $key1 => $value1) { ?>
                                                <option value="<?php echo $value1['id']; ?>"><?php echo $value1['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="p-t-30">
                                        <button class="btn btn--radius btn--black" type="submit" name="submit" >Add Product</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

$(document).ready(function () {
    $('#myTable').DataTable();
     // Populate the update modal with existing product data
    $('#updateProductModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var desc = button.data('desc');
        var price = button.data('price');
        var status = button.data('status');
        var type = button.data('type');
        var img = button.data('img');

        var modal = $(this);
        modal.find('#product_id').val(id);
        modal.find('#update_name').val(name);
        modal.find('#update_desc').val(desc);
        modal.find('#update_img').val(img);
        modal.find('#update_status').val(status);
        modal.find('#update_price').val(price);
        modal.find('#update_type').val(type);
    });
    document.getElementById('category').addEventListener('change', function () {
        var categoryId = this.value;
        var typeSelect = document.getElementById('ptype');
        
        // Reset the type options
        typeSelect.innerHTML = '';

        if (categoryId == 1 || categoryId == 2) {
            // Add Veg and Non-Veg options
            typeSelect.innerHTML = '<option value="Vegetarian">Vegetarian</option><option value="Non-vegetarian">Non-Vegetarian</option>';
        } else if (categoryId == 4 || categoryId == 3) {
            // Add None option
            typeSelect.innerHTML = '<option value="None">None</option>';
        } else {
            // Default in case any other category is added later
            typeSelect.innerHTML = '<option value="None">None</option>';
        }
    });
    
} );

</script> 
<?php 
    require('footer.php');
?>