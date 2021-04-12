<?php
//session started
session_start();
$_SESSION['message']="";
include_once("connect.php");
$sql = "USE blogsdb;";
$conn->query($sql);

?>


<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Portfolio</title>
</head>
<body id="home" data-spy="scroll" data-offset="70">



<nav class="navbar navbar-expand-lg navbar-light bg-light transparent-navbar">
    <div class="container">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a class="nav-link" href="index.html">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.html">About</a></li>
                <li class="nav-item"><a class="nav-link" href="skills.html">Skills</a></li>
                <li class="nav-item"><a class="nav-link" href="education.html">Education</a></li>
                <li class="nav-item"><a class="nav-link" href="experience.html">Experience</a></li>
                <li class="nav-item"><a class="nav-link" href="portfolio.html">Portfolio</a></li>
                <li class="nav-item"><a class="nav-link" href="blog.php">Blog</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.html">Contact</a></li>
            </ul>
        </div>
    </div>
</nav>

<section class="jarallax" data-jarallax='{"speed": 0.2}' style="background: black;height: 70px">
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">

            </div>
        </div>
    </div>
</section>


<section id="about" class="about-area ptb-120">
    <div class="container">
        <div class="section-title">
            <h2>BLOGS</h2>
        </div>
        <a class="btn btn-success" style="float: right" href="addEntry.php">Add New</a>

        <div class="row">

                <?php
                //get all students from database query
                $sql = "SELECT * FROM blogs;";
                $result = $conn->query($sql);
                $index = 0;

                ?>
            <?php

            if($result->num_rows>0){
                while($row = $result->fetch_assoc()){
                    $index++;
                    $title = $row['title'];
                    $description = $row['description'];
                    $created_at = $row['created_at'];
                    echo "<div class=\"col-lg-4 col-md-6\">
                <div class=\"services-box\">
                    <div class=\"icon\">
                        <i class=\"flaticon-computer\"></i>
                    </div>
                    <h3>$title</h3>
                    <p>$description</p>
                    <p style='font-size: 12px'>Upload on $created_at</p>
                </div>
            </div>";
                }
            }

            ?>
        </div>

    </div>
</section>

<div class="copyright-area">
    <div class="container">
        <p><i class="far fa-copyright"></i> Copyright 2021. All Rights are Reserved.</p>
    </div>
</div>

<div class="go-top"><i class="fas fa-arrow-up"></i></div>

<script src="assets/js/bootstrap.min.js"></script>
</body>
</html>
