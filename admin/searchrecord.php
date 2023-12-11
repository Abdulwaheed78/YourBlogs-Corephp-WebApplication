<?php
include "conn.php";
include "../includes/adminside.php";
?>

<?php
$recordsPerPage = 10;
$currentSection = "managepost";
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $recordsPerPage;

// Initialize $totalRecords with the correct value
// Replace the following line with your query to get the total number of records
$totalRecordsQuery = mysqli_query($con, "SELECT COUNT(*) AS total FROM post");
$totalRecordsData = mysqli_fetch_assoc($totalRecordsQuery);
$totalRecords = $totalRecordsData['total'];

// Check if a search query is present
if (isset($_GET['searchpost'])) {
    $searchQuery = mysqli_real_escape_string($con, $_GET['searchpost']);

    // Check if the search query is not empty
    if (!empty($searchQuery)) {
        $sql = "SELECT post.id, post.title, post.content, post.created_at, category.name, post.image
        FROM post
        LEFT JOIN category ON post.category_id = category.id
        WHERE post.title LIKE '%$searchQuery%'
        ORDER BY post.id DESC
        LIMIT $offset, $recordsPerPage";

        // Execute the query
        $r = mysqli_query($con, $sql);

        // Fetch total records for the search query
        $totalRecordsQuery = mysqli_query($con, "SELECT COUNT(*) AS total FROM post WHERE post.title LIKE '%$searchQuery%'");
        $totalRecordsData = mysqli_fetch_assoc($totalRecordsQuery);
        $totalRecords = $totalRecordsData['total'];
    } else {
        // If search query is empty, set $totalRecords to 0
        $totalRecords = 0;
    }
} else {
    // Query without search
    $sql = "SELECT post.id, post.title, post.content, post.created_at, category.name, post.image
            FROM post
            LEFT JOIN category ON post.category_id = category.id
            ORDER BY post.id DESC
            LIMIT $offset, $recordsPerPage";

    // Execute the query
    $r = mysqli_query($con, $sql);
}

?>

<div class="main mt-5">
    <div class="row" style="padding-left: 320px; padding-right: 20px; ">
        <h2 class="mt-5 mb-5">Search Post </h2>
        <div class="container mb-3">
            <a href="index.php?" class="btn btn-outline-primary"> Add New Post</a>
            <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Import Post
            </button>
        </div>
        <!-- import Button modal -->
        <!-- ... (unchanged modal code) ... -->
        <div class="table-responsive">
            <div class="container d-flex justify-content-end">
                <button class="btn btn-outline-primary me-3" onclick="exportTableToCSV('postTable.csv')">
                    <i class="bi bi-file-earmark-text"></i> CSV
                </button>
                <button class="btn btn-outline-danger" onclick="exportTableToExcel('postTable.xlsx')">
                    <i class="bi bi-file-earmark-excel"></i> Excel
                </button>
            </div>
            <div class="container-fluid">
                <?php echo "Total records: " . $totalRecords; ?>
                <form action="searchrecord.php" method="GET" class="d-flex mt-2">
                    <label for="search" class="visually-hidden">Search</label>
                    <input class="form-control me-2" placeholder="Search" aria-label="Search" name="searchpost" id="search" value="<?php echo isset($searchQuery) ? htmlspecialchars($searchQuery) : ''; ?>">
                    <button class="btn btn-outline-success">Search</button>
                </form>

            </div>

            <?php
            // Check if there are any search results
            if (mysqli_num_rows($r) > 0) {
            ?>
                <table id="postTable" class="table">
                    <thead>
                        <tr>
                            <th scope="col">Sr</th>
                            <th scope="col">Title</th>
                            <th scope="col">Image</th>
                            <th scope="col">Content</th>
                            <th scope="col">Category</th>
                            <th scope="col">Posted</th>
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
                                <td> <a href="editpost.php?edit=<?php echo $run['id']; ?>"><?php echo $run['title']; ?></a></td>
                                <td><img src="../images/<?php echo $run['image']; ?>" height="75px" width="75px" alt="not found"></td>
                                <td>
                                    <?php
                                    $contentLines = explode("\n", $run['content']);
                                    echo implode("<br>", array_slice($contentLines, 0, 1));
                                    ?>
                                </td>
                                <td><?php echo $run['name']; ?></td>
                                <td><?php echo $run['created_at']; ?></td>
                                <td>
                                    <a href="deletepost.php?delete=<?php echo $run['id']; ?>">Delete</a>
                                    <a href="editpost.php?edit=<?php echo $run['id']; ?>">Edit</a>
                                </td>
                            </tr>
                        <?php $j += 1;
                        } ?>
                    </tbody>
                </table>
            <?php
            } else {
                // No matching records found
                echo " <div class='container mt-5 text-center mb-5'><h3>
                No matching records found in the database.
                </h3></div>";
            }
            ?>

            <!-- Pagination links -->
            <nav aria-label="Page navigation example" class="d-flex justify-content-center">
                <ul class="pagination">
                    <?php
                    $totalPages = ceil($totalRecords / $recordsPerPage);

                    for ($i = 1; $i <= $totalPages; $i++) {
                        $url = "?{$currentSection}&page={$i}";
                    ?>
                        <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                            <a class="page-link" href="<?php echo $url; ?>"><?php echo $i; ?></a>
                        </li>
                    <?php } ?>
                </ul>
            </nav>
        </div>
    </div>
</div>
<script>
    // ... (unchanged exportTableToCSV and exportTableToExcel functions) ...
</script>

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
</script>
<script>
    function exportToCSV() {
        const table = document.getElementById('commentTable');
        const rows = Array.from(table.querySelectorAll('tr'));

        const csvContent = rows.map(row => {
            const cells = Array.from(row.querySelectorAll('th,td'));
            return cells.map(cell => cell.textContent).join(',');
        }).join('\n');

        const blob = new Blob([csvContent], {
            type: 'text/csv;charset=utf-8;'
        });
        const link = document.createElement("a");
        const url = URL.createObjectURL(blob);
        link.setAttribute("href", url);
        link.setAttribute("download", "comments.csv");
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    function exportToExcel() {
        const table = document.getElementById('commentTable');
        const ws = XLSX.utils.table_to_sheet(table);
        const wb = XLSX.utils.book_new();
        XLSX.utils.book_append_sheet(wb, ws, 'Sheet 1');
        XLSX.writeFile(wb, 'comments.xlsx');
    }
</script>