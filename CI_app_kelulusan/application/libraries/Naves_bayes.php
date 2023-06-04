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
  public $tableStatus = 'tb_prob_status';
  public function __construct()
  {
    // 
    $this->CI = &get_instance();
    $this->CI->load->model('Data_latih_model');
    $this->CI->load->model('Data_probabilitas_model');
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



  public function Clasification($jenkel = NULL, $usia = NULL, $alamat = NULL, $ips_1 = NULL, $ips_2 = NULL, $ips_3 = NULL, $ips_4 = NULL)
  {

    $data_status = $this->getDataStatus();

    // $data_jenkel = $this->getPropabilitas('jenis_kelamin');
    $data_jenkel = $this->CI->Data_probabilitas_model->get_all_tb_prob('tb_prob_jenkel');


    foreach ($data_jenkel as $key => $value) {
      if ($value['name'] == $jenkel) {
        $jenkelOnTime = $value['resultOnTime'];
        $jenkelLate = $value['resultLate'];
      }
    }

    $data_usia = $this->CI->Data_probabilitas_model->get_all_tb_prob('tb_prob_usia');

    foreach ($data_usia as $key => $value) {
      if ($value['name'] == $usia) {
        $usiaOnTime = $value['resultOnTime'];
        $usiaLate = $value['resultLate'];
      }
    }

    $data_alamat = $this->CI->Data_probabilitas_model->get_all_tb_prob('tb_prob_alamat');

    foreach ($data_alamat as $key => $value) {
      if ($value['name'] == $alamat) {
        $alamatOnTime = $value['resultOnTime'];
        $alamatLate = $value['resultLate'];
      }
    }


    $data_ips_1 = $this->CI->Data_probabilitas_model->get_all_tb_prob('tb_prob_ips1');

    foreach ($data_ips_1 as $key => $value) {
      if ($value['name'] == $ips_1) {
        $ips_1OnTime = $value['resultOnTime'];
        $ips_1Late = $value['resultLate'];
      }
    }

    $data_ips_2 = $this->CI->Data_probabilitas_model->get_all_tb_prob('tb_prob_ips2');

    foreach ($data_ips_2 as $key => $value) {
      if ($value['name'] == $ips_2) {
        $ips_2OnTime = $value['resultOnTime'];
        $ips_2Late = $value['resultLate'];
      }
    }

    $data_ips_3 = $this->CI->Data_probabilitas_model->get_all_tb_prob('tb_prob_ips3');

    foreach ($data_ips_3 as $key => $value) {
      if ($value['name'] == $ips_3) {
        $ips_3OnTime = $value['resultOnTime'];
        $ips_3Late = $value['resultLate'];
      }
    }

    $data_ips_4 = $this->CI->Data_probabilitas_model->get_all_tb_prob('tb_prob_ips4');

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

  public function Clasification2($jenkel = NULL, $usia = NULL, $alamat = NULL, $ips_1 = NULL, $ips_2 = NULL, $ips_3 = NULL, $ips_4 = NULL)
  {

    $data_status = $this->getDataStatus();

    // $data_jenkel = $this->getPropabilitas('jenis_kelamin');
    $data_jenkel = $this->CI->Data_probabilitas_model->get_all_tb_prob('tb_prob_jenkel');


    foreach ($data_jenkel as $key => $value) {
      if ($value['name'] == $jenkel) {
        $jenkelOnTime = $value['resultOnTime'];
        $jenkelLate = $value['resultLate'];
      }
    }

    $mean_usia = $this->mean_data('ips_1');
    $std_usia = $this->standard_deviasi($mean_usia);
    $prob_usia = $this->prob_num($ips_1, $mean_usia, $std_usia);

    $data_alamat = $this->CI->Data_probabilitas_model->get_all_tb_prob('tb_prob_alamat');

    foreach ($data_alamat as $key => $value) {
      if ($value['name'] == $alamat) {
        $alamatOnTime = $value['resultOnTime'];
        $alamatLate = $value['resultLate'];
      }
    }



    $mean_ips1 = $this->mean_data('ips_1');
    $std_ips1 = $this->standard_deviasi($mean_ips1);
    $prob_ips1 = $this->prob_num($ips_1, $mean_ips1, $std_ips1);

    $mean_ips2 = $this->mean_data('ips_2');
    $std_ips2 = $this->standard_deviasi($mean_ips2);
    $prob_ips2 = $this->prob_num($ips_2, $mean_ips2, $std_ips2);

    $mean_ips3 = $this->mean_data('ips_3');
    $std_ips3 = $this->standard_deviasi($mean_ips3);
    $prob_ips3 = $this->prob_num($ips_3, $mean_ips3, $std_ips3);

    $mean_ips4 = $this->mean_data('ips_4');
    $std_ips4 = $this->standard_deviasi($mean_ips4);
    $prob_ips4 = $this->prob_num($ips_4, $mean_ips4, $std_ips4);


    $onTime = $data_status[0]['result'];
    $late = $data_status[1]['result'];

    $countOnTime = $jenkelOnTime * $prob_usia['onTime'] * $alamatOnTime * $prob_ips1['onTime'] * $prob_ips2['onTime'] * $prob_ips3['onTime'] * $prob_ips4['onTime'];
    $classOntime = $onTime * $countOnTime;

    $countLate = $jenkelLate * $prob_usia['late'] * $alamatLate * $prob_ips1['late'] * $prob_ips2['late'] * $prob_ips3['late'] * $prob_ips4['late'];
    $classLate = $late * $countLate;

    $result = ($classOntime > $classLate) ? 'TEPAT' : 'TERLAMBAT';

    // var_dump($result);
    return $result;
  }

  function mean_data($field)
  {
    $getData = $this->CI->Data_latih_model->get_all();
    $data_status = $this->getDataStatus();

    $v_data_onTime = 0;

    $n_data_onTime = $data_status[1]['count'];

    $v_data_late = 0;

    $n_data_late = $data_status[0]['count'];

    foreach ($getData as $key => $value) {
      if ($value->status == 'TEPAT') {
        $v_data_onTime = $v_data_onTime + $value->$field;
      } else {
        $v_data_late = $v_data_late + $value->$field;
      }
    }

    $mean_onTime = $v_data_onTime / $n_data_onTime;
    $mean_late = $v_data_late / $n_data_late;



    $mean_data['onTime'] = round($mean_onTime, 2);
    $mean_data['late'] = round($mean_late, 2);

    return $mean_data;
  }

  function standard_deviasi($mean_data)
  {
    $data_status = $this->getDataStatus();
    $getData = $this->CI->Data_latih_model->get_all();

    $std_x_onTime = 0;
    $std_y_onTime = $data_status[1]['count'] - 1;

    $std_x_late = 0;
    $std_y_late = $data_status[0]['count'] - 1;

    foreach ($getData as $key => $value) {
      if ($value->status == 'TEPAT') {
        $std_x_onTime = $std_x_onTime + pow(($value->ips_1 -  $mean_data['onTime']), 2);
      } else {
        $std_x_late = $std_x_onTime + pow(($value->ips_1 -  $mean_data['onTime']), 2);
      }
    }

    $std_onTime = sqrt($std_x_onTime / $std_y_onTime);
    $std_late = sqrt($std_x_late / $std_y_late);

    $std_data['onTime'] = round($std_onTime, 2);
    $std_data['late'] = round($std_late, 2);

    return $std_data;
  }

  function prob_num($val, $mean_data, $std_data)
  {

    $p_x_onTime = - (pow(($val - $mean_data['onTime']), 2)) / (pow((2 * $std_data['onTime']), 2));

    $p_exp_ontime = pow(2.718, $p_x_onTime);

    $p_y_ontime = 1 / ((sqrt(2 * pi())) * $std_data['onTime']);

    $prob_onTime = $p_y_ontime * $p_exp_ontime;

    $p_x_late = - (pow(($val - $mean_data['late']), 2)) / (pow((2 * $std_data['late']), 2));

    $p_exp_late = pow(2.718, $p_x_late);

    $p_y_late = 1 / ((sqrt(2 * pi())) * $std_data['late']);

    $prob_late = $p_y_late * $p_exp_late;

    $data_prob['onTime'] = $prob_onTime;
    $data_prob['late'] = $prob_late;

    return $data_prob;
  }

  public function Percentage_data($data, $allData)
  {
    # code...
  }

  public function new_data_prob_usia($data)
  {
    $newPropUsia = [];
    $cat1_Ontime = 0;
    $cat1_late = 0;
    $cat1_prob_onTime = 0;
    $cat1_prob_late = 0;

    $cat2_Ontime = 0;
    $cat2_late = 0;
    $cat2_prob_onTime = 0;
    $cat2_prob_late = 0;

    $cat3_Ontime = 0;
    $cat3_late = 0;
    $cat3_prob_onTime = 0;
    $cat3_prob_late = 0;

    // $cat4_Ontime = 0;
    // $cat4_late = 0;
    // $cat4_prob_onTime = 0;
    // $cat4_prob_late = 0;


    foreach ($data as $key => $value) {
      if (intval($value['name']) < 20) {
        $cat1_Ontime = $cat1_Ontime + intval($value['countOnTime']);
        $cat1_late = $cat1_late + intval($value['countLate']);
        $cat1_prob_onTime = $cat1_prob_onTime + doubleval($value['resultOnTime']);
        $cat1_prob_late = $cat1_prob_late + doubleval($value['resultLate']);
      }

      if (intval($value['name']) >= 20 && intval($value['name']) < 23) {
        $cat2_Ontime = $cat2_Ontime + intval($value['countOnTime']);
        $cat2_late = $cat2_late + intval($value['countLate']);
        $cat2_prob_onTime = $cat2_prob_onTime + doubleval($value['resultOnTime']);
        $cat2_prob_late = $cat2_prob_late + doubleval($value['resultLate']);
      }

      if (intval($value['name']) >= 23) {
        $cat3_Ontime = $cat3_Ontime + intval($value['countOnTime']);
        $cat3_late = $cat3_late + intval($value['countLate']);
        $cat3_prob_onTime = $cat3_prob_onTime + doubleval($value['resultOnTime']);
        $cat3_prob_late = $cat3_prob_late + doubleval($value['resultLate']);
      }

      // if (intval($value['name']) >= 31 && intval($value['name']) < 36) {
      //   $cat3_Ontime = $cat3_Ontime + intval($value['countOnTime']);
      //   $cat3_late = $cat3_late + intval($value['countLate']);
      //   $cat3_prob_onTime = $cat3_prob_onTime + doubleval($value['resultOnTime']);
      //   $cat3_prob_late = $cat3_prob_late + doubleval($value['resultLate']);
      // }

      // if (intval($value['name']) >= 36) {
      //   $cat4_Ontime = $cat4_Ontime + intval($value['countOnTime']);
      //   $cat4_late = $cat4_late + intval($value['countLate']);
      //   $cat4_prob_onTime = $cat4_prob_onTime + doubleval($value['resultOnTime']);
      //   $cat4_prob_late = $cat4_prob_late + doubleval($value['resultLate']);
      // }
    }

    $newPropUsia[0]['name'] = '< 20 Tahun';
    $newPropUsia[0]['countOnTime'] = $cat1_Ontime;
    $newPropUsia[0]['countLate'] = $cat1_late;
    $newPropUsia[0]['resultOnTime'] = $cat1_prob_onTime;
    $newPropUsia[0]['resultLate'] = $cat1_prob_late;

    $newPropUsia[1]['name'] = '20 - 23 Tahun';
    $newPropUsia[1]['countOnTime'] = $cat2_Ontime;
    $newPropUsia[1]['countLate'] = $cat2_late;
    $newPropUsia[1]['resultOnTime'] = $cat2_prob_onTime;
    $newPropUsia[1]['resultLate'] = $cat2_prob_late;

    $newPropUsia[2]['name'] = '> 23 Tahun';
    $newPropUsia[2]['countOnTime'] = $cat3_Ontime;
    $newPropUsia[2]['countLate'] = $cat3_late;
    $newPropUsia[2]['resultOnTime'] = $cat3_prob_onTime;
    $newPropUsia[2]['resultLate'] = $cat3_prob_late;

    // $newPropUsia[3]['name'] = '> 36 Tahun';
    // $newPropUsia[3]['countOnTime'] = $cat4_Ontime;
    // $newPropUsia[3]['countLate'] = $cat4_late;
    // $newPropUsia[3]['resultOnTime'] = $cat4_prob_onTime;
    // $newPropUsia[3]['resultLate'] = $cat4_prob_late;

    return $newPropUsia;
  }

  public function new_data_prob_ips($data)
  {
    $newData = [];
    $cat1_Ontime = 0;
    $cat1_late = 0;
    $cat1_prob_onTime = 0;
    $cat1_prob_late = 0;

    $cat2_Ontime = 0;
    $cat2_late = 0;
    $cat2_prob_onTime = 0;
    $cat2_prob_late = 0;

    $cat3_Ontime = 0;
    $cat3_late = 0;
    $cat3_prob_onTime = 0;
    $cat3_prob_late = 0;

    $cat4_Ontime = 0;
    $cat4_late = 0;
    $cat4_prob_onTime = 0;
    $cat4_prob_late = 0;

    $cat5_Ontime = 0;
    $cat5_late = 0;
    $cat5_prob_onTime = 0;
    $cat5_prob_late = 0;


    foreach ($data as $key => $value) {
      if (doubleval($value['name']) < doubleval(2.0)) {
        $cat1_Ontime = $cat1_Ontime + intval($value['countOnTime']);
        $cat1_late = $cat1_late + intval($value['countLate']);
        $cat1_prob_onTime = $cat1_prob_onTime + doubleval($value['resultOnTime']);
        $cat1_prob_late = $cat1_prob_late + doubleval($value['resultLate']);
      }

      if (doubleval($value['name']) >= doubleval(2.0) && intval($value['name']) < doubleval(2.5)) {
        $cat2_Ontime = $cat2_Ontime + intval($value['countOnTime']);
        $cat2_late = $cat2_late + intval($value['countLate']);
        $cat2_prob_onTime = $cat2_prob_onTime + doubleval($value['resultOnTime']);
        $cat2_prob_late = $cat2_prob_late + doubleval($value['resultLate']);
      }

      if (doubleval($value['name']) >= doubleval(2.5) && intval($value['name']) < doubleval(3.0)) {
        $cat3_Ontime = $cat3_Ontime + intval($value['countOnTime']);
        $cat3_late = $cat3_late + intval($value['countLate']);
        $cat3_prob_onTime = $cat3_prob_onTime + doubleval($value['resultOnTime']);
        $cat3_prob_late = $cat3_prob_late + doubleval($value['resultLate']);
      }

      if (doubleval($value['name']) >= doubleval(3.0) && intval($value['name']) < doubleval(3.5)) {
        $cat4_Ontime = $cat4_Ontime + intval($value['countOnTime']);
        $cat4_late = $cat4_late + intval($value['countLate']);
        $cat4_prob_onTime = $cat4_prob_onTime + doubleval($value['resultOnTime']);
        $cat4_prob_late = $cat4_prob_late + doubleval($value['resultLate']);
      }

      if (doubleval($value['name']) >= doubleval(3.5)) {
        $cat5_Ontime = $cat5_Ontime + intval($value['countOnTime']);
        $cat5_late = $cat5_late + intval($value['countLate']);
        $cat5_prob_onTime = $cat5_prob_onTime + doubleval($value['resultOnTime']);
        $cat5_prob_late = $cat5_prob_late + doubleval($value['resultLate']);
      }
    }

    $newData[0]['name'] = '0 - 2';
    $newData[0]['countOnTime'] = $cat1_Ontime;
    $newData[0]['countLate'] = $cat1_late;
    $newData[0]['resultOnTime'] = $cat1_prob_onTime;
    $newData[0]['resultLate'] = $cat1_prob_late;

    $newData[1]['name'] = '2 - 2.5';
    $newData[1]['countOnTime'] = $cat2_Ontime;
    $newData[1]['countLate'] = $cat2_late;
    $newData[1]['resultOnTime'] = $cat2_prob_onTime;
    $newData[1]['resultLate'] = $cat2_prob_late;

    $newData[2]['name'] = '2.5 - 3';
    $newData[2]['countOnTime'] = $cat3_Ontime;
    $newData[2]['countLate'] = $cat3_late;
    $newData[2]['resultOnTime'] = $cat3_prob_onTime;
    $newData[2]['resultLate'] = $cat3_prob_late;

    $newData[3]['name'] = '3 - 3.5';
    $newData[3]['countOnTime'] = $cat4_Ontime;
    $newData[3]['countLate'] = $cat4_late;
    $newData[3]['resultOnTime'] = $cat4_prob_onTime;
    $newData[3]['resultLate'] = $cat4_prob_late;

    $newData[4]['name'] = '3.5 - 4';
    $newData[4]['countOnTime'] = $cat4_Ontime;
    $newData[4]['countLate'] = $cat4_late;
    $newData[4]['resultOnTime'] = $cat4_prob_onTime;
    $newData[4]['resultLate'] = $cat4_prob_late;

    return $newData;
  }

  // ------------------------------------------------------------------------
}



/* End of file NavesBayes.php */
/* Location: ./application/libraries/NavesBayes.php */