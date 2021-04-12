<?php
session_start();
include_once('connect.php');
$_SESSION['message']="";
if(!isset($_SESSION["username"])){
    header('Location: login.php');
    exit();
}


if($_SERVER["REQUEST_METHOD"]=="POST"){

    $title = $_POST['title'];
    $description = $_POST['description'];
    $sql = "USE blogsdb;";
    $conn->query($sql);

        $stmt = $conn->prepare("INSERT INTO blogs(title, description) "."VALUES ('$title', '$description');");
        if(!$stmt){
            echo "Error preparing statement ".htmlspecialchars($conn->error);
        }
        $stmt->execute();
    $_SESSION['message'] = "Blog Added!";
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Add Entry </title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style type="text/css"></style>
</head>
<body>
<section class="d-flex bg-light align-items-center" style="background: url('images/bg/bg-lines-one.png') center;height: 100vh">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-8">
                <div class="card login-page bg-white shadow mt-4 rounded border-0">
                    <div class="card-body">
                        <h4 class="text-center">Welcome User!</h4><br>
                        <h4 class="text-center">Add Blog</h4>
                        <div id="errMsg" style="color: green"><?= $_SESSION['message'] ?></div>
                        <form action="addEntry.php" class="login-form mt-4" method="post" id="myForm">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Title" name="title" required="">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <textarea class="form-control" name="description" placeholder="Description" required></textarea>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                </div>
                                <div class="col-lg-12 mb-0">
                                    <div class="d-grid">
                                        <button class="btn btn-primary">POST</button>
                                        <button class="btn btn-primary" type="button" onclick="clearForm()">CLEAR</button>
                                    </div>
                                </div>

                                <div class="col-12 text-center" style="margin-top: 40px">
                                    <a href="logout.php">Logout</a>
                                    <a href="index.html" style="margin-top: 20px">Go to home</a>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
</section>

<script>
 function clearForm() {
    if (confirm('Are you sure to clear the form fields?')){
        document.getElementById("myForm").reset();
    }
 }
</script>
</body>
</html>
