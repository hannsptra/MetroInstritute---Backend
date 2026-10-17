<?php
$host = "localhost";
$user = "root";
$password = "";
$db = "tugas2_backend_cafe";

$koneksi = mysqli_connect ($host, $user, $password, $db);

$ID = "";
$kode_menu = "";
$nama_menu = "";
$kategori = "";
$harga = "";
$status = "";
$sukses = "";
$gagal = "";

if (isset($_GET['op'])){
    $op = $_GET['op'];
}else {
    $op = "";
}

if ($op == 'Delete'){
    $ID = $_GET['ID'];
    $sql1 = "DELETE FROM menu WHERE ID = '$ID'";
    $q1 = mysqli_query($koneksi, $sql1);
    if ($q1){
        $sukses = "Data Berhasil Dihapus!";
    }else {
        $gagal = "Data Belum Terhapus!";
    }
}

if ($op == 'Edit')
{
    $ID = $_GET['ID'];
    $sql1 = "SELECT * FROM menu WHERE ID = $ID";
    $q1 = mysqli_query($koneksi, $sql1);
    $r1 = mysqli_fetch_array($q1);
    $kode_menu = $r1 ['Kode_Menu'];
    $nama_menu = $r1 ['Nama_Menu'];
    $kategori = $r1 ['Kategori'];
    $harga = $r1 ['Harga'];
    $status = $r1 ['Status'];

    if($kode_menu == ""){
        $gagal = "Data gaada!";
    }
}

if (isset($_POST["submit"])){
    $kode_menu = $_POST["Kode_Menu"];
    $nama_menu = $_POST["Nama_Menu"];
    $kategori = $_POST["Kategori"];
    $harga = $_POST["Harga"];
    $status = $_POST["Status"];

    if($kode_menu && $nama_menu && $kategori && $harga && $status){
        if (is_numeric($harga)){
            if ($op == "Edit"){
                $sql1 = "UPDATE menu SET Kode_Menu = '$kode_menu', Nama_Menu = '$nama_menu', Kategori = '$kategori', Harga = '$harga', Status = '$status' WHERE ID = '$ID' ";
                $q1 = mysqli_query($koneksi, $sql1);
                if($q1){
                    $sukses = "Data Berhasil Diubah!";
                }else {
                    $gagal = "Data Gabisa Diubah!";
                }
            }else {
                $sql1 = "INSERT INTO menu (Kode_Menu, Nama_Menu, Kategori, Harga, Status) VALUES ('$kode_menu', '$nama_menu', '$kategori', '$harga', '$status')";
                $q1 = mysqli_query($koneksi, $sql1);
                if ($q1){
                    $sukses = "Berhasil nambahin data";
                }else{
                    $gagal = "Gagal nambahin data ";
                }
            }
        } else {
            $gagal = "Harga harus berupa angka!";
        }
    } else {
        $gagal = "Masukkan semua data!";
    }
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Manajemen Menu Cafe</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        .mx-auto {
            width: 800px;
        }
      .card {
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="mx-auto">
        <!-- UNTUK MEMASUKKAN DATA -->
        <div class="card">
            <div class="card-header">Create/Edit Data
            </div>
            <div class="card-body">
                <?php
                if($sukses){
                ?>
                    <div class="alert alert-success" role="alert">
                    <?php echo $sukses ?>
                    </div>
                <?php
                }
                ?>
                <?php
                if($gagal){
                ?>
                    <div class="alert alert-danger" role="alert">
                    <?php echo $gagal ?>
                    </div>
                <?php
                }
                ?>
                <form action="" method="post">
                    <div class="mb-3 row">
                        <label for="Kode_Menu" class="col-sm-2 col-form-label">Kode Menu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Kode_Menu" name = "Kode_Menu" value="<?php echo $kode_menu; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Nama_Menu" class="col-sm-2 col-form-label">Nama Menu</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Nama_Menu" name = "Nama_Menu" value="<?php echo $nama_menu; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Kategori" class="col-sm-2 col-form-label">Kategori</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Kategori" name = "Kategori" value="<?php echo $kategori; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Harga" class="col-sm-2 col-form-label">Harga</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Harga" name = "Harga" value="<?php echo $harga; ?>">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="Status" class="col-sm-2 col-form-label">Status</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="Status" name = "Status" value="<?php echo $status; ?>">
                        </div>
                    </div>
                    <div class="col-12">
                        <input type="submit" name="submit" value="submit" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header text-white bg-secondary">
                Data Menu Cafe
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No.</th>
                            <th scope="col">ID</th>
                            <th scope="col">Kode Menu.</th>
                            <th scope="col">Nama Menu.</th>
                            <th scope="col">Kategori.</th>
                            <th scope="col">Harga.</th>
                            <th scope="col">Status</th>
                            <th scope="col">Aksi</th>
                        </tr>
                        <tbody>
                            <?php
                            $sql2 = "SELECT * FROM menu ORDER BY ID DESC";
                            $q2 = mysqli_query($koneksi, $sql2);
                            $urut = 1;
                            while($r2 = mysqli_fetch_array($q2)){
                                $ID = $r2['ID'];
                                $kode_menu = $r2['Kode_Menu'];
                                $nama_menu = $r2['Nama_Menu'];
                                $kategori = $r2['Kategori'];
                                $harga = $r2['Harga'];
                                $status = $r2['Status'];
                                ?>
                                <tr>
                                    <th scope="row"><?php echo $urut++ ?></th>
                                    <td scope="row"><?php echo $ID; ?></td>
                                    <td scope="row"><?php echo $kode_menu; ?></td>
                                    <td scope="row"><?php echo $nama_menu; ?></td>
                                    <td scope="row"><?php echo $kategori; ?></td>
                                    <td scope="row"><?php echo $harga; ?></td>
                                    <td scope="row"><?php echo $status; ?></td>
                                    <td scope="row">
                                        <a href="index.php?op=Edit&ID=<?php echo $ID?>" class="btn btn-primary">Edit</a>
                                        <a href="index.php?op=Delete&ID=<?php echo $ID; ?>" onclick="return confirm('Konfirmasi Delete')" class="btn btn-danger">Delete</a>
                                    </td>
                                </tr> 
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </thead>
                </table>    
            </div>
        </div>
    </div>
</body>
</html>
