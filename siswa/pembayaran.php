<?php
require_once '../isLogin.php';
include_once '../connection.php';
include_once '../helper.php';
global $connect;
$user_id = getUserId();
$siswa_id = getSiswaId();
$get_pembayaran_query = "SELECT c.nama, p.total, p.deskripsi, p.bukti_pembayaran, p.is_verified FROM pembayaran p join cabang c on p.cabang_id = c.id where p.siswa_id = '$siswa_id'";
$get_pembayaran_result = mysqli_query($connect, $get_pembayaran_query);
$get_pembayaran = mysqli_fetch_assoc($get_pembayaran_result);

if(!$get_pembayaran){
    header('Location: pembayaran_create.php');
}
include_once '../template/header.php'; ?>
    <div class="container container-boxed main-content">
        <div class="container-header">Halaman Informasi Pembayaran </div>
        <div class="row p-3 mt-4">
            <div class="col-md-9">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nama Cabang</th>
                        <th scope="col">Total Pembayaran</th>
                        <th scope="col">Deskripsi</th>
                        <th scope="col">Bukti Pembayaran</th>
                        <th scope="col">Status Pembayaran</th>
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <?php echo $get_pembayaran['nama']; ?>
                            </td>
                            <td><?php echo $get_pembayaran['total']; ?></td>
                            <td><?php echo $get_pembayaran['deskripsi']; ?></td>
                            <td><a href="<?php echo $get_pembayaran['bukti_pembayaran']; ?>"><?php echo $get_pembayaran['bukti_pembayaran']; ?></a></td>
                            <td>
                                <span class="badge bg-<?php echo $get_pembayaran['is_verified'] == 1 ? 'success' : 'danger' ?>"><?php echo $get_pembayaran['is_verified'] == 1 ? 'Verified' : 'Not Verified' ?></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-3">
                <img src="<?php echo $get_pembayaran['bukti_pembayaran']; ?>" alt="no images" class="img-fluid">
            </div>
        </div>
    </div>
<?php
include_once '../template/footer.php';