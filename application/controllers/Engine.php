<?php

class Engine extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();

    $this->load->model('Engine_model');
  }

  // -------------------------------------------------------------------------------------------------------------- VIEWS

  // Dashboard view
  public function index()
  {
    $this->load->view('templates/part_open_tag');
    $this->load->view('templates/part_top_bar');
    $this->load->view('dashboard/index');
    $this->load->view('templates/part_global_js');
    $this->load->view('dashboard/script');
    $this->load->view('templates/part_close_tag');
  }

  // Categories view
  public function categories()
  {
    $this->load->view('templates/part_open_tag');
    $this->load->view('templates/part_top_bar');
    $this->load->view('categories/index');
    $this->load->view('templates/part_global_js');
    $this->load->view('categories/script');
    $this->load->view('templates/part_close_tag');
  }

  // New Category view
  public function new_category()
  {
    $this->load->view('templates/part_open_tag');
    $this->load->view('templates/part_top_bar');
    $this->load->view('categories/create');
    $this->load->view('templates/part_global_js');
    $this->load->view('categories/script');
    $this->load->view('templates/part_close_tag');
  }

  // Edit Category view
  public function edit_category()
  {
    $data['category'] = $this->load_category_for_form();

    $this->load->view('templates/part_open_tag');
    $this->load->view('templates/part_top_bar');
    $this->load->view('categories/edit', $data);
    $this->load->view('templates/part_global_js');
    $this->load->view('categories/script');
    $this->load->view('templates/part_close_tag');
  }

  // Transactions view
  public function transactions()
  {
    $this->load->view('templates/part_open_tag');
    $this->load->view('templates/part_top_bar');
    $this->load->view('transactions/index');
    $this->load->view('templates/part_global_js');
    $this->load->view('transactions/script');
    $this->load->view('templates/part_close_tag');
  }

  // New Transaction view
  public function new_transaction()
  {
    $this->load->view('templates/part_open_tag');
    $this->load->view('templates/part_top_bar');
    $this->load->view('transactions/create');
    $this->load->view('templates/part_global_js');
    $this->load->view('transactions/script');
    $this->load->view('templates/part_close_tag');
  }

  // Edit Transaction view
  public function edit_transaction()
  {
    $data['transaction'] = $this->load_transaction_for_form();
    $data['categories'] = $this->Engine_model->load_all_categories_for_list();

    $this->load->view('templates/part_open_tag');
    $this->load->view('templates/part_top_bar');
    $this->load->view('transactions/edit', $data);
    $this->load->view('templates/part_global_js');
    $this->load->view('transactions/script');
    $this->load->view('templates/part_close_tag');
  }

  // Reports view
  public function reports()
  {
    $this->load->view('templates/part_open_tag');
    $this->load->view('templates/part_top_bar');
    $this->load->view('reports/index');
    $this->load->view('templates/part_global_js');
    $this->load->view('reports/script');
    $this->load->view('templates/part_close_tag');
  }

  // -------------------------------------------------------------------------------------------------------------- LOADER

  // Categories loader
  public function load_all_categories()
  {
    $draw = $this->input->post('draw');
    $no = $this->input->post('start');

    $result = $this->Engine_model->load_all_categories();

    $data = [];
    foreach ($result as $field)
    {
      $no++;
      $column = [];
      $column[0] = $no;
      $column[1] = $field->category_nm;
      $column[2] = $field->inserted_datetime;
      $column[3] = '<a href="' . base_url('engine/edit_category/') . $field->id . '" class="btn btn-outline-teal-md btn-sm btn-block rounded-0 shadow-2dp"><i class="fas fa-pen"></i></a>';

      $data[] = $column;
    }

    $counter = $this->Engine_model->counter_all_categories();

    $output = [
      'draw' => $draw,
      'recordsTotal' => $counter,
      'recordsFiltered' => $counter,
      'data' => $data
    ];

    echo json_encode($output);
  }

  // Category loader for form
  public function load_category_for_form()
  {
    $category_id = $this->uri->segment(3, 0);

    $result = $this->Engine_model->load_category_for_form($category_id);

    return $result;
  }

  // Categories loader for list
  public function load_all_categories_for_list()
  {
    $result = $this->Engine_model->load_all_categories_for_list();

    if ($result != false)
    {
      echo json_encode($result);
    }
    else
    {
      $response = [
        'success' => false
      ];

      echo json_encode($response);
    }
  }

  // Transactions loader
  public function load_all_transactions()
  {
    $draw = $this->input->post('draw');
    $no = $this->input->post('start');

    $result = $this->Engine_model->load_all_transactions();

    $data = [];
    foreach ($result as $field)
    {
      $no++;
      $column = [];
      $column[0] = $no;
      $column[1] = $field->date;
      $column[2] = $field->category_nm;
      $column[3] = $field->information;
      $column[4] = $field->credit;
      $column[5] = $field->debit;
      $column[6] = $field->saldo;
      $column[7] = $field->inserted_datetime;
      $column[8] = '<a href="' . base_url('engine/edit_transaction/') . $field->id . '" class="btn btn-outline-teal-md btn-sm btn-block rounded-0 shadow-2dp"><i class="fas fa-pen"></i></a>';

      $data[] = $column;
    }

    $counter = $this->Engine_model->counter_all_transactions();

    $output = [
      'draw' => $draw,
      'recordsTotal' => $counter,
      'recordsFiltered' => $counter,
      'data' => $data
    ];

    echo json_encode($output);
  }

  // Transaction loader for form
  public function load_transaction_for_form()
  {
    $transaction_id = $this->uri->segment(3, 0);

    $result = $this->Engine_model->load_transaction_for_form($transaction_id);

    return $result;
  }

  // Reports loader
  public function load_all_report_data()
  {
    $start_date = $this->input->post('start_date');
    $end_date = $this->input->post('end_date');
    $draw = $this->input->post('draw');
    $no = $this->input->post('start');

    $result = $this->Engine_model->load_all_report_data($start_date, $end_date);

    $data = [];
    foreach ($result as $field)
    {
      $no++;
      $column = [];
      $column[0] = $no;
      $column[1] = $field->date;
      $column[2] = $field->category_nm;
      $column[3] = $field->information;
      $column[4] = $field->credit;
      $column[5] = $field->debit;
      $column[6] = $field->saldo;
      $column[7] = $field->inserted_datetime;

      $data[] = $column;
    }

    $counter = $this->Engine_model->counter_all_report_data($start_date, $end_date);

    $output = [
      'draw' => $draw,
      'recordsTotal' => $counter,
      'recordsFiltered' => $counter,
      'data' => $data
    ];

    echo json_encode($output);
  }

  // -------------------------------------------------------------------------------------------------------------- CREATOR

  // New Category creator
  public function create_new_category()
  {
    $params = [
      'category_nm' => $this->input->post('category_nm')
    ];

    $result = $this->Engine_model->create_new_category($params);

    if ($result)
    {
      $response = [
        'success' => true,
        'msg' => 'Successfully inserted!'
      ];

      echo json_encode($response);
    }
    else
    {
      $response = [
        'success' => false,
        'msg' => 'Inserting new category is failed!'
      ];

      echo json_encode($response);
    }
  }

  // New Transaction creator
  public function create_new_transaction()
  {
    $params = [
      'date' => $this->input->post('date'),
      'category_id' => $this->input->post('category_id'),
      'information' => $this->input->post('information'),
      'credit' => $this->input->post('credit'),
      'debit' => $this->input->post('debit'),
      'saldo' => $this->input->post('saldo')
    ];

    $result = $this->Engine_model->create_new_transaction($params);

    if ($result)
    {
      $response = [
        'success' => true,
        'msg' => 'Successfully inserted!'
      ];

      echo json_encode($response);
    }
    else
    {
      $response = [
        'success' => false,
        'msg' => 'Inserting new transaction is failed!'
      ];

      echo json_encode($response);
    }
  }

  // -------------------------------------------------------------------------------------------------------------- UPDATER

  // Category updater
  public function update_category()
  {
    $category_id = $this->input->post('category_id');

    $query_time = "SELECT NOW() AS waktu";
    $result_time = $this->db->query($query_time)->result();
    $updated_datetime = $result_time[0]->waktu;

    $params = [
      'category_nm' => $this->input->post('category_nm'),
      'updated_datetime' => $updated_datetime
    ];

    $result = $this->Engine_model->update_category($category_id, $params);

    if ($result)
    {
      $response = [
        'success' => true,
        'msg' => 'Successfully edited!'
      ];

      echo json_encode($response);
    }
    else
    {
      $response = [
        'success' => false,
        'msg' => 'Editing category is failed!'
      ];

      echo json_encode($response);
    }
  }

  // Transaction updater
  public function update_transaction()
  {
    $transaction_id = $this->input->post('transaction_id');

    $query_time = "SELECT NOW() AS waktu";
    $result_time = $this->db->query($query_time)->result();
    $updated_datetime = $result_time[0]->waktu;

    $params = [
      'date' => $this->input->post('date'),
      'category_id' => $this->input->post('category_id'),
      'information' => $this->input->post('information'),
      'credit' => $this->input->post('credit'),
      'debit' => $this->input->post('debit'),
      'saldo' => $this->input->post('saldo'),
      'updated_datetime' => $updated_datetime
    ];

    $result = $this->Engine_model->update_transaction($transaction_id, $params);

    if ($result)
    {
      $response = [
        'success' => true,
        'msg' => 'Successfully edited!'
      ];

      echo json_encode($response);
    }
    else
    {
      $response = [
        'success' => false,
        'msg' => 'Editing transaction is failed!'
      ];

      echo json_encode($response);
    }
  }

  // -------------------------------------------------------------------------------------------------------------- REMOVER

  // Category remover
  public function remove_category()
  {
    $category_id = $this->input->post('category_id');

    $query_time = "SELECT NOW() AS waktu";
    $result_time = $this->db->query($query_time)->result();
    $deleted_datetime = $result_time[0]->waktu;

    $result = $this->Engine_model->remove_category($category_id, $deleted_datetime);

    if ($result)
    {
      $response = [
        'success' => true,
        'msg' => 'Successfully deleted!'
      ];

      echo json_encode($response);
    }
    else
    {
      $response = [
        'success' => false,
        'msg' => 'Deleting category is failed!'
      ];

      echo json_encode($response);
    }
  }

  // Transaction remover
  public function remove_transaction()
  {
    $transaction_id = $this->input->post('transaction_id');

    $query_time = "SELECT NOW() AS waktu";
    $result_time = $this->db->query($query_time)->result();
    $deleted_datetime = $result_time[0]->waktu;

    $result = $this->Engine_model->remove_transaction($transaction_id, $deleted_datetime);

    if ($result)
    {
      $response = [
        'success' => true,
        'msg' => 'Successfully deleted!'
      ];

      echo json_encode($response);
    }
    else
    {
      $response = [
        'success' => false,
        'msg' => 'Deleting transaction is failed!'
      ];

      echo json_encode($response);
    }
  }

  // -------------------------------------------------------------------------------------------------------------- GENERATOR

  // Reports generator
  public function generate_report()
  {
    $start_date = $this->input->post('_start_date_post');
    $end_date = $this->input->post('_end_date_post');

    $this->Engine_model->generate_report($start_date, $end_date);
  }
}
