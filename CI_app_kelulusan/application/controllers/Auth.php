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
    $this->load->model('Users_model');
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
    $this->_rules_login();

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

      $userLogin = $this->Auth_model->login($username, $password);

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
    $titlePage = 'Register';

    $data = array(
      'button' => 'Create',
      'action' => base_url('auth/register_action'),
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
      'titlePage' => $titlePage
    );


    $this->layout_login->views('auth/register', $data);
  }

  public function register_action()
  {
    $this->_rules();

    if ($this->form_validation->run() == FALSE) {
      $this->register();
    } else {
      $data = array(
        'username' => $this->input->post('username', TRUE),
        // 'password' => $this->input->post('password', TRUE),
        'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
        'email' => $this->input->post('email', TRUE),
        'nama' => $this->input->post('nama', TRUE),
        'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
        'no_telp' => $this->input->post('no_telp', TRUE),
        'alamat' => $this->input->post('alamat', TRUE),
        'image' => $this->input->post('image', TRUE),
        'status' => $this->input->post('status', TRUE),
      );

      $this->Users_model->insert($data);
      $this->session->set_flashdata('message', 'Create Record Success');
      redirect(site_url('users'));
    }
  }

  public function logout()
  {
    $this->session->unset_userdata('isLogin');
    $this->session->unset_userdata('nama_user');
    $this->session->unset_userdata('id_user');

    redirect(base_url('auth'));
  }

  public function _rules_login()
  {
    $this->form_validation->set_rules('username', 'username', 'trim|required');
    $this->form_validation->set_rules('password', 'password', 'trim|required');
    $this->form_validation->set_error_delimiters('<span>', '</span>');
  }

  public function _rules()
  {
    $this->form_validation->set_rules('username', 'username', 'trim|required');
    $this->form_validation->set_rules('password', 'password', 'trim|required');
    $this->form_validation->set_rules('email', 'email', 'trim|required');
    $this->form_validation->set_rules('nama', 'nama', 'trim|required');
    $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
    $this->form_validation->set_rules('no_telp', 'no telp', 'trim|required');
    $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
    // $this->form_validation->set_rules('image', 'image', 'trim|required');
    // $this->form_validation->set_rules('status', 'status', 'trim|required');

    $this->form_validation->set_rules('id', 'id', 'trim');
    $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
  }
}
