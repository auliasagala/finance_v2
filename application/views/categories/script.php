<script>
$( document ).ready( function () {
  $( '#dataTables' ).DataTable();

  init_datatable();
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
      'url': "<?= base_url('engine/load_all_categories'); ?>",
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

function create_new_category()
{
  var category_nm = $( '#category_nm' ).val();

  if ( category_nm == '' )
  {
    alert( 'Category Name cannot be empty!' );
  }
  else
  {
    $.ajax({
      type: 'POST',
      url: "<?= base_url('engine/create_new_category'); ?>",
      dataType: 'json',
      data:
      {
        'category_nm': category_nm
      },
      success: function( response )
      {
        if ( response.success )
        {
          alert( response.msg );

          window.location.href = '<?= base_url('engine/categories'); ?>';

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

function recreate_new_category()
{
  var category_nm = $( '#category_nm' ).val();

  if ( category_nm == '' )
  {
    alert( 'Category Name cannot be empty!' );
  }
  else
  {
    $.ajax({
      type: 'POST',
      url: "<?= base_url('engine/create_new_category'); ?>",
      dataType: 'json',
      data:
      {
        'category_nm': category_nm
      },
      success: function( response )
      {
        if ( response.success )
        {
          alert( response.msg );

          $( '#category_nm' ).val( '' );

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

function edit_category()
{
  var category_nm = $( '#category_nm' ).val();

  if ( category_nm == '' )
  {
    alert( 'Category Name cannot be empty!' );
  }
  else
  {
    var full_url = window.location.href;
    var splitted_url = full_url.split('/');

    $.ajax({
      type: 'POST',
      url: "<?= base_url('engine/update_category'); ?>",
      dataType: 'json',
      data:
      {
        'category_id': splitted_url[6],
        'category_nm': category_nm
      },
      success: function( response )
      {
        if ( response.success )
        {
          alert( response.msg );

          window.location.href = '<?= base_url('engine/categories'); ?>';

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

function remove_category()
{
  var full_url = window.location.href;
  var splitted_url = full_url.split('/');

  var response = confirm( 'Do you want to delete this category?' );

  if ( response )
  {
    $.ajax({
      type: 'POST',
      url: "<?= base_url('engine/remove_category'); ?>",
      dataType: 'json',
      data:
      {
        'category_id': splitted_url[6]
      },
      success: function( response )
      {
        if ( response.success )
        {
          alert( response.msg );

          window.location.href = '<?= base_url('engine/categories'); ?>';

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
