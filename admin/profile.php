<?php include "../includes/adminside.php"; ?>
<main id="main" class="main">

  <div class="pagetitle">
    <h1>Profile</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Profile</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section profile">
    <div class="row">
      <div class="col-xl-4">

        <div class="card">
          <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
            <!-- Display user profile image or default image if not available -->
            <?php if (!empty($len['profileimage'])) : ?>
              <img src="<?php echo $len['profileimage']; ?>" alt="Profile" class="rounded-circle">
            <?php else : ?>
              <img src="assets/img/profile-img.jpg" alt="Default Profile" class="rounded-circle">
            <?php endif; ?>

            <h2><?= $len['full_name']; ?></h2>
            <h3><?= $len['job']; ?></h3>
            <div class="social-links mt-2">
              <a href="<?= $len['twitter_profile']; ?>" class="twitter"><i class="bi bi-twitter"></i></a>
              <a href="<?= $len['facebook_profile']; ?>" class="facebook"><i class="bi bi-facebook"></i></a>
              <a href="<?= $len['instagram_profile']; ?>" class="instagram"><i class="bi bi-instagram"></i></a>
              <a href="<?= $len['linkedin_profile']; ?>" class="linkedin"><i class="bi bi-linkedin"></i></a>
            </div>
          </div>
        </div>

      </div>

      <div class="col-xl-8">

        <div class="card">
          <div class="card-body pt-3">
            <!-- Bordered Tabs -->
            <ul class="nav nav-tabs nav-tabs-bordered">

              <li class="nav-item">
                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
              </li>

              <li class="nav-item">
                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
              </li>

            </ul>
            <div class="tab-content pt-2">

              <div class="tab-pane fade show active profile-overview" id="profile-overview">
                <h5 class="card-title">About</h5>
                <p class="small fst-italic"><?= $len['about']; ?></p>

                <h5 class="card-title">Profile Details</h5>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label ">Full Name</div>
                  <div class="col-lg-9 col-md-8"><?= $len['full_name']; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Company</div>
                  <div class="col-lg-9 col-md-8"><?= $len['about_company']; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Job</div>
                  <div class="col-lg-9 col-md-8"><?= $len['job']; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Country</div>
                  <div class="col-lg-9 col-md-8"><?= $len['country']; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Address</div>
                  <div class="col-lg-9 col-md-8"><?= $len['address']; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Phone</div>
                  <div class="col-lg-9 col-md-8"><?= $len['phone']; ?></div>
                </div>

                <div class="row">
                  <div class="col-lg-3 col-md-4 label">Email</div>
                  <div class="col-lg-9 col-md-8"><?= $len['email']; ?></div>
                </div>

              </div>

              <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                <!-- Profile Edit Form -->
                <form action="" method="POST" enctype="multipart/form-data">
                  <div class="row mb-3">
                    <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile Image</label>
                    <div class="col-md-8 col-lg-9">
                      <!-- Display user profile image or default image if not available -->
                      <?php if (!empty($len['profileimage'])) : ?>
                        <img src="<?php echo $len['profileimage']; ?>" alt="Profile" class="img-thumbnail">
                      <?php else : ?>
                        <img src="assets/img/profile-img.jpg" alt="Default Profile" class="img-thumbnail">
                      <?php endif; ?>
                      <!-- Image preview container -->
                      <div id="imagePreviewContainer"></div>

                      <div class="pt-2">
                        <a href="#" class="btn btn-primary btn-sm" title="Upload new profile image" onclick="chooseFile()">
                          <i class="bi bi-upload"></i>
                        </a>
                        <!-- Hidden file input -->
                        <input type="file" id="fileInput" style="display: none;" name="fileInput" accept="image/*" onchange="displayImagePreview()">
                        <a href="deleteimg.php?delete=<?= $len['id']; ?>" class="btn btn-danger btn-sm" title="Remove my profile image"><i class="bi bi-trash"></i></a>
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Full Name</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="fullName" type="text" class="form-control" id="fullName" value="<?= $len['full_name']; ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="about" class="col-md-4 col-lg-3 col-form-label">About</label>
                    <div class="col-md-8 col-lg-9">
                      <textarea name="about" class="form-control" id="about" style="height: 100px"><?= $len['about']; ?></textarea>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="company" class="col-md-4 col-lg-3 col-form-label">Company</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="company" type="text" class="form-control" id="company" value="<?= $len['about_company']; ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Job" class="col-md-4 col-lg-3 col-form-label">Job</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="job" type="text" class="form-control" id="Job" value="<?= $len['job']; ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Country" class="col-md-4 col-lg-3 col-form-label">Country</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="country" type="text" class="form-control" id="Country" value="<?= $len['country']; ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Address" class="col-md-4 col-lg-3 col-form-label">Address</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="address" type="text" class="form-control" id="Address" value="<?= $len['address']; ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Phone" class="col-md-4 col-lg-3 col-form-label">Phone</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="phone" type="text" class="form-control" id="Phone" value="<?= $len['phone']; ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="email" type="email" class="form-control" id="Email" value="<?= $len['email']; ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Twitter" class="col-md-4 col-lg-3 col-form-label">Twitter Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="twitter" type="text" class="form-control" id="Twitter" value="<?= $len['twitter_profile']; ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Facebook" class="col-md-4 col-lg-3 col-form-label">Facebook Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="facebook" type="text" class="form-control" id="Facebook" value="<?= $len['facebook_profile']; ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Instagram" class="col-md-4 col-lg-3 col-form-label">Instagram Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="instagram" type="text" class="form-control" id="Instagram" value="<?= $len['instagram_profile']; ?>">
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="Linkedin" class="col-md-4 col-lg-3 col-form-label">Linkedin Profile</label>
                    <div class="col-md-8 col-lg-9">
                      <input name="linkedin" type="text" class="form-control" id="Linkedin" value="<?= $len['linkedin_profile']; ?>">
                    </div>
                  </div>

                  <div class="text-center">
                    <button type="submit" value="update" name="update" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End Profile Edit Form -->
              </div>

              <div class="tab-pane fade pt-3" id="profile-settings">
                <!-- Settings Form -->
                <form>
                  <div class="row mb-3">
                    <label for="fullName" class="col-md-4 col-lg-3 col-form-label">Email Notifications</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="changesMade" checked>
                        <label class="form-check-label" for="changesMade">
                          Changes made to your account
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="newProducts" checked>
                        <label class="form-check-label" for="newProducts">
                          Information on new products and services
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="proOffers">
                        <label class="form-check-label" for="proOffers">
                          Marketing and promo offers
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="securityNotify" checked disabled>
                        <label class="form-check-label" for="securityNotify">
                          Security alerts
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="text-center">
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                  </div>
                </form><!-- End settings Form -->
              </div>
              <div class="tab-pane fade pt-3" id="profile-change-password">
                <!-- Change Password Form -->
                <form action="" method="post">
                  <!-- Current Password -->
                  <div class="row mb-3">
                    <label for="currentPassword" class="col-md-4 col-lg-3 col-form-label">Current Password</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="input-group">
                        <input name="currentpassword" type="password" class="form-control" id="currentPassword" value="<?= $len['password_hash']; ?>">
                        <button type="button" class="btn btn-outline-secondary" id="toggleCurrentPassword">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- New Password -->
                  <div class="row mb-3">
                    <label for="newPassword" class="col-md-4 col-lg-3 col-form-label">New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="input-group">
                        <input name="newpassword" type="password" class="form-control" id="newPassword">
                        <button type="button" class="btn btn-outline-secondary" id="toggleNewPassword">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- Re-enter New Password -->
                  <div class="row mb-3">
                    <label for="renewpassword" class="col-md-4 col-lg-3 col-form-label">Re-enter New Password</label>
                    <div class="col-md-8 col-lg-9">
                      <div class="input-group">
                        <input name="renewpassword" type="password" class="form-control" id="renewPassword">
                        <button type="button" class="btn btn-outline-secondary" id="toggleRenewPassword">
                          <i class="bi bi-eye"></i>
                        </button>
                      </div>
                    </div>
                  </div>
                  <!-- Change Password Button -->
                  <div class="text-center">
                    <button type="submit" name="change" value="change" class="btn btn-primary">Change Password</button>
                  </div>
                </form><!-- End Change Password Form -->
              </div>
            </div><!-- End Bordered Tabs -->

          </div>
        </div>

      </div>
    </div>
  </section>
  <?php
  //updating thw user password
  if (isset($_POST['change'])) {
    // Retrieve form data
    $currentPassword =  $_POST['currentpassword'];
    $newPassword = $_POST['newpassword'];
    $renewPassword = $_POST['renewpassword'];

    $userId = $len['id']; // Replace with your actual user ID
    $query = mysqli_fetch_assoc(mysqli_query($con, "SELECT password_hash FROM users WHERE id = $userId"));

    //  echo"$query[password_hash]";

    if ($currentPassword == $query['password_hash'] && $newPassword === $renewPassword) {
      $newhash = $newPassword;
      $updatequery = mysqli_query($con, "UPDATE users SET password_hash='$newhash' WHERE id=$userId");
      if ($updatequery) {
        echo '<script>window.location.reload();</script>';
      } else {
        echo "sorry some error";
      }
    }
    // Close the database connection
    mysqli_close($con);
  }
  ?>

  <?php
  if (isset($_POST['update'])) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Retrieve form data
      $fullName = $_POST['fullName'];
      $about = $_POST['about'];
      $company = $_POST['company'];
      $job = $_POST['job'];
      $country = $_POST['country'];
      $address = $_POST['address'];
      $phone = $_POST['phone'];
      $email = $_POST['email'];
      $twitter = $_POST['twitter'];
      $facebook = $_POST['facebook'];
      $instagram = $_POST['instagram'];
      $linkedin = $_POST['linkedin'];

      // Check if a new file is uploaded
      if ($_FILES["fileInput"]["size"] > 0) {
        // Handle file upload
        $targetDir = "../images/";
        $targetFile = $targetDir . time() . '_' . basename($_FILES["fileInput"]["name"]);
        $uploadOk = 1;
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Check if file already exists
        if (file_exists($targetFile)) {
          echo "Sorry, file already exists.";
          $uploadOk = 0;
        }

        // Check file size
        if ($_FILES["fileInput"]["size"] > 500000) {
          echo "Sorry, your file is too large.";
          $uploadOk = 0;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
          echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
          $uploadOk = 0;
        }

        if ($uploadOk == 0) {
          echo "Sorry, your file was not uploaded.";
        } else {
          // Move the uploaded file to the specified directory
          if (move_uploaded_file($_FILES["fileInput"]["tmp_name"], $targetFile)) {
            echo "The file " . htmlspecialchars(basename($_FILES["fileInput"]["name"])) . " has been uploaded.";
          }
          $imagePath = $targetFile;
        }
      } else {
        // No new file uploaded, retain the existing image path
        $imagePath = $len['profileimage']; // Replace with your actual image path variable
      }

      // Update user profile in the database
      $userId = $len['id']; // Replace with your actual user ID
      $updateQuery = "UPDATE users SET
         full_name = '$fullName',
         about = '$about',
         about_company = '$company',
         job = '$job',
         profileimage='$imagePath',
         country = '$country',
         address = '$address',
         phone = '$phone',
         email = '$email',
         twitter_profile = '$twitter',
         facebook_profile = '$facebook',
         instagram_profile = '$instagram',
         linkedin_profile = '$linkedin'
         WHERE id = $userId";

      $updateResult = mysqli_query($con, $updateQuery);

      if ($updateResult) {
        echo '<script>window.location.href = "profile.php";</script>';
      } else {
        echo "Error updating profile: " . mysqli_error($con);
      }
    }
  }
  ?>
