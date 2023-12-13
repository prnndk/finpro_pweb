<?php
include_once '../connection.php';

$get_pengajar_query = "SELECT p.nama as nama_pengajar, p.kode,p.mapel, c.nama as nama_cabang FROM pengajar p join cabang c on p.cabang_id = c.id";
$get_pengajar_result = mysqli_query($connect, $get_pengajar_query);
$get_pengajar = mysqli_fetch_all($get_pengajar_result, MYSQLI_ASSOC);

include_once '../template/header.php';
?>

<div class="container container-boxed main-content p-4">
    <div class="container-header">Daftar Pengajar Bimbel</div>
    <button type="button" class="btn btn-primary my-4" data-bs-toggle="modal" data-bs-target="#guruModal">Tambah guru
    </button>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Nama Pengajar</th>
            <th scope="col">Mapel</th>
            <th scope="col">Kode Pengajar</th>
            <th scope="col">Cabang</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($get_pengajar as $pengajar) { ?>
            <tr>
                <td>
                    <?php echo $pengajar["nama_pengajar"]; ?>
                </td>
                <td><?php echo $pengajar['mapel']; ?></td>
                <td><?php echo $pengajar['kode']; ?></td>
                <td><?php echo $pengajar['nama_cabang']; ?></td>
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
                    <label for="nama_guru">Nama Guru</label>
                    <input type="text" name="nama_guru" id="nama_guru" class="form-control mb-3" required>
                    <label for="mapel">Mapel</label>
                    <input type="text" name="mapel" id="mapel" class="form-control mb-3" required>
                    <label for="cabang_id">Cabang</label>
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
                    <label for="user_id">User</label>
                    <select name="user_id" id="user_id" class="form-control mb-3">
                        <?php
                        $user_query = "SELECT * FROM users";
                        $user_result = mysqli_query($connect, $user_query);
                        $user = mysqli_fetch_all($user_result, MYSQLI_ASSOC);
                        foreach ($user as $user) {
                            ?>
                            <option value="<?php echo $user['id']; ?>"><?php echo $user['name']; ?></option>
                        <?php } ?>
                    </select>
                    <button type="submit" id="tambah_guru_btn" class="btn btn-primary">Tambah guru</button>
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
        $('#tambah_guru').on("submit", function (event) {
            event.preventDefault();

            $.ajax({
                url: "tambah_guru.php",
                method: "POST",
                data: $('#tambah_guru').serialize(),
                success: function (data) {
                    $('#tambah_guru')[0].reset();
                    $('#error_catcher_guru').empty();
                    $('#error_catcher_guru').append(
                        `<div class="alert alert-success" role="alert">Berhasil Menambah guru</div>`
                    );
                    location.reload();
                },
                error: function (param) {
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
