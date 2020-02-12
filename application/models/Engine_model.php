<?php

class Engine_model extends CI_Model
{
  // -------------------------------------------------------------------------------------------------------------- LOADER

  // Categories loader
  private function init_all_categories_query()
  {
    $column_order = [
      null,
      'c.id',
      'c.category_nm',
      'c.inserted_datetime'
    ];
    $column_search = [
      'c.category_nm',
      'c.inserted_datetime'
    ];
    $order = [ 'c.category_nm' => 'asc' ];

    $this->db->select('c.id,
                       c.category_nm,
                       c.inserted_datetime');
    $this->db->from('categories c');
    $this->db->where('c.deleted_datetime', null);

    $i = 0;
    foreach ($column_search as $item)
    {
      $search_value = $this->input->post('search')['value'];

      if ($search_value)
      {
        if ($i === 0)
        {
          $this->db->group_start();
          $this->db->like($item, $search_value);
        }
        else
        {
          $this->db->or_like($item, $search_value);
        }

        if (count($column_search) - 1 == $i)
        {
          $this->db->group_end();
        }
      }

      $i++;
    }

    if (isset($_POST['order']))
    {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }
    elseif (isset($order))
    {
      $order = $order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  // Categories loader
  public function load_all_categories()
  {
    $this->init_all_categories_query();

    if ($_POST['length'] != -1)
    {
      $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get()->result();

      return $query;
    }
  }

  // Categories loader
  public function counter_all_categories()
  {
    $this->db->select('*');
    $this->db->from('categories c');
    $this->db->where('c.deleted_datetime', null);

    $result = $this->db->get()->num_rows();

    return $result;
  }

  // Category loader for form
  public function load_category_for_form($category_id)
  {
    $this->db->where('id', $category_id);
    $result = $this->db->get('categories')->result();

    if ($result)
    {
      return $result;
    }
    else
    {
      return false;
    }
  }

  // Categories loader for list
  public function load_all_categories_for_list()
  {
    $this->db->order_by('category_nm', 'asc');
    $this->db->where('deleted_datetime', null);
    $result = $this->db->get('categories')->result();

    if ($result)
    {
      $data = [];
			$i = 0;

			foreach ($result as $row)
			{
				$data[$i]['category_id'] = $row->id;
				$data[$i]['category_nm'] = $row->category_nm;

				$i++;
			}

      return $data;
    }
    else
    {
      return false;
    }
  }

  // Transactions loader
  private function init_all_transactions_query()
  {
    $column_order = [
      null,
      't.id',
      't.date',
      'c.category_nm',
      't.information',
      't.credit',
      't.debit',
      't.saldo',
      't.inserted_datetime'
    ];
    $column_search = [
      't.id',
      't.date',
      'c.category_nm',
      't.information',
      't.credit',
      't.debit',
      't.saldo',
      't.inserted_datetime'
    ];
    $order = [ 't.date' => 'desc' ];

    $this->db->select('t.id,
                       t.date,
                       t.category_id,
                       c.category_nm,
                       t.information,
                       t.credit,
                       t.debit,
                       t.saldo,
                       t.inserted_datetime');
    $this->db->from('transactions t');
    $this->db->join('categories c', 't.category_id = c.id', 'left');
    $this->db->where('t.deleted_datetime', null);

    $i = 0;
    foreach ($column_search as $item)
    {
      $search_value = $this->input->post('search')['value'];

      if ($search_value)
      {
        if ($i === 0)
        {
          $this->db->group_start();
          $this->db->like($item, $search_value);
        }
        else
        {
          $this->db->or_like($item, $search_value);
        }

        if (count($column_search) - 1 == $i)
        {
          $this->db->group_end();
        }
      }

      $i++;
    }

    if (isset($_POST['order']))
    {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }
    elseif (isset($order))
    {
      $order = $order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  // Transactions loader
  public function load_all_transactions()
  {
    $this->init_all_transactions_query();

    if ($_POST['length'] != -1)
    {
      $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get()->result();

      return $query;
    }
  }

  // Transactions loader
  public function counter_all_transactions()
  {
    $this->db->select('*');
    $this->db->from('transactions t');
    $this->db->where('t.deleted_datetime', null);

    $result = $this->db->get()->num_rows();

    return $result;
  }

  // Transaction loader for form
  public function load_transaction_for_form($transaction_id)
  {
    $this->db->where('id', $transaction_id);
    $result = $this->db->get('transactions')->result();

    if ($result)
    {
      return $result;
    }
    else
    {
      return false;
    }
  }

  // Reports loader
  private function init_all_report_data_query($start_date, $end_date)
  {
    $column_order = [
      null,
      't.id',
      't.date',
      'c.category_nm',
      't.information',
      't.credit',
      't.debit',
      't.saldo',
      't.inserted_datetime'
    ];
    $column_search = [
      't.id',
      't.date',
      'c.category_nm',
      't.information',
      't.credit',
      't.debit',
      't.saldo',
      't.inserted_datetime'
    ];
    $order = [ 't.date' => 'desc' ];

    $this->db->select('t.id,
                       t.date,
                       t.category_id,
                       c.category_nm,
                       t.information,
                       t.credit,
                       t.debit,
                       t.saldo,
                       t.inserted_datetime');
    $this->db->from('transactions t');
    $this->db->join('categories c', 't.category_id = c.id', 'left');
    $this->db->where('t.deleted_datetime', null);
    $this->db->where('t.date >=', $start_date);
    $this->db->where('t.date <=', $end_date);

    $i = 0;
    foreach ($column_search as $item)
    {
      $search_value = $this->input->post('search')['value'];

      if ($search_value)
      {
        if ($i === 0)
        {
          $this->db->group_start();
          $this->db->like($item, $search_value);
        }
        else
        {
          $this->db->or_like($item, $search_value);
        }

        if (count($column_search) - 1 == $i)
        {
          $this->db->group_end();
        }
      }

      $i++;
    }

    if (isset($_POST['order']))
    {
      $this->db->order_by($column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
    }
    elseif (isset($order))
    {
      $order = $order;
      $this->db->order_by(key($order), $order[key($order)]);
    }
  }

  // Reports loader
  public function load_all_report_data($start_date, $end_date)
  {
    $this->init_all_report_data_query($start_date, $end_date);

    if ($_POST['length'] != -1)
    {
      $this->db->limit($_POST['length'], $_POST['start']);
      $query = $this->db->get()->result();

      return $query;
    }
  }

  // Reports loader
  public function counter_all_report_data($start_date, $end_date)
  {
    $this->db->select('*');
    $this->db->from('transactions t');
    $this->db->join('categories c', 't.category_id = c.id', 'left');
    $this->db->where('t.deleted_datetime', null);
    $this->db->where('t.date >=', $start_date);
    $this->db->where('t.date <=', $end_date);

    $result = $this->db->get()->num_rows();

    return $result;
  }

  // -------------------------------------------------------------------------------------------------------------- CREATOR

  // New Category creator
  public function create_new_category($params)
  {
    $result = $this->db->insert('categories', $params);

    if ($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  // New Transaction creator
  public function create_new_transaction($params)
  {
    $result = $this->db->insert('transactions', $params);

    if ($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  // -------------------------------------------------------------------------------------------------------------- UPDATER

  // Category updater
  public function update_category($category_id, $params)
  {
    $this->db->where('id', $category_id);
    $result = $this->db->update('categories', $params);

    if ($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  // Transaction updater
  public function update_transaction($transaction_id, $params)
  {
    $this->db->where('id', $transaction_id);
    $result = $this->db->update('transactions', $params);

    if ($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  // -------------------------------------------------------------------------------------------------------------- REMOVER

  // Category remover
  public function remove_category($category_id, $deleted_datetime)
  {
    $this->db->where('id', $category_id);
    $result = $this->db->update('categories', [ 'deleted_datetime' => $deleted_datetime ]);

    if ($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  // Transaction remover
  public function remove_transaction($transaction_id, $deleted_datetime)
  {
    $this->db->where('id', $transaction_id);
    $result = $this->db->update('transactions', [ 'deleted_datetime' => $deleted_datetime ]);

    if ($result)
    {
      return true;
    }
    else
    {
      return false;
    }
  }

  // -------------------------------------------------------------------------------------------------------------- GENERATOR

  // Reports generator
  public function generate_report($start_date, $end_date)
  {
    $this->db->select('t.date,
                       c.category_nm,
                       t.information,
                       t.credit,
                       t.debit,
                       t.saldo,
                       t.inserted_datetime');
    $this->db->from('transactions t');
    $this->db->join('categories c', 't.category_id = c.id', 'left');
    $this->db->where('t.deleted_datetime', null);
    $this->db->where('t.date >=', $start_date);
    $this->db->where('t.date <=', $end_date);
    $this->db->order_by('t.date', 'desc');

    $result = $this->db->get()->result();

    if ($result)
    {
      header("Content-type: application/vnd-ms-excel");
	    header("Content-Disposition: attachment; filename=FinanceReport_" . date('YmdHis') . ".xls");

      echo '<table border="1">';
      echo '<thead>';
	    echo '<tr>';
      echo '<th>' . 'No' . '</th>';
	    echo '<th>' . 'Date' . '</th>';
	    echo '<th>' . 'Category' . '</th>';
	    echo '<th>' . 'Information' . '</th>';
	    echo '<th>' . 'Credit' . '</th>';
	    echo '<th>' . 'Debit' . '</th>';
	    echo '<th>' . 'Saldo' . '</th>';
	    echo '<th>' . 'Inserted Datetime' . '</th>';
	    echo '</tr>';
	    echo '</thead>';
	    echo '<tbody>';

      $i = 1;
      foreach ($result as $row)
	    {
        echo '<tr>';
        echo '<td>' . $i++ . '</td>';
	      echo '<td>' . $row->date . '</td>';
	      echo '<td>' . $row->category_nm . '</td>';
	      echo '<td>' . $row->information . '</td>';
	      echo '<td>' . $row->credit . '</td>';
	      echo '<td>' . $row->debit . '</td>';
	      echo '<td>' . $row->saldo . '</td>';
	      echo '<td>' . $row->inserted_datetime . '</td>';
	      echo '</tr>';
	    }

      echo '</tbody>';
      echo '</table>';
    }
    else
    {
      header("Content-type: application/vnd-ms-excel");
	    header("Content-Disposition: attachment; filename=FinanceReport_" . date('YmdHis') . ".xls");

      echo '<table border="1">';
      echo '<thead>';
	    echo '<tr>';
      echo '<th>' . 'Date' . '</th>';
	    echo '<th>' . 'Category' . '</th>';
	    echo '<th>' . 'Information' . '</th>';
	    echo '<th>' . 'Credit' . '</th>';
	    echo '<th>' . 'Debit' . '</th>';
	    echo '<th>' . 'Saldo' . '</th>';
	    echo '<th>' . 'Inserted Datetime' . '</th>';
	    echo '</tr>';
	    echo '</thead>';
	    echo '<tbody>';
      echo '</tbody>';
      echo '</table>';
    }
  }
}
