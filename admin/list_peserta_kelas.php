<?php
require_once '../isAdmin.php';
// get header kelas_id
$kelas_id = $_GET['id'];
include_once '../connection.php';
global $connect;
$query_kelas = "SELECT nama,kode_kelas from kelas k where k.id = '$kelas_id'";
$result_kelas = mysqli_query($connect, $query_kelas);
$kelas = mysqli_fetch_assoc($result_kelas);
if (!$kelas) {
    header('Location:kelas.php?error=true');
}
$query_peserta_kelas = "SELECT s.nama from daftar_siswa ds join siswas s on ds.siswa_id = s.id where ds.kelas_id =" . $kelas_id;
$result_peserta_kelas = mysqli_query($connect, $query_peserta_kelas);
$peserta_kelas = mysqli_fetch_all($result_peserta_kelas, MYSQLI_ASSOC);
include_once '../template/header.php'; ?>
<div class="container container-boxed main-content p-3">
    <div class="error_handler"></div>
    <div class="container-header">Data Peserta <?php echo $kelas['nama'].' '.$kelas['kode_kelas']; ?></div>
    <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#tambahPeserta">Tambah Peserta</button>
    <table class="table table-responsice mt-3">
        <thead>
            <tr>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($peserta_kelas as $peserta) {?>
            <tr>
                <td><?php echo $peserta['nama']; ?></td>
                </td>
                <td>

                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<!-- Modal for adding peserta -->
<div class="modal fade" id="tambahPeserta" tabindex="-1" aria-labelledby="tambahPesertaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="tambahPesertaLabel">Tambah Peserta</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error_catcher"></div>
                <form method="post" id="tambah_peserta">
                    <label for="siswa_id">Nama Siswa</label>
                    <select name="siswa_id" id="siswa_id" class="form-control mb-3">
                        <?php
                        $siswa_query = "SELECT * FROM siswas";
                        $siswa_result = mysqli_query($connect, $siswa_query);
                        $siswa = mysqli_fetch_all($siswa_result, MYSQLI_ASSOC);
                        foreach ($siswa as $siswa) {
                            ?>
                        <option value="<?php echo $siswa['id']; ?>"><?php echo $siswa['nama']; ?></option>
                        <?php } ?>
                    </select>
                    <input type="hidden" name="kelas_id" id="kelas_id" value="<?php echo $kelas_id; ?>">
                    <button type="submit" class="btn btn-primary" id="tambahPeserta">Tambah Peserta</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#tambah_peserta').on("submit", function(event) {
        event.preventDefault();

        $.ajax({
            url: "tambah_peserta.php",
            method: "POST",
            data: $('#tambah_peserta').serialize(),
            success: function(data) {
                $('#tambah_peserta')[0].reset();
                $('#error_catcher').empty();
                $('#error_catcher').append(
                    `<div class="alert alert-success" role="alert">Berhasil Menambah Peserta Kelas</div>`
                );
                location.reload();
            },
            error: function(param) {
                const error_msg = JSON.parse(param.responseText);
                $('#error_catcher').empty();
                $('#error_catcher').append(`<div class="alert alert-danger" role="alert">
                            ${error_msg.error}
                        </div>`);
            }
        });
    });
});
</script>
<?php
include_once '../template/footer.php';