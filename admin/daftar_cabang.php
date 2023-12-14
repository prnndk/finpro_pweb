<?php
require_once '../isAdmin.php';
include_once '../connection.php';
global $connect;
$get_cabang_query = "SELECT * FROM cabang";
$get_cabang_result = mysqli_query($connect, $get_cabang_query);
$get_cabang = mysqli_fetch_all($get_cabang_result, MYSQLI_ASSOC);

include_once '../template/header.php';
?>

<div class="container container-boxed main-content">
    <div class="container-header">Daftar Cabang</div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cabangModal">Tambah Cabang</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Cabang</th>
                <th scope="col">Kota</th>
                <th scope="col">Alamat</th>
                <th scope="col">Kontak</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($get_cabang as $cabang) { ?>
                <tr>
                    <td><?php echo $cabang['id']; ?></td>
                    <td><?php echo $cabang['nama']; ?></td>
                    <td><?php echo $cabang['kota']; ?></td>
                    <td><?php echo $cabang['alamat']; ?></td>
                    <td><?php echo $cabang['kontak']; ?></td>
                    <td>
                        <!-- Tambahkan tombol untuk aksi cabang, misalnya untuk menghapus -->
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal for adding cabang -->
<div class="modal fade" id="cabangModal" tabindex="-1" aria-labelledby="cabangModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="cabangModalLabel">Tambah Cabang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error_catcher_cabang"></div>
                <form method="post" id="tambah_cabang">
                    <label for="nama_cabang">Nama Cabang</label>
                    <input type="text" name="nama_cabang" id="nama_cabang" class="form-control mb-3" required>
                    <label for="kota">Kota</label>
                    <input type="text" name="kota" id="kota" class="form-control mb-3" required>
                    <label for="alamat">Alamat</label>
                    <input type="text" name="alamat" id="alamat" class="form-control mb-3" required>
                    <label for="kontak">Kontak</label>
                    <input type="text" name="kontak" id="kontak" class="form-control mb-3">
                    <!-- Tambahkan input untuk informasi cabang lainnya sesuai kebutuhan -->
                    <button type="submit" id="tambah_cabang_btn" class="btn btn-primary">Tambah Cabang</button>
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
        $('#tambah_cabang').on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                url: "tambah_cabang.php", // Sesuaikan dengan file yang akan menangani penambahan cabang
                method: "POST",
                data: $('#tambah_cabang').serialize(),
                success: function(data) {
                    $('#tambah_cabang')[0].reset();
                    $('#error_catcher_cabang').empty();
                    $('#error_catcher_cabang').append(
                        `<div class="alert alert-success" role="alert">Berhasil Menambah Cabang</div>`
                    );
                    location.reload();
                },
                error: function(param) {
                    const error_msg = JSON.parse(param.responseText);
                    $('#error_catcher_cabang').empty();
                    $('#error_catcher_cabang').append(`<div class="alert alert-danger" role="alert">
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
