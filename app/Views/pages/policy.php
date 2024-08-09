<?= $this->extend('main') ?>

<?= $this->section('content') ?>
<div class="content-header">
    <div class="container">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0"> Policy Page</h1>
            </div>
        </div>
    </div>
</div>

<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-primary card-outline">
                  <div class="card-header">
                    <h5 class="card-title m-0"></h5>
                    <img src="/assets/logo.jpg" style="max-width: 15%;"/>
                    <button class="float-right btn btn-sm btn-outline-primary" id="btnCreate">Create New Policy</button>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered" style="width:100%" id="table-policy">
                        <thead style="text-align">
                            <tr>
                                <th>No</th>
                                <th>Nama Nasabah</th>
                                <th>Periode Pertanggungan</th>
                                <th>Pertanggungan / Kendaraan</th>
                                <th>Harga Pertanggungan</th>
                                <th>Jenis Pertanggungan</th>
                                <th>Resiko Pertanggungan</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="addNewModal" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addModalLabel">Modal title</h5>
        <button type="reset" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="policyForm">
        <input type="hidden" name="id" id="id">
        
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>Nama Nasabah</label>
                <input type="text" class="form-control" name="nama_nasabah" id="nama_nasabah" placeholder="Nama Lengkap Nasabah" required />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Periode Pertanggungan</label>
                    <div class="form-inline">
                        <input type="date" class="form-control" name="start_date" id="start_date" required/> &nbsp; <b> - </b> &nbsp;
                        <input type="date" class="form-control" name="end_date" id="end_date" required/>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>Pertanggungan / Kendaraan</label>
                <input type="text" class="form-control" name="kendaraan" id="kendaraan" placeholder="Pertanggungan / Kendaraan" required />
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Harga Pertanggungan</label>
                <input type="number" class="form-control" name="harga" id="harga" placeholder="Nominal angka" required />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="form-group">
                <label>Jenis Pertanggungan</label>
                <select name="jenis" id="jenis" class="form-control" required>
                    <option selected disabled>Pilih Jenis Pertanggungan</option>
                    <option value="1">COMPREHENSIVE</option>
                    <option value="2">TOTAL LOSS ONLY</option>
                </select>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group">
                <label>Resiko Pertanggungan</label>
                <div class="form-inline">
                    <input type="radio" name="resiko" id="resiko" value="0" /> Banjir &nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp; 
                    <input type="radio" name="resiko" id="resiko" value="1" /> Gempa
                </div>
                </div>
            </div>
        </div>
        
      </div>
      <div class="modal-footer justify-content-center">
            <button type="reset" class="btn btn-secondary m-1" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary" id="simpan" value="create">Save Policy</button>
      </div>
      </form>
    </div>
  </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('script') ?>
<script>
$(document).ready(function() {
    let dataTable = $('#table-policy').DataTable({
        processing: true,
        servrside: true,
        scrollX: true,
        responsive: true,
        ajax: {
            url:"<?= base_url('policy/new') ?>",
          },

    });

    $('#end_date').change(function(){
      var end = document.getElementById("end_date").value;
      var start = document.getElementById("start_date").value;
      if(end <= start){
        Swal.fire("Peringatan !","Tanggal Akhir Periode harus Lebih Besar dari Tanggal Awal Periode");
        $('#end_date').val('Y-m-d');
      }
    });

    $('#btnCreate').click(function () {
        $('#simpan').val("create-policy");
        $('#id').val('');
        $('#policyForm').trigger("reset");
        $('#addModalLabel').html("Create New Policy ");
        $('#addNewModal').modal('show');
    });

    $('#policyForm').submit(function(e) {
        e.preventDefault();
        let formData = new FormData(this);
            $('#simpan').html('Sending...');
                $.ajax({
                    type: 'POST',
                    url: "<?= base_url('policy') ?>",
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: (response) => {
                        $('#simpan').html('Submit');
                        $('#policyForm').trigger("reset");
                        $('#addNewModal').modal('hide');
                        Swal.fire({
                            title: "Success",
                            text: `${response.message}`,
                            icon: "success",
                            customClass: { confirmButton: "btn btn-success" },
                            buttonsStyling: !1,
                        });
                        $('#table-policy').DataTable().ajax.reload(null, false);
                    },
                    
            });
    });

    $('body').on('click', '#editBtn', function () {
        var id = $(this).data('id');
        $.get("<?= base_url('policy') ?>" +'/' + id +'/edit', function (data) {
            $('#addModalLabel').html("Edit Policy");
            $('#simpan').val("edit-policy");
            $('#addNewModal').modal('show');
            $('#id').val(data.id);
            $('#nama_nasabah').val(data.nama_nasabah);
            $('#kendaraan').val(data.kendaraan);
            $('#harga').val(data.harga);
            $('#jenis').val(data.jenis);
            $('input[name="resiko"][value="'+data.resiko+'"]').attr('checked', true);
            $('#start_date').val(data.start_date);
            $('#end_date').val(data.end_date);
        })
    });

    $('body').on('click', '#deleteBtn', function () {
        var id = $(this).data("id");
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, deleted",
            customClass: {
                confirmButton: "btn btn-primary me-3",
                cancelButton: "btn btn-label-secondary",
            }
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "<?= base_url('policy') ?>"+"/"+id,
                    type: "DELETE",
                    data: {id},
                    success: function(response) {
                        Swal.fire({
                            title: "Deleted!",
                            text: `${response.message}`,
                            icon: "success",
                            customClass: { confirmButton: "btn btn-success" },
                        });
                        $('#table-policy').DataTable().ajax.reload(null, false);
                    }
                });
            }
        });
    });
    

});
</script>

<?= $this->endSection() ?>