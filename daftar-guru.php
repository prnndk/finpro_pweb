<?php
include_once '../connection.php';

$get_pengajar_query = "SELECT * FROM pengajar";
$get_pengajar_result = mysqli_query($connect, $get_pengajar_query);
$get_pengajar = mysqli_fetch_all($get_pengajar_result, MYSQLI_ASSOC);

include_once '../template/header.php';
?>

<div class="container container-boxed main-content">
    <div class="container-header">Daftar Pengajar</div>
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pengajarModal">Tambah Pengajar</button>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nama Pengajar</th>
                <th scope="col">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($get_pengajar as $pengajar) { ?>
                <tr>
                    <td><?php echo $pengajar['id']; ?></td>
                    <td><?php echo $pengajar['nama']; ?></td>
                    <td>
                        <!-- Tambahkan tombol untuk aksi pengajar, misalnya untuk menghapus -->
                        <button class="btn btn-danger btn-sm">Hapus</button>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<!-- Modal for adding pengajar -->
<div class="modal fade" id="pengajarModal" tabindex="-1" aria-labelledby="pengajarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="pengajarModalLabel">Tambah Pengajar</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="error_catcher_pengajar"></div>
                <form method="post" id="tambah_pengajar">
                    <label for="nama_pengajar">Nama Pengajar</label>
                    <input type="text" name="nama_pengajar" id="nama_pengajar" class="form-control mb-3" required>
                    <!-- Tambahkan input untuk informasi pengajar lainnya sesuai kebutuhan -->
                    <button type="submit" id="tambah_pengajar_btn" class="btn btn-primary">Tambah Pengajar</button>
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
        $('#tambah_pengajar').on("submit", function(event) {
            event.preventDefault();

            $.ajax({
                url: "tambah_pengajar.php", // Sesuaikan dengan file yang akan menangani penambahan pengajar
                method: "POST",
                data: $('#tambah_pengajar').serialize(),
                success: function(data) {
                    $('#tambah_pengajar')[0].reset();
                    $('#error_catcher_pengajar').empty();
                    $('#error_catcher_pengajar').append(
                        `<div class="alert alert-success" role="alert">Berhasil Menambah Pengajar</div>`
                    );
                    // location.reload();
                },
                error: function(param) {
                    const error_msg = JSON.parse(param.responseText);
                    $('#error_catcher_pengajar').empty();
                    $('#error_catcher_pengajar').append(`<div class="alert alert-danger" role="alert">
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
