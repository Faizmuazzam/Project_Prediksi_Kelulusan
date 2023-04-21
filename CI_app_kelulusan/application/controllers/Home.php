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
     
  }

  public function index()
  {
    $titlePage = 'Home';
    // $titlePage = pageTitle($activePage);


    $data = array(
      'titlePage' => $titlePage
    );

    $this->layout->views('pages/home/index', $data);
  }
}


/* End of file Home.php */
/* Location: ./application/controllers/Home.php */