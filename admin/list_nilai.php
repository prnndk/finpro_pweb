<?php
require_once '../isAdmin.php';
if (!isset($_GET['kelas_id']) && !isset($_GET['pengajar_id'])) {
    header('Location: nilai.php');
}
$kelas_id = $_GET['kelas_id'];
$pengajar_id = $_GET['pengajar_id'];

include_once '../connection.php';
//get kelas and pengajar
$kelas_query = "SELECT k.nama as nama_kelas, p.nama as nama_pengajar FROM kelas k join pengajar p on k.pengajar_id = p.id where k.id = '$kelas_id' and k.pengajar_id = '$pengajar_id'";
$kelas_result = mysqli_query($connect, $kelas_query);
$kelas = mysqli_fetch_assoc($kelas_result);
if (!$kelas) {
    header('Location:nilai.php?error=true');
}
$nilai_siswa_query = "SELECT n.id, k.nama as nama_kelas, n.nilai, n.catatan, s.nama as nama_siswa FROM nilai_siswa n join kelas k on n.kelas_id = k.id join siswas s on n.siswa_id = s.id where n.kelas_id = '$kelas_id' and n.pengajar_id = '$pengajar_id'";
$nilai_siswa_result = mysqli_query($connect, $nilai_siswa_query);
$nilai_siswa = mysqli_fetch_all($nilai_siswa_result, MYSQLI_ASSOC);
include_once '../template/header.php'; ?>
    <div class="container container-boxed main-content">
        <div class="container-header">Daftar Nilai Siswa <?= $kelas['nama_kelas'] ?></div>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#nilaiModal">Tambah Nilai
        </button>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Nilai Siswa</th>
                <th scope="col">Catatan</th>
                <th scope="col">Aksi Kelas</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($nilai_siswa as $nilai) { ?>
                <tr>
                    <td><?php echo $nilai['nama_kelas']; ?></td>
                    <td><?php echo $nilai['nama_siswa']; ?></td>
                    <td><?php echo $nilai['nilai']; ?></td>
                    <td><?php echo $nilai['catatan']; ?></td>
                    <td>
                        <button data-nilai-id="<?php echo $nilai['id']; ?>" class="btn btn-primary btn-sm"
                                data-bs-toggle="modal" data-bs-target="#nilaiModal<?php echo $nilai['id']; ?>">Rubah
                            Nilai
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="nilaiModal<?php echo $nilai['id'] ?>" tabindex="-1"
                     aria-labelledby="presensiModal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="presensiModalLabel">Rubah Nilai Siswa</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="error_catcher"></div>
                                <form method="post" id="rubah_nilai<?php echo $nilai['id'] ?>">
                                    <label for="nilai_siswa">Nilai Siswa</label>
                                    <input type="text" name="nilai_siswa" id="nilai_siswa" class="form-control mb-3"
                                           value="<?php echo $nilai['nilai'] ?>">
                                    <label for="nilai_siswa">Catatan Nilai Siswa</label>
                                    <input type="text" name="catatan" id="catatan" class="form-control mb-3"
                                           value="<?php echo $nilai['catatan'] ?>">
                                    <input type="hidden" name="nilai_siswa_id" id="nilai_siswa_id"
                                           value="<?php echo $nilai['id']; ?>"/>
                                    <button type="submit" id="insert_button" class="btn btn-primary">Rubah Nilai
                                    </button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
                <script src="https://code.jquery.com/jquery-3.7.1.min.js"
                        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
                        crossorigin="anonymous"></script>
                <script>$(document).ready(function () {
                        $('#rubah_nilai<?php echo $nilai['id'] ?>').on("submit", function (event) {
                            event.preventDefault();
                            // cek nilai is float
                            if (!$.isNumeric($('#nilai_siswa').val())) {
                                alert("Nilai harus angka");
                            } else if ($('#Nilai').val() == "") {
                                alert("Nilai is required");
                            } else {
                                $.ajax({
                                    url: "rubah_nilai.php",
                                    method: "POST",
                                    data: $('#rubah_nilai<?php echo $nilai['id'] ?>').serialize(),
                                    success: function (data) {
                                        $('#rubah_nilai')[0].reset();
                                        $('.modal-body #error_catcher').append(
                                            `<div class="alert alert-success" role="alert">Berhasil Merubah Nilai</div>`
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

            <?php } ?>
            </tbody>
        </table>
    </div>
    <div class="modal fade" id="nilaiModal" tabindex="-1" aria-labelledby="nilaiModal" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="nilaiModalLabel">Tambahkan Nilai Siswa</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="error_catcher"></div>
                    <form method="post" id="input_nilai">
                        <label for="nilai_siswa_input">Nilai Siswa</label>
                        <input type="text" name="nilai_siswa" id="nilai_siswa_input" class="form-control mb-3">
                        <label for="catatan">Catatan Nilai Siswa</label>
                        <input type="text" name="catatan" id="catatan_input" class="form-control mb-3">
                        <!--                        select siswa-->
                        <label for="siswa_id">Siswa</label>
                        <select name="siswa_id" id="siswa_id" class="form-control mb-3">
                            <?php
                            $siswa_query = "SELECT s.id,s.nama FROM siswas s join daftar_siswa d on s.id = d.siswa_id where d.kelas_id = '$kelas_id'";
                            $siswa_result = mysqli_query($connect, $siswa_query);
                            $siswa = mysqli_fetch_all($siswa_result, MYSQLI_ASSOC);
                            foreach ($siswa as $item) {
                                ?>
                                <option value="<?php echo $item['id'] ?>"><?php echo $item['nama'] ?></option>
                            <?php } ?>
                        </select>
                        <input type="hidden" name="kelas_id" id="kelas_id" value="<?php echo $kelas_id ?>"/>
                        <input type="hidden" name="pengajar_id" id="pengajar_id" value="<?php echo $pengajar_id ?>"/>
                        <button type="submit" id="input_nilai_btn" class="btn btn-primary">Tambah Nilai</button>
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
            $('#input_nilai').on("submit", function (event) {
                event.preventDefault();
                if (!$.isNumeric($('#nilai_siswa_input').val())) {
                    alert("Nilai harus angka");
                } else if ($('#siswa_id').val() == "") {
                    alert("Cannot be null");
                } else if ($('#nilai_siswa_input').val() == "") {
                    alert("Nilai is required");
                } else {

                    $.ajax({
                        url: "tambah_nilai.php",
                        method: "POST",
                        data: $('#input_nilai').serialize(),
                        success: function (data) {
                            $('#input_nilai')[0].reset();
                            $('.modal-body #error_catcher').append(
                                `<div class="alert alert-success" role="alert">Berhasil Merubah Nilai</div>`
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