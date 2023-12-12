<?php
include "conn.php";
include "../includes/adminside.php";
?>

<div class="main mt-5">
    <div class="row mt-5" style="padding-left: 320px; padding-right: 20px; ">

        <div class="container mt-5 mb-3">
            <h2>Search Category</h2>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add category
            </button>
            <?php
            if (isset($_POST['submit'])) {
                $name = $_POST['name'];
                $sub = mysqli_query($con, "INSERT INTO category (name) VALUES ('$name')");
            }
            ?>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Category </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="index.php?managecategory" method="post">
                                <div class="mb-3">
                                    <label for="exampleInputPassword1" class="form-label"> Enter Category Name</label>
                                    <input type="text" name="name" class="form-control" id="exampleInputPassword1" required>
                                </div>
                                <button type="submit" name="submit" class="btn btn-outline-primary mt-2">Post Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <?php
            include("conn.php");
            // Define the number of records to display per page
            $recordsPerPage = 10;
            $currentSection = "managecategory";
            // Get the current page from the URL, default to 1 if not set
            $page = isset($_GET['page']) ? $_GET['page'] : 1;
            // Calculate the offset for the SQL query
            $offset = ($page - 1) * $recordsPerPage;

            // Check if a search query is present
            $searchQuery = isset($_GET['searchpost']) ? mysqli_real_escape_string($con, $_GET['searchpost']) : '';
            $searchCondition = $searchQuery ? "WHERE name LIKE '%$searchQuery%'" : '';

            // Fetch total number of records without search condition
            $totalRecordsQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM category $searchCondition");
            $totalRecordsData = mysqli_fetch_assoc($totalRecordsQuery);
            $totalRecords = $totalRecordsData['total'];

            // Fetch records with pagination and search condition
            $r = mysqli_query($con, "SELECT * FROM category $searchCondition ORDER BY id DESC LIMIT $offset, $recordsPerPage");
            ?>
            <div class="table-responsive">
                <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
                    <div class="text-danger">
                        <?php echo "Total records: " . $totalRecords; ?>
                    </div>
                    <form action="searchrecordcat.php" method="GET" class="d-flex">
                        <label for="search" class="visually-hidden">Search</label>
                        <input class="form-control me-2" placeholder="Search" aria-label="Search" name="searchpost" id="search" style="width: 70%;">
                        <button class="btn btn-outline-success">Search</button>
                    </form>
                </div>
                <div class="container-fluid">

                    <?php
                    if ($totalRecords > 0) {
                    } else {
                        echo '<div class="container mt-5 text-center mb-5"><h3>No matching records found.</h3></div>';
                    }
                    ?>
                </div>

                <?php
                if ($totalRecords > 0) {
                ?>
                    <table class="table">
                        <thead>
                            <tr class="bg-dark text-white">
                                <th scope="col">Sr</th>
                                <th scope="col">Category Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $j = 1;
                            while ($run = mysqli_fetch_assoc($r)) {
                            ?>
                                <tr>
                                    <td scope="row"><?php echo $j ?></td>
                                    <td><?php echo $run['name']; ?></td>
                                    <td>
                                        <a href="deletecategory.php?delete=<?php echo $run['id']; ?>"><button type="button" class="btn btn-outline-danger" name="delete">Delete</button></a>
                                        <a href="index.php?editcategory=<?php echo $run['id']; ?>"><button type="button" class="btn btn-outline-primary" name="delete">Edit</button></a>
                                    </td>
                                </tr>
                            <?php $j += 1;
                            } ?>
                        </tbody>
                    </table>

                    <!-- Pagination links -->
                    <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                        <ul class="pagination">
                            <?php
                            // Define the total number of pages based on the total number of records and records per page
                            $totalPages = ceil($totalRecords / $recordsPerPage);

                            for ($i = 1; $i <= $totalPages; $i++) : ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                    <?php
                                    // Concatenate the section name and page number in the URL
                                    $url = "?{$currentSection}&page={$i}&searchpost=" . urlencode($searchQuery);
                                    ?>
                                    <a class="page-link" href="<?php echo $url; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
                    </nav>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>