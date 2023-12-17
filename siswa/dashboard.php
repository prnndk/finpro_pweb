<?php

require_once '../isLogin.php';
if ($_SESSION['isAdmin'] == true) {
    header('Location: ../admin/dashboard.php');
}
//get user id from session
include_once '../connection.php';
include_once '../helper.php';
$user_id = getUserId();
$siswa_id = getSiswaId();
$user = getUserData();
$query_kelas_akan_datang = 'SELECT k.kode_kelas as kode, k.nama, j.jam, j.hari AS day FROM kelas k JOIN daftar_siswa ds on k.id = ds.kelas_id JOIN jadwal_kelas j ON k.id = j.kelas_id JOIN pengajar p ON k.pengajar_id = p.id WHERE j.hari = DAYNAME(DATE_ADD(DATE(NOW()), INTERVAL 1 DAY)) AND ds.siswa_id = '.$siswa_id.' LIMIT 1';
$result_kelas_akan_datang = mysqli_query($connect, $query_kelas_akan_datang);
$kelas_akan_datang = mysqli_fetch_row($result_kelas_akan_datang);
$query_get_kelas_user = "SELECT k.nama, k.kode_kelas, j.hari, j.jam, d.kelas_id FROM daftar_siswa d JOIN kelas k ON d.kelas_id = k.id JOIN jadwal_kelas j ON k.id = j.kelas_id WHERE d.siswa_id = '$siswa_id' GROUP BY j.hari, k.nama, k.kode_kelas, j.jam, d.kelas_id";
$result_get_kelas_user = mysqli_query($connect, $query_get_kelas_user);
$kelas_user = mysqli_fetch_all($result_get_kelas_user, MYSQLI_ASSOC);
$kelas_user = array_reduce($kelas_user, function ($result, $item) {
    $result[$item['hari']][] = $item;

    return $result;
}, []);

$hari = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
require_once '../helper.php';
require_once '../template/header.php';
?>
<div class="container container-boxed main-content">
    <div class="row p-4">
        <div class="col-md-6">
            <div class="card-jadwal">
                <div class="card-jadwal-hari">
                    <?php if (!empty($kelas_akan_datang)): ?>
                        <div class="fs-4 fw-bold"><?php echo $kelas_akan_datang[1] ?></div>
                        <div class="desc"><?php echo $kelas_akan_datang[2]; ?><br /><?php echo $kelas_akan_datang[0]; ?>
                        </div>
                    <?php else: ?>
                        <div class="fs-4 fw-bold">No data available</div>
                    <?php endif; ?>
                </div>
                <div class="card-jadwal-text">Kelas Yang Akan Datang</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="profile-dashboard ">
                <img src="https://t4.ftcdn.net/jpg/03/64/21/11/360_F_364211147_1qgLVxv1Tcq0Ohz3FawUfrtONzz8nq3e.jpg"
                    alt="" width="200" height="150" class="profile-image d-none d-lg-flex" />
                <div class="profile-nama p-4">
                    <h3 class="fw-semibold">Hello, <?php echo $user['name'];?></h3>
                    <a href="#">Go to my profile</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container container-boxed mt-5">
    <div class="container-header">Jadwal Kelas</div>
    <div class="row mt-5">
        <?php foreach ($kelas_user as $kelas) {?>

        <div class="col-md-6">
            <div class="card-jadwal-2">
                <div class="card-jadwal-list">
                    <h3 class="fw-bold"><?php echo indonesiaDate($kelas[0]['hari']); ?></h3>
                </div>
                <div class="mapel-list">
                    <?php foreach ($kelas as $jadwal) { ?>
                    <div class="row">
                        <div class="col-md-8">
                            <p class="fw-bold fs-5 mb-0">
                                <?php echo $jadwal['nama']; ?>
                            </p>
                            <p class="my-1"><?php echo $jadwal['jam']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <p class="badge rounded-pill text-bg-primary">
                                <?php echo $jadwal['kode_kelas']; ?></p>
                        </div>
                    </div>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php } ?>
    </div>
</div>

<?php require_once '../template/footer.php'; ?>