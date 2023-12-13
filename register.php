<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="bg-primary">
    <div class="row mt-5 pt-5 mb-5 pb-5">
        <div class="col-9 border rounded-start rounded-4 bg-light">
            <div class="">
                <div for="validation" class="card-body">
                    <h3 class="text-left fw-bold mt-5 mb-4 ms-5">Register</h3>
    
                    <form action="register_process.php" method="POST">
                        <div class="ms-5 w-75">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>

                        <div class="ms-5 w-75">
                            <label for="exampleInputEmail1" class="form-label">Name</label>
                            <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>

                        <div class="ms-5 w-75">
                            <label for="exampleInputEmail1" class="form-label">Username</label>
                            <input type="text" class="form-control" name="username" id="exampleInputEmail1" aria-describedby="emailHelp" required>
                        </div>

                        <div class="ms-5 w-75">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control mb-4" name="password" id="exampleInputPassword1" required>
                        </div>
                        <div class="mb-5 ms-5 w-100">
                            <button type="submit" name="register" class="btn border-primary btn-light w-75">Register</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-3"></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>