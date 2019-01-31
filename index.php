 <?php
 session_start();
  include("config.php"); 
if(!isset($_SESSION['id_user'])){
  header('location: login.php');
}else{
?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Video Uploader</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Page level plugin CSS-->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin.css" rel="stylesheet">

  </head>

  <body id="page-top">

    <nav class="navbar navbar-expand navbar-dark bg-dark static-top">

      <a class="navbar-brand mr-1" href="index.html">Video Uploader</a>

      <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
      </button>

      <!-- Navbar Search -->
      <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
      </div>

      <!-- Navbar -->
      <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
          <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-user-circle fa-fw"></i>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
            <a class="dropdown-item" href="#">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Logout</a>
          </div>
        </li>
      </ul>

    </nav>

    <div id="wrapper">

      <!-- Sidebar -->
      <ul class="sidebar navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="#">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
          </a>
        </li>
       </ul>

      <div id="content-wrapper">

        <div class="container-fluid">

          <!-- Breadcrumbs-->
          <ol class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="index.php">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">Overview</li>
          </ol>

          <?php
            if(@$_SESSION['stat'] == 'suc'){ ?>
            <div class="alert alert-success">
            <strong>Success!</strong> Login Berhasil
          </div>
          <?php }
            if(@$_SESSION['stats'] == 'suc'){ ?>
            <div class="alert alert-success">
            <strong>Success!</strong> Berkas berhasil diunggah.
          </div>
          <?php }
            if(@$_SESSION['del'] == 'suc'){ ?>
            <div class="alert alert-success">
            <strong>Success!</strong> Berkas berhasil dihapus.
          </div>
          <?php }
            if(@$_SESSION['stats'] == 'err'){ ?>
            <div class="alert alert-danger">
            <strong>Oops!</strong> Terjadi suatu kesalahan.
          </div>
          <?php }
            if(@$_SESSION['update'] == 'suc'){ ?>
            <div class="alert alert-success">
            <strong>Success!</strong> Perubahan berhasil.
          </div>
        <?php } ?>

          <!-- Area Chart Example-->
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-upload"></i> Video Uploader</div>
            <div class="card-body">
              <div class="row">
        <!-- left column -->
        <div class="col-md-6">
            <form action="upload.php" method="POST" enctype="multipart/form-data">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1"><b>Nama Video :</b></label>
                  <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Video">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile"><b>File input :</b></label><br>
                  <input type="file" name="file" id="exampleInputFile">
              </div>
              <div class="box-footer">
                <button type="submit" class="btn btn-primary btn-sm" name="tapi_upload"><i class="fas fa-upload"></i> Upload</button>
              </div>
            </form>
          </div>
        </div>
      </div>
            </div>
          </div>
          <div class="card mb-3">
            <div class="card-header">
              <i class="fas fa-table"></i>
              Daftar Video</div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">

                  <thead>
                    <tr>
                      <th>Nama</th>
                      <th>Referensi</th>
                      <th>URL</th>
                      <th>Status</th>
                      <th>Menu</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>Nama</th>
                      <th>Referensi</th>
                      <th>URL</th>
                      <th>Status</th>
                      <th>Menu</th>
                    </tr>
                  </tfoot>
                  <tbody style="font-size: 14px;">
                  <?php
                  $shw = mysqli_query($con,'SELECT * FROM video_training');
                  while($row = mysqli_fetch_array($shw)){
                  ?>
                    <tr>
                      <td><?php echo $row['nama_video'] ?></td>
                      <td><?php echo $row['referensi_video'] ?></td>
                      <td><a target="_blank" href="<?php echo $row['url_video'] ?>"><?php echo $row['url_video'] ?></a></td>
                      <?php if($row['status_aktif'] == 'active'){ ?>
                      <td><span class="badge badge-success"><?php echo $row['status_aktif'] ?></span></td>
                      <?php }elseif(($row['status_aktif'] == 'inactive')){ ?>
                      <td><span class="badge badge-danger"><?php echo $row['status_aktif'] ?></span></td>
                    <?php } ?>
                      <td><a href="update.php?id=<?php echo $row['id_video'] ?>"><div class="btn btn-warning btn-sm"><i class="fas fa-edit"></i> Edit</div></a>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal_del" data-whatever="<?php echo $row['id_video']; ?>" data-judul="<?php echo $row['nama_video']; ?>"><i class="fas fa-trash"></i> Delete</button></td>
                    </tr>
                <?php } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
        <footer class="sticky-footer">
          <div class="container my-auto">
            <div class="copyright text-center my-auto">
              <span>Copyright © Your Website 2019</span>
            </div>
          </div>
        </footer>

      </div>
      <!-- /.content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
      <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade bd-example-modal-lg" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Anda Yakin Ingin Logout?</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">Pilih Tombol "Logout" bila anda ingin mengakhiri sesi ini.</div>
          <div class="modal-footer">
            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            <a class="btn btn-danger" href="logout.php">Logout</a>
          </div>
        </div>
      </div>
    </div>
<!-- Modal Delete-->
<div class="modal fade" id="modal_del" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete Video</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="delete_video.php" method="POST">
          <div class="form-group">
            <label class="col-form-label">Anda Yakin Akan Menghapus Video Ini?</label>
            <form action="delete_video.php">
              <input type="hidden" name="idvideo">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-danger">Delete</button>
            </form>
      </div>
    </div>
  </div>
</div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Page level plugin JavaScript-->
    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin.min.js"></script>
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
    <script src="js/demo/datatables-demo.js"></script>
    <script>
      $('#modal_del').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget)
  var recipient = button.data('whatever')
  var judulq = button.data('judul')
  var modal = $(this)
  modal.find('.modal-title').text('Hapus Video Berjudul "' + judulq + '"')
  modal.find('.modal-body input').val(recipient)
})
    </script>
  </body>

</html>
<?php unset($_SESSION['stats']); unset($_SESSION['stat']); unset($_SESSION['del']); unset($_SESSION['update']); }?>