<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Home
 *
 * This controller for ...
 *
 * @package   CodeIgniter
 * @category  Controller CI
 * @author    Setiawan Jodi <jodisetiawan@fisip-untirta.ac.id>
 * @author    Raul Guerrero <r.g.c@me.com>
 * @link      https://github.com/setdjod/myci-extension/
 * @param     ...
 * @return    ...
 *
 */

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    // $this->load->helper('main');
    $this->load->library('form_validation');
    $this->load->library('naves_bayes');
    $this->load->model('Data_latih_model');
    $this->load->model('Data_prediksi_model');
    $this->load->model('Data_uji_model');
  }

  public function index()
  {
    $titlePage = 'Home';
    // $titlePage = pageTitle($activePage);
    $data_prediksi = $this->Data_prediksi_model->get_all();
    $data_uji = $this->Data_uji_model->get_all();
    $data_latih = $this->Data_latih_model->get_all();

    $totalDataPrediksi = $this->Data_prediksi_model->total_rows(null);
    $totalDataUji = $this->Data_uji_model->total_rows(null);
    $totalDataLatih = $this->Data_latih_model->total_rows(null);


    $data_status = $this->naves_bayes->getDataStatus();;

    $dataAccuracy = 0;
    $correct = 0;
    $inCorrect = 0;

    foreach ($data_uji as $key => $value) {
      if ($value->result == $value->status) {
        $correct = $correct + 1;
      } else {
        $inCorrect = $inCorrect + 1;
      }
    }

    if (!empty($correct)) {
      $dataAccuracy = ($correct / $totalDataUji) * 100;
    }

    $percentageOnTime = 0;
    $onTime = 0;
    $late = 0;

    foreach ($data_prediksi as $key => $value) {
      if ($value->result == $data_status[0]['status']) {
        $onTime = $onTime + 1;
      } else if ($value->result == $data_status[1]['status']) {
        $late = $late + 1;
      }
    }

    if (!empty($correct)) {
      $percentageOnTime = ($onTime / $totalDataPrediksi) * 100;
    }

    // var_dump($onTime);
    // var_dump($late);


    $data = array(
      'titlePage' => $titlePage,
      'dataAccuracy' => $dataAccuracy,
      'percentageOnTime' => round($percentageOnTime, 0),
      'totalDataUji' => $totalDataUji,
      'totalDataLatih' => $totalDataLatih
    );

    $this->layout->views('pages/home/index', $data);
  }
}


/* End of file Home.php */
/* Location: ./application/controllers/Home.php */