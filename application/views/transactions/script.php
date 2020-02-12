<script>
$( document ).ready( function () {
  var full_url = window.location.href;
  var splitted_url = full_url.split('/');

  if ( splitted_url[5] == 'transactions' )
  {
    $( '#dataTables' ).DataTable();

    init_datatable();
  }
  else if ( splitted_url[5] == 'new_transaction' )
  {
    load_all_categories_for_list();
  }
});

var table = null;
function init_datatable()
{
  table = $(' #dataTables' ).DataTable({
    'processing': true,
    'serverSide': true,
    'destroy': true,
    'order': [],
    'ajax':
    {
      'url': "<?= base_url('engine/load_all_transactions'); ?>",
      'type': 'POST'
    },
    'columnDefs':
    [
      {
        'targets': [ 0 ],
        'orderable': false,
      },
    ]
  });
}

function reload_datatable()
{
  if ( table != null )
  {
    table = null;

    init_datatable();
  }
}

function load_all_categories_for_list()
{
  $.ajax({
    type: 'POST',
    url: "<?= base_url('engine/load_all_categories_for_list'); ?>",
    dataType: 'json',
    success: function( response )
    {
      if ( response.success != false )
      {
        $( '#category_id' ).empty();

        $.each( response, function( i, d )
        {
          $( '#category_id' ).append( '<option value="' + d.category_id + '">' + d.category_nm + '</option>' );
        });
      }
      else
      {
        $( '#category_id' ).append( '<option value="">No data</option>' );
      }
    }
  });
}

function create_new_transaction()
{
  var date = $( '#date' ).val();
  var category_id = $( '#category_id' ).val();
  var information = $( '#information' ).val();
  var credit = $( '#credit' ).val();
  var debit = $( '#debit' ).val();
  var saldo = $( '#saldo' ).val();

  if ( date == '' )
  {
    alert( 'Date cannot be empty!' );
  }
  else
  {
    if ( credit == '' && debit == '' )
    {
      alert( 'Credit and Debit cannot be empty. Fill in one of them at least!' );
    }
    else
    {
      if ( credit == '' ) { credit = 0; }
      if ( debit == '' ) { debit = 0; }
      if ( saldo == '' ) { saldo = 0; }

      $.ajax({
        type: 'POST',
        url: "<?= base_url('engine/create_new_transaction'); ?>",
        dataType: 'json',
        data:
        {
          'date': date,
          'category_id': category_id,
          'information': information,
          'credit': credit,
          'debit': debit,
          'saldo': saldo
        },
        success: function( response )
        {
          if ( response.success )
          {
            alert( response.msg );

            window.location.href = '<?= base_url('engine/transactions'); ?>';

            reload_datatable();
          }
          else
          {
            alert( response.msg );
          }
        }
      });
    }
  }
}

function recreate_new_transaction()
{
  var date = $( '#date' ).val();
  var category_id = $( '#category_id' ).val();
  var information = $( '#information' ).val();
  var credit = $( '#credit' ).val();
  var debit = $( '#debit' ).val();
  var saldo = $( '#saldo' ).val();

  if ( date == '' )
  {
    alert( 'Date cannot be empty!' );
  }
  else
  {
    if ( credit == '' && debit == '' )
    {
      alert( 'Credit and Debit cannot be empty. Fill in one of them at least!' );
    }
    else
    {
      if ( credit == '' ) { credit = 0; }
      if ( debit == '' ) { debit = 0; }
      if ( saldo == '' ) { saldo = 0; }

      $.ajax({
        type: 'POST',
        url: "<?= base_url('engine/create_new_transaction'); ?>",
        dataType: 'json',
        data:
        {
          'date': date,
          'category_id': category_id,
          'information': information,
          'credit': credit,
          'debit': debit,
          'saldo': saldo
        },
        success: function( response )
        {
          if ( response.success )
          {
            alert( response.msg );

            $( '#date' ).val( '' );
            load_all_categories_for_list();
            $( '#information' ).val( '' );
            $( '#credit' ).val( '' );
            $( '#debit' ).val( '' );
            $( '#saldo' ).val( '' );

            reload_datatable();
          }
          else
          {
            alert( response.msg );
          }
        }
      });
    }
  }
}

function edit_transaction()
{
  var date = $( '#date' ).val();
  var category_id = $( '#category_id' ).val();
  var information = $( '#information' ).val();
  var credit = $( '#credit' ).val();
  var debit = $( '#debit' ).val();
  var saldo = $( '#saldo' ).val();

  if ( date == '' )
  {
    alert( 'Date cannot be empty!' );
  }
  else
  {
    if ( credit == '' && debit == '' )
    {
      alert( 'Credit and Debit cannot be empty. Fill in one of them at least!' );
    }
    else
    {
      if ( credit == '' ) { credit = 0; }
      if ( debit == '' ) { debit = 0; }
      if ( saldo == '' ) { saldo = 0; }

      var full_url = window.location.href;
      var splitted_url = full_url.split('/');

      $.ajax({
        type: 'POST',
        url: "<?= base_url('engine/update_transaction'); ?>",
        dataType: 'json',
        data:
        {
          'transaction_id': splitted_url[6],
          'date': date,
          'category_id': category_id,
          'information': information,
          'credit': credit,
          'debit': debit,
          'saldo': saldo
        },
        success: function( response )
        {
          if ( response.success )
          {
            alert( response.msg );

            window.location.href = '<?= base_url('engine/transactions'); ?>';

            reload_datatable();
          }
          else
          {
            alert( response.msg );
          }
        }
      });
    }
  }
}

function remove_transaction()
{
  var full_url = window.location.href;
  var splitted_url = full_url.split('/');

  var response = confirm( 'Do you want to delete this transaction?' );

  if ( response )
  {
    $.ajax({
      type: 'POST',
      url: "<?= base_url('engine/remove_transaction'); ?>",
      dataType: 'json',
      data:
      {
        'transaction_id': splitted_url[6]
      },
      success: function( response )
      {
        if ( response.success )
        {
          alert( response.msg );

          window.location.href = '<?= base_url('engine/transactions'); ?>';

          reload_datatable();
        }
        else
        {
          alert( response.msg );
        }
      }
    });
  }
}
</script>
