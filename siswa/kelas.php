<?php
require_once '../isLogin.php';
include_once '../connection.php';
include_once '../helper.php';
global $connect;
$user_id = getUserId();
$siswa_id = getSiswaId();
$absen_kelas_siswa_query = 'SELECT k.id, k.nama,k.kode_kelas, c.nama as nama_cabang, p.nama as nama_pengajar, j.jam, j.hari FROM kelas k join daftar_siswa d on k.id = d.kelas_id join pengajar p on k.pengajar_id = p.id join cabang c on k.cabang_id = c.id join jadwal_kelas j on k.id = j.kelas_id WHERE d.siswa_id = '.$siswa_id;
$absen_kelas_siswa_result = mysqli_query($connect, $absen_kelas_siswa_query);
$absen_kelas_siswa = mysqli_fetch_all($absen_kelas_siswa_result, MYSQLI_ASSOC);
include_once '../template/header.php'; ?>
    <div class="container container-boxed main-content">
        <div class="container-header fw-semibold">Data Kelas dan Jadwal</div>
        <div class="row">
            <?php foreach ($absen_kelas_siswa as $presensi) { ?>
                <div class="col-md-6">
                    <div class="card-pengajar">
                        <div class="row">
                            <div class="col-md-8 d-flex flex-column justify-content-start">
                                <h4 class="fw-bold"><?php echo $presensi['nama']; ?></h4>
                                <h6><?php echo $presensi['kode_kelas']; ?></h6>
                                <div class="d-flex gap-2">
                                <a href="list_presensi.php?kelas_id=<?php echo $presensi['id']; ?>"
                                   class="btn btn-success btn-sm">Lihat Presensi</a>
                                <a href="daftar_materi.php?id=<?php echo $presensi['id']; ?>"
                                   class="btn btn-info btn-sm">Materi Kelas</a>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex flex-column justify-content-end">
                                <h5 class="fw-semibold"><?php echo $presensi['nama_pengajar']; ?></h5>
                                <h6><?php echo $presensi['hari']." ". $presensi['jam']; ?></h6>
                                <p><?php echo $presensi['nama_cabang']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
include_once '../template/footer.php';