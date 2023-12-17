<?php

require_once '../isAdmin.php';
include_once '../connection.php';
global $connect;
// count tota kelas
$query_kelas = 'SELECT COUNT(*) AS total_kelas FROM kelas';
$result_kelas = mysqli_query($connect, $query_kelas);
$total_kelas = mysqli_fetch_assoc($result_kelas)['total_kelas'];

// count total pendaftar
$query_siswa = 'SELECT COUNT(*) AS total_siswa FROM siswas s left join pembayaran p on s.id = p.siswa_id';
$result_siswa = mysqli_query($connect, $query_siswa);
$total_siswa = mysqli_fetch_assoc($result_siswa)['total_siswa'];

// count total pengajar
$query_pengajar = 'SELECT COUNT(*) AS total_pengajar FROM pengajar';
$result_pengajar = mysqli_query($connect, $query_pengajar);
$total_pengajar = mysqli_fetch_assoc($result_pengajar)['total_pengajar'];

// statistik pendaftar
$query_diterima = 'SELECT COUNT(*) as diterima from pembayaran where is_verified = true';
$result_diterima = mysqli_query($connect, $query_diterima);
$diterima = mysqli_fetch_assoc($result_diterima)['diterima'];

// statistik total cabang
$query_cabang = 'SELECT COUNT(*) as total_cabang from cabang';
$result_cabang = mysqli_query($connect, $query_cabang);
$total_cabang = mysqli_fetch_assoc($result_cabang)['total_cabang'];

$query_ditolak = 'SELECT COUNT(*) as ditolak from pembayaran where is_verified = false';
$result_ditolak = mysqli_query($connect, $query_ditolak);
$ditolak = mysqli_fetch_assoc($result_ditolak)['ditolak'];
// get all pendaftar
$query_pendaftar = 'SELECT p.id as id,s.nama as siswa_nama ,c.nama as cabang_nama, s.no_hp, p.is_verified FROM siswas s join pembayaran p on s.id = p.siswa_id join cabang c on p.cabang_id = c.id ORDER BY s.created_at DESC';
$result_pendaftar = mysqli_query($connect, $query_pendaftar);
$pendaftar = mysqli_fetch_all($result_pendaftar, MYSQLI_ASSOC);
require_once '../template/header.php';
?>
<div class="container container-boxed main-content">
    <div class="container-header">Statistik Aplikasi</div>
    <div class="row p-4">
        <div class="col-md-3">
            <div class="card-statistic">
                <div class="card-statistic-number csn-info"><?php echo $total_kelas; ?></div>
                <div class="card-statistic-text">Total Kelas</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-statistic">
                <div class="card-statistic-number csn-info"><?php echo $total_siswa; ?></div>
                <div class="card-statistic-text">Total Siswa</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-statistic">
                <div class="card-statistic-number csn-info"><?php echo $total_pengajar; ?></div>
                <div class="card-statistic-text">Total Pengajar</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-statistic">
                <div class="card-statistic-number csn-info"><?php echo $total_cabang; ?></div>
                <div class="card-statistic-text">Total Cabang</div>
            </div>
        </div>
    </div>
</div>
<div class="container container-boxed mt-5">
    <div class="container-header">Pendaftar Terbaru</div>
    <div class="row p-3">
        <div class="col-md-4">
            <div class="card-statistic">
                <div class="card-statistic-number csn-success"><?php echo $diterima; ?></div>
                <div class="card-statistic-text">Pendaftar Diterima</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card-statistic">
                <div class="card-statistic-number csn-danger">
                    <?php echo $ditolak; ?>
                </div>
                <div class="card-statistic-text">Pendaftar Ditolak</div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Pendaftar Terbaru</div>
                <div class="card-body">
                    <table class="table table-striped table-responsive">
                        <thead>
                            <tr>
                                <th scope="col">Nama</th>
                                <th scope="col">Cabang</th>
                                <th scope="col">Nomor Hp</th>
                                <th scope="col">Is Verified</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pendaftar as $pendaftar) { ?>
                            <tr>
                                <td><?php echo $pendaftar['siswa_nama']; ?></td>
                                <td><?php echo $pendaftar['cabang_nama']; ?></td>
                                <td><?php echo $pendaftar['no_hp']; ?></td>
                                <td><?php echo $pendaftar['is_verified'] ? '<span class="badge rounded-pill text-bg-success">Terverifikasi</span>' : '<span class="badge rounded-pill text-bg-danger">Not Verified</span>'; ?>
                                </td>
                                <td>
                                    <a href="verifikasi.php?id=<?php echo $pendaftar['id']; ?>"
                                        class="btn btn-success btn-sm">Verifikasi</a>
                                    <a href="tolak.php?id=<?php echo $pendaftar['id']; ?>"
                                        class="btn btn-danger btn-sm">Tolak</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once '../template/footer.php'; ?>