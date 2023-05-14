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
    $this->CI->load->model('Data_uji_model');
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
      $data[$key]['resultOnTime'] = round($dataOnTime /  $data_status[0]['count'], 3);
      $data[$key]['resultLate'] = round($dataLate /  $data_status[1]['count'], 3);
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
      $data[$key]['resultOnTime'] = round($dataOnTime /  $data_status[0]['count'], 3);
      $data[$key]['resultLate'] = round($dataLate /  $data_status[1]['count'], 3);
    }

    return $data;
  }

  public function Clasification($jenkel = NULL, $usia = NULL, $alamat = NULL, $ips_1 = NULL, $ips_2 = NULL, $ips_3 = NULL, $ips_4 = NULL)
  {

    $data_status = $this->getDataStatus();

    $data_jenkel = $this->getPropabilitas('jenis_kelamin');

    foreach ($data_jenkel as $key => $value) {
      if ($value['name'] == $jenkel) {
        $jenkelOnTime = $value['resultOnTime'];
        $jenkelLate = $value['resultLate'];
      }
    }

    $data_usia = $this->getPropabilitas('usia');

    foreach ($data_usia as $key => $value) {
      if ($value['name'] == $usia) {
        $usiaOnTime = $value['resultOnTime'];
        $usiaLate = $value['resultLate'];
      }
    }

    $data_alamat = $this->getPropabilitas('alamat');

    foreach ($data_alamat as $key => $value) {
      if ($value['name'] == $alamat) {
        $alamatOnTime = $value['resultOnTime'];
        $alamatLate = $value['resultLate'];
      }
    }


    $data_ips_1 = $this->getPropabilitas('ips_1');

    foreach ($data_ips_1 as $key => $value) {
      if ($value['name'] == $ips_1) {
        $ips_1OnTime = $value['resultOnTime'];
        $ips_1Late = $value['resultLate'];
      }
    }

    $data_ips_2 = $this->getPropabilitas('ips_2');

    foreach ($data_ips_2 as $key => $value) {
      if ($value['name'] == $ips_2) {
        $ips_2OnTime = $value['resultOnTime'];
        $ips_2Late = $value['resultLate'];
      }
    }

    $data_ips_3 = $this->getPropabilitas('ips_3');

    foreach ($data_ips_3 as $key => $value) {
      if ($value['name'] == $ips_3) {
        $ips_3OnTime = $value['resultOnTime'];
        $ips_3Late = $value['resultLate'];
      }
    }

    $data_ips_4 = $this->getPropabilitas('ips_4');

    foreach ($data_ips_4 as $key => $value) {
      if ($value['name'] == $ips_4) {
        $ips_4OnTime = $value['resultOnTime'];
        $ips_4Late = $value['resultLate'];
      }
    }

    $onTime = $data_status[0]['result'];
    $late = $data_status[1]['result'];

    $countOnTime = $jenkelOnTime * $usiaOnTime * $alamatOnTime * $ips_1OnTime * $ips_2OnTime * $ips_3OnTime * $ips_4OnTime;
    $classOntime = $onTime * $countOnTime;

    $countLate = $jenkelLate * $usiaLate * $alamatLate * $ips_1Late * $ips_2Late * $ips_3Late * $ips_4Late;
    $classLate = $late * $countLate;

    $result = ($classOntime > $classLate) ? 'TEPAT' : 'TERLAMBAT';

    return $result;
  }

  public function Percentage_data($data, $allData)
  {
    # code...
  }

  // ------------------------------------------------------------------------
}



/* End of file NavesBayes.php */
/* Location: ./application/libraries/NavesBayes.php */