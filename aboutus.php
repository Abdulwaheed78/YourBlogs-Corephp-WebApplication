<?php
include "admin/conn.php";
include "functions.php";
include "includes/nav3.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  <title>HOME</title>
  <style>
    .banner {
      width: 100%;
      max-width: 100%;
      height: auto;
    }

    .abdul {
      margin-top: 80px;
    }

    .card-title {
      padding-top: 30px;
      font-size: 20px;
    }

    .card-text {
      font-size: 16px;
    }

    /* Media query for small screens (mobile) */
    @media screen and (max-width: 767px) {
      .card-title {
        font-size: 16px;
        /* Adjust font size for mobile screens */
      }

      .card-text {
        font-size: 14px;
        /* Adjust font size for mobile screens */
      }
    }

    /* Media query for medium-sized screens (tablets) */
    @media screen and (min-width: 768px) and (max-width: 1024px) {
      .card-title {
        font-size: 16px;
        /* Adjust font size for tablets */
      }

      .card-text {
        font-size: 14px;
        /* Adjust font size for tablets */
      }
    }
  </style>
</head>

<body class="abdul" style="background-color:#F6F9FF;">

  <img src="https://img.freepik.com/free-photo/mountain-landscape-day-time_23-2150724875.jpg?t=st=1700921112~exp=1700924712~hmac=0df0c7f4a16f13fdec54830ca58758a860b4a5e64e932b5662527b264f2a6c9f&w=1380" class="banner" alt="Responsive Banner">

  <div class="container mt-5 mb-5">
    <div class="card mt-5" width="75%">
      <div class="row">

        <div class="col-sm-6">
          <center>
            <h1 style="color:blue; margin-top:25px">About Us</h1>
          </center>
          <div class="container">
            <img src="https://img.freepik.com/free-vector/contact-us-concept-landing-page_52683-18636.jpg?w=996&t=st=1700890171~exp=1700890771~hmac=73fc13010d5989a4387dc935d63884865f818e7804fc772d2a34c8efccbed703" class="img-fluid" alt="not found">
          </div>
        </div>

        <div class="col-sm-6">
          <div class="mt-4 mt-sm-0"> <!-- Add spacing for small devices -->
            <div class="card mb-5 border-0"> <!-- Remove the border -->
              <div class="card-body">
                <h3 class="card-title">FULL STACK WEB DEVELOPER</h3>
                <p class="card-text">As a seasoned full-stack web developer, I specialize in creating robust and intuitive web applications. My skill set encompasses both front-end technologies for crafting engaging user interfaces and back-end technologies for ensuring seamless functionality. With a keen eye for design and a commitment to writing efficient and scalable code, I thrive on transforming complex ideas into user-friendly solutions. Whether it's optimizing database performance or implementing cutting-edge technologies, I approach each project with a dedication to delivering high-quality, impactful web experiences.</p>
              </div>
            </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  <div class="mt-5 text-danger">
    <?php include "includes/footer.php"; ?>
  </div>
  <style>
        #back-to-top-btn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 16px;
            border: none;
            outline: none;
            background-color: #333;
            color: #fff;
            cursor: pointer;
            padding: 15px;
            border-radius: 10px;
        }

        #back-to-top-btn:hover {
            background-color: #555;
        }
    </style>
    <button id="back-to-top-btn">Back to Top</button>
    <script>
        var backToTopBtn = document.getElementById("back-to-top-btn");
        var navbar = document.querySelector(".navbar");
        var prevScrollpos = window.pageYOffset;

        window.onscroll = function() {
            var currentScrollPos = window.pageYOffset;

            // Scroll behavior for Back-to-Top button
            if (
                document.body.scrollTop > 300 ||
                document.documentElement.scrollTop > 200
            ) {
                backToTopBtn.style.display = "block";
            } else {
                backToTopBtn.style.display = "none";
            }

            // Scroll behavior for navbar
            if (prevScrollpos > currentScrollPos) {
                navbar.classList.remove("hide");
            } else {
                navbar.classList.add("hide");
            }
            prevScrollpos = currentScrollPos;
        };

        backToTopBtn.addEventListener("click", function() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        });
    </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</body>

</html>