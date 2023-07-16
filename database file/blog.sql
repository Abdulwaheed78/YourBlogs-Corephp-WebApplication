-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 16, 2023 at 08:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `blog`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(25) NOT NULL,
  `password` varchar(23) NOT NULL,
  `name` varchar(56) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `name`) VALUES
(2, 'abdul', 'waheed12', 'waheed');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(5, 'python Blogs'),
(6, 'php Blogs'),
(7, 'Html Blogs'),
(8, 'JS Blogs'),
(9, 'Laravel Blogs'),
(10, 'Css Blogs'),
(11, 'Java Blogs');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `name`, `email`, `comment`, `created_at`) VALUES
(18, 20, 'waheed', 'bababooks29@gmail.com', 'testing', '2023-07-14 11:59:39'),
(19, 20, 'YourBlogs', 'bababooks29@gmail.com', 'this is amazing', '2023-07-14 12:00:13'),
(20, 21, 'rahul', 'abdulwaheedchaudhary78@gmail.com', 'nice\r\n', '2023-07-15 04:15:37'),
(21, 18, 'sameer', 'abdulwaheedchaudhary78@gmail.com', 'nive', '2023-07-15 04:19:29'),
(22, 21, 'rahul', 'bababooks29@gmail.com', 'ni', '2023-07-15 04:19:59'),
(23, 21, 'YourBlogs', 'bababooks29@gmail.com', 'again trying', '2023-07-15 04:48:19'),
(24, 21, 'known', 'bababooks29@gmail.com', 'finally this is woring', '2023-07-15 04:49:31'),
(25, 22, 'sameer', 'bababooks29@gmail.com', 'nice picture', '2023-07-15 05:30:22'),
(26, 26, 'about', 'bababooks29@gmail.com', 'nice working\r\n', '2023-07-15 12:11:47'),
(27, 25, 'waheed', 'abdulwaheedchaudhary78@gmail.com', 'nice one', '2023-07-15 12:23:57'),
(28, 43, 'sameer', 'abdulwaheedchaudhary78@gmail.com', 'nice one\r\n', '2023-07-16 05:05:49');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `image` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `post_id`, `image`) VALUES
(28, 26, 'good-morning-images-funkylife.jpg'),
(29, 25, 'download.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`id`, `name`, `action`) VALUES
(15, 'Home', '/blog'),
(16, 'AboutUs', 'Aboutus.php'),
(17, 'ContactUs', 'contactus.php');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `content` mediumtext NOT NULL,
  `image` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`id`, `title`, `category_id`, `created_at`, `content`, `image`) VALUES
