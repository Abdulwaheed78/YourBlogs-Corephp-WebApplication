<?php
include "conn.php";
include "../includes/adminside.php";
?>

<?php
include("conn.php");

$recordsPerPage = 10;
$currentSection = "manageimage";
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Fetch total number of records
$totalRecordsQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM images");
$totalRecordsData = mysqli_fetch_assoc($totalRecordsQuery);
$totalRecords = $totalRecordsData['total'];

// Check if a search query is present
if (isset($_GET['searchpost'])) {
    $searchQuery = mysqli_real_escape_string($con, $_GET['searchpost']);
    $sql = "SELECT images.id, images.image, post.title 
            FROM images 
            INNER JOIN post ON images.post_id = post.id 
            WHERE post.title LIKE '%$searchQuery%' 
            ORDER BY images.id DESC";
} else {
    // Fetch records with pagination (without search)
    $sql = "SELECT images.id, images.image, post.title 
            FROM images 
            INNER JOIN post ON images.post_id = post.id 
            ORDER BY images.id DESC 
            LIMIT $offset, $recordsPerPage";
}

$r = mysqli_query($con, $sql);

// Calculate total records after applying search
$totalRecords = mysqli_num_rows($r);

// Adjust offset for pagination
$offset = ($page - 1) * $recordsPerPage;

// Fetch records with pagination
$r = mysqli_query($con, "$sql LIMIT $offset, $recordsPerPage");
?>

<div class="main mt-5">
    <div class="row" style="padding-left: 320px; padding-right: 20px; ">
        <h2 class="mt-5 mb-5">Manage Image / Add Image</h2>
        <div class="col-12">
            <div class="table-responsive">
                <div class="container-fluid">
                    <?php echo "Total records: " . $totalRecords; ?>
                    <form action="searchrecordim.php" method="GET" class="d-flex mt-2">
                        <label for="search" class="visually-hidden">Search</label>
                        <input class="form-control me-2" placeholder="Search" aria-label="Search" name="searchpost" id="search" value="<?php echo isset($searchQuery) ? htmlspecialchars($searchQuery) : ''; ?>">
                        <button class="btn btn-outline-success">Search</button>
                    </form>
                </div>

                <?php
                // Check if there are any search results
                if ($totalRecords > 0) {
                ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sr</th>
                                <th scope="col">Images</th>
                                <th scope="col">Post Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $j = 1;
                            while ($run = mysqli_fetch_assoc($r)) {
                            ?>
                                <tr>
                                    <td><?php echo $j ?></td>
                                    <td> <img src="../images/<?php echo $run['image'] ?>" class="d-block " height="50px" width="100px" alt="not found"></td>
                                    <td><?php echo $run['title']; ?></td>
                                    <td>
                                        <a href="deleteimage.php?delete=<?php echo  $run['id']; ?>"><button type="button" class="btn btn-outline-danger" name="delete">Delete</button></a>
                                        <a href="index.php?editimage=<?php echo  $run['id']; ?>"><button type="button" class="btn btn-outline-primary" name="delete">Edit</button></a>
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
                            $totalPages = ceil($totalRecords / $recordsPerPage);

                            for ($i = 1; $i <= $totalPages; $i++) {
                                $url = "?{$currentSection}&page={$i}&searchpost=" . urlencode($searchQuery);
                            ?>
                                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                                    <a class="page-link" href="<?php echo $url; ?>"><?php echo $i; ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    </nav>
                <?php
                } else {
                    // No matching records found
                    echo '<div class="container mt-5 text-center mb-5"><h3>No matching records found.</h3></div>';
                }
                ?>
            </div>
        </div>
    </div>
</div>
