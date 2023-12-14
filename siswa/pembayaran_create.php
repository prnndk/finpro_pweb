<?php
require_once '../isLogin.php';
include_once '../connection.php';
include_once '../helper.php';
global $connect;
$user_id = getUserId();
$siswa_id = getSiswaId();
$get_pembayaran_query = "SELECT c.nama, p.total, p.deskripsi, p.bukti_pembayaran, p.is_verified FROM pembayaran p join cabang c on p.cabang_id = c.id where p.siswa_id = $siswa_id";
$get_pembayaran_result = mysqli_query($connect, $get_pembayaran_query);
$get_pembayaran = mysqli_fetch_assoc($get_pembayaran_result);

if($get_pembayaran){
    header('Location: pembayaran.php');
}
include_once '../template/header.php'; ?>
    <div class="container container-boxed main-content">
        <div class="container-header">Pembayaran Bimbel </div>
        <div class="row p-3 mt-4">
            <div class="col-md-6">
                <form action="proses_pembayaran.php" enctype="multipart/form-data" method="post">
                    <input type="hidden" name="siswa_id" value="<?php  echo $siswa_id?>">
                <div class="mb-3">
                    <label for="exampleFormControlInput1" class="form-label">Cabang</label>
                    <select class="form-select" aria-label="Select cabang" name="cabang_id" >
                        <option selected>Pilih Cabang</option>
                        <?php
                        $query = "SELECT * FROM cabang";
                        $result = mysqli_query($connect, $query);
                        $cabang = mysqli_fetch_all($result, MYSQLI_ASSOC);
                        foreach ($cabang as $cabang) {
                            echo "<option value=".$cabang['id'].">".$cabang['nama']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="total" class="form-label">Jumlah Bayar</label>
                    <input type="text" class="form-control" id="total" value="10000" name="total" readonly>
                </div>
                <div class="mb-3">
                    <label for="deskripsi" class="form-label">Deskripsi</label>
                    <input type="text" class="form-control" id="deskripsi" name="deskripsi" placeholder="Penjelasan...">
                </div>
                <div class="mb-3">
                    <label for="bukti_pembayaran" class="form-label">Bukti Pembayaran</label>
                    <input class="form-control" type="file" id="bukti_pembayaran" name="bukti_pembayaran" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>
<?php
include_once '../template/footer.php';