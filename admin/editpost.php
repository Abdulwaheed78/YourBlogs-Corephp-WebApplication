

    <style>
    /* Add the following style */
    #selected-files {
        display: flex;
        flex-wrap: wrap;
    }

    #drop-area {
        border: 2px dashed #4CAF50;
        border-radius: 10px;
        padding: 20px;
        width: 800px;
        text-align: center;
        font-size: 20px;
        color: #4CAF50;
        cursor: pointer;
        background-color: #f9f9f9;
    }

    .thumbnail {
        margin: 10px;
        padding: 5px;
        border: 1px solid #ccc;
        text-align: center;
        width: calc(33.333% - 20px);
        /* Adjust the width of each image to take up 33.333% of the row width, minus the margin */
        box-sizing: border-box;
        position: relative;
        /* Add this style */
    }

    .thumbnail img {
        max-width: 100px;
        max-height: 100px;
    }

    .cancel-btn {
        position: absolute;
        /* Add this style */
        top: 5px;
        /* Add this style */
        right: 5px;
        /* Add this style */
        margin-top: 5px;
        cursor: pointer;
    }
</style>
    <?php
    include("../includes/adminside.php");
    if (isset($_GET['edit'])) {
        $id = $_GET['edit'];
    }
    echo "$id";
    // Fetch post details from the database based on the ID
    $result = mysqli_query($con, "SELECT * FROM post WHERE id = $id");
    $postDetails = mysqli_fetch_assoc($result);
    ?>
    <main id="main" class="main">
        <section class="section dashboard">
            <div class="col-lg-10">

                <div class="row">
                    <div>
                        <form action="updatepost.php?edit=<?php echo $id; ?>" method="post" enctype="multipart/form-data">

                            <div class="card ">
                                <div class="card-header">
                                    <h5 class="card-title">Update Post</h5>
                                </div>
                                <div class="card-body mt-2">
                                    <h6><label for="title">Title</label></h6>
                                    <input style="width:800px;" type="text" class="form-control mb-2" name="title" required value="<?php echo isset($id) ? $postDetails['title'] : ''; ?>">
                                    <div class="mt-3 mb-3">
                                        <label for="featured_image">Select Featured Image:</label>
                                        <input type="file" id="featured_image" name="featured_image">
                                    </div>
                                    
                                    <h6> Content</h6>
                                    <textarea name="content" id="ckditor" cols="113" rows="10"><?php echo isset($id) ? $postDetails['content'] : ''; ?></textarea>
                                    

                                    <div class="col mt-3">
                                        <h6>Select Category</h6>
                                        <select style="width:800px;" class="form-select mb-3" id="inputGroupSelect01" name="category_id">
                                            <?php
                                            $categoriesResult = mysqli_query($con, "SELECT * FROM category ORDER BY id DESC ");
                                            while ($row = mysqli_fetch_assoc($categoriesResult)) {
                                            ?>
                                                <option value="<?php echo $row['id']; ?>" <?php echo (isset($id) && $row['id'] == $postDetails['category_id']) || (!isset($id) && $row['id'] == $defaultCategoryId) ? 'selected' : ''; ?>><?php echo $row['name']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div id="drop-area">
                                        Drag and drop files here
                                        <br>
                                        or
                                        <br>
                                        <input type="file" id="file-input" name="image[]" multiple>
                                    </div>
                                    <div id="selected-files" style="width: 650px; max-height: 150px; overflow: auto; margin-bottom: 30px;"></div>
                                    <div>
                                        <label for="delete_previous_images"><input type="checkbox" name="delete_previous_images" value="1"> Delete Previous Images:</label>

                                    </div>
                                    <div class="mt-3  mr-3">
                                        <button type="submit" name="post" class="btn btn-outline-primary mt-3" value=""><?php echo isset($id) ? 'Update' : 'Publish'; ?></button>
                                    </div>
                                </div>

                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main><!-- End #main -->

    <?php include("footeradmin.php"); ?>

    <a href="" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

</body>
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
