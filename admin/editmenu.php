<?php
include "../includes/adminside.php";
if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
}
echo "$id";
// Fetch post details from the database based on the ID
$result = mysqli_query($con, "SELECT * FROM menu WHERE id = $id");
$postDetails = mysqli_fetch_assoc($result);

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $action = mysqli_real_escape_string($con, $_POST['action']);

    // Update the record in the 'menu' table
    $updateQuery = mysqli_query($con, "UPDATE menu SET name='$name', action='$action' WHERE id=$id");
}

?>
<main id="main" class="main">
    <section class="section dashboard">
        <div class="col-lg-10">

            <div class="row">
                <div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-6">
                                <div class="card mt-5">
                                    <div class="card-header">
                                        <h5 class="card-title">Update Menu</h5>
                                    </div>
                                    <div class="card-body">
                                        <form action="" method="post">
                                            <div class="mb-3">
                                                <label for="name" class="form-label">Enter Name</label>
                                                <input type="text" value="<?php echo $postDetails['name']; ?>" name="name" class="form-control" id="name" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="action" class="form-label">Give Link</label>
                                                <input type="text" value="<?php echo $postDetails['action']; ?>" name="action" class="form-control" id="action" required>
                                            </div>
                                            <button type="submit" name="submit" class="btn btn-outline-primary mt-2">Update Menu</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

<?php include("footeradmin.php"); ?>

<a href="" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>