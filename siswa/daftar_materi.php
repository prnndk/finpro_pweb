<?php
require_once '../isLogin.php';
if(!isset($_GET['id'])){
    header('Location: kelas.php');
}
$kelas_id = $_GET['id'];

include_once '../connection.php';
include_once '../helper.php';
global $connect;
$user_id = getUserId();
$siswa_id = getSiswaId();
$get_nama_kelas_query = "SELECT nama FROM kelas WHERE id = '$kelas_id'";
$get_nama_kelas_result = mysqli_query($connect, $get_nama_kelas_query);
$get_nama_kelas = mysqli_fetch_assoc($get_nama_kelas_result);
if(!$get_nama_kelas){
    header('Location: kelas.php');
}
$get_kelas_query = "SELECT k.nama as nama_kelas,k.kode_kelas, m.nama_materi, m.link, m.is_latihan FROM daftar_siswa d join kelas k on d.kelas_id = k.id join materi_kelas m on k.id = m.kelas_id WHERE k.id = '$kelas_id' and d.siswa_id = '$siswa_id'";
$get_kelas_result = mysqli_query($connect, $get_kelas_query);
$get_kelas = mysqli_fetch_all($get_kelas_result, MYSQLI_ASSOC);
include_once '../template/header.php'; ?>
    <div class="container container-boxed main-content">
        <div class="container-header">Daftar Materi <?php echo $get_nama_kelas["nama"];?></div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Nama Materi</th>
                <th scope="col">Link Latihan</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($get_kelas as $kelas) {?>
                <tr>
                    <td>
                        <?php echo $kelas['nama_kelas']. " " .$kelas['kode_kelas'];; ?>
                    </td>
                    <td><?php echo $kelas['nama_materi']; ?></td>
                    <td><a href="<?php echo $kelas['link']; ?>"><?php echo $kelas['link']; ?></a></td>
                    <td>
                        <span class="badge bg-<?php echo $kelas['is_latihan'] == 1 ? 'danger' : 'info' ?>"><?php echo $kelas['is_latihan'] == 1 ? 'Latihan' : 'Materi' ?></span>
                    </td>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>
<?php
include_once '../template/footer.php';