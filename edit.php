<?php
session_start();

include("connection.php");

if (!isset($_SESSION['username'])) {
    header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Profile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style1.css">
</head>

<body>

    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Change Profile</h3>
            </div>
            <div class="card-body">

                <?php

                if (isset($_POST['update'])) {
                    $username = $_POST['username'];
                    $email = $_POST['email'];
                    $password = $_POST['password'];

                    $id = $_SESSION['id'];
                    $edit_query = mysqli_query($conn, "UPDATE users SET username='$username', email='$email', password='$password' WHERE id = $id");

                    if ($edit_query) {
                        echo "<div class='alert alert-success' role='alert'>
                    Profile Updated!
                    </div>";
                        echo "<a href='dashboard.php'><button class='btn btn-primary'>Go Home</button></a>";
                    }
                } else {

                    $id = $_SESSION['id'];
                    $query = mysqli_query($conn, "SELECT * FROM users WHERE id = $id") or die("error occurs");

                    while ($result = mysqli_fetch_assoc($query)) {
                        $res_username = $result['username'];
                        $res_email = $result['email'];
                        $res_password = $result['password'];
                        $res_id = $result['id'];
                    }

                ?>

                <form action="#" method="POST" enctype="multipart/form-data">

                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-user"></i></span>
                            <input type="text" class="form-control" id="username" name="username" value="<?php echo $res_username; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo $res_email; ?>" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            <input type="password" class="form-control" id="password" name="password" value="<?php echo $res_password; ?>" required>
                            <span class="input-group-text"><i class="fa fa-eye toggle" id="togglePassword"></i></span>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" name="update" id="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>
                <?php } ?>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('togglePassword').addEventListener('click', function (e) {
            const password = document.getElementById('password');
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>

</html>
