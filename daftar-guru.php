<?php

if (!isset($_GET['id'])) {
    header('Location: kelas.php');
}
$kelas_id = $_GET['id'];

include_once '../connection.php';

$get_nama_kelas_query = "SELECT nama FROM kelas WHERE id = '$kelas_id'";
$get_nama_kelas_result = mysqli_query($connect, $get_nama_kelas_query);
$get_nama_kelas = mysqli_fetch_assoc($get_nama_kelas_result);
if (!$get_nama_kelas) {
    header('Location: kelas.php');
}

$get_kelas_query = "SELECT k.nama as nama_kelas, k.kode_kelas, m.nama_guru, m.link, m.is_latihan FROM kelas k join guru_kelas m on k.id = m.kelas_id WHERE k.id = '$kelas_id'";
$get_kelas_result = mysqli_query($connect, $get_kelas_query);
$get_kelas = mysqli_fetch_all($get_kelas_result, MYSQLI_ASSOC);

include_once '../template/header.php';
?>

<div class="container container-boxed main-content">
    <div class="container-header">Daftar guru <?php echo $get_nama_kelas["nama"]; ?></div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#guruModal">Tambah guru</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Nama guru</th>
                <th scope="col">Link Latihan</th>
                <th scope="col">Jenis</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($get_kelas as $kelas) { ?>
                <tr>
                    <td>
                        <?php echo $kelas['nama_kelas'] . " " . $kelas['kode_kelas']; ?>
                    </td>
                    <td><?php echo $kelas['nama_guru']; ?></td>
                    <td><a href="<?php echo $kelas['link']; ?>"><?php echo $kelas['link']; ?></a></td>
                    <td>
                        <span class="badge bg-<?php echo $kelas['is_latihan'] == 1 ? 'danger' : 'info' ?>"><?php echo $kelas['is_latihan'] == 1 ? 'Latihan' : 'guru' ?></span>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal for adding guru -->
<div class="modal fade" id="guruModal" tabindex="-1" aria-labelledby="guruModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="guruModalLabel">Tambah guru</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error_catcher_guru"></div>
                <form method="post" id="tambah_guru">
                    <label for="nama_guru">Nama guru</label>
                    <input type="text" name="nama_guru" id="nama_guru" class="form-control mb-3" required>
                    <label for="link">Link guru</label>
                    <input type="text" name="link" id="link" class="form-control mb-3" required>
                    <label for="is_latihan">Jenis</label>
                    <select name="is_latihan" id="is_latihan" class="form-control mb-3">
                        <option value="0">guru</option>
                        <option value="1">Latihan</option>
                    </select>
                    <input type="hidden" name="kelas_id" id="kelas_id" value="<?php echo $kelas_id; ?>" />
                    <button type="submit" id="tambah_guru_btn" class="btn btn-primary">Tambah guru</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
    $(document).ready(function() {
        $('#tambah_guru').on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                url: "tambah_guru.php",
                method: "POST",
                data: $('#tambah_guru').serialize(),
                success: function(data) {
                    $('#tambah_guru')[0].reset();
                    $('#error_catcher_guru').empty();
                    $('#error_catcher_guru').append(
                        `<div class="alert alert-success" role="alert">Berhasil Menambah guru</div>`
                    );
                    // location.reload();
                },
                error: function(param) {
                    const error_msg = JSON.parse(param.responseText);
                    $('#error_catcher_guru').empty();
                    $('#error_catcher_guru').append(`<div class="alert alert-danger" role="alert">
                            ${error_msg.error}
                        </div>`);
                }
            });
        });
    });
</script>

<?php
include_once '../template/footer.php';
?>
