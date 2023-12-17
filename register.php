<?php
//cek user is login
session_start();
if (isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body class="bg-primary">
    <div class="row ,y-5 py-5 mx-0">
        <div class="col-9 border rounded-start rounded-4 bg-light">
            <div class="">
                <div for="validation" class="card-body">
                    <h3 class="text-left fw-bold mt-5 mb-4 ms-5">Register</h3>

                    <form action="register_process.php" method="POST">
                        <div class="ms-5 w-75">
                            <label for="email" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="email" aria-describedby="email"
                                required>
                        </div>

                        <div class="ms-5 w-75">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="name" aria-describedby="name"
                                required>
                        </div>

                        <div class="ms-5 w-75">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="username"
                                aria-describedby="username" required>
                        </div>

                        <div class="ms-5 w-75">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control mb-4" name="password" id="password" required>
                        </div>
                        <div class="ms-5 w-75">
                            <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                            <input type="date" class="form-control" name="tanggal_lahir" id="tanggal_lahir"
                                aria-describedby="tanggal_lahir" required>
                        </div>
                        <div class="ms-5 w-75">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id="alamat" aria-describedby="alamat"
                                required>
                        </div>
                        <div class="ms-5 w-75">
                            <label for="no_hp" class="form-label">Nomor HP</label>
                            <input type="text" class="form-control" name="no_hp" id="no_hp" aria-describedby="no_hp"
                                required>
                        </div>
                        <div class="ms-5 w-75">
                            <label for="riwayat_belajar" class="form-label">Riwayat Belajar</label>
                            <input type="text" class="form-control" name="riwayat_belajar" id="riwayat_belajar"
                                aria-describedby="riwayat_belajar" required>
                        </div>
                        <div class="my-4 ms-5 w-100">
                            <button type="submit" id="submit_btn" name="register" class="btn btn-outline-primary w-75">
                                Register
                            </button>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous">
        </script>
</body>

</html>