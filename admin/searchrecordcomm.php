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
    <div class="table-responsive">
      <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <div class="text-danger">
          <button class="btn btn-outline-primary me-3" onclick="exportDBToCSV()">
            <i class="bi bi-file-earmark-text"></i> CSV
          </button>

          <button class="btn btn-outline-danger" onclick="exportDBToExcel()">
            <i class="bi bi-file-earmark-excel"></i> Excel
          </button>
          <?php echo "Total records: " . $totalRecords; ?>  | <a href="index.php?managecomment">Reset search</a>
        </div>
        <form action="searchrecordcomm.php" method="GET" class="d-flex">
          <label for="search" class="visually-hidden">Search</label>
          <input class="form-control me-2" placeholder="Search" aria-label="Search" name="searchpost" id="search" style="width: 70%;">
          <button class="btn btn-outline-success">Search</button>
        </form>

      </div>

      <?php if ($totalRecords > 0) : ?>
        <table class="table" id="commentTable">
          <thead>
            <tr class="bg-dark text-white">
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
<script>
  function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll('#postTable tbody tr');

    // Get table header elements
    var header = Array.from(document.querySelectorAll('#postTable thead th')).map(th => th.innerText);
    csv.push(header.join(','));

    for (var i = 0; i < rows.length; i++) {
      var row = [],
        cols = rows[i].querySelectorAll('td');

      for (var j = 0; j < cols.length; j++) {
        if (j === 5) {
          // Handle the "Posted On" date separately
          var postedOnDate = new Date(cols[j].innerText);
          row.push(postedOnDate.toLocaleString());
        } else {
          row.push(cols[j].innerText);
        }
      }

      csv.push(row.join(','));
    }

    downloadCSV(csv.join('\n'), filename);
  }

  function downloadCSV(csv, filename) {
    var csvFile;
    var downloadLink;

    csvFile = new Blob([csv], {
      type: 'text/csv'
    });
    downloadLink = document.createElement('a');
    downloadLink.download = filename;
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = 'none';
    document.body.appendChild(downloadLink);
    downloadLink.click();
  }

  function exportTableToExcel(filename) {
    var table = document.getElementById('postTable');
    var ws = XLSX.utils.table_to_sheet(table);
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet 1');
    XLSX.writeFile(wb, filename);
  }

  function exportDBToCSV() {
    // Adjust the URL based on the location of your server-side script
    var exportUrl = 'exportcom.php?type=csv';

    // Trigger a GET request to the server-side script
    fetch(exportUrl)
      .then(response => response.text())
      .then(csv => downloadCSV(csv, 'database_records.csv'))
      .catch(error => console.error('Error:', error));
  }

  function exportDBToExcel() {
    // Adjust the URL based on the location of your server-side script for Excel
    var exportUrl = 'exportcom.php?type=excel';

    // Trigger a GET request to the server-side script for Excel
    fetch(exportUrl)
      .then(response => response.blob())
      .then(blob => downloadBlob(blob, 'database_records.xlsx'))
      .catch(error => console.error('Error:', error));
  }

  function downloadBlob(blob, filename) {
    var link = document.createElement('a');
    link.href = window.URL.createObjectURL(blob);
    link.download = filename;
    link.style.display = 'none';
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
  }
</script>