<?php include "../includes/adminside.php"; ?>
<main id="main" class="main">
  <section class="section dashboard">
    <div class="row">
      <?php if (isset($_GET['managepost'])) { ?>
        <pre><h2>Manage Post </h2></pre>
        <div class="container mb-3">
          <a href="index.php?" class="btn btn-outline-primary"> Add New Post</a>
          <!--<button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Import Post
          </button>-->
        </div>
        <!-- import Button modal 
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Import Your File</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <form action="importpost.php" method="POST" enctype="multipart/form-data">
                <div class="modal-body">

                  <input type="file" name="csv_file" accept=".csv" required>


                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" name="import" class="btn btn-primary">Import</button>
                </div>
              </form>
            </div>
          </div>
        </div>-->
        <?php
        include("conn.php");

        $recordsPerPage = 10;
        $currentSection = "managepost";
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        $offset = ($page - 1) * $recordsPerPage;

        // Check if a search query is present
        if (isset($_GET['searcpost'])) {
          $searchQuery = mysqli_real_escape_string($con, $_GET['search']);
          $sql = "SELECT post.id, post.title, post.content, post.created_at, category.name, post.image
            FROM post
            LEFT JOIN category ON post.category_id = category.id
            WHERE post.title LIKE '%$searchQuery%' OR post.content LIKE '%$searchQuery%'
            ORDER BY post.id DESC
            LIMIT $offset, $recordsPerPage";
        } else {
          // Fetch total number of records
          $totalRecordsQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM post");
          $totalRecordsData = mysqli_fetch_assoc($totalRecordsQuery);
          $totalRecords = $totalRecordsData['total'];

          // Fetch records with pagination
          $sql = "SELECT post.id, post.title, post.content, post.created_at, category.name, post.image
            FROM post
            LEFT JOIN category ON post.category_id = category.id
            ORDER BY post.id DESC
            LIMIT $offset, $recordsPerPage";
        }

        // Execute the query
        $r = mysqli_query($con, $sql);
        ?>

        <!-- Rest of your HTML code for displaying the table, search form, and pagination -->


        <div class="table-responsive">
          <!-- HTML buttons for CSV and Excel exports -->
          <!--<div class="container d-flex justify-content-end">
            <button class="btn btn-outline-primary me-3" onclick="exportDBToCSV()">
              <i class="bi bi-file-earmark-text"></i> Export to CSV
            </button>

            <button class="btn btn-outline-danger" onclick="exportDBToExcel()">
              <i class="bi bi-file-earmark-excel"></i> Export to Excel
            </button>
          </div>-->

          <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
            <div class="text-danger">
              <?php echo "Total records: " . $totalRecords; ?>
            </div>
            <form action="searchrecord.php" method="GET" class="d-flex">
              <label for="search" class="visually-hidden">Search</label>
              <input class="form-control me-2" placeholder="Search" aria-label="Search" name="searchpost" id="search" style="width: 70%;">
              <button class="btn btn-outline-success">Search</button>
            </form>
          </div>



          <table id="postTable" class="table">
            <thead>
              <tr class="bg-dark  text-white">
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
          <!-- Pagination links -->
          <nav aria-label="Page navigation example" class="d-flex justify-content-center">
            <ul class="pagination">
              <?php
              $totalPages = ceil($totalRecords / $recordsPerPage); // Define the total number of pages based on the total number of records and records per page

              for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                  <?php
                  $url = "?{$currentSection}&page={$i}"; // Concatenate the section name and page number in the URL
                  ?>
                  <a class="page-link" href="<?php echo $url; ?>"><?php echo $i; ?></a>
                </li>
              <?php endfor; ?>
            </ul>
          </nav>
        </div>


      <?php } elseif (isset($_GET['manageimage'])) { ?>

        <pre><h2>Manage Image / Add Image</h2></pre>
        <div class="col-12">
          <?php
          include("conn.php");
          $recordsPerPage = 10; // Define the number of records to display per page
          $currentSection = "manageimage";          // Get the current page from the URL, default to 1 if not set
          $page = isset($_GET['page']) ? $_GET['page'] : 1;
          $offset = ($page - 1) * $recordsPerPage; // Calculate the offset for the SQL query

          // Fetch total number of records
          $totalRecordsQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM images");
          $totalRecordsData = mysqli_fetch_assoc($totalRecordsQuery);
          $totalRecords = $totalRecordsData['total'];

          // Fetch records with pagination
          $r = mysqli_query($con, "SELECT images.id, images.image, post.title FROM images INNER JOIN post ON images.post_id = post.id ORDER BY images.id DESC LIMIT $offset, $recordsPerPage");
          ?>
          <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
            <div class="text-danger">
              <?php echo "Total records: " . $totalRecords; ?>
            </div>
            <form action="searchrecordim.php" method="GET" class="d-flex">
              <label for="search" class="visually-hidden">Search</label>
              <input class="form-control me-2" placeholder="Search" aria-label="Search" name="searchpost" id="search" style="width: 70%;">
              <button class="btn btn-outline-success">Search</button>
            </form>
          </div>
          <table class="table">
            <thead>
              <tr class="bg-dark  text-white">
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
                  <td><a href="deleteimage.php?delete=<?php echo  $run['id']; ?>"><button type="button" class="btn btn-outline-danger" name="delete">Delete</button></a>
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
              // Define the total number of pages based on the total number of records and records per page
              $totalPages = ceil($totalRecords / $recordsPerPage);

              for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                  <?php
                  // Concatenate the section name and page number in the URL
                  $url = "?{$currentSection}&page={$i}";
                  ?>
                  <a class="page-link" href="<?php echo $url; ?>"><?php echo $i; ?></a>
                </li>
              <?php endfor; ?>
            </ul>
          </nav>
        </div>
    </div>
  <?php } elseif (isset($_GET['editimage'])) { ?>
    <?php if (isset($_GET['editimage'])) {
          $id = $_GET['editimage'];
          $getdata = mysqli_query($con, "SELECT * FROM images where id=$id");
        } ?>
    <pre><h2>Edit Image</h2></pre>
    <div class="container">
      <form action="editimage.php" method="POST" enctype="multipart/form-data">
        <div>
          <?php echo $id ?>
          <input type="hidden" name="id" value="<?php echo $id ?>">
          <label for="new image">Choose New Image</label>
          <input type="file" class form-control name="image">
          <button class="btn btn-outline-primary" name="updateimage">Update</button>
        </div>
      </form>
    </div>
  <?php } elseif (isset($_GET['managecategory'])) { ?>
    <!-- manage comments section start -->
    <pre><h2>Manage Categories / Add category</h2></pre>
    <div class="container mb-3">
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

        // Fetch total number of records
        $totalRecordsQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM category");
        $totalRecordsData = mysqli_fetch_assoc($totalRecordsQuery);
        $totalRecords = $totalRecordsData['total'];

        // Fetch records with pagination
        $r = mysqli_query($con, "SELECT * FROM category ORDER BY id DESC LIMIT $offset, $recordsPerPage");
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
        <table class="table">
          <thead>
            <tr class="bg-dark  text-white">
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
                $url = "?{$currentSection}&page={$i}";
                ?>
                <a class="page-link" href="<?php echo $url; ?>"><?php echo $i; ?></a>
              </li>
            <?php endfor; ?>
          </ul>
        </nav>
      </div>
    </div>
    <!-- Manage comments section end  -->
  <?php } elseif (isset($_GET['editcategory'])) { ?>
    <?php
        if (isset($_GET['editcategory'])) {
          $catid = $_GET['editcategory'];
          $fetchcat = mysqli_query($con, "SELECT * FROM Category WHERE id=$catid");
          // Fetch the data from the result set
          $fetchcat_data = mysqli_fetch_assoc($fetchcat);
        }
    ?>
    <div class="container">
      <h5 class="modal-title" id="exampleModalLabel">Edit Category </h5>
      <div class="card-body w-50 mt-5 justify-content-center">
        <form action="updatecategory.php" method="POST">
          <div class="mb-3">
            <input type="hidden" name="id" value="<?php echo $catid ?>">
            <label for="exampleInputPassword1" class="form-label"> Enter Category Name</label>
            <input type="text" name="name" value="<?php echo $fetchcat_data['name']; ?>" class="form-control" id="exampleInputPassword1" required>
          </div>
          <button type="submit" name="updatecat" class="btn btn-outline-primary mt-2">Update Category</button>
        </form>
      </div>
    </div>

  <?php } elseif (isset($_GET['managemenu'])) { ?>
    <pre><h2>Manage Menu / Add Menu</h2></pre>
    <div class="container mb-3">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add New Menu
      </button>
      <?php
        if (isset($_POST['submit'])) {
          $name = mysqli_real_escape_string($con, $_POST['name']);
          $action = mysqli_real_escape_string($con, $_POST['action']);
          $sub = mysqli_query($con, "INSERT INTO menu (name,action) VALUES ('$name','$action')");
        }
      ?>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add Menu </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="index.php?managemenu" method="post">
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label"> Enter Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                  <label for="exampleInputPassword1" class="form-label"> Give Link</label>
                  <input type="text" name="action" class="form-control" id="exampleInputPassword1" required>
                </div>
                <button type="submit" name="submit" class="btn btn-outline-primary mt-2">Post Menu</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <table class="table mt-5 ">
      <thead>
        <tr class="bg-dark  text-white">
          <th scope="col">Sr</th>
          <th scope="col">Menu Name</th>
          <th scope="col">Link</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $r = mysqli_query($con, "SELECT * FROM menu ORDER BY id DESC ");
        $j = 1;
        while ($run = mysqli_fetch_assoc($r)) {
        ?>
          <tr>
            <td scope="row"><?php echo $j ?></td>
            <td><?php echo $run['name']; ?></td>
            <td><?php echo $run['action']; ?></td>
            <td>
              <a href="deletemenu.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-outline-danger me-3" name="delete">Delete</button>
                <a href="editmenu.php?edit=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-outline-primary" name="delete">Edit</button>
            </td>
          </tr>
        <?php $j += 1;
        } ?>
      </tbody>
    </table>

  <?php } elseif (isset($_GET['managesubmenu'])) { ?>
    <pre><h2>Manage SubMenu / Add SubMenu</h2></pre>
    <div class="container mb-3">
      <!-- Button trigger modal -->
      <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Add New SubMenu
      </button>
      <?php
        if (isset($_POST['submit'])) {
          $parentid = mysqli_real_escape_string($con, $_POST['parent_menu_id']);
          $name = mysqli_real_escape_string($con, $_POST['name']);
          $action = mysqli_real_escape_string($con, $_POST['action']);
          $sub = mysqli_query($con, "INSERT INTO submenu (parent_menu_id,name,action) VALUES ($parentid,'$name','$action')");
        }
      ?>
      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Add SubMenu </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form action="index.php?managesubmenu" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                  <label class="form-label"> Enter SubmMenu Name</label>
                  <input type="text" name="name" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                  <label class="form-label"> Enter action Name</label>
                  <input type="text" name="action" class="form-control" id="exampleInputPassword1" required>
                </div>
                <div class="mb-3">
                  <h6>Select Menu</h6>
                  <select class="form-select" id="inputGroupSelect01" name="parent_menu_id">
                    <?php
                    $r = mysqli_query($con, "SELECT * FROM menu ORDER BY id DESC ");
                    while ($row = mysqli_fetch_assoc($r)) { ?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
                <button type="submit" name="submit" class="btn btn-outline-primary mt-2">Post SubMenu</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <table class="table mt-5">
      <thead>
        <tr class="bg-dark  text-white">
          <th scope="col">Sr</th>
          <th scope="col"> Parent Menu</th>
          <th scope="col">Menu Name</th>
          <th scope="col">Link</th>
          <th scope="col">Action</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $r = mysqli_query($con, "SELECT * FROM submenu ORDER BY id DESC ");
        $j = 1;
        while ($run = mysqli_fetch_assoc($r)) {
          // Fetch the parent menu name
          $parentMenuId = $run['parent_menu_id'];
          $menuQuery = mysqli_query($con, "SELECT name FROM menu WHERE id = $parentMenuId");
          $menuResult = mysqli_fetch_assoc($menuQuery);
          $parentMenuName = $menuResult['name'];

          // Display the data in the table
        ?>
          <tr>
            <th scope="row"><?php echo $j ?></th>
            <td><?php echo $parentMenuName;; ?></td>
            <td><?php echo $run['name']; ?></td>
            <td><?php echo $run['action']; ?></td>
            <td>
              <a href="deletesubmenu.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-outline-danger me-2" name="delete">Delete</button>
                <a href="index.php?editsub=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-outline-primary" name="delete">Edit</button>
            </td>
          </tr>
        <?php $j += 1;
        } ?>
      </tbody>
    </table>
  <?php } elseif (isset($_GET['editsub'])) { ?>
    <pre><h2>Edit Submenu</h2></pre>
    <?php
        if (isset($_GET['editsub'])) {
          $subid = $_GET['editsub'];
          $query = mysqli_query($con, "SELECT * FROM submenu Where id=$subid");
          $result = mysqli_fetch_assoc($query);
        }
    ?>
    <div class="container mt-5">
      <div class="card-body w-50">
        <form action="updatesubmenu.php" method="POST">
          <input type="hidden" name="id" value="<?php echo $subid ?>">
          <div class="mb-3">
            <label class="form-label">SubmMenu Name</label>
            <input type="text" name="name" value="<?php echo $result['name'] ?>" class="form-control" id="exampleInputPassword1" required>
          </div>
          <div class="mb-3">
            <label class="form-label"> Enter action Name</label>
            <input type="text" name="action" value="<?php echo $result['action'] ?>" class="form-control" id="exampleInputPassword1" required>
          </div>
          <div class="mb-3">
            <h6>Select Menu</h6>
            <select class="form-select" id="inputGroupSelect01" name="parent_menu_id">
              <?php
              $r = mysqli_query($con, "SELECT * FROM menu ORDER BY id DESC ");
              while ($row = mysqli_fetch_assoc($r)) {
                $selected = ($row['id'] == $result['parent_menu_id']) ? 'selected' : '';
              ?>
                <option value="<?php echo $row['id']; ?>" <?php echo $selected; ?>>
                  <?php echo $row['name']; ?>
                </option>
              <?php } ?>
            </select>
          </div>

          <button type="submit" name="updatesub" class="btn btn-outline-primary mt-2">Update SubMenu</button>
        </form>
      </div>
    </div>
  <?php } elseif (isset($_GET['managecomment'])) { ?>
    <pre><h2>Manage Comments</h2></pre>
    <?php
        include("conn.php");
        // Define the number of records to display per page
        $recordsPerPage = 10;
        $currentSection = "managecomment";
        // Get the current page from the URL, default to 1 if not set
        $page = isset($_GET['page']) ? $_GET['page'] : 1;
        // Fetch total number of records
        $totalRecordsQuery = mysqli_query($con, "SELECT COUNT(*) as total FROM comments");
        $totalRecordsData = mysqli_fetch_assoc($totalRecordsQuery);
        $totalRecords = $totalRecordsData['total'];
        // Calculate the offset for the SQL query
        $offset = ($page - 1) * $recordsPerPage;
        // Fetch records with pagination only if there are records
        if ($totalRecords > 0) {
          $r = mysqli_query($con, "SELECT 
          comments.id, 
          COALESCE(comments.name, 'N/A') as name, 
          COALESCE(comments.comment, 'N/A') as comment, 
          COALESCE(post.title, 'N/A') as title, 
          COALESCE(comments.email, 'N/A') as email
          FROM comments
          LEFT JOIN post ON comments.post_id = post.id
          LIMIT $offset, $recordsPerPage");
        }
    ?>
    <div class="table-responsive">
      <div class="d-flex justify-content-between align-items-center mt-5 mb-3">
        <div class="text-danger">
          <button class="btn btn-outline-primary me-3" onclick="exportDBToCSV()">
            <i class="bi bi-file-earmark-text"></i> CSV
          </button>

          <button class="btn btn-outline-danger" onclick="exportDBToExcel()">
            <i class="bi bi-file-earmark-excel"></i> Excel
          </button>
          <?php echo "Total records: " . $totalRecords; ?>
        </div>
        <form action="searchrecordcomm.php" method="GET" class="d-flex">
          <label for="search" class="visually-hidden">Search</label>
          <input class="form-control me-2" placeholder="Search" aria-label="Search" name="searchpost" id="search" style="width: 70%;">
          <button class="btn btn-outline-success">Search</button>
        </form>
      </div>
      <table class="table" id="commentTable">
        <thead>
          <tr class="bg-dark  text-white">
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
          if ($totalRecords > 0) {
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
          } else {
            // Display a message if there are no records
            echo '<tr><td colspan="5">No comments found</td></tr>';
          }
          ?>
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
              $url = "?{$currentSection}&page={$i}";
              ?>
              <a class="page-link" href="<?php echo $url; ?>"><?php echo $i; ?></a>
            </li>
          <?php endfor; ?>
        </ul>
      </nav>
    </div>
  <?php } elseif (isset($_GET['error404'])) { ?>
    <main>
      <div class="container">
        <section class="section error-404 min-vh-100 d-flex flex-column align-items-center justify-content-center">
          <h1>404</h1>
          <h2>The page you are looking for doesn't exist.</h2>
          <a class="btn" href="index.php">Back to home</a>
          <img src="assets/img/not-found.svg" class="img-fluid py-5" alt="Page Not Found">
        </section>
      </div>
    </main><!-- End #main -->
  <?php } else { ?>
    <div class="col-lg-10">
      <div class="row">
        <div>
          <form action="index2.php?" method="post" enctype="multipart/form-data">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Write New Post Here</h5>
              </div>
              <div class="card-body">
                <h6><label for="title">Title</label></h6>
                <input style="width:800px;" type="text" class="form-control mb-2" name="title" required>
                <div class="mt-3 mb-3">
                  <label for="featured_image">Select Featured Image: size not more then 2 MB</label>
                  <input type="file" required id="featured_image" name="featured_image">
                </div>
                <h6> Content</h6>
                <textarea name="content" id="ckditor" cols="113" rows="10"></textarea>
                <div class="col mt-3">
                  <h6>Select Category</h6>
                  <select style="width:800px;" class="form-select mb-3" required id="inputGroupSelect01" name="category_id">
                    <?php
                    $r = mysqli_query($con, "SELECT * FROM category ORDER BY id DESC ");
                    while ($row = mysqli_fetch_assoc($r)) { ?>
                      <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
                    <?php } ?>
                    <option selected>Choose...</option>
                  </select>
                </div>
                <div id="drop-area">
                  Drag and drop files here
                  <br>
                  or
                  <br>
                  <input type="file" id="file-input" name="image[]" multiple>
                </div>
                <div id="selected-files" style="width:650px; max-height:150px; overflow: auto; margin-bottom: 30px;"></div>
                <div class="mt-3 mr-3">
                  <button type="submit" name="post" class="btn btn-outline-primary mt-3" value="">Publish</button>
                </div>
              </div>
          </form>
        </div>
      </div>
    </div>
    </div>
    <!-- Left side columns -->
  <?php } ?>
  </div>
  <!-- End Left side columns -->
  </div>
  </section>
</main><!-- End #main -->
<?php include("footeradmin.php"); ?>
</body>
<!-- JavaScript functions for CSV and Excel exports -->
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

<script>
  // Add event listener to handle when files are dropped into the drop area
  document.getElementById('drop-area').addEventListener('drop', handleDrop, false);

  // Prevent default actions on drag over
  document.getElementById('drop-area').addEventListener('dragover', handleDragOver, false);

  // Add event listener to handle when files are selected from the file input
  document.getElementById('file-input').addEventListener('change', handleFileSelect, false);

  // Function to handle the drop event
  function handleDrop(e) {
    e.preventDefault(); // Prevent default actions
    e.stopPropagation(); // Stop event propagation

    var files = e.dataTransfer.files; // Access files from the data transfer object
    handleFiles(files);
  }

  // Function to handle the drag over event
  function handleDragOver(e) {
    e.preventDefault(); // Prevent default actions
    e.stopPropagation(); // Stop event propagation
  }

  // Function to handle the file selection event
  function handleFileSelect(e) {
    var files = e.target.files; // Access files from the input element
    handleFiles(files);
  }

  // Function to process the selected files
  function handleFiles(files) {
    var selectedFiles = document.getElementById('selected-files');
    selectedFiles.innerHTML = '';

    for (var i = 0; i < files.length; i++) {
      var file = files[i];

      // Check if the file is an image
      if (!file.type.match('image.*')) continue;

      // Create a thumbnail and a cancel button for the image
      var thumbnail = document.createElement('div');
      thumbnail.className = 'thumbnail';
      var img = document.createElement('img');
      img.file = file;
      img.src = URL.createObjectURL(file);
      thumbnail.appendChild(img);
      var cancelBtn = document.createElement('span');
      cancelBtn.textContent = 'x';
      cancelBtn.className = 'cancel-btn';
      cancelBtn.onclick = function(e) {
        var imgDiv = this.parentElement;
        var img = imgDiv.querySelector('img');
        imgDiv.parentElement.removeChild(imgDiv);
        URL.revokeObjectURL(img.src);
      };
      thumbnail.appendChild(cancelBtn);

      // Add the thumbnail to the selected-files div
      selectedFiles.appendChild(thumbnail);
    }
  }
</script>

<script type="text/javascript">
  // Initialize CKEditor
  CKEDITOR.replace('content', {

    width: "800px",
    height: "200px"

  });
</script>