<?php
require_once '../isAdmin.php';
include_once '../connection.php';
include_once '../helper.php';
global $connect;
$admin_id = getUserId();
$pembayaran_query = "SELECT p.id, p.total, p.deskripsi, p.is_verified,p.bukti_pembayaran, s.nama as nama_siswa, p.siswa_id, p.cabang_id FROM pembayaran p join siswas s on p.siswa_id = s.id";
$pembayaran_result = mysqli_query($connect, $pembayaran_query);
$pembayaran = mysqli_fetch_all($pembayaran_result, MYSQLI_ASSOC);
include_once '../template/header.php'; ?>
    <div class="container container-boxed main-content p-3">
        <div class="container-header">Data Pembayaran</div>
        </button>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nama Siswa</th>
                <th scope="col">Total Biaya</th>
                <th scope="col">Deskripsi</th>
                <th scope="col">Verify Status</th>
                <th scope="col">Verifikasi</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($pembayaran as $item) { ?>
                <tr>
                    <td><?php echo $item['nama_siswa']; ?></td>
                    <td><?php echo $item['total']; ?></td>
                    <td><?php echo $item['deskripsi']; ?></td>
                    <td>
                        <span class="badge bg-<?php echo $item['is_verified'] == 1 ? 'success' : 'danger' ?>"><?php echo $item['is_verified'] == 1 ? 'Verified' : 'Not Verified' ?></span>
                    </td>
                    <td>
                        <button data-pembayaran-id="<?php echo $item['id']; ?>" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#verifModal<?php echo $item['id']; ?>">Verifikasi
                        </button>
                    </td>
                </tr>
                <div class="modal fade" id="verifModal<?php echo $item['id'] ?>" tabindex="-1"
                     aria-labelledby="verifikasi-modal" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="presensiModalLabel">Verifikasi Pembayaran</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div id="error_catcher"></div>
                                <form method="post" id="verifikasi_pembayaran_<?php echo $item['id'];?>" >
                                    <label for="total">Total Pembayaran</label>
                                    <input type="text" name="total" id="total" class="form-control mb-3"
                                           value="<?php echo $item['total'] ?>">
                                    <label for="nilai_siswa">Deskripsi Pembayaran</label>
                                    <input type="text" name="deskripsi" id="deskripsi" class="form-control mb-3"
                                           value="<?php echo $item['deskripsi'] ?>">
                                    <label for="nilai_siswa">Bukti Pembayaran</label>
                                    <img src="<?php echo $item['bukti_pembayaran'] ?>" alt="bukti_pembayaran"
                                         class="img-fluid mb-3">
                                    <input type="hidden" name="pembayaran_id" id="pembayaran_id"
                                           value="<?php echo $item['id']; ?>"/>
                                    <input type="hidden" name="siswa_id" id="siswa_id"
                                           value="<?php echo $item['siswa_id']; ?>"/>
                                    <input type="hidden" name="cabang_id" id="cabang_id"
                                           value="<?php echo $item['cabang_id']; ?>"/>
                                    <input type="hidden" name="verified_by" id="verified_by"
                                           value="<?php echo $admin_id; ?>"/>

                                    <button type="submit" id="insert_button" class="btn btn-primary">Verifikasi</button>
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
                        $('#verifikasi_pembayaran_<?php echo $item['id']?>').on("submit", function (event) {
                            event.preventDefault();
                            if ($('#pembayaran_id').val() == "") {
                                alert("pembayaran id is required");
                            } else {
                                $.ajax({
                                    url: "verifikasi_pembayaran.php",
                                    method: "POST",
                                    data: $('#verifikasi_pembayaran_<?php echo $item['id']?>').serialize(),
                                    success: function (data) {
                                        $('#verifikasi_pembayaran_<?php echo $item['id']?>')[0].reset();
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

<?php
include_once '../template/footer.php';