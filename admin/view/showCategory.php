<!-- Category -->
<?php 
require('nav.php');
include('../controller/category_controller.php');

$data = [];
$avCheck = "";
$navCheck = "";

$obj = new CategoryController();

// Handle insert category
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_REQUEST['submit'])) {
    $res = $obj->insertCat($_REQUEST['name'], $_REQUEST['desc'], $_REQUEST['status']);
    if ($res) {
        echo "<script>window.location.href = 'showCategory.php'</script>";
    }
}

// Show all categories
$res = $obj->showCat();

// Handle updating category if ID is set
if (isset($_REQUEST['id'])) {
    $data = $obj->searchCat($_REQUEST['id']);
    if ($data != null) {
        if ($data['available'] == "available") {
            $avCheck = "selected";
        } else {
            $navCheck = "selected";
        }
    }

    // Handle form submission for update
    if (isset($_REQUEST['Update'])) {
        $res = $obj->upCategory($data['id'], $_REQUEST['name'], $_REQUEST['desc'], $_REQUEST['status']);
        if ($res) {
            echo "<script>window.location.href = 'showCategory.php'</script>";
        }
    }
}
?>

<div class="container-fluid m-2 p-2">
    <h1 class="" style="font-size: 50px;" align="center">Categories</h1>
    <div class="table-responsive">
        <button class="btn btn-light bg-dark text-light pull-right" data-toggle="modal" data-target="#addCategoryModal">Add Category</button>
        
        <table class="table table-dashboard data-table" id="myTable">
            <thead class="bg-table">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody class="bg-white">                   
                <?php foreach ($res as $value1) { ?>
                    <tr>
                        <td><?php echo $value1['id']; ?></td>
                        <td><?php echo $value1['name']; ?></td>
                        <td><?php echo $value1['description']; ?></td>
                        <td><?php echo $value1['status']; ?></td>
                        <td>
                            <button class="btn  text-dark" 
                                    data-toggle="modal" 
                                    data-target="#updateCategoryModal" 
                                    data-id="<?php echo $value1['id']; ?>" 
                                    data-name="<?php echo $value1['name']; ?>" 
                                    data-desc="<?php echo $value1['description']; ?>" 
                                    data-status="<?php echo $value1['status']; ?>">
                                <img src="../attachment/icon_img/edit.png" class="img-responsive img-fluid icon">
                            </button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Add Category Modal -->
<div id="addCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="addCategoryModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title" id="addCategoryModalLabel">Add Category</h4>
            </div>
            <div class="modal-body">
                <div class="page-wrapper font-robo">
                    <div class="wrapper wrapper--w960">
                        <div class="card card-2">
                            <div class="card-body">
                                <h2 class="title">Add Category</h2>
                                <form method="POST">
                                    <div class="input-group">
                                        <label class="lb">Name:</label>
                                        <input class="input--style-2" type="text" placeholder="Name" name="name" required>
                                    </div>
                                    <div class="input-group">
                                        <label class="lb">Description:</label>
                                        <input class="input--style-2" type="text" placeholder="Description" name="desc" required>
                                    </div>
                                    <div class="input-group">
                                        <label class="lb">Status:</label>
                                        <select class="form-control" name="status" required>
                                            <option value="available">Active</option>
                                            <option value="not-available">Not Active</option>
                                        </select>
                                    </div>
                                    <div class="p-t-30">
                                        <button class="btn btn--radius btn--black" type="submit" name="submit">Add Category</button>
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

<!-- Update Category Modal -->
<div id="updateCategoryModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="updateCategoryModalLabel" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog" role="document">
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
                                <h2 class="title text-center">Update Category</h2>
                                <form method="POST">
                                    <input type="hidden" name="id" id="category_id">
                                    <div class="input-group">
                                        <label class="lb">Name:</label>
                                        <input class="input--style-2" type="text" placeholder="Name" name="name" id="update_name" required>
                                    </div>
                                    <div class="input-group">
                                        <label class="lb">Description:</label>
                                        <input class="input--style-2" type="text" placeholder="Description" name="desc" id="update_desc" required>
                                    </div>
                                    <div class="input-group">
                                        <label class="lb">Status:</label>
                                        <select class="form-control" name="status" id="update_status" required>
                                            <option value="available">Active</option>
                                            <option value="not-available">Not Active</option>
                                        </select>
                                    </div>
                                    <div class="p-t-30">
                                        <button class="btn btn--radius btn--black center-button" type="submit" name="Update">Update Category</button>
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

    // Populate the update modal with existing category data
    $('#updateCategoryModal').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var id = button.data('id');
        var name = button.data('name');
        var desc = button.data('desc');
        var status = button.data('status');

        var modal = $(this);
        modal.find('#category_id').val(id);
        modal.find('#update_name').val(name);
        modal.find('#update_desc').val(desc);
        modal.find('#update_status').val(status);
    });
});
</script> 

<?php 
require('footer.php');
?>
