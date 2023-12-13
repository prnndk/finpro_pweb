<?php
include_once '../connection.php';

// Proses form jika ada data yang dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pengajar = $_POST['nama_pengajar'];
    $mapel = $_POST['mapel'];
    $kode = $_POST['kode'];
    $cabang_id = $_POST['cabang_id'];

    // Query untuk menambahkan data pengajar beserta nama file
    $insert_pengajar_query = "INSERT INTO pengajar (nama, mapel, kode, cabang_id, file_name) VALUES ('$nama_pengajar', '$mapel', '$kode', '$cabang_id', '$file_name')";
    $insert_pengajar_result = mysqli_query($connect, $insert_pengajar_query);

    if ($insert_pengajar_result) {
        echo "Data Pengajar berhasil ditambahkan!";
    } else {
        echo "Gagal menambahkan data Pengajar: " . mysqli_error($connect);
    }
}

// Query untuk mendapatkan data pengajar
$get_pengajar_query = "SELECT * FROM pengajar";
$get_pengajar_result = mysqli_query($connect, $get_pengajar_query);
$get_pengajar = mysqli_fetch_all($get_pengajar_result, MYSQLI_ASSOC);

include_once '../template/header.php';
?>

<!-- Tambahkan form langsung ke halaman -->
<form method="post" enctype="multipart/form-data">
    <label for="nama_pengajar">Nama Pengajar</label>
    <input type="text" name="nama_pengajar" required>

    <label for="mapel">Mapel</label>
    <input type="text" name="mapel" required>

    <label for="kode">Kode</label>
    <input type="text" name="kode" required>

    <label for="cabang_id">Cabang</label>
    <input type="text" name="cabang_id" required>

    <button type="submit">Tambah Pengajar</button>
</form>

<!-- Tampilkan daftar pengajar -->
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Pengajar</th>
            <th>Mapel</th>
            <th>Kode</th>
            <th>Cabang</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($get_pengajar as $pengajar) { ?>
            <tr>
                <td><?php echo $pengajar['id']; ?></td>
                <td><?php echo $pengajar['nama']; ?></td>
                <td><?php echo $pengajar['mapel']; ?></td>
                <td><?php echo $pengajar['kode']; ?></td>
                <td><?php echo $pengajar['cabang_id']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php include_once '../template/footer.php'; ?>
