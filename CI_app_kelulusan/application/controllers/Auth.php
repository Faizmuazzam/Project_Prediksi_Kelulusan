<?php
defined('BASEPATH') or exit('No direct script access allowed');


/**
 *
 * Controller Auth
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

class Auth extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('Auth_model');
    $this->load->library('form_validation');
  }

  public function index()
  {
    $titlePage = 'Login';

    $data = array(
      // 'action' => site_url('auth/index'),
      'titlePage' => $titlePage,
    );

    $this->layout_login->views('auth/index', $data);
  }

  public function login()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $data = array(
        'username' => set_value('username'),
        'password' => set_value('password'),
        // 'testNama' => 'Gagal Validasi',
      );
      $this->layout_login->views('auth/index', $data);
    } else {

      $username = $this->input->post('username', TRUE);
      $password = $this->input->post('password', TRUE);

      $userLogin = $this->Auth_model->login($username);

      if (password_verify($password, $userLogin->password)) {
        $this->session->set_userdata('isLogin', 'active');
        $this->session->set_userdata('nama_user', $userLogin->nama);
        $this->session->set_userdata('id_user', $userLogin->id);
        var_dump($userLogin);
        redirect(base_url('/'));
      } else {
        $this->session->set_flashdata('message_error', 'Username atau Password Salah !');
        redirect(base_url('auth'));
      }
    }
  }
  public function register()
  {
    $data = array(
      'button' => 'Create',
      'action' => site_url('users/create_action'),
      'id' => set_value('id'),
      'username' => set_value('username'),
      'password' => set_value('password'),
      'email' => set_value('email'),
      'nama' => set_value('nama'),
      'jenis_kelamin' => set_value('jenis_kelamin'),
      'no_telp' => set_value('no_telp'),
      'alamat' => set_value('alamat'),
      'image' => set_value('image'),
      'status' => set_value('status'),
    );


    $this->layout_login->views('auth/register', $data);
  }

  public function logout()
  {
    $this->session->unset_userdata('isLogin');
    $this->session->unset_userdata('nama_user');
    $this->session->unset_userdata('id_user');

    redirect(base_url('auth'));
  }

  public function _rules()
  {
    $this->form_validation->set_rules('username', 'username', 'trim|required');
    $this->form_validation->set_rules('password', 'password', 'trim|required');
    $this->form_validation->set_error_delimiters('<span>', '</span>');
  }
}
