<?php

require_once '../isAdmin.php';
// get header kelas_id
$kelas_id = $_GET['kelas_id'];
$pengajar_id = $_GET['pengajar_id'];
include_once '../connection.php';
$query_kelas = "SELECT nama, kode_kelas from kelas where id = '$kelas_id'";
$result_kelas = mysqli_query($connect, $query_kelas);
$kelas = mysqli_fetch_assoc($result_kelas);
if (!$kelas) {
    header('Location:absensi.php?error=true');
}
$query_presensi_siswa_query = "SELECT a.expired_at, a.created_at, a.kode_absen, a.id FROM absen_kelas a where a.kelas_id = '$kelas_id'";
$query_presensi_siswa_result = mysqli_query($connect, $query_presensi_siswa_query);
$presensi_siswa = mysqli_fetch_all($query_presensi_siswa_result, MYSQLI_ASSOC);
$presensi_siswa = array_map(function ($item) {
    $item['expired_at'] = date('d F Y H:i', strtotime($item['expired_at']));
    $item['created_at'] = date('d F Y H:i', strtotime($item['created_at']));

    return $item;
}, $presensi_siswa);
include_once '../template/header.php'; ?>
<div class="container container-boxed main-content p-3">
    <div class="container-header">Presensi Kelas <?php echo $kelas['nama'].' '.$kelas['kode_kelas']; ?></div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
        data-bs-target="#presensiModal">Presensi</button>
    <table class="table table-responsice mt-3">
        <thead>
            <tr>
                <th scope="col">Presensi Berakhir</th>
                <th scope="col">Presensi Mulai</th>
                <th scope="col">Kode Absen</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($presensi_siswa as $presensi) {?>
            <tr>
                <td>
                    <?php echo $presensi['expired_at']; ?>
                </td>
                <td><?php echo $presensi['created_at']; ?></td>
                <td><?php echo $presensi['kode_absen']; ?></td>
                </td>
                <td>
                    <a href="list_presensi_siswa.php?id=<?php echo $presensi['id']; ?>"
                        class="btn btn-success btn-sm">Lihat
                        Presensi</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <!-- Modal -->
</div>
<div class="modal fade" id="presensiModal" tabindex="-1" aria-labelledby="presensiModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="presensiModalLabel">Buat Presensi Kelas</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error_catcher"></div>
                <form method="post" id="insert_form">
                    <label for="expired_at">Jam Berakhir</label>
                    <input type="datetime-local" name="expired_at" id="expired_at" class="form-control mb-3">
                    <input type="hidden" name="kelas_id" id="kelas_id" value="<?php echo $kelas_id; ?>" />
                    <input type="hidden" name="pengajar_id" id="pengajar_id" value="<?php echo $pengajar_id; ?>" />
                    <button type="submit" id="insert_button" class="btn btn-primary">Buat Presensi</button>
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
    $('#insert_form').on("submit", function(event) {
        event.preventDefault();
        if ($('#expired_at').val() == "") {
            alert("Tanggal Presensi Berakhir is required");
        } else {
            $.ajax({
                url: "buat_presensi.php",
                method: "POST",
                data: $('#insert_form').serialize(),
                success: function(data) {
                    $('#insert_form')[0].reset();
                    $('.modal-body #error_catcher').append(
                        `<div class="alert alert-success" role="alert">Berhasil Presensi</div>`
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