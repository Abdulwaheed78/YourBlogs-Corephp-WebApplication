<?php include"../includes/adminside.php";?>
<main id="main" class="main">
  <section class="section dashboard">
    <div class="row">
      <?php if (isset($_GET['managepost'])) { ?>
        <pre><h2>Manage Post </h2>

</pre>
        <div class="container mb-3">
          <a href="index.php?" class="btn btn-outline-primary"> Add New Post</a>
          <a href="importpost.php" class="btn btn-outline-primary"> Import Post</a>
        </div>
        <div class="table-responsive">
          <div class="container d-flex justify-content-end">
            <button class="btn btn-outline-primary me-3" onclick="exportTableToCSV('postTable.csv')">
              <i class="bi bi-file-earmark-text"></i> CSV
            </button>
            <button class="btn btn-outline-danger" onclick="exportTableToExcel('postTable.xlsx')">
              <i class="bi bi-file-earmark-excel"></i> Excel
            </button>
          </div>

          <table id="postTable" class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
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
              $r = mysqli_query($con, "SELECT post.id, post.title, post.content, post.created_at, category.name,post.image From post INNER JOIN category ON post.category_id=category.id ORDER BY post.id DESC ");
              while ($run = mysqli_fetch_assoc($r)) {
              ?>

                <tr>
                  <td scope="row"><?php echo $run['id']; ?></td>
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
              <?php } ?>
            </tbody>
          </table>
        </div>


      <?php } elseif (isset($_GET['manageimage'])) { ?>

        <pre><h2>Manage Image / Add Image</h2>

</pre>


        <div class="col-6">

          <table class="table ">
            <thead>
              <tr>

                <th scope="col">Main Carousel Images</th>
                <th scope="col">Post Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $r = mysqli_query($con, "SELECT images.id, images.image,post.title FROM images INNER JOIN post ON images.post_id=post.id");

              while ($run = mysqli_fetch_assoc($r)) {
              ?>
                <tr>

                  <td> <img src="../images/<?php echo $run['image'] ?>" class="d-block " height="50px" width="100px" alt="not found"></td>
                  <td><?php echo $run['title']; ?></td>
                  <td><a href="deleteimage.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-outline-danger" name="delete">Delete</button></td>

                </tr>
              <?php } ?>
            </tbody>
          </table>

        </div>


      <?php } elseif (isset($_GET['managecategory'])) { ?>
        <!-- manage comments section start -->

        <pre><h2>Manage Categories / Add category</h2>

  </pre>
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

        <div class="col-6">


          <table class="table ">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Category Name</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $r = mysqli_query($con, "SELECT * FROM category ORDER BY id DESC ");

              while ($run = mysqli_fetch_assoc($r)) {
              ?>
                <tr>
                  <th scope="row"><?php echo $run['id']; ?></th>
                  <td><?php echo $run['name']; ?></td>

                  <td><a href="deletecategory.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-outline-danger" name="delete">Delete</button></td>
                </tr>
              <?php } ?>
            </tbody>
          </table>

        </div>


        <!-- Manage comments section end  -->


      <?php } elseif (isset($_GET['managemenu'])) { ?>
        <pre><h2>Manage Menu / Add Menu</h2>

  </pre>
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
        <table class="table ">

          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col">Menu Name</th>
              <th scope="col">Link</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $r = mysqli_query($con, "SELECT * FROM menu ORDER BY id DESC ");

            while ($run = mysqli_fetch_assoc($r)) {
            ?>
              <tr>
                <th scope="row"><?php echo $run['id']; ?></th>
                <td><?php echo $run['name']; ?></td>
                <td><?php echo $run['action']; ?></td>
                <td>
                  <a href="deletemenu.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-outline-danger me-3" name="delete">Delete</button>
                    <a href="editmenu.php?edit=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-outline-primary" name="delete">Edit</button>
                </td>
              </tr>
            <?php } ?>
          </tbody>
        </table>



      <?php } elseif (isset($_GET['managesubmenu'])) { ?>
        <pre><h2>Manage SubMenu / Add SubMenu</h2>

  </pre>
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
        <table class="table ">

          <thead>
            <tr>
              <th scope="col">Id</th>
              <th scope="col"> Parent Menu Id</th>
              <th scope="col">Menu Name</th>
              <th scope="col">Link</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $r = mysqli_query($con, "SELECT * FROM submenu ORDER BY id DESC ");

            while ($run = mysqli_fetch_assoc($r)) {
            ?>
              <tr>
                <th scope="row"><?php echo $run['id']; ?></th>
                <td><?php echo $run['parent_menu_id']; ?></td>
                <td><?php echo $run['name']; ?></td>
                <td><?php echo $run['action']; ?></td>
                <td><a href="deletesubmenu.php?delete=<?php echo  $run['id']; ?>" <button type="button" class="btn btn-outline-danger" name="delete">Delete</button></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>



      <?php } elseif (isset($_GET['managecomment'])) { ?>
        <pre><h2>Manage Comments</h2>

</pre>

        <div class="container d-flex justify-content-end">
          <button class="btn btn-outline-primary ms-auto me-3" onclick="exportToCSV()">
            <i class="bi bi-file-earmark-text"></i> csv
          </button>
          <button class="btn btn-outline-danger" onclick="exportToExcel()">
            <i class="bi bi-file-earmark-excel"></i> excel
          </button>
        </div>


        <table class="table" id="commentTable">
          <thead>
            <tr>

              <th scope="col"> Name</th>
              <th scope="col">Comment</th>
              <th scope="col">Post</th>
              <th scope="col">Email</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $r = mysqli_query($con, "SELECT comments.id,comments.name,comments.comment,post.title,comments.email FROM comments INNER JOIN post ON comments.post_id=post.id ");

            while ($run = mysqli_fetch_assoc($r)) {
            ?>
              <tr>

                <td><?php echo $run['name']; ?></td>
                <td><?php echo $run['comment']; ?></td>
                <td><?php echo $run['title']; ?></td>
                <td><?php echo $run['email']; ?></td>
              </tr>
            <?php } ?>
          </tbody>
        </table>
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
                      <label for="featured_image">Select Featured Image:</label>
                      <input type="file" id="featured_image" name="featured_image">
                    </div>
                    <h6> Content</h6>
                    <textarea name="content" id="ckditor" cols="113" rows="10"></textarea>

                    <div class="col mt-3">
                      <h6>Select Category</h6>
                      <select style="width:800px;" class="form-select mb-3" id="inputGroupSelect01" name="category_id">
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
<script>
  function exportTableToCSV(filename) {
    var csv = [];
    var rows = document.querySelectorAll('#postTable tbody tr');

    for (var i = 0; i < rows.length; i++) {
      var row = [],
        cols = rows[i].querySelectorAll('td, th');

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