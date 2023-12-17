<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Landing Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar fixed-top navbar-expand-lg bg-info">
        <div class="container-fluid">
            <a class="navbar-brand text-light fw-bold" href="index.php">BIMBEL ACC</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="register.php">Pendaftaran Baru</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#lokasi">Lokasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="#informasi">Informasi</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="siswa/dashboard.php">Mata Pelajaran</a>
                    </li>
                </ul>
                <a href="login.php" class="btn btn-outline-light me-2" type="button">Login</a>
            </div>
        </div>
    </nav>

    <div class="row p-5 mt-5 bg-info">
        <h1 class="text-center text-light fw-bold">Aktual Cendekia Course</h1>
        <h5 class="text-center text-light fw-light">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Culpa expedita itaque neque nesciunt rem? Excepturi laboriosam quaerat sed velit. A commodi eligendi in iusto molestias nihil nobis praesentium quis similique!</h5>

    </div>
    <div class="row">
        <div class="col-1">
            <div class="row pt-3 bg-info h-50">
                <h4 class="text-info">baris1</h4>
            </div>
            <div class="row pb-3 bg-light">
                <h4 class="text-light">baris2</h4>
            </div>
        </div>

        <div class="col-10 pt-5 pb-5 border-3 shadow bg-light rounded-4">
            <div class="row justify-content-between">
                <div class="col-3 text-center">
                    <img src="image/go_to_class.png" class="img-fluid" alt="gotoclass">
                    <div class="text-center">
                        <a href="siswa/dashboard.php" class="btn text-black btn-outline-light" onclick="goToPage()">Go to Class</a>
                    </div>
                </div>
                    
                <div class="col-3 text-center">
                    <img src="image/register.png" class="img-fluid" alt="registerasstudent">
                    <div class="text-center">
                        <a href="register.php" class="btn text-black btn-outline-light" onclick="goToPage()">Register as Student</a>
                    </div>
                </div>
    
                <div class="col-3 text-center">
                    <img src="image/teacher_list.png" class="img-fluid" alt="teacherlist">
                    <div class="text-center">
                        <a href="admin/daftar_guru.php" class="btn text-black btn-outline-light" onclick="goToPage()">Teacher List</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-1">
            <div class="row pt-3 bg-info h-50">
                <h4 class="text-info">baris1</h4>
            </div>
            <div class="row pb-3 bg-light">
                <h4 class="text-light">baris2</h4>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 mb-4">
        <h1 id="lokasi">
            OUR LOCATION
        </h1>
    </div>

    <div class="d-flex justify-content-center mb-4">
        <div class="card" style="width: 70%;">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title mt-3 ms-3">CABANG MERR</h5>
                        <p class="card-text ms-3">Jalan Ir. Soekarno Hatta Testing 123 Deket ITS kok</p>
                        <a href="https://maps.app.goo.gl/ypq79M7f4XfkRGGH6" class="btn btn-info ms-3">Go To Detail</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="image/Rectangle 6.png" class="img-fluid" alt="alamat">
                </div>
            </div>
        </div>
    </div>
    
    <div class="d-flex justify-content-center mb-4">
        <div class="card" style="width: 70%;">
            <div class="row g-0">
                <div class="col-md-8">
                    <div class="card-body">
                        <h5 class="card-title mt-3 ms-3">CABANG NGADILUWIH</h5>
                        <p class="card-text ms-3">Jalan Proborini deket stasiun</p>
                        <a href="https://maps.app.goo.gl/N7QHrqazECCsQVWk8" class="btn btn-info ms-3">Go To Detail</a>
                    </div>
                </div>
                <div class="col-md-4">
                    <img src="image/Rectangle 6.png" class="img-fluid" alt="alamat">
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mt-5 mb-4">
        <h1>
            JENJANG LOREM
        </h1>
    </div>

    <div class="row justify-content-center">
        <div class="col-10 pt-5 pb-5">
            <div class="row justify-content-around">
                <div class="col-3 text-center">
                    <img src="image/Rectangle 8.png" class="img-fluid" alt="wendy">
                </div>
                    
                <div class="col-3 text-center">
                    <img src="image/Rectangle 9.png" class="img-fluid" alt="wendy">
                </div>
    
                <div class="col-3 text-center">
                    <img src="image/Rectangle 10.png" class="img-fluid" alt="wendy">
                </div>
            </div>
        </div>
    </div>

    <div class="text-center mb-5">
        <a href="faq.html" id="informasi" class="btn btn-light btn-outline-info">Go To Detail</a>
    </div>
        
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
</body>
</html>
