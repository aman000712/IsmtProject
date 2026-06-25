<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Status | Cit-E Cycling</title>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- Bootstrap Icons -->
<link rel="stylesheet"
href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

<style>
body{
    min-height:100vh;
    background:
        linear-gradient(rgba(13,17,23,.75),rgba(13,17,23,.75)),
        url("https://images.unsplash.com/photo-1517649763962-0c623066013b?w=1600");
    background-size:cover;
    background-position:center;
    background-attachment:fixed;
}

/* Navbar */
.navbar{
    background:rgba(255,255,255,.1);
    backdrop-filter:blur(10px);
    transition:.3s;
}

.navbar.scrolled{
    background:#111827!important;
}

/* Loader */
#loader{
    min-height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    flex-direction:column;
    color:white;
}

.bike-icon{
    font-size:5rem;
    animation: ride 1.5s infinite ease-in-out;
}

@keyframes ride{
    0%,100%{
        transform:translateY(0);
    }
    50%{
        transform:translateY(-10px);
    }
}

.progress{
    width:300px;
    height:10px;
    border-radius:50px;
    overflow:hidden;
    background:rgba(255,255,255,.2);
}

.progress-bar{
    animation:loading 3s linear forwards;
}

@keyframes loading{
    from{
        width:0%;
    }
    to{
        width:100%;
    }
}

#content{
    display:none;
}

.main-section{
    padding-top:130px;
    padding-bottom:80px;
}

.result-card{
    max-width:700px;
    margin:auto;
    border:none;
    border-radius:25px;
    overflow:hidden;
    background:rgba(255,255,255,.96);
    backdrop-filter:blur(20px);
    box-shadow:0 1rem 3rem rgba(0,0,0,.3);
}

footer{
    background:#111827;
}
</style>

</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
<div class="container">

<a class="navbar-brand fw-bold fs-3" href="index.html">
<i class="bi bi-bicycle"></i>
Cit-E Cycling
</a>

<button class="navbar-toggler"
type="button"
data-bs-toggle="collapse"
data-bs-target="#menu">
<span class="navbar-toggler-icon"></span>
</button>

<div class="collapse navbar-collapse" id="menu">

<ul class="navbar-nav ms-auto">

<li class="nav-item">
<a class="nav-link" href="index.html">
Home
</a>
</li>

<li class="nav-item">
<a class="nav-link active" href="register_form.html">
Register Interest
</a>
</li>

<li class="nav-item">
<a class="nav-link" href="admin_login.html">
Admin Login
</a>
</li>

</ul>

</div>

</div>
</nav>

<!-- Loader -->
<div id="loader">

<i class="bi bi-bicycle bike-icon mb-4"></i>

<h2 class="fw-bold">
Processing Registration
</h2>

<p class="text-light opacity-75 mb-4">
Saving your information securely...
</p>

<div class="progress">
<div class="progress-bar bg-primary"></div>
</div>

</div>

<!-- Content -->
<div id="content">

<?php

include 'dbconnect.php';

try{

$conn = new PDO(
"mysql:host=$servername;dbname=$database",
$username,
$password
);

$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

$firstname = trim($_POST['firstname']);
$surname = trim($_POST['surname']);
$email = trim($_POST['email']);
$terms = isset($_POST['terms']) ? $_POST['terms'] : 'no';

if(empty($firstname) || empty($surname) || empty($email)){
    throw new Exception("Please fill in all required fields.");
}

$sql = "INSERT INTO interest(firstname,surname,email,terms)
VALUES(:firstname,:surname,:email,:terms)";

$stmt = $conn->prepare($sql);

$stmt->execute([
':firstname'=>$firstname,
':surname'=>$surname,
':email'=>$email,
':terms'=>$terms
]);

?>

<section class="main-section">

<div class="container">

<div class="card result-card">

<div class="card-body text-center p-5">

<div class="display-1 text-success mb-4">
<i class="bi bi-check-circle-fill"></i>
</div>

<h1 class="fw-bold text-success">
Registration Successful
</h1>

<p class="text-muted mt-3 fs-5">
Thank you,
<strong><?php echo htmlspecialchars($firstname); ?></strong>.

Your interest for future events has been recorded successfully.
We look forward to seeing you at upcoming Cit-E Cycling events.
</p>

<div class="mt-4">

<a href="index.html"
class="btn btn-primary btn-lg rounded-pill px-4">

<i class="bi bi-house-door-fill me-2"></i>
Back to Home

</a>

</div>

</div>

</div>

</div>

</section>

<?php

}catch(Exception $e){

?>

<section class="main-section">

<div class="container">

<div class="card result-card">

<div class="card-body text-center p-5">

<div class="display-1 text-danger mb-4">
<i class="bi bi-x-circle-fill"></i>
</div>

<h1 class="fw-bold text-danger">
Registration Failed
</h1>

<p class="text-muted fs-5 mt-3">
<?php echo $e->getMessage(); ?>
</p>

<div class="mt-4">

<a href="register_form.html"
class="btn btn-outline-danger btn-lg rounded-pill px-4">

<i class="bi bi-arrow-repeat me-2"></i>
Try Again

</a>

</div>

</div>

</div>

</div>

</section>

<?php
}

$conn=null;

?>

<!-- Footer -->
<footer class="text-white py-5">

<div class="container">

<div class="row">

<div class="col-lg-6">

<h3 class="fw-bold">
<i class="bi bi-bicycle"></i>
Cit-E Cycling
</h3>

<p class="text-secondary">
A modern platform for managing cycling events,
registrations and administration through one
integrated web portal.
</p>

</div>

<div class="col-lg-3">

<h5>Quick Links</h5>

<ul class="list-unstyled">

<li class="mb-2">
<a href="index.html"
class="text-secondary text-decoration-none">
Home
</a>
</li>

<li class="mb-2">
<a href="register_form.html"
class="text-secondary text-decoration-none">
Register Interest
</a>
</li>

<li class="mb-2">
<a href="admin_login.html"
class="text-secondary text-decoration-none">
Admin Login
</a>
</li>

</ul>

</div>

<div class="col-lg-3">

<h5>Contact</h5>

<p class="text-secondary">
<i class="bi bi-envelope"></i>
info@citecycling.com
</p>

</div>

</div>

<hr class="border-secondary">

<div class="text-center text-secondary">
© 2026 Cit-E Cycling Web Portal | Built with Bootstrap 5
</div>

</div>

</footer>

</div>

<script>

setTimeout(function(){

document.getElementById("loader").style.display="none";
document.getElementById("content").style.display="block";

},3000); // change to 30000 for 30 seconds


window.addEventListener("scroll",function(){

const navbar=document.querySelector(".navbar");

if(window.scrollY>50){
navbar.classList.add("scrolled");
}else{
navbar.classList.remove("scrolled");
}

});

</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>