<?php
session_start();
include_once('connect.php');
$_SESSION['message']="";

if($_SERVER["REQUEST_METHOD"]=="POST"){

	$username = $_POST['username'];

	$password = $_POST['password'];
    $sql = "USE blogsdb;";
    $conn->query($sql);

	$stmt = $conn->prepare("SELECT * FROM admin WHERE username= ?;");
	if(!$stmt){
		echo "Error preparing statement ".htmlspecialchars($conn->error);
	}
	$stmt->bind_param("s",$username);
	$stmt->execute();
	$result = $stmt->get_result();
	$stmt->close();

	if($result->num_rows>0){
		while($row = $result->fetch_assoc()){

			if($row["password"]==$password){
				$_SESSION["username"] = $username;
				$_SESSION["admin"] = 'true';
				header("location: addEntry.php");
			}
			else{
				$_SESSION['message'] = "Sorry, Wrong Password!";
			}
		}
	}	
	else{
		$_SESSION['message'] = "Username doesn't exist!";
	}	
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Login </title>
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
                        <h4 class="text-center">Sign In</h4>
                        <div id="errMsg" style="color: red"><?= $_SESSION['message'] ?></div>
                        <form action="login.php" class="login-form mt-4" method="post">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Username" name="username" required="">
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                                    </div>
                                </div>

                                <div class="col-lg-12">
                                </div>
                                <div class="col-lg-12 mb-0">
                                    <div class="d-grid">
                                        <button class="btn btn-primary">Sign in</button>
                                        <a href="index.html" style="margin-top: 20px">Go to home</a>
                                    </div>
                                </div>

                                <div class="col-12 text-center">
                                </div>
                            </div>
                        </form>
                    </div>
                </div><!---->
            </div> <!--end col-->
        </div><!--end row-->
    </div> <!--end container-->
</section>

<script>

</script>
</body>
</html>
