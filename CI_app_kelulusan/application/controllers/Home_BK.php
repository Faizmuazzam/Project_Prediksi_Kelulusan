<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{
    function __construct()
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
