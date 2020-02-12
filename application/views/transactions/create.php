<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mt-3">
    <h1 class="display-6-teal-md mb-0">New Transaction</h1>
  </div>

  <div class="row mt-3 mb-5">
    <div class="col-xl-12">
      <div class="card rounded-0 shadow-2dp">
        <div class="card-body">

          <div class="row">
            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-12">

              <div class="form-group small">
                <label for="date">Date</label>
                <input type="date" class="form-control form-control-sm rounded-0" id="date">
              </div>
              <div class="form-group small">
                <label for="category_id">Category</label>
                <select class="form-control form-control-sm rounded-0" id="category_id">
                  <option>1</option>
                </select>
              </div>
              <div class="form-group small">
                <label for="information">Information</label>
                <input type="text" class="form-control form-control-sm rounded-0" id="information">
              </div>
              <div class="form-group small">
                <label for="credit">Credit</label>
                <input type="number" class="form-control form-control-sm rounded-0" id="credit">
              </div>
              <div class="form-group small">
                <label for="debit">Debit</label>
                <input type="number" class="form-control form-control-sm rounded-0" id="debit">
              </div>
              <div class="form-group small">
                <label for="saldo">Saldo</label>
                <input type="number" class="form-control form-control-sm rounded-0" id="saldo">
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-12">

              <div class="form-group text-right">
                <a href="<?= base_url('engine/transactions'); ?>" class="btn btn-outline-teal-md btn-sm rounded-0 shadow-2dp"><i class="fas fa-sm fa-arrow-left"></i> Back</a>
                <button type="button" class="btn btn-outline-teal-md btn-sm rounded-0 shadow-2dp" onclick="create_new_transaction()">
                  <i class="fas fa-sm fa-check"></i> Save
                </button>
                <button type="button" class="btn btn-outline-teal-md btn-sm rounded-0 shadow-2dp" onclick="recreate_new_transaction()">
                  <i class="fas fa-sm fa-check"></i> Save and Re-insert
                </button>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
