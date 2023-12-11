<?php
include "conn.php";
include "../includes/adminside.php";

// Initialize variables
$currentSection = "managecomment";

// Initialize search variables
$searchKeyword = isset($_GET['searchpost']) ? mysqli_real_escape_string($con, $_GET['searchpost']) : '';
$searchCondition = '';

// Apply search condition if a keyword is provided
if (!empty($searchKeyword)) {
  $searchCondition = "AND (comments.name LIKE '%$searchKeyword%' OR post.title LIKE '%$searchKeyword%' OR comments.comment LIKE '%$searchKeyword%' OR comments.email LIKE '%$searchKeyword%')";
}

// Fetch records with search condition
$r = mysqli_query($con, "SELECT 
        comments.id, 
        COALESCE(comments.name, 'N/A') as name, 
        COALESCE(comments.comment, 'N/A') as comment, 
        COALESCE(post.title, 'N/A') as title, 
        COALESCE(comments.email, 'N/A') as email
        FROM comments
        LEFT JOIN post ON comments.post_id = post.id
        WHERE 1 $searchCondition");

// Fetch total number of records
$totalRecordsQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM comments LEFT JOIN post ON comments.post_id = post.id WHERE 1 $searchCondition");
$totalRecordsData = mysqli_fetch_assoc($totalRecordsQuery);
$totalRecords = $totalRecordsData['total'];
?>

<div class="main mt-5">
  <div class="row mt-5" style="padding-left: 320px; padding-right: 20px;">
    <div class="container mt-5">
      <pre><h2>Search Comments</h2></pre>
    </div>

    <div class="container d-flex justify-content-end">
      <button class="btn btn-outline-primary ms-auto me-3" onclick="exportToCSV()">
        <i class="bi bi-file-earmark-text"></i> csv
      </button>
      <button class="btn btn-outline-danger" onclick="exportToExcel()">
        <i class="bi bi-file-earmark-excel"></i> excel
      </button>
    </div>
    <div class="table-responsive">
      <div class="container-fluid">
        <?php
        echo "Total Records: " . $totalRecords;
        ?>
        <form action="searchrecordcomm.php" method="GET" class="d-flex mt-2">
          <label for="search" class="visually-hidden">Search</label>
          <input class="form-control me-2" placeholder="Search" aria-label="Search" name="searchpost" id="search" value="<?php echo htmlspecialchars($searchKeyword); ?>">
          <button class="btn btn-outline-success">Search</button>
        </form>
      </div>

      <?php if ($totalRecords > 0) : ?>
        <table class="table" id="commentTable">
          <thead>
            <tr>
              <th>Sr</th>
              <th scope="col">Name</th>
              <th scope="col">Comment</th>
              <th scope="col">Post</th>
              <th scope="col">Email</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $j = 1;
            while ($run = mysqli_fetch_assoc($r)) {
            ?>
              <tr>
                <td><?php echo $j ?></td>
                <td><?php echo isset($run['name']) ? $run['name'] : ''; ?></td>
                <td><?php echo isset($run['comment']) ? $run['comment'] : ''; ?></td>
                <td><?php echo isset($run['title']) ? $run['title'] : ''; ?></td>
                <td><?php echo isset($run['email']) ? $run['email'] : ''; ?></td>
                <td><a href="deletecomment.php?delete=<?php echo $run['id']; ?>" class="btn btn-outline-danger">Delete</a></td>
              </tr>
            <?php
              $j += 1;
            }
            ?>
          </tbody>
        </table>
      <?php else : ?>
        <div class="container mt-5 text-center mb-5">
          <h3>No matching records found.</h3>
        </div>
      <?php endif; ?>

    </div>
  </div>
</div>