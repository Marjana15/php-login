<?php
session_start();

include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location:login.php");
}

$id = $_SESSION['id'];
$query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id");
$result = mysqli_fetch_assoc($query);
$res_username = $result['username'];
$res_id = $result['id'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link href="https://fonts.googleapis.com/css?family=PT+Sans+Caption:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
    <link rel="stylesheet" href="css/index.css">

</head>

<body>

    <section class="hero">
        <header id="header">
            <a id="logo" href="#">Marjana</a>
        </header>
        <header class="hero-header">
            <h1 class="presentation-title">Welcome, <?php echo $_SESSION['username']; ?>!</h1>
        </header>
        <footer class="hero-footer">
            <a class="button" target="_blank" href="https://github.com/Marjana15">Visit Github</a>
            <a class="button button-primary" href="edit.php?id=<?php echo $res_id; ?>">Edit Profile</a>
            <a class="button" href="logout.php">Logout</a>
        </footer>
    </section>


</body>

</html>