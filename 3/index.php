<?php
session_start();
if(!isset($_SESSION['login'])){
    header("location:../index.php");
    exit();
}
$rolesession = 3;
if ($_SESSION['role'] != $rolesession){
    ?>
    <script>
    alert('Maaf, Untuk mengakses halaman ini, anda harus login dengan role "Administrator" terlebih dahulu, terima kasih!');
    document.location='../index.php'
    </script>
    <?php
}

include '../koneksi.php';
include 'prosesadmin.php';
function tampildata()
{
    $query = "SELECT * FROM tbl_user WHERE role IN (1,2,3)";
    $sql = mysqli_query($GLOBALS['conn'], $query);
    $no = 1;
    if (!$sql) {
    } else {
        while ($data = mysqli_fetch_array($sql)) {
            if ($data['role'] == 2) {
                $namaRole = "Manager Operasional";
            } elseif ($data['role'] == 1) {
                $namaRole = "Staff Operasional";
            } else {
                $namaRole = "Administrator";
            }
            ?>
            <tr>
                <td>
                    <?php
                    echo $no;
                    ?>
                </td>
                <td>
                    <?php
                    echo $data['uname'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $data['nama'];
                    ?>
                </td>
                <td>
                    <?php
                    echo $namaRole;
                    ?>
                </td>
                <td class="d-flex align-items-center">
                    <a href="#" class="btn btn-outline-success tombol-detail bi bi-pencil" data-toggle="modal"
                        data-target="#editModal<?php echo $no ?>"> Edit</a>
                    <a href="#" class="btn btn-outline-danger tombol-detail bi bi-trash" data-toggle="modal"
                        data-target="#hapusModal<?php echo $no ?>"> Hapus</a>
                    <a href="#" class="btn btn-outline-warning tombol-detail bi bi-arrow-repeat" data-toggle="modal"
                        data-target="#resetModal<?php echo $no ?>"> Reset Password </a>
                </td>
            </tr>
            <!-- Awal Modal edit -->
            <div class="modal" tabindex="-1" id="editModal<?php echo $no ?>">
                <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Edit transaksi barang ke <?php echo $no ?> </h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="" method="post">
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label for="edituser" class="col-form-label">Nama User</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="edituser" name="edituser"
                                            value="<?php echo $data['nama'] ?>" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <div class="col-sm-2">
                                        <label for="editrole" class="col-form-label">Role</label>
                                    </div>
                                    <div class="col-sm-10">
                                        <select class="custom-select" id="editrole" name="editrole" required>
                                            <option value="<?php echo $data['role'] ?>"><?php echo $namaRole ?>
                                            </option>

                                            <option value="2">Manager Operasional</option>
                                            <option value="1">Staff Operasional</option>
                                            <option value="3">Administrator</option>
                                        </select>
                                    </div>
                                </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" name="editid" value="<?php echo $data['id_user'] ?>">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" id="edit" name="edit" class="btn btn-primary">Simpan</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal edit -->
            <!-- Awal Modal hapus-->
            <div class="modal" tabindex="-1" id="resetModal<?php echo $no ?>">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Konfirmasi</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah anda yakin ingin me-reset password dari user ini? <span style="font-weight: 500;">
                                    <?php echo $data['nama'] ?>
                                </span></h5>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="post">
                                <input type="hidden" name="resetid" value="<?php echo $data['id_user'] ?>">
                                <button type="submit" class="btn btn-warning" name="reset">Reset</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal hapus -->
            <!-- Awal Modal reset-->
            <div class="modal" tabindex="-1" id="hapusModal<?php echo $no ?>">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h3 class="modal-title">Konfirmasi</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <h5>Apakah anda yakin ingin menghapus user ini? <span style="font-weight: 500;">
                                    <?php echo $data['nama'] ?>
                                </span></h5>
                        </div>
                        <div class="modal-footer">
                            <form action="" method="post">
                                <input type="hidden" name="hapusid" value="<?php echo $data['id_user'] ?>">
                                <button type="submit" class="btn btn-danger" name="hapus">Hapus</button>
                            </form>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Akhir Modal reset -->
            <?php
            $no++;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User</title>
    <link rel="icon" href="../assets/foto/tbri.png" type="image/png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
        integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
</head>

<body>
    <!-- Modal Form -->
    <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Masukan Data User!</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" method="post">
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="nama" class="col-form-label">Nama</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="nama" name="nama"
                                    placeholder="Masukan Nama User" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="uname" class="col-form-label">Username</label>
                            </div>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="uname" name="uname"
                                    placeholder="Masukan Username!" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-2">
                                <label for="rolenew" class="col-form-label">Role</label>
                            </div>
                            <div class="col-sm-10">
                                <select class="custom-select" id="rolenew" name="rolenew" required>
                                    <option value="1">Manager Operasional</option>
                                    <option value="2">Staff Operasional</option>
                                    <option value="3">Administrator</option>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="password" value="1234">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" id="newUser" name="newUser" class="btn btn-primary">Simpan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Akhir Modal Form -->
    <div class="shadow p-3 mb-5 bg-white rounded">
        <div class="row justify-content-center">
            <div class="col-md-10 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h4>Data User</h4>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            Masukan Data User baru
                            <button type="button" class="btn btn-outline-primary" data-toggle="modal"
                                data-target="#exampleModal">
                                <i class="bi bi-file-earmark-plus"></i>
                            </button>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="example" class="table table-striped data-table" style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Username</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        tampildata();
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div style="display: flex; justify-content: flex-end; padding: 10px">
                    <form action="logout.php">
                    <button type="submit" id="logout" name="logout" class="btn btn-danger bi bi-box-arrow-right">Logout</button>
                    </form>
            </div>
        </div>
        

</body>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
    crossorigin="anonymous"></script>
<script src="../assets/js/jquery-3.5.1.js"></script>
<script src="../assets/js/jquery.dataTables.min.js"></script>
<script src="../assets/js/dataTables.bootstrap5.min.js"></script>
<script src="../assets/js/script.js"></script>

</html>