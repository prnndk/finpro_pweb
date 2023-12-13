<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  </head>
  <body class="bg-primary">
        <div class="row mt-5 pt-5 mb-5 pb-5">
          <div class="col-3">
          </div>
          <div class="col-9 border rounded-end rounded-4 bg-light">
            <div class="">
                <div for="validation" class="card-body">
                    <h3 class="text-left fw-bold mt-5 ms-5">Login</h3>
    
                    <form method="post" action="login">
                        <div class="ms-5 w-75">
                            <label for="exampleInputEmail1" class="form-label">Email address</label>
                            <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                        </div>
                        <div class="ms-5 w-75">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" name="password" class="form-control mb-4" id="exampleInputPassword1">
                        </div>
                        <div class="mb-5 ms-5 w-100">
                            <button type="submit" class="btn border-primary btn-light w-75">Login</button>
                            <div id="Signup" class="form-text text-center mt-3 w-75">
                                Doesn't have account? <a class="text-primary" href="register.html">Signup here</a>
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
            </div>
          </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
  </body>
</html>