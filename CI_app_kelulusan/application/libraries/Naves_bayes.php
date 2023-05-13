<?php
defined('BASEPATH') or exit('No direct script access allowed');

/**
 *
 * Libraries NavesBayes
 *
 * This Libraries for ...
 * 
 * @package		CodeIgniter
 * @category	Libraries
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Naves_bayes
{

  // ------------------------------------------------------------------------
  private $CI;
  public function __construct()
  {
    // 
    $this->CI = &get_instance();
    $this->CI->load->model('Data_latih_model');
  }

  // ------------------------------------------------------------------------


  // ------------------------------------------------------------------------

  public function index()
  {
  }

  public function getDataStatus()
  {
    // Probabilitas Status
    $get_status = $this->CI->Data_latih_model->get_data_prob('status');

    $data_status = [];

    foreach ($get_status as $key => $value) {
      $data_status[$key]['status'] = $value->status;
    }

    foreach ($data_status as $key => $value) {
      $total_data_prob = $this->CI->Data_latih_model->total_rows($value['status']);
      $total_data_all = $config['total_rows'] = $this->CI->Data_latih_model->total_rows();
      $data_status[$key]['count'] = $total_data_prob;
      $data_status[$key]['result'] =  round($total_data_prob / $total_data_all, 2);
    }

    return $data_status;
  }

  public function getPropabilitas($field)
  {
    $getData = $this->CI->Data_latih_model->get_data_prob($field);

    $data = [];
    $data_status = $this->getDataStatus();


    foreach ($getData as $key => $value) {
      $data[$key]['name'] = $value->$field;
    }

    foreach ($data as $key => $value) {
      $dataOnTime = $this->CI->Data_latih_model->total_data_prob($field, 'TEPAT', $value['name']);
      $dataLate = $this->CI->Data_latih_model->total_data_prob($field, 'TERLAMBAT', $value['name']);
      $data[$key]['countAll'] = $this->CI->Data_latih_model->total_rows($value['name']);
      $data[$key]['countOnTime'] = $dataOnTime;
      $data[$key]['countLate'] = $dataLate;
      $data[$key]['resultOnTime'] = round($dataOnTime /  $data_status[0]['count'], 2);
      $data[$key]['resultLate'] = round($dataLate /  $data_status[1]['count'], 2);
    }

    return $data;
  }

  public function getPropabilitasIPS($field)
  {
    $getData = $this->CI->Data_latih_model->get_data_prob($field);

    $data = [];
    $data_status = $this->getDataStatus();


    foreach ($getData as $key => $value) {
      $data[$key]['name'] = $value->$field;
    }

    foreach ($data as $key => $value) {
      $dataOnTime = $this->CI->Data_latih_model->total_data_prob_ips($field, 'TEPAT', $value['name']);
      $dataLate = $this->CI->Data_latih_model->total_data_prob_ips($field, 'TERLAMBAT', $value['name']);
      $data[$key]['countAll'] = $this->CI->Data_latih_model->total_rows($value['name']);
      $data[$key]['countOnTime'] = $dataOnTime;
      $data[$key]['countLate'] = $dataLate;
      $data[$key]['resultOnTime'] = round($dataOnTime /  $data_status[0]['count'], 2);
      $data[$key]['resultLate'] = round($dataLate /  $data_status[1]['count'], 2);
    }

    return $data;
  }

  // ------------------------------------------------------------------------
}

/* End of file NavesBayes.php */
/* Location: ./application/libraries/NavesBayes.php */