</main><!-- End #main -->

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
  </div>
  <div class="credits">
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
<script>
  // Toggle password visibility
  function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
    input.setAttribute('type', type);
  }

  // Attach event listeners to toggle buttons
  document.getElementById('toggleCurrentPassword').addEventListener('click', () => {
    togglePassword('currentPassword');
  });

  document.getElementById('toggleNewPassword').addEventListener('click', () => {
    togglePassword('newPassword');
  });

  document.getElementById('toggleRenewPassword').addEventListener('click', () => {
    togglePassword('renewPassword');
  });
</script>
<script>
  // Function to trigger click on the hidden file input
  function chooseFile() {
    document.getElementById('fileInput').click();
  }

  // Function to display image preview
  function displayImagePreview() {
    const fileInput = document.getElementById('fileInput');
    const imagePreviewContainer = document.getElementById('imagePreviewContainer');

    // Check if a file is selected
    if (fileInput.files && fileInput.files[0]) {
      const reader = new FileReader();

      // Read the image file and display it in the preview container
      reader.onload = function(e) {
        const imagePreview = document.createElement('img');
        imagePreview.src = e.target.result;
        imagePreview.classList.add('img-thumbnail'); // Optional: Add Bootstrap class for styling
        imagePreviewContainer.innerHTML = ''; // Clear previous preview
        imagePreviewContainer.appendChild(imagePreview);
      };

      reader.readAsDataURL(fileInput.files[0]);
    }
  }
</script>