<div class="container-fluid">

  <div class="d-sm-flex align-items-center justify-content-between mt-3">
    <h1 class="display-6-teal-md mb-0">Edit Transaction</h1>
  </div>

  <div class="row mt-3 mb-5">
    <div class="col-xl-12">
      <div class="card rounded-0 shadow-2dp">
        <div class="card-body">

          <div class="row">
            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-12">

              <div class="form-group small">
                <label for="date">Date</label>
                <input type="date" class="form-control form-control-sm rounded-0" id="date" value="<?= $transaction[0]->date; ?>">
              </div>
              <div class="form-group small">
                <label for="category_id">Category</label>
                <select class="form-control form-control-sm rounded-0" id="category_id">
                  <?php foreach ($categories as $row) : ?>
                    <?php if ($row['category_id'] == $transaction[0]->category_id) : ?>
                      <option value="<?= $row['category_id']; ?>" selected><?= $row['category_nm']; ?></option>
                    <?php else : ?>
                      <option value="<?= $row['category_id']; ?>"><?= $row['category_nm']; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                </select>
              </div>
              <div class="form-group small">
                <label for="information">Information</label>
                <input type="text" class="form-control form-control-sm rounded-0" id="information" value="<?= $transaction[0]->information; ?>">
              </div>
              <div class="form-group small">
                <label for="credit">Credit</label>
                <input type="number" class="form-control form-control-sm rounded-0" id="credit" value="<?= $transaction[0]->credit; ?>">
              </div>
              <div class="form-group small">
                <label for="debit">Debit</label>
                <input type="number" class="form-control form-control-sm rounded-0" id="debit" value="<?= $transaction[0]->debit; ?>">
              </div>
              <div class="form-group small">
                <label for="saldo">Saldo</label>
                <input type="number" class="form-control form-control-sm rounded-0" id="saldo" value="<?= $transaction[0]->saldo; ?>">
              </div>

            </div>
          </div>

          <div class="row">
            <div class="col-xl-3 col-lg-5 col-md-6 col-sm-12">

              <div class="form-group text-right">
                <a href="<?= base_url('engine/transactions'); ?>" class="btn btn-outline-teal-md btn-sm rounded-0 shadow-2dp"><i class="fas fa-sm fa-arrow-left"></i> Back</a>
                <button type="button" class="btn btn-outline-orange-md btn-sm rounded-0 shadow-2dp" onclick="remove_transaction()">
                  <i class="fas fa-times"></i> Delete
                </button>
                <button type="button" class="btn btn-outline-teal-md btn-sm rounded-0 shadow-2dp" onclick="edit_transaction()">
                  <i class="fas fa-sm fa-check"></i> Save Changes
                </button>
              </div>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>

</div>