(27, 'What is  HTML ?', 7, '2023-07-16 04:45:27', '<p>HTML stands for HyperText Markup Language. It is a markup language used to create web pages. Markup languages are used to describe the structure of a document, so that a computer can understand it and display it correctly.</p>\r\n\r\n<p>HTML documents are made up of elements, which are enclosed in tags. Tags tell the browser how to display the content between them. For example, the following code creates a heading element:</p>\r\n\r\n<p>&lt;h1&gt;This is a heading&lt;/h1&gt;</p>\r\n\r\n<p>Sure, here is an introduction to HTML:</p>\r\n\r\n<p>HTML stands for HyperText Markup Language. It is a markup language used to create web pages. Markup languages are used to describe the structure of a document, so that a computer can understand it and display it correctly.</p>\r\n\r\n<p>HTML documents are made up of elements, which are enclosed in tags. Tags tell the browser how to display the content between them. For example, the following code creates a heading element:</p>\r\n\r\n<p>HTML</p>\r\n\r\n<pre>\r\n<code>&lt;h1&gt;This is a heading&lt;/h1&gt;\r\n</code></pre>\r\n\r\n<p>Use code with caution.&nbsp;<a href=\"https://bard.google.com/faq#coding\" target=\"_blank\">Learn more</a></p>\r\n\r\n<p>content_copy</p>\r\n\r\n<p>The <code>&lt;h1&gt;</code> tag tells the browser to display the content between the tags as a heading. The <code>&lt;/h1&gt;</code> tag tells the browser that the heading element is finished.</p>\r\n\r\n<p>There are many different types of HTML elements, each of which has a different purpose. For example, there are elements for creating paragraphs, lists, tables, images, and links.</p>\r\n\r\n<p>HTML is a very simple language to learn. The basic syntax is easy to understand, and there are a limited number of elements to learn. Once you have learned the basics, you can start creating your own web pages.</p>\r\n\r\n<p>Here are some of the benefits of learning HTML:</p>\r\n\r\n<ul>\r\n	<li>HTML is the foundation of web development. If you want to become a web developer, you will need to learn HTML.</li>\r\n	<li>HTML is a simple language to learn. Even if you don&#39;t have any programming experience, you can learn HTML in a short amount of time.</li>\r\n	<li>HTML is a powerful language. You can use HTML to create all kinds of web pages, from simple static pages to complex dynamic pages.</li>\r\n</ul>\r\n\r\n<p>If you are interested in learning HTML, there are many resources available online. You can find tutorials, articles, and even complete courses on HTML.</p>\r\n', 'HTML-Tutorials.png'),
(29, 'introduction to css', 10, '2023-07-16 04:49:00', '<p><strong>CSS stands for Cascading Style Sheets.</strong> It is a style sheet language used to describe the presentation of a document written in a markup language such as HTML or XML. CSS is a cornerstone technology of the World Wide Web, alongside HTML and JavaScript.</p>\r\n\r\n<p>CSS is designed to enable the separation of content and presentation, including layout, colors, and fonts. This separation of concerns makes it easier to maintain and update web pages.</p>\r\n\r\n<p>CSS can be used to control the appearance of all aspects of a web page, including:</p>\r\n\r\n<ul>\r\n	<li>The font, size, and color of text</li>\r\n	<li>The layout of elements on a page</li>\r\n	<li>The colors and borders of elements</li>\r\n	<li>The background image of a page</li>\r\n	<li>The animation of elements</li>\r\n</ul>\r\n\r\n<p>CSS can be used in three ways:</p>\r\n\r\n<ul>\r\n	<li><strong>Internal CSS:</strong>&nbsp;This is the most common way to use CSS. The CSS code is placed inside the HTML document, between the&nbsp;<code>&lt;head&gt;</code>&nbsp;and&nbsp;<code>&lt;/head&gt;</code>&nbsp;tags.</li>\r\n	<li><strong>External CSS:</strong>&nbsp;This is a way to separate the CSS code from the HTML document. The CSS code is stored in a separate file, which is then linked to the HTML document.</li>\r\n	<li><strong>Inline CSS:</strong>&nbsp;This is a way to add CSS code directly to an HTML element. The CSS code is placed inside the&nbsp;<code>style</code>&nbsp;attribute of the HTML element.</li>\r\n</ul>\r\n\r\n<p>CSS is a powerful tool that can be used to create visually appealing and engaging web pages. It is a essential skill for any web developer.</p>\r\n', 'images (1).png'),
(30, 'css tutorials part 2', 10, '2023-07-16 04:50:35', '<p>Here are some of the benefits of using CSS:</p>\r\n\r\n<ul>\r\n	<li><strong>It makes web pages more accessible.</strong>&nbsp;By separating the content and presentation, CSS makes it easier for people with disabilities to access web pages.</li>\r\n	<li><strong>It makes web pages more dynamic.</strong>&nbsp;CSS can be used to create animations and other dynamic effects on web pages.</li>\r\n	<li><strong>It makes web pages more maintainable.</strong>&nbsp;By separating the content and presentation, CSS makes it easier to update and maintain web pages.</li>\r\n</ul>\r\n\r\n<p>If you are interested in learning CSS, there are many resources available online. You can find tutorials, articles, and even complete courses on CSS.</p>\r\n\r\n<p>Here are some of the resources I recommend:</p>\r\n\r\n<ul>\r\n	<li>W3Schools: https://www.w3schools.com/css/</li>\r\n	<li>Mozilla Developer Network: https://developer.mozilla.org/en-US/docs/Learn/CSS</li>\r\n	<li>CSS Tricks: https://css-tricks.com/</li>\r\n	<li>Codecademy: https://www.codecademy.com/learn/learn-css</li>\r\n</ul>\r\n', 'images (1).png'),
(31, 'what is javascript ?', 8, '2023-07-16 04:52:10', '<p>&nbsp;</p>\r\n\r\n<p>1+</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>3</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>4</p>\r\n\r\n<p>JavaScript, often abbreviated as JS, is a programming language that is one of the core technologies of the World Wide Web, alongside HTML and CSS. As of 2023, 98.7% of websites use JavaScript on the client side for webpage behavior, often incorporating third-party libraries.</p>\r\n\r\n<p>JavaScript is a lightweight interpreted programming language. The web browser receives the JavaScript code in its original text form and runs the script from that.</p>\r\n\r\n<p>JavaScript is a multi-paradigm, single-threaded, dynamic language, supporting object-oriented, imperative, and declarative (e.g. functional programming) styles.</p>\r\n\r\n<p>JavaScript can be used to do many things on a web page, including:</p>\r\n\r\n<ul>\r\n	<li><strong>Update the content of a web page.</strong>&nbsp;For example, you can use JavaScript to change the text of a heading or to add a new paragraph to a page.</li>\r\n	<li><strong>Control the behavior of a web page.</strong>&nbsp;For example, you can use JavaScript to make a button interactive or to open a new window.</li>\r\n	<li><strong>Animate elements on a web page.</strong>&nbsp;For example, you can use JavaScript to create a slideshow or to make an image move.</li>\r\n	<li><strong>Validate user input.</strong>&nbsp;For example, you can use JavaScript to check if a user has entered a valid email address or a valid phone number.</li>\r\n</ul>\r\n\r\n<p>JavaScript is a powerful language that can be used to create interactive and dynamic web pages. It is a essential skill for any web developer.</p>\r\n', 'Free Courses to learn JavaScript.jpg'),
(32, 'java script part 2', 8, '2023-07-16 04:52:58', '<p>Here are some of the benefits of using JavaScript:</p>\r\n\r\n<ul>\r\n	<li><strong>It makes web pages more interactive.</strong>&nbsp;JavaScript can be used to create interactive elements on web pages, such as buttons, dropdown menus, and sliders.</li>\r\n	<li><strong>It makes web pages more dynamic.</strong>&nbsp;JavaScript can be used to update the content of a web page dynamically, without having to reload the page.</li>\r\n	<li><strong>It makes web pages more engaging.</strong>&nbsp;JavaScript can be used to create animations and other effects that can engage users with a web page.</li>\r\n</ul>\r\n\r\n<p>If you are interested in learning JavaScript, there are many resources available online. You can find tutorials, articles, and even complete courses on JavaScript.</p>\r\n\r\n<p>Here are some of the resources I recommend:</p>\r\n\r\n<ul>\r\n	<li>W3Schools: https://www.w3schools.com/js/</li>\r\n	<li>Mozilla Developer Network: https://developer.mozilla.org/en-US/docs/Learn/JavaScript</li>\r\n	<li>JavaScript Tutorial: https://www.javascripttutorial.net/</li>\r\n	<li>Codecademy: https://www.codecademy.com/learn/learn-javascript</li>\r\n</ul>\r\n', 'Free Courses to learn JavaScript.jpg'),
(33, 'What is Python?', 5, '2023-07-16 04:54:45', '<p>Python is a popular programming language. It was created by Guido van Rossum, and released in 1991.</p>\r\n\r\n<p>It is used for:</p>\r\n\r\n<ul>\r\n	<li>web development (server-side),</li>\r\n	<li>software development,</li>\r\n	<li>mathematics,</li>\r\n	<li>system scripting.</li>\r\n</ul>\r\n\r\n<h3>What can Python do?</h3>\r\n\r\n<ul>\r\n	<li>Python can be used on a server to create web applications.</li>\r\n	<li>Python can be used alongside software to create workflows.</li>\r\n	<li>Python can connect to database systems. It can also read and modify files.</li>\r\n	<li>Python can be used to handle big data and perform complex mathematics.</li>\r\n	<li>Python can be used for rapid prototyping, or for production-ready software development.</li>\r\n</ul>\r\n\r\n<h3>Why Python?</h3>\r\n\r\n<ul>\r\n	<li>Python works on different platforms (Windows, Mac, Linux, Raspberry Pi, etc).</li>\r\n	<li>Python has a simple syntax similar to the English language.</li>\r\n	<li>Python has syntax that allows developers to write programs with fewer lines than some other programming languages.</li>\r\n	<li>Python runs on an interpreter system, meaning that code can be executed as soon as it is written. This means that prototyping can be very quick.</li>\r\n	<li>Python can be treated in a procedural way, an object-oriented way or a functional way.</li>\r\n</ul>\r\n\r\n<h3>Good to know</h3>\r\n\r\n<ul>\r\n	<li>The most recent major version of Python is Python 3, which we shall be using in this tutorial. However, Python 2, although not being updated with anything other than security updates, is still quite popular.</li>\r\n	<li>In this tutorial Python will be written in a text editor. It is possible to write Python in an Integrated Development Environment, such as Thonny, Pycharm, Netbeans or Eclipse which are particularly useful when managing larger collections of Python files.</li>\r\n</ul>\r\n\r\n<h3>Python Syntax compared to other programming languages</h3>\r\n\r\n<ul>\r\n	<li>Python was designed for readability, and has some similarities to the English language with influence from mathematics.</li>\r\n	<li>Python uses new lines to complete a command, as opposed to other programming languages which often use semicolons or parentheses.</li>\r\n	<li>Python relies on indentation, using whitespace, to define scope; such as the scope of loops, functions and classes. Other programming languages often use curly-brackets for this purpose.</li>\r\n</ul>\r\n', 'python-coding-mistakes.jpg'),
(34, 'Python Indentation', 5, '2023-07-16 04:56:25', '<p>Indentation refers to the spaces at the beginning of a code line.</p>\r\n\r\n<p>Where in other programming languages the indentation in code is for readability only, the indentation in Python is very important.</p>\r\n\r\n<p>Python uses indentation to indicate a block of code.</p>\r\n\r\n<h3>Example<a href=\"https://www.w3schools.com/spaces/\" target=\"_blank\">Get your own Python Server</a></h3>\r\n\r\n<p>if&nbsp;5&nbsp;&gt;&nbsp;2:<br />\r\n&nbsp;&nbsp;print(&quot;Five is greater than two!&quot;)</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_indentation\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<p>Python will give you an error if you skip the indentation:</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>Syntax Error:</p>\r\n\r\n<p>if&nbsp;5&nbsp;&gt;&nbsp;2:<br />\r\nprint(&quot;Five is greater than two!&quot;)</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_indentation_test\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<p>The number of spaces is up to you as a programmer, the most common use is four, but it has to be at least one.</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>if&nbsp;5&nbsp;&gt;&nbsp;2:<br />\r\n&nbsp;print(&quot;Five is greater than two!&quot;)&nbsp;<br />\r\nif&nbsp;5&nbsp;&gt;&nbsp;2:<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print(&quot;Five is greater than two!&quot;)&nbsp;</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_indentation2\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<p>You have to use the same number of spaces in the same block of code, otherwise Python will give you an error:</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>Syntax Error:</p>\r\n\r\n<p>if&nbsp;5&nbsp;&gt;&nbsp;2:<br />\r\n&nbsp;print(&quot;Five is greater than two!&quot;)<br />\r\n&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;print(&quot;Five is greater than two!&quot;)</p>\r\n', 'python-coding-mistakes.jpg'),
(35, 'Python Comments', 5, '2023-07-16 04:57:33', '<p>Comments can be used to explain Python code.</p>\r\n\r\n<p>Comments can be used to make the code more readable.</p>\r\n\r\n<p>Comments can be used to prevent execution when testing code.</p>\r\n\r\n<hr />\r\n<h2>Creating a Comment</h2>\r\n\r\n<p>Comments starts with a&nbsp;<code>#</code>, and Python will ignore them:</p>\r\n\r\n<h3>Example<a href=\"https://www.w3schools.com/spaces/\" target=\"_blank\">Get your own Python Server</a></h3>\r\n\r\n<p>#This is a comment<br />\r\nprint(&quot;Hello, World!&quot;)</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_comment1\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<p>Comments can be placed at the end of a line, and Python will ignore the rest of the line:</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>print(&quot;Hello, World!&quot;)&nbsp;#This is a comment</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_comment2\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<p>A comment does not have to be text that explains the code, it can also be used to prevent Python from executing code:</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>#print(&quot;Hello, World!&quot;)<br />\r\nprint(&quot;Cheers, Mate!&quot;)</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_comment3\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<hr />', 'python-coding-mistakes.jpg'),
(36, 'Python Variables', 5, '2023-07-16 04:58:40', '<h2>Variables</h2>\r\n\r\n<p>Variables are containers for storing data values.</p>\r\n\r\n<hr />\r\n<h2>Creating Variables</h2>\r\n\r\n<p>Python has no command for declaring a variable.</p>\r\n\r\n<p>A variable is created the moment you first assign a value to it.</p>\r\n\r\n<h3>Example<a href=\"https://www.w3schools.com/spaces/\" target=\"_blank\">Get your own Python Server</a></h3>\r\n\r\n<p>x =&nbsp;5<br />\r\ny =&nbsp;&quot;John&quot;<br />\r\nprint(x)<br />\r\nprint(y)</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_variables1\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<p>Variables do not need to be declared with any particular&nbsp;<em>type</em>, and can even change type after they have been set.</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>x =&nbsp;4&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;# x is of type int<br />\r\nx =&nbsp;&quot;Sally&quot;&nbsp;# x is now of type str<br />\r\nprint(x)</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_variables2\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<hr />\r\n<h2>Casting</h2>\r\n\r\n<p>If you want to specify the data type of a variable, this can be done with casting.</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>x =&nbsp;str(3)&nbsp;&nbsp;&nbsp;&nbsp;# x will be &#39;3&#39;<br />\r\ny =&nbsp;int(3)&nbsp;&nbsp;&nbsp;&nbsp;# y will be 3<br />\r\nz =&nbsp;float(3)&nbsp;&nbsp;# z will be 3.0</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_variables_casting\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n', 'python-coding-mistakes.jpg'),
(37, 'Python - Variable Names', 5, '2023-07-16 04:59:28', '<h2>Variable Names</h2>\r\n\r\n<p>A variable can have a short name (like x and y) or a more descriptive name (age, carname, total_volume). Rules for Python variables:</p>\r\n\r\n<ul>\r\n	<li>A variable name must start with a letter or the underscore character</li>\r\n	<li>A variable name cannot start with a number</li>\r\n	<li>A variable name can only contain alpha-numeric characters and underscores (A-z, 0-9, and _ )</li>\r\n	<li>Variable names are case-sensitive (age, Age and AGE are three different variables)</li>\r\n	<li>A variable name cannot be any of the&nbsp;<a href=\"https://www.w3schools.com/python/python_ref_keywords.asp\">Python keywords</a>.</li>\r\n</ul>\r\n\r\n<h3>Example<a href=\"https://www.w3schools.com/spaces/\" target=\"_blank\">Get your own Python Server</a></h3>\r\n\r\n<p>Legal variable names:</p>\r\n\r\n<p>myvar =&nbsp;&quot;John&quot;<br />\r\nmy_var =&nbsp;&quot;John&quot;<br />\r\n_my_var =&nbsp;&quot;John&quot;<br />\r\nmyVar =&nbsp;&quot;John&quot;<br />\r\nMYVAR =&nbsp;&quot;John&quot;<br />\r\nmyvar2 =&nbsp;&quot;John&quot;</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_variable_names_legal\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>Illegal variable names:</p>\r\n\r\n<p>2myvar =&nbsp;&quot;John&quot;<br />\r\nmy-var =&nbsp;&quot;John&quot;<br />\r\nmy var =&nbsp;&quot;John&quot;</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_variable_names_error\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<p>Remember that variable names are case-sensitive</p>\r\n', 'python-coding-mistakes.jpg'),
(38, 'Python Data Types', 5, '2023-07-16 05:00:02', '<h2>Built-in Data Types</h2>\r\n\r\n<p>In programming, data type is an important concept.</p>\r\n\r\n<p>Variables can store data of different types, and different types can do different things.</p>\r\n\r\n<p>Python has the following data types built-in by default, in these categories:</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<td>Text Type:</td>\r\n			<td><code>str</code></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Numeric Types:</td>\r\n			<td><code>int</code>,&nbsp;<code>float</code>,&nbsp;<code>complex</code></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sequence Types:</td>\r\n			<td><code>list</code>,&nbsp;<code>tuple</code>,&nbsp;<code>range</code></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Mapping Type:</td>\r\n			<td><code>dict</code></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Set Types:</td>\r\n			<td><code>set</code>,&nbsp;<code>frozenset</code></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Boolean Type:</td>\r\n			<td><code>bool</code></td>\r\n		</tr>\r\n		<tr>\r\n			<td>Binary Types:</td>\r\n			<td><code>bytes</code>,&nbsp;<code>bytearray</code>,&nbsp;<code>memoryview</code></td>\r\n		</tr>\r\n		<tr>\r\n			<td>None Type:</td>\r\n			<td><code>NoneType</code></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<hr />\r\n<h2>Getting the Data Type</h2>\r\n\r\n<p>You can get the data type of any object by using the&nbsp;<code>type()</code>&nbsp;function:</p>\r\n\r\n<h3>Example<a href=\"https://www.w3schools.com/spaces/\" target=\"_blank\">Get your own Python Server</a></h3>\r\n\r\n<p>Print the data type of the variable x:</p>\r\n\r\n<p>x =&nbsp;5<br />\r\nprint(type(x))</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<hr />\r\n<h2>Setting the Data Type</h2>\r\n\r\n<p>In Python, the data type is set when you assign a value to a variable:</p>\r\n\r\n<table>\r\n	<tbody>\r\n		<tr>\r\n			<th>Example</th>\r\n			<th>Data Type</th>\r\n			<th>Try it</th>\r\n		</tr>\r\n		<tr>\r\n			<td>x = &quot;Hello World&quot;</td>\r\n			<td>str</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_str\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = 20</td>\r\n			<td>int</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_int\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = 20.5</td>\r\n			<td>float</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_float\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = 1j</td>\r\n			<td>complex</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_complex\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = [&quot;apple&quot;, &quot;banana&quot;, &quot;cherry&quot;]</td>\r\n			<td>list</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_list\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = (&quot;apple&quot;, &quot;banana&quot;, &quot;cherry&quot;)</td>\r\n			<td>tuple</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_tuple\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = range(6)</td>\r\n			<td>range</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_range\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = {&quot;name&quot; : &quot;John&quot;, &quot;age&quot; : 36}</td>\r\n			<td>dict</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_dict\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = {&quot;apple&quot;, &quot;banana&quot;, &quot;cherry&quot;}</td>\r\n			<td>set</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_set\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = frozenset({&quot;apple&quot;, &quot;banana&quot;, &quot;cherry&quot;})</td>\r\n			<td>frozenset</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_frozenset\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = True</td>\r\n			<td>bool</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_bool\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = b&quot;Hello&quot;</td>\r\n			<td>bytes</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_bytes\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = bytearray(5)</td>\r\n			<td>bytearray</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_bytearray\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = memoryview(bytes(5))</td>\r\n			<td>memoryview</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_memoryview\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n		<tr>\r\n			<td>x = None</td>\r\n			<td>NoneType</td>\r\n			<td><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_type_nonetype\" target=\"_blank\">Try it &raquo;</a></td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n\r\n<hr />', 'python-coding-mistakes.jpg'),
(39, 'Python Numbers', 5, '2023-07-16 05:00:45', '<h2>Python Numbers</h2>\r\n\r\n<p>There are three numeric types in Python:</p>\r\n\r\n<ul>\r\n	<li><code>int</code></li>\r\n	<li><code>float</code></li>\r\n	<li><code>complex</code></li>\r\n</ul>\r\n\r\n<p>Variables of numeric types are created when you assign a value to them:</p>\r\n\r\n<h3>Example<a href=\"https://www.w3schools.com/spaces/\" target=\"_blank\">Get your own Python Server</a></h3>\r\n\r\n<p>x =&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;# int<br />\r\ny =&nbsp;2.8&nbsp;&nbsp;# float<br />\r\nz = 1j&nbsp;&nbsp;&nbsp;# complex</p>\r\n\r\n<p>To verify the type of any object in Python, use the&nbsp;<code>type()</code>&nbsp;function:</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>print(type(x))<br />\r\nprint(type(y))<br />\r\nprint(type(z))</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_numbers\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<hr />\r\n<h2>Int</h2>\r\n\r\n<p>Int, or integer, is a whole number, positive or negative, without decimals, of unlimited length.</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>Integers:</p>\r\n\r\n<p>x =&nbsp;1<br />\r\ny =&nbsp;35656222554887711<br />\r\nz =&nbsp;-3255522<br />\r\n<br />\r\nprint(type(x))<br />\r\nprint(type(y))<br />\r\nprint(type(z))</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_numbers_int\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<hr />\r\n<h2>Float</h2>\r\n\r\n<p>Float, or &quot;floating point number&quot; is a number, positive or negative, containing one or more decimals.</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>Floats:</p>\r\n\r\n<p>x =&nbsp;1.10<br />\r\ny =&nbsp;1.0<br />\r\nz = -35.59<br />\r\n<br />\r\nprint(type(x))<br />\r\nprint(type(y))<br />\r\nprint(type(z))</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_numbers_float\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<p>Float can also be scientific numbers with an &quot;e&quot; to indicate the power of 10.</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>Floats:</p>\r\n\r\n<p>x =&nbsp;35e3<br />\r\ny =&nbsp;12E4<br />\r\nz = -87.7e100<br />\r\n<br />\r\nprint(type(x))<br />\r\nprint(type(y))<br />\r\nprint(type(z))</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_numbers_float2\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<hr />\r\n<p>ADVERTISEMENT</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<hr />\r\n<h2>Complex</h2>\r\n\r\n<p>Complex numbers are written with a &quot;j&quot; as the imaginary part:</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>Complex:</p>\r\n\r\n<p>x =&nbsp;3+5j<br />\r\ny = 5j<br />\r\nz = -5j<br />\r\n<br />\r\nprint(type(x))<br />\r\nprint(type(y))<br />\r\nprint(type(z))</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_numbers_complex\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<hr />\r\n<h2>Type Conversion</h2>\r\n\r\n<p>You can convert from one type to another with the&nbsp;<code>int()</code>,&nbsp;<code>float()</code>, and&nbsp;<code>complex()</code>&nbsp;methods:</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>Convert from one type to another:</p>\r\n\r\n<p>x =&nbsp;1&nbsp;&nbsp;&nbsp;&nbsp;# int<br />\r\ny =&nbsp;2.8&nbsp;&nbsp;# float<br />\r\nz = 1j&nbsp;&nbsp;&nbsp;# complex<br />\r\n<br />\r\n#convert from int to float:<br />\r\na =&nbsp;float(x)<br />\r\n<br />\r\n#convert from float to int:<br />\r\nb =&nbsp;int(y)<br />\r\n<br />\r\n#convert from int to complex:<br />\r\nc =&nbsp;complex(x)<br />\r\n<br />\r\nprint(a)<br />\r\nprint(b)<br />\r\nprint(c)<br />\r\n<br />\r\nprint(type(a))<br />\r\nprint(type(b))<br />\r\nprint(type(c))</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_numbers_convert\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n\r\n<p><strong>Note:</strong>&nbsp;You cannot convert complex numbers into another number type.</p>\r\n\r\n<hr />\r\n<h2>Random Number</h2>\r\n\r\n<p>Python does not have a&nbsp;<code>random()</code>&nbsp;function to make a random number, but Python has a built-in module called&nbsp;<code>random</code>&nbsp;that can be used to make random numbers:</p>\r\n\r\n<h3>Example</h3>\r\n\r\n<p>Import the random module, and display a random number between 1 and 9:</p>\r\n\r\n<p>import&nbsp;random<br />\r\n<br />\r\nprint(random.randrange(1,&nbsp;10))</p>\r\n\r\n<p><a href=\"https://www.w3schools.com/python/trypython.asp?filename=demo_numbers_random\" target=\"_blank\">Try it Yourself &raquo;</a></p>\r\n', 'python-coding-mistakes.jpg'),
(40, 'What is Java?', 11, '2023-07-16 05:02:07', '<p>Java is a&nbsp;<strong>programming language</strong>&nbsp;and a&nbsp;<strong>platform</strong>. Java is a high level, robust, object-oriented and secure programming language.</p>\r\n\r\n<p>Java was developed by&nbsp;<em>Sun Microsystems</em>&nbsp;(which is now the subsidiary of Oracle) in the year 1995.&nbsp;<em>James Gosling</em>&nbsp;is known as the father of Java. Before Java, its name was&nbsp;<em>Oak</em>. Since Oak was already a registered company, so James Gosling and his team changed the name from Oak to Java.</p>\r\n\r\n<p><strong>Platform</strong>: Any hardware or software environment in which a program runs, is known as a platform. Since Java has a runtime environment (JRE) and API, it is called a platform.</p>\r\n', 'ST-java1_1x (1).png'),
(41, 'History of Java', 11, '2023-07-16 05:02:38', '<p>The history of Java is very interesting. Java was originally designed for interactive television, but it was too advanced technology for the digital cable television industry at the time. The history of Java starts with the Green Team. Java team members (also known as Green Team), initiated this project to develop a language for digital devices such as set-top boxes, televisions, etc. However, it was best suited for internet programming. Later, Java technology was incorporated by Netscape.</p>\r\n\r\n<p>The principles for creating Java programming were &quot;Simple, Robust, Portable, Platform-independent, Secured, High Performance, Multithreaded, Architecture Neutral, Object-Oriented, Interpreted, and Dynamic&quot;.&nbsp;<a href=\"https://www.javatpoint.com/java-tutorial\">Java</a>&nbsp;was developed by James Gosling, who is known as the father of Java, in 1995. James Gosling and his team members started the project in the early &#39;90s.</p>\r\n\r\n<p><img alt=\"James Gosling - founder of java\" src=\"https://static.javatpoint.com/images/j1.jpg\" /></p>\r\n\r\n<p>Currently, Java is used in internet programming, mobile devices, games, e-business solutions, etc. Following are given significant points that describe the history of Java.</p>\r\n\r\n<p>1)&nbsp;<strong><a href=\"https://www.javatpoint.com/james-gosling-father-of-java\">James Gosling</a>, Mike Sheridan</strong>, and&nbsp;<strong>Patrick Naughton</strong>&nbsp;initiated the Java language project in June 1991. The small team of sun engineers called&nbsp;<strong>Green Team</strong>.</p>\r\n', 'ST-java1_1x (1).png'),
(42, 'Features of Java', 11, '2023-07-16 05:03:58', '<p>The primary objective of&nbsp;<a href=\"https://www.javatpoint.com/java-tutorial\">Java programming</a>&nbsp;language creation was to make it portable, simple and secure programming language. Apart from this, there are also some excellent features which play an important role in the popularity of this language. The features of Java are also known as Java buzzwords.</p>\r\n\r\n<p>A list of the most important features of the Java language is given below.</p>\r\n\r\n<p><img alt=\"Java Features\" src=\"https://static.javatpoint.com/images/core/java-features.png\" /></p>\r\n\r\n<ol>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Simple\">Simple</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Object-Oriented\">Object-Oriented</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Portable\">Portable</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Platform-independent\">Platform independent</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Secured\">Secured</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Robust\">Robust</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Architecture-neutral\">Architecture neutral</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Interpreted\">Interpreted</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#High-Performance\">High Performance</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Multithreaded\">Multithreaded</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Distributed\">Distributed</a></li>\r\n	<li><a href=\"https://www.javatpoint.com/features-of-java#Dynamic\">Dynamic</a></li>\r\n</ol>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<hr />\r\n<h3>Simple</h3>\r\n\r\n<p>Java is very easy to learn, and its syntax is simple, clean and easy to understand. According to Sun Microsystem, Java language is a simple programming language because:</p>\r\n\r\n<ul>\r\n	<li>Java syntax is based on C++ (so easier for programmers to learn it after C++).</li>\r\n	<li>Java has removed many complicated and rarely-used features, for example, explicit pointers, operator overloading, etc.</li>\r\n	<li>There is no need to remove unreferenced objects because there is an Automatic Garbage Collection in Java.</li>\r\n</ul>\r\n\r\n<hr />\r\n<h3>Object-oriented</h3>\r\n\r\n<p>Java is an&nbsp;<a href=\"https://www.javatpoint.com/java-oops-concepts\">object-oriented</a>&nbsp;programming language. Everything in Java is an object. Object-oriented means we organize our software as a combination of different types of objects that incorporate both data and behavior.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'ST-java1_1x (1).png'),
(43, 'Object class in Java', 11, '2023-07-16 05:05:16', '<p>The&nbsp;<strong>Object class</strong>&nbsp;is the parent class of all the classes in java by default. In other words, it is the topmost class of java.</p>\r\n\r\n<p>The Object class is beneficial if you want to refer any object whose type you don&#39;t know. Notice that parent class reference variable can refer the child class object, know as upcasting.</p>\r\n\r\n<p>Let&#39;s take an example, there is getObject() method that returns an object but it can be of any type like Employee,Student etc, we can use Object class reference to refer that object. For example:</p>\r\n\r\n<ol>\r\n	<li>Object&nbsp;obj=getObject();//we&nbsp;don&#39;t&nbsp;know&nbsp;what&nbsp;object&nbsp;will&nbsp;be&nbsp;returned&nbsp;from&nbsp;this&nbsp;method&nbsp;&nbsp;</li>\r\n</ol>\r\n\r\n<p>The Object class provides some common behaviors to all the objects such as object can be compared, object can be cloned, object can be notified etc.</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>&nbsp;</p>\r\n', 'ST-java1_1x (1).png');

-- --------------------------------------------------------

--
-- Table structure for table `submenu`
--

CREATE TABLE `submenu` (
  `id` int(11) NOT NULL,
  `parent_menu_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `action` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `submenu`
--
ALTER TABLE `submenu`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `submenu`
--
ALTER TABLE `submenu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
