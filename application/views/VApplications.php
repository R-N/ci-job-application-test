<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Apply - Energeek</title>
  <?php $this->view("common/CommonCSS.php"); ?>
  <style>
    div.dt-buttons {
      clear: both;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
  <?php $this->view("common/Navbar.php"); ?>
  <?php $this->view("common/Sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper py-4 px-5">
    <!-- Content Header (Page header)-->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Lamaran</h1>
          </div>
        </div>
      </div>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Apply</th>
                    <th>Email</th>
                    <th>Jabatan</th>
                    <th>Aksi</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php foreach($applications as $application) { ?>
                    <tr>
                      <td><?=$application['id']?></td>
                      <td><?=$application['created_at']?></td>
                      <td><?=$application['email']?></td>
                      <td><?=$application['position_name']?></td>
                      <td>
                        <button type="button" class="btn" data-toggle="modal" data-target="#modal-info-<?=$application['id']?>"><i class="fa fa-comment"></i></button>
                        <button type="button" class="btn"><i class="fa fa-trash" onclick="askDelete(<?=$application['id']?>);"></i></button>

                      </td>
                    </tr>
                  <?php } ?>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php $this->view("common/Footer.php"); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php foreach($applications as $application) { ?>
  <div class="modal fade" id="modal-info-<?=$application['id']?>">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Detail Lamaran</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <!-- form start -->
            <div class="form-group">
              <label>Tanggal Apply</label>
              <div><?=$application['created_at']?>
            </div>
            <div class="form-group">
              <label>Jabatan</label>
              <div><?=$application['position_name']?>
            </div>
            <div class="form-group">
              <label>Telepon</label>
              <div><?=$application['phone']?>
            </div>
            <div class="form-group">
              <label>Email</label>
              <div><?=$application['email']?>
            </div>
            <div class="form-group">
              <label>Tahun Lahir</label>
              <div><?=$application['birthyear']?>
            </div>
          </div>

        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal -->
<?php } ?>
<?php $this->view("common/CommonJS.php"); ?>
<!-- Page specific script -->
<script>

var baseUrl = "<?php echo base_url(); ?>";

  function alertSuccess(message, callback){
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: message,
      confirmButtonColor: 'teal',
      confirmButtonText: "Selesai"
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        if (callback)
          callback();
      }
    });
  }
  function askDelete($id){
    Swal.fire({
      icon: 'warning',
      title: 'Hapus Lamaran?',
      showCancelButton: true,
      confirmButtonText: 'Ya, Hapus',
      confirmButtonColor: "red",
      cancelButtonText: `Batal`,
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        let loginData = {
          url: baseUrl + "applications/delete/" + $id,
          method: 'post',
          success: function(response, textStatus, xhr){
            alertSuccess("Data lamaran berhasil dihapus.", function(){
              window.location.reload();
            });
          },
          error: function (xhr, ajaxOptions, thrownError) {
            alertError(xhr.responseText);
          }
        };
        $.ajax(loginData);
      } 
    });
  }

  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": true, "autoWidth": false, "info": true,
      //"dom": 'lBfrtip',
      "buttons": [ 'pageLength' ]
    });
  });


</script>
</body>
</html>
