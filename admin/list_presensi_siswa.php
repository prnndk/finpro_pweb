<?php
require_once '../isAdmin.php';
// get header kelas_id
$absen_id = $_GET['id'];
include_once '../connection.php';
$query_kelas = "SELECT nama, kode_kelas from absen_kelas abs join kelas k on abs.kelas_id = k.id where abs.id = '$absen_id'";
$result_kelas = mysqli_query($connect, $query_kelas);
$kelas = mysqli_fetch_assoc($result_kelas);
if (!$kelas) {
    header('Location:absensi.php?error=true');
}
$query_presensi_siswa_query = "SELECT  a.created_at, s.nama,a.kehadiran,a.id FROM absen_siswa a join siswas s on a.siswa_id = s.id  where a.absen_id = '$absen_id'";
$query_presensi_siswa_result = mysqli_query($connect, $query_presensi_siswa_query);
$presensi_siswa = mysqli_fetch_all($query_presensi_siswa_result, MYSQLI_ASSOC);
$presensi_siswa = array_map(function ($item) {
    $item['created_at'] = date('d F Y H:i', strtotime($item['created_at']));

    return $item;
}, $presensi_siswa);
include_once '../template/header.php'; ?>
<div class="container container-boxed main-content p-3">
    <div class="error_handler"></div>
    <div class="container-header">Data Presensi <?php echo $kelas['nama'].' '.$kelas['kode_kelas']; ?></div>
    <table class="table table-responsice mt-3">
        <thead>
            <tr>
                <th scope="col">Jam Presensi</th>
                <th scope="col">Siswa Nama</th>
                <th scope="col">Kehadiran</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($presensi_siswa as $presensi) {?>
            <tr>
                <td><?php echo $presensi['created_at']; ?></td>
                <td><?php echo $presensi['nama']; ?></td>
                <td><?php echo $presensi['kehadiran'] == 'HADIR' ? '<span class="badge rounded-pill text-bg-success">HADIR</span>' : '<span class="badge rounded-pill text-bg-danger">ALPHA</span>'; ?>
                </td>
                <td>
                    <button type="button" id="rubahHadir" class=" btn btn-success btn-sm" data-kehadiran="Hadir"
                        data-absensi-id="<?php echo
                        $presensi['id'] ?>">Hadir</button>
                    <button type=" button" id="rubahAlpha" class="btn btn-danger btn-sm" data-kehadiran="Alpha"
                        data-absensi-id="<?php echo
                        $presensi['id']; ?>">Alpha</button>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
    integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#rubahHadir').click(function(e) {
        e.preventDefault();
        var absensi_id = $(this).data('absensi-id');
        var kehadiran = $(this).data('kehadiran');
        $.ajax({
            url: 'proses_presensi.php',
            type: 'POST',
            data: {
                absensi_id: absensi_id,
                kehadiran: kehadiran
            },
            success: function(data) {
                location.reload();
            },
            error: function(data) {
                const error_msg = JSON.parse(data.responseText);   
                $('.error_handler').append(
                    `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${error_msg.error}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`
                );
            }
        });
    });
    $('#rubahAlpha').click(function(e) {
        e.preventDefault();
        var absensi_id = $(this).data('absensi-id');
        var kehadiran = $(this).data('kehadiran');
        $.ajax({
            url: 'proses_presensi.php',
            type: 'POST',
            data: {
                absensi_id: absensi_id,
                kehadiran: kehadiran
            },
            success: function(data) {
                location.reload();
            },
            error: function(data) {
                const error_msg = JSON.parse(data.responseText);   
                $('.error_handler').append(
                    `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    ${error_msg.error}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>`
                );
            }
        });
    });
});
</script>
<?php
include_once '../template/footer.php';