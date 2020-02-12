<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mt-3">
    <h1 class="display-6-teal-md mb-0">Reports</h1>

    <form action="<?= base_url('engine/generate_report'); ?>" method="post">

      <!-- Params -->
      <input type="hidden" id="_start_date" name="_start_date_post">
      <input type="hidden" id="_end_date" name="_end_date_post">

      <button type="submit" class="btn btn-outline-teal-md btn-sm rounded-0 shadow-2dp">
        <i class="fas fa-sm fa-download"></i> Generate Report
      </button>
    </form>
  </div>

  <div class="row mt-3 mb-3">
    <div class="col-xl-12">
      <div class="card rounded-0 shadow-2dp">
        <div class="card-body">

          <div class="row">

            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
              <div class="form-group small">
                <label for="start_date">Start Date</label>
                <input type="date" class="form-control form-control-sm rounded-0" id="start_date" onchange="init_date_generate_report()">
              </div>
            </div>

            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
              <div class="form-group small">
                <label for="end_date">End Date</label>
                <input type="date" class="form-control form-control-sm rounded-0" id="end_date" onchange="init_date_generate_report()">
              </div>
            </div>

            <div class="col-xl-2 col-lg-2 col-md-3 col-sm-12">
              <div class="form-group">
                <button type="button" class="btn btn-outline-teal-md btn-sm rounded-0 shadow-2dp mt-4" onclick="reload_datatable()">
                  <i class="fas fa-sm fa-search"></i> Load
                </button>
              </div>
            </div>

          </div>

        </div>
      </div>
    </div>
  </div>

  <div class="row mt-3 mb-5">
    <div class="col-xl-12">
      <div class="card rounded-0 shadow-2dp">
        <div class="card-body">
          <div class="table-responsive">
            <table id="dataTables" class="table table-bordered table-hover small" width="100%">
              <thead>
                <tr>
                  <th style="width: 30px;">No</th>
                  <th>Date</th>
                  <th>Category</th>
                  <th>Information</th>
                  <th>Credit</th>
                  <th>Debit</th>
                  <th>Saldo</th>
                  <th>Inserted Datetime</th>
                </tr>
              </thead>
              <tbody>
                <!-- data -->
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
