<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_uji extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_uji_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_uji/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_uji/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_uji/index.html';
            $config['first_url'] = base_url() . 'data_uji/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_uji_model->total_rows($q);
        $data_uji = $this->Data_uji_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $titlePage = 'Data Uji';


        $data = array(
            'data_uji_data' => $data_uji,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'titlePage' => $titlePage

        );
        $this->layout->views('data_uji/tb_data_uji_list', $data);
    }

    public function read($id)
    {
        $row = $this->Data_uji_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nim' => $row->nim,
                'jenis_kelamin' => $row->jenis_kelamin,
                'ipk1' => $row->ipk1,
                'ipk2' => $row->ipk2,
                'ipk3' => $row->ipk3,
                'ipk4' => $row->ipk4,
                'ipk_akhir' => $row->ipk_akhir,
                'keterangan' => $row->keterangan,
            );
            $this->layout->views('data_uji/tb_data_uji_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_uji'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_uji/create_action'),
            'id' => set_value('id'),
            'nim' => set_value('nim'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'ipk1' => set_value('ipk1'),
            'ipk2' => set_value('ipk2'),
            'ipk3' => set_value('ipk3'),
            'ipk4' => set_value('ipk4'),
            'ipk_akhir' => set_value('ipk_akhir'),
            'keterangan' => set_value('keterangan'),
        );
        $this->layout->views('data_uji/tb_data_uji_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nim' => $this->input->post('nim', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'ipk1' => $this->input->post('ipk1', TRUE),
                'ipk2' => $this->input->post('ipk2', TRUE),
                'ipk3' => $this->input->post('ipk3', TRUE),
                'ipk4' => $this->input->post('ipk4', TRUE),
                'ipk_akhir' => $this->input->post('ipk_akhir', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
            );

            $this->Data_uji_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_uji'));
        }
    }

    public function import()
    {

        $titlePage = 'Import Data';

        $data = array(
            'titlePage' => $titlePage,
            'file_excel' => set_value(null),
            'keterangan' => set_value('keterangan'),
        );
        $this->layout->views('data_uji/import', $data);
    }

    public function import_action()
    {
        if (isset($_FILES["file_excel"]["name"])) {
            // upload
            $file_tmp = $_FILES['file_excel']['tmp_name'];
            $file_name = $_FILES['file_excel']['name'];
            $file_size = $_FILES['file_excel']['size'];
            $file_type = $_FILES['file_excel']['type'];
            // move_uploaded_file($file_tmp,"uploads/".$file_name); // simpan filenya di folder uploads

            $object = PHPExcel_IOFactory::load($file_tmp);

            foreach ($object->getWorksheetIterator() as $worksheet) {

                $highestRow = $worksheet->getHighestRow();
                $highestColumn = $worksheet->getHighestColumn();

                for ($row = 2; $row <= $highestRow; $row++) {

                    $nim = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $jenis_kelamin = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $ipk1 = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $ipk2 = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $ipk3 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $ipk4 = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $ipk_akhir = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $keterangan = $worksheet->getCellByColumnAndRow(8, $row)->getValue();



                    $data[] = array(
                        'nim' => strval($nim),
                        'jenis_kelamin' => strval($jenis_kelamin),
                        'ipk1' => strval($ipk1),
                        'ipk2' => strval($ipk2),
                        'ipk3' => strval($ipk3),
                        'ipk4' => strval($ipk4),
                        'ipk_akhir' => strval($ipk_akhir),
                        'keterangan' => strval($keterangan),
                    );

                    // var_dump($data);
                }
            }

            $this->Data_uji_model->insert_excell($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_uji'));
        } else {
            $this->session->set_flashdata('message_error', 'Create Record Failed');
            redirect('data_uji/import');
        }
    }

    public function update($id)
    {
        $row = $this->Data_uji_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_uji/update_action'),
                'id' => set_value('id', $row->id),
                'nim' => set_value('nim', $row->nim),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'ipk1' => set_value('ipk1', $row->ipk1),
                'ipk2' => set_value('ipk2', $row->ipk2),
                'ipk3' => set_value('ipk3', $row->ipk3),
                'ipk4' => set_value('ipk4', $row->ipk4),
                'ipk_akhir' => set_value('ipk_akhir', $row->ipk_akhir),
                'keterangan' => set_value('keterangan', $row->keterangan),
            );
            $this->layout->views('data_uji/tb_data_uji_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_uji'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nim' => $this->input->post('nim', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'ipk1' => $this->input->post('ipk1', TRUE),
                'ipk2' => $this->input->post('ipk2', TRUE),
                'ipk3' => $this->input->post('ipk3', TRUE),
                'ipk4' => $this->input->post('ipk4', TRUE),
                'ipk_akhir' => $this->input->post('ipk_akhir', TRUE),
                'keterangan' => $this->input->post('keterangan', TRUE),
            );

            $this->Data_uji_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_uji'));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_uji_model->get_by_id($id);

        if ($row) {
            $this->Data_uji_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_uji'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_uji'));
        }
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nim', 'nim', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('ipk1', 'ipk1', 'trim|required');
        $this->form_validation->set_rules('ipk2', 'ipk2', 'trim|required');
        $this->form_validation->set_rules('ipk3', 'ipk3', 'trim|required');
        $this->form_validation->set_rules('ipk4', 'ipk4', 'trim|required');
        $this->form_validation->set_rules('ipk_akhir', 'ipk akhir', 'trim|required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_data_uji.xls";
        $judul = "tb_data_uji";
        $tablehead = 0;
        $tablebody = 1;
        $nourut = 1;
        //penulisan header
        header("Pragma: public");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0,pre-check=0");
        header("Content-Type: application/force-download");
        header("Content-Type: application/octet-stream");
        header("Content-Type: application/download");
        header("Content-Disposition: attachment;filename=" . $namaFile . "");
        header("Content-Transfer-Encoding: binary ");

        xlsBOF();

        $kolomhead = 0;
        xlsWriteLabel($tablehead, $kolomhead++, "No");
        xlsWriteLabel($tablehead, $kolomhead++, "Nim");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "Ipk1");
        xlsWriteLabel($tablehead, $kolomhead++, "Ipk2");
        xlsWriteLabel($tablehead, $kolomhead++, "Ipk3");
        xlsWriteLabel($tablehead, $kolomhead++, "Ipk4");
        xlsWriteLabel($tablehead, $kolomhead++, "Ipk Akhir");
        xlsWriteLabel($tablehead, $kolomhead++, "Keterangan");

        foreach ($this->Data_uji_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nim);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
            xlsWriteLabel($tablebody, $kolombody++, $data->ipk1);
            xlsWriteLabel($tablebody, $kolombody++, $data->ipk2);
            xlsWriteLabel($tablebody, $kolombody++, $data->ipk3);
            xlsWriteLabel($tablebody, $kolombody++, $data->ipk4);
            xlsWriteLabel($tablebody, $kolombody++, $data->ipk_akhir);
            xlsWriteLabel($tablebody, $kolombody++, $data->keterangan);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Data_uji.php */
/* Location: ./application/controllers/Data_uji.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-05-08 23:53:12 */
/* http://harviacode.com */