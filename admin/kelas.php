<?php
require_once '../isAdmin.php';
include_once '../connection.php';
global $connect;
$absen_kelas_siswa_query = 'SELECT k.id, k.nama,k.kode_kelas, c.nama as nama_cabang, p.nama as nama_pengajar,p.id as pengajar_id FROM kelas k join pengajar p on k.pengajar_id = p.id join cabang c on k.cabang_id = c.id';
$absen_kelas_siswa_result = mysqli_query($connect, $absen_kelas_siswa_query);
$absen_kelas_siswa = mysqli_fetch_all($absen_kelas_siswa_result, MYSQLI_ASSOC);
include_once '../template/header.php'; ?>
    <div class="container container-boxed main-content">
        <div class="container-header fw-semibold">Data Kelas dan Jadwal</div>
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahKelas">Tambah
            Kelas
        </button>
        <div class="row">
            <?php foreach ($absen_kelas_siswa as $presensi) { ?>
                <div class="col-md-6">
                    <div class="card-pengajar">
                        <div class="row">
                            <div class="col-md-8 d-flex flex-column justify-content-start">
                                <h4 class="fw-bold"><?php echo $presensi['nama']; ?></h4>
                                <h6><?php echo $presensi['kode_kelas']; ?></h6>
                                <div class="d-flex gap-2">
                                    <a href="list_presensi.php?kelas_id=<?php echo $presensi['id'] . "&pengajar_id=" . $presensi['pengajar_id']; ?>"
                                       class="btn btn-success btn-sm">Presensi</a>
                                    <a href="list_materi.php?id=<?php echo $presensi['id']; ?>"
                                       class="btn btn-info btn-sm">Materi</a>
                                    <a href="list_jadwal.php?id=<?php echo $presensi['id']; ?>"
                                       class="btn btn-primary btn-sm">Jadwal</a>
                                    <a href="list_peserta_kelas.php?id=<?php echo $presensi['id']; ?>"
                                       class="btn btn-outline-dark btn-sm">Peserta</a>
                                </div>
                            </div>
                            <div class="col-md-4 d-flex flex-column justify-content-end">
                                <h5 class="fw-semibold"><?php echo $presensi['nama_pengajar']; ?></h5>
                                <p><?php echo $presensi['nama_cabang']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="modal fade" id="tambahKelas" tabindex="-1" aria-labelledby="kelasModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="presensiModalLabel">Tambahkan kelas</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error_catcher_tambah_kelas"></div>
                    <form method="post" id="tambah_kelas">
                        <label for="nilai_siswa">Nama Kelas</label>
                        <input type="text" name="nama" id="nama" class="form-control mb-3">
                        <label for="nilai_siswa">Pengajar</label>
                        <select name="pengajar_id" id="pengajar_id" class="form-control mb-3">
                            <?php
                            $pengajar_query = "SELECT * FROM pengajar";
                            $pengajar_result = mysqli_query($connect, $pengajar_query);
                            $pengajar = mysqli_fetch_all($pengajar_result, MYSQLI_ASSOC);
                            foreach ($pengajar as $pengajar) {
                                ?>
                                <option value="<?php echo $pengajar['id']; ?>"><?php echo $pengajar['nama']; ?></option>
                            <?php } ?>
                        </select>
                        <label for="nilai_siswa">Cabang</label>
                        <select name="cabang_id" id="cabang_id" class="form-control mb-3">
                            <?php
                            $cabang_query = "SELECT * FROM cabang";
                            $cabang_result = mysqli_query($connect, $cabang_query);
                            $cabang = mysqli_fetch_all($cabang_result, MYSQLI_ASSOC);
                            foreach ($cabang as $cabang) {
                                ?>
                                <option value="<?php echo $cabang['id']; ?>"><?php echo $cabang['nama']; ?></option>
                            <?php } ?>
                        </select>
                        <button type="submit" id="insert_button" class="btn btn-primary">Tambah Kelas</button>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function () {
            $('#tambah_kelas').on("submit", function (event) {
                event.preventDefault();
                if ($('#nama').val() == "") {
                    alert("nama is required");
                } else {
                    $.ajax({
                        url: "tambah_kelas.php",
                        method: "POST",
                        data: $('#tambah_kelas').serialize(),
                        success: function (data) {
                            $('#tambah_kelas')[0].reset();
                            $('.modal-body #error_catcher').append(
                                `<div class="alert alert-success" role="alert">Berhasil Menambahkan Kelas</div>`
                            );
                            location.reload()
                        },
                        error: function (param) {
                            const error_msg = JSON.parse(param.responseText);
                            $('.modal-body #error_catcher').append(`<div class="alert alert-danger" role="alert">
                            ${error_msg.error}
                        </div>`);
                        }
                    });
                }
            });
        });
    </script>
<?php
include_once '../template/footer.php';