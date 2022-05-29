<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Apply - Energeek</title>
  <?php $this->view("common/CommonCSS.php"); ?>
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">
  <?php $this->view("common/Navbar.php"); ?>
  <?php $this->view("common/Sidebar.php"); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper py-4 px-5">
    <!-- Content Header (Page header)
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Validation</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Validation</li>
            </ol>
          </div>
        </div>
      </div>
    </section>
    -->
    <!-- Main content -->
    <section class="content py-3">
      <div class="container-fluid ">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- jquery validation -->
            <div class="card w-50 mx-auto">
              <!-- /.card-header -->
              <div class="card-header bg-white border-bottom-0">
                <h3 class="text-center mx-auto w-100 d-block mt-3 font-weight-bold">Apply Lamaran</h3>
              </div>
              <!-- form start -->
              <form
                id="applyForm"
                action="<?php echo base_url(); ?>apply/submit"
                enctype="multipart/form-data"
                method="POST"
              >
                <div class="card-body">
                  <div class="form-group">
                    <label>Jabatan</label>
                    <select class="form-control select2" style="width: 100%;" data-placeholder="Pilih jabatan" name="position">
                      <option disabled selected value></option>
                      <?php foreach($positions as $position) { ?>
                        <option value="<?=$position['id']?>"><?=$position['name']?></option>
                      <?php } ?>
                    </select>
                  </div>
                  <!-- phone mask -->
                  <div class="form-group">
                    <label>Telepon</label>

                    <div class="input-group">
                      <input type="text" name="phone" class="form-control" data-inputmask="'mask': ['9999-9999-9999', '+62 999 9999 9999']" data-mask>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="fas fa-phone"></i></span>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- /.form group -->
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <div class="input-group">
                      <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-envelope"></i></span>
                      </div>
                    </div>
                  </div>
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Tahun Lahir</label>

                    <div class="input-group">
                      <input type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy" name="birthyear" data-mask>
                      <div class="input-group-append">
                        <span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                  <!-- Date dd/mm/yyyy -->
                  <div class="form-group">
                    <label>Berkas Lamaran</label>
                    <div class="dropzone dropzone-file-area bg-light rounded" id="myDropzone">
                      <div class="dz-default dz-message text-center">
                          <h3 class="text-center mx-auto w-50 h-50"><i class="fa fa-upload"></i></h3>
                          <h4 class="sbold">Drop files here or click to upload</h4>
                          <span class="color-secondary">Only allowed to upload with the format .pdf</span>
                      </div>
                    </div>
                    <!-- /.input group -->
                  </div>
                </div>
                <!-- /.form group -->
                <!-- /.card-body -->
                <div class="card-footer bg-white">
                  <button type="submit" class="btn btn-danger d-block w-100 mb-3">Apply</button>
                </div>
              </form>
            </div>
            <!-- /.card -->
            </div>
          <!--/.col (left) -->
          <!-- right column -->
          <div class="col-md-6">

          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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

<?php $this->view("common/CommonJS.php"); ?>
<!-- Page specific script -->
<script>
Dropzone.autoDiscover = false;

var baseUrl = "<?php echo base_url(); ?>";

function alertError(message){
  Swal.fire({
    icon: 'warning',
    title: 'Terjadi kesalahan!',
    text: message,
    confirmButtonColor: 'red',
    confirmButtonText: "Baiklah"
  });
}

function alertSuccess(message){
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: message,
    confirmButtonColor: 'teal',
    confirmButtonText: "Selesai"
  });
}
function alertSubmitSuccess(){
  Swal.fire({
    icon: 'success',
    title: 'Berhasil!',
    text: 'Lamaran berhasil dikirim.',
    confirmButtonColor: 'teal',
    confirmButtonText: "Selesai"
  });
}

function checkEmailPosition(callback=null){
  let formData = new FormData(document.querySelector("#applyForm"));
  let postData = {
    "email": formData.get("email"),
    "position": formData.get("position")
  };
  let loginData = {
    url: baseUrl + "apply/check_email_position",
    method: 'post',
    dataType: 'json',
    data: postData,
    success: function(response, textStatus, xhr){
      if (callback)
        callback();
    },
    error: function (xhr, ajaxOptions, thrownError) {
      alertError(xhr.responseText);
    }
  };
  $.ajax(loginData);
}

function preupload(data, xhr, formData) {
  let myForm = $("#applyForm");
  $(":input[name]", myForm).each(function () {
    formData.append(
      this.name,
      $(':input[name=' + this.name + ']', myForm).val()
    );
  });
}

$(function () {
  Dropzone.autoDiscover = false;
  //Initialize Select2 Elements
  $('.select2').select2()


  //Datemask dd/mm/yyyy
  $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
  //Datemask2 mm/dd/yyyy
  $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
  //Money Euro
  $('[data-mask]').inputmask()

  var myDropzone = $("#myDropzone").dropzone({
    url: baseUrl + 'apply/submit',
    autoProcessQueue: false,
    uploadMultiple: true,
    parallelUploads: 5,
    maxFilesize: 1,
    acceptedFiles: "application/pdf,.pdf,.PDF",
    addRemoveLinks: true,
    init: function() {
      dzClosure = this; // Makes sure that 'this' is understood inside the functions below.
    }
  });

  myDropzone = Dropzone.forElement("#myDropzone");
  myDropzone.on("sendingmultiple", preupload);
  myDropzone.on("success", function(file, response){
    //Here you can get your response.
    console.log(response);
  });
  myDropzone.on("successmultiple", function(response){
    $("#applyForm :input").prop("disabled", true);
    myDropzone.disable();
    $("#myDropzone").hide();
    alertSubmitSuccess();
  });

  $('#applyForm').validate({
    rules: {
      position: {
        required: true
      },
      phone: {
        required: true
      },
      email: {
        required: true,
        email: true,
      },
      birthyear: {
        required: true,
        minlength: 4
      }
    },
    messages: {
      position: {
        required: "Please select a position to apply"
      },
      phone: {
        required: "Please enter your phone number"
      },
      email: {
        required: "Please enter your email address",
        email: "Please enter a valid email address"
      },
      birthyear: {
        required: "Please enter your year of birth",
        minlength: "Enter your year of birth in YYYY format"
      }
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    },
    submitHandler: function (form, event) {
      event.preventDefault();
      if(myDropzone.getAcceptedFiles().length < 2){
        Swal.fire({
          icon: 'warning',
          title: 'Terjadi kesalahan!',
          text: 'Anda perlu upload minimal 2 berkas lamaran.',
          confirmButtonColor: 'red',
          confirmButtonText: "Baiklah"
        });
        return;
      }
      checkEmailPosition(function(){
        dzClosure.processQueue();
      });
    }
  });
});
</script>
</body>
</html>
