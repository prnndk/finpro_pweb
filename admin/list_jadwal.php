<?php
require_once '../isAdmin.php';
if (!isset($_GET['id'])) {
    header('Location: nilai.php');
}
$kelas_id = $_GET['id'];

include_once '../connection.php';
include_once '../helper.php';
//get kelas and pengajar
$kelas_query = "SELECT k.nama as nama_kelas, k.kode_kelas FROM kelas k join pengajar p on k.pengajar_id = p.id where k.id = '$kelas_id'";
$kelas_result = mysqli_query($connect, $kelas_query);
$kelas = mysqli_fetch_assoc($kelas_result);
if (!$kelas) {
    header('Location:nilai.php?error=true');
}
$jadwal_query = "SELECT j.id, j.hari, j.jam FROM jadwal_kelas j join kelas k on j.kelas_id = k.id where k.id = '$kelas_id'";
$jadwal_result = mysqli_query($connect, $jadwal_query);
$jadwal = mysqli_fetch_all($jadwal_result, MYSQLI_ASSOC);

$hari = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
include_once '../template/header.php'; ?>
    <div class="container container-boxed main-content">
        <div class="container-header fw-semibold">Data Kelas dan Jadwal</div>
        <button type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#tambahJadwal">Tambah Jadwal</button>
        <div class="row">
            <?php foreach ($jadwal as $item) { ?>
                <div class="col-md-6">
                    <div class="card-pengajar p-4">
                        <div class="row">
                            <div class="col-md-8 d-flex flex-column justify-content-start">
                                <h4 class="fw-bold"><?php echo indonesiaDate($item['hari']); ?></h4>
                                <h6><?php echo $item['jam']; ?></h6>
                            </div>
                            <div class="col-md-4 d-flex flex-column justify-content-end">
                                <h5 class="fw-semibold"><?php echo $kelas['nama_kelas']; ?></h5>
                                <p><?php echo $kelas['kode_kelas']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
    <div class="modal fade" id="tambahJadwal" tabindex="-1" aria-labelledby="tambahJadwal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="nilaiModalLabel">Tambahkan Nilai Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error_catcher"></div>
                    <form method="post" id="tambah_jadwal">
                        <label for="jam">Masukkan Jam</label>
                        <input type="time" name="jam" id="jam" class="form-control mb-3">
                        <label for="hari">Pilih Hari</label>
                        <select name="hari" id="hari" class="form-control mb-3">
                            <?php
                            foreach ($hari as $item) {
                                ?>
                                <option value="<?php echo $item ?>"><?php echo $item ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="kelas_id" id="kelas_id" value="<?php echo $kelas_id ?>"/>
                        <button type="submit"  id="input_nilai_btn" class="btn btn-primary" >Tambah Jadwal Baru</button>
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
        $(document).ready(function() {
            $('#tambah_jadwal').on("submit", function(event) {
                event.preventDefault();
                // cek is jam is time
                if ($('#jam').val() == "") {
                    alert("Jam is required");
                }else if($('#hari').val() == ""){
                    alert("Hari is required");
                } else {

                    $.ajax({
                        url: "tambah_jadwal.php",
                        method: "POST",
                        data: $('#tambah_jadwal').serialize(),
                        success: function(data) {
                            $('#tambah_jadwal')[0].reset();
                            $('.modal-body #error_catcher').append(
                                `<div class="alert alert-success" role="alert">Berhasil Menambahkan Jadwal</div>`
                            );
                            location.reload()
                        },
                        error: function(param) {
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