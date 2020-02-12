<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mt-3">
    <h1 class="display-6-teal-md mb-0">Transactions</h1>
    <a href="<?= base_url('engine/new_transaction'); ?>" class="btn btn-outline-teal-md btn-sm rounded-0 shadow-2dp"><i class="fas fa-sm fa-plus"></i> New Transaction</a>
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
                  <th style="width: 15px;">#</th>
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
