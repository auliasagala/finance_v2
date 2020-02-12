<script>
$( document ).ready( function () {
  init_date();
  init_datatable();
  init_date_generate_report();
});

function init_date()
{
  var date = new Date();
  var year = date.getFullYear();
  var month = date.getMonth() + 1;
  var day = date.getDate();

  var first_day = date.getFullYear() + '-' + ( ( '' + month ).length < 2 ? '0' : '' ) + month + '-' + '01';
  var last_date = days_in_month( month, year );
  var last_day = date.getFullYear() + '-' + ( ( '' + month ).length < 2 ? '0' : '' ) + month + '-' + last_date;

  $( '#start_date' ).val( first_day );
  $( '#end_date' ).val( last_day );
}

function days_in_month ( month, year )
{
  return new Date( year, month, 0 ).getDate();
}

function init_date_generate_report()
{
  var start_date = $( '#start_date' ).val();
  var end_date = $( '#end_date' ).val();

  $( '#_start_date' ).val( start_date );
  $( '#_end_date' ).val( end_date );
}

var table = null;
function init_datatable()
{
  var start_date = $( '#start_date' ).val();
  var end_date = $( '#end_date' ).val();

  table = $(' #dataTables' ).DataTable({
    'processing': true,
    'serverSide': true,
    'destroy': true,
    'order': [],
    'ajax':
    {
      'url': "<?= base_url('engine/load_all_report_data'); ?>",
      'type': 'POST',
      'data':
      {
        'start_date': start_date,
        'end_date': end_date
      }
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
</script>
