<?php include 'admin/conn.php';
include('functions.php');
include("includes/nav3.php");

if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 1;
}
$post_per_page = 5;
$result = ($page - 1) * $post_per_page;

#code for   blog post in showing the first latest page
$query = mysqli_query($con, "SELECT * FROM post ORDER BY id desc LIMIT 1");
$data = mysqli_fetch_assoc($query);
$laest_post_id = $data['id'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <title>HOME</title>
</head>

<body style="background-color:#F8F9F9;">

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
    </script>
    <script>
        function showShareOptions() {
            // URL to be shared
            var shareUrl = 'https://your-website.com/your-post-url';

            // Social media share URLs
            var whatsappUrl = 'whatsapp://send?text=' + encodeURIComponent(shareUrl);
            var facebookUrl = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURIComponent(shareUrl);
            var linkedinUrl = 'https://www.linkedin.com/shareArticle?url=' + encodeURIComponent(shareUrl);
            var twitterUrl = 'https://twitter.com/intent/tweet?url=' + encodeURIComponent(shareUrl);

            // Open a popup or modal with share options
            var shareOptions = window.open('', 'Share Options', 'width=400,height=300');

            // Build the HTML content for the share options
            shareOptions.document.write('<h2>Share Options</h2>');
            shareOptions.document.write('<button onclick="window.location=\'' + whatsappUrl + '\'">Share on WhatsApp</button>');
            shareOptions.document.write('<button onclick="window.location=\'' + facebookUrl + '\'">Share on Facebook</button>');
            shareOptions.document.write('<button onclick="window.location=\'' + linkedinUrl + '\'">Share on LinkedIn</button>');
            shareOptions.document.write('<button onclick="window.location=\'' + twitterUrl + '\'">Share on Twitter</button>');

            // Add styling if needed
            shareOptions.document.write('<style>button { margin: 5px; }</style>');

            // Close the document
            shareOptions.document.close();
        }
    </script>
    <script>
        // JavaScript code to limit words in the textarea
        $(document).ready(function() {
            var maxWords = 100;

            $('#commentInput').on('input', function() {
                var words = this.value.split(' ');
                var wordCount = words.length;

                // Display word count
                $('#wordCount').text(wordCount + ' words');

                // Limit the textarea to maxWords
                if (wordCount > maxWords) {
                    // Split the words to maxWords and join them back
                    this.value = words.slice(0, maxWords).join(' ');
                    // Display updated word count
                    $('#wordCount').text(maxWords + ' words');
                }
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <!-- Include Bootstrap and other necessary libraries -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>