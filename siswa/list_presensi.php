<?php
require_once '../isLogin.php';
$kelas_id = $_GET['kelas_id'];
include_once '../connection.php';
include_once '../helper.php';
global $connect;
$user_id = getUserId();
$siswa_id = getSiswaId();
$query_kelas = "SELECT nama, kode_kelas from kelas where id = '$kelas_id'";
$result_kelas = mysqli_query($connect, $query_kelas);
$kelas = mysqli_fetch_assoc($result_kelas);
if (!$kelas) {
    header('Location:absensi.php?error=true');
}
$query_presensi_siswa_query = "SELECT a.expired_at, a.created_at, abs.kehadiran FROM absen_kelas a left join absen_siswa abs on a.id = abs.absen_id where a.kelas_id = '$kelas_id' AND abs.siswa_id = '$siswa_id'";
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
                <th scope="col">Kehadiran</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($presensi_siswa as $presensi) {?>
            <tr>
                <td>
                    <?php echo $presensi['expired_at']; ?>
                </td>
                <td><?php echo $presensi['created_at']; ?></td>
                <td><?php echo $presensi['kehadiran'] == 'HADIR' ? '<span class="badge rounded-pill text-bg-success">Hadir</span>' : '<span class="badge rounded-pill text-bg-danger">ALPHA</span>'; ?>
                </td>
                <!-- <td>
                    <a href="list-presensi.php?id=<?php echo $presensi['id']; ?>" class="btn btn-success btn-sm">Lihat
                        Presensi</a>
                </td> -->
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
                <h1 class="modal-title fs-5" id="presensiModalLabel">Presensi Online</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error_catcher"></div>
                <form method="post" id="insert_form">
                    <input type="text" name="kode_absen" id="kode_absen" placeholder="Kode Absen" maxlength="6"
                        class="form-control mb-3" />
                    <input type="hidden" name="kelas_id" id="kelas_id" value="<?php echo $kelas_id; ?>" />
                    <input type="hidden" name="siswa_id" id="siswa_id" value="<?php echo $siswa_id; ?>" />
                    <input type="submit" name="insert" id="insert" value="Presensi" class="btn btn-primary" />
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
        if ($('#kode_absen').val() == "") {
            alert("Kode Absen is required");
        } else {
            $.ajax({
                url: "proses_presensi.php",
                method: "POST",
                data: $('#insert_form').serialize(),
                beforeSend: function() {
                    $('#insert').val("Proccessing");
                },
                success: function(data) {
                    $('#insert_form')[0].reset();
                    $('.modal-body #error_catcher').append(
                        `<div class="alert alert-success" role="alert">Berhasil Presensi</div>`
                        );
                    $('#insert').val("Presensi");
                },
                error: function(param) {
                    const error_msg = JSON.parse(param.responseText);
                    $('.modal-body #error_catcher').append(`<div class="alert alert-danger" role="alert">
                            ${error_msg.error}
                        </div>`);
                    $('#insert').val("Presensi");
                }
            });
        }
    });
});
</script>
<?php
include_once '../template/footer.php';