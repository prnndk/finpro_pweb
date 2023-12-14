<?php
require_once '../isAdmin.php';
include_once '../connection.php';
$data_kelas_absen = 'SELECT k.id, k.nama as nama_kelas ,k.kode_kelas, p.nama, k.pengajar_id, k.nama as nama_pengajar FROM kelas k join pengajar p on k.pengajar_id = p.id';
$data_kelas_absen_result = mysqli_query($connect, $data_kelas_absen);
$data_kelas_absen = mysqli_fetch_all($data_kelas_absen_result, MYSQLI_ASSOC);
include_once '../template/header.php'; ?>
<div class="container container-boxed main-content p-4">
    <div class="container-header">Data Nilai Siswa Bimbel</div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Nama Kelas</th>
                <th scope="col">Nama Pengajar</th>
                <th scope="col">Kode Kelas</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data_kelas_absen as $presensi) {?>
            <tr>
                <td>
                    <?php echo $presensi['nama_kelas']; ?>
                </td>
                <td><?php echo $presensi['nama_pengajar']; ?></td>
                <td><?php echo $presensi['kode_kelas']; ?></td>
                <td>
                    <a href="list_nilai.php?pengajar_id=<?php echo $presensi['pengajar_id']; ?>&kelas_id=<?php echo $presensi['id']; ?>"
                        class="btn btn-success btn-sm">Lihat Nilai Siswa</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
<?php
include_once '../template/footer.php';