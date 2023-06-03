<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Users extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Users_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'users/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'users/index.html';
            $config['first_url'] = base_url() . 'users/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Users_model->total_rows($q);
        $users = $this->Users_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $titlePage = 'Data Users';
        $data = array(
            'titlePage' => $titlePage,
            'users_data' => $users,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
        );
        $this->layout->views('users/users_list', $data);
    }

    public function read($id)
    {
        $row = $this->Users_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'username' => $row->username,
                'password' => $row->password,
                'email' => $row->email,
                'nama' => $row->nama,
                'jenis_kelamin' => $row->jenis_kelamin,
                'no_telp' => $row->no_telp,
                'alamat' => $row->alamat,
                'image' => $row->image,
                'status' => $row->status,
            );
            $this->layout->views('users/users_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function create()
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
        $this->layout->views('users/users_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'username' => $this->input->post('username', TRUE),
                'password' => $this->input->post('password', TRUE),
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

    public function update($id)
    {
        $row = $this->Users_model->get_by_id($id);

        $titlePage = 'Update Data Users';

        if ($row) {
            $data = array(
                'titlePage' => $titlePage,
                'button' => 'Update',
                'action' => site_url('users/update_action'),
                'id' => set_value('id', $row->id),
                'username' => set_value('username', $row->username),
                'password' => set_value('password', $row->password),
                'email' => set_value('email', $row->email),
                'nama' => set_value('nama', $row->nama),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'no_telp' => set_value('no_telp', $row->no_telp),
                'alamat' => set_value('alamat', $row->alamat),
                'image' => set_value('image', $row->image),
                'status' => set_value('status', $row->status),
            );
            $this->layout->views('users/users_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            if (!empty($this->input->post('ganti_passowrd', TRUE))) {
                $data = array(
                    'username' => $this->input->post('username', TRUE),
                    'password' => password_hash($this->input->post('ganti_passowrd'), PASSWORD_DEFAULT),
                    // 'password' => $this->input->post('ganti_passowrd', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'nama' => $this->input->post('nama', TRUE),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                    'no_telp' => $this->input->post('no_telp', TRUE),
                    'alamat' => $this->input->post('alamat', TRUE),
                    'image' => $this->input->post('image', TRUE),
                    'status' => $this->input->post('status', TRUE),
                );
            } else {
                $data = array(
                    'username' => $this->input->post('username', TRUE),
                    // 'password' => $this->input->post('ganti_passowrd', TRUE),
                    'email' => $this->input->post('email', TRUE),
                    'nama' => $this->input->post('nama', TRUE),
                    'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                    'no_telp' => $this->input->post('no_telp', TRUE),
                    'alamat' => $this->input->post('alamat', TRUE),
                    'image' => $this->input->post('image', TRUE),
                    'status' => $this->input->post('status', TRUE),
                );
            }

            $this->Users_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(base_url('/'));
        }
    }

    public function delete($id)
    {
        $row = $this->Users_model->get_by_id($id);

        if ($row) {
            $this->Users_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('users'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('users'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        // $this->form_validation->set_rules('password', 'password', 'trim|required');
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

/* End of file Users.php */
/* Location: ./application/controllers/Users.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-05-08 23:51:07 */
/* http://harviacode.com */