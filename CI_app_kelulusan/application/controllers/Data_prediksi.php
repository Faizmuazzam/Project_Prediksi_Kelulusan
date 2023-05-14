<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_prediksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_prediksi_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));

        if ($q <> '') {
            $config['base_url'] = base_url() . 'data_prediksi/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'data_prediksi/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'data_prediksi/index.html';
            $config['first_url'] = base_url() . 'data_prediksi/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Data_prediksi_model->total_rows($q);
        $data_prediksi = $this->Data_prediksi_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $titlePage = 'Prediksi';

        $data = array(
            'data_prediksi_data' => $data_prediksi,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'titlePage' => $titlePage,
        );
        $this->layout->views('data_prediksi/tb_data_prediksi_list', $data);
    }

    public function read($id)
    {
        $row = $this->Data_prediksi_model->get_by_id($id);
        if ($row) {
            $data = array(
                'id' => $row->id,
                'nama' => $row->nama,
                'jenis_kelamin' => $row->jenis_kelamin,
                'nim' => $row->nim,
                'usia' => $row->usia,
                'alamat' => $row->alamat,
                'ips_1' => $row->ips_1,
                'ips_2' => $row->ips_2,
                'ips_3' => $row->ips_3,
                'ips_4' => $row->ips_4,
                'result' => $row->result,
            );
            $this->layout->views('data_prediksi/tb_data_prediksi_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_prediksi'));
        }
    }

    public function create()
    {
        $data = array(
            'button' => 'Create',
            'action' => site_url('data_prediksi/create_action'),
            'id' => set_value('id'),
            'nama' => set_value('nama'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'nim' => set_value('nim'),
            'usia' => set_value('usia'),
            'alamat' => set_value('alamat'),
            'ips_1' => set_value('ips_1'),
            'ips_2' => set_value('ips_2'),
            'ips_3' => set_value('ips_3'),
            'ips_4' => set_value('ips_4'),
            'result' => set_value('result'),
        );
        $this->layout->views('data_prediksi/tb_data_prediksi_form', $data);
    }

    public function create_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'nim' => $this->input->post('nim', TRUE),
                'usia' => $this->input->post('usia', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'ips_1' => $this->input->post('ips_1', TRUE),
                'ips_2' => $this->input->post('ips_2', TRUE),
                'ips_3' => $this->input->post('ips_3', TRUE),
                'ips_4' => $this->input->post('ips_4', TRUE),
                'result' => $this->input->post('result', TRUE),
            );

            $this->Data_prediksi_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_prediksi'));
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
        $this->layout->views('data_prediksi/import', $data);
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

                    $nama = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $jenis_kelamin = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nim = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $usia = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $ips_1 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $ips_2 = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $ips_3 = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $ips_4 = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    // $status = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

                    $clasification = $this->naves_bayes->clasification($jenis_kelamin, $usia, $alamat, $ips_1, $ips_2, $ips_3, $ips_4);

                    $data[] = array(
                        'nama' => strval($nama),
                        'jenis_kelamin' => strval($jenis_kelamin),
                        'nim' => strval($nim),
                        'usia' => $usia,
                        'alamat' => strval($alamat),
                        'ips_1' => $ips_1,
                        'ips_2' => $ips_2,
                        'ips_3' => $ips_3,
                        'ips_4' => $ips_4,
                        // 'status' => strval($status),
                        'result' => $clasification
                    );

                    // var_dump($data);
                }
            }

            $this->Data_prediksi_model->insert_excell($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('data_prediksi'));
        } else {
            $this->session->set_flashdata('message_error', 'Create Record Failed');
            redirect('data_prediksi/import');
        }
    }

    public function update($id)
    {
        $row = $this->Data_prediksi_model->get_by_id($id);

        if ($row) {
            $data = array(
                'button' => 'Update',
                'action' => site_url('data_prediksi/update_action'),
                'id' => set_value('id', $row->id),
                'nama' => set_value('nama', $row->nama),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'nim' => set_value('nim', $row->nim),
                'usia' => set_value('usia', $row->usia),
                'alamat' => set_value('alamat', $row->alamat),
                'ips_1' => set_value('ips_1', $row->ips_1),
                'ips_2' => set_value('ips_2', $row->ips_2),
                'ips_3' => set_value('ips_3', $row->ips_3),
                'ips_4' => set_value('ips_4', $row->ips_4),
                'result' => set_value('result', $row->result),
            );
            $this->layout->views('data_prediksi/tb_data_prediksi_form', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_prediksi'));
        }
    }

    public function update_action()
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
                'nama' => $this->input->post('nama', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'nim' => $this->input->post('nim', TRUE),
                'usia' => $this->input->post('usia', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'ips_1' => $this->input->post('ips_1', TRUE),
                'ips_2' => $this->input->post('ips_2', TRUE),
                'ips_3' => $this->input->post('ips_3', TRUE),
                'ips_4' => $this->input->post('ips_4', TRUE),
                'result' => $this->input->post('result', TRUE),
            );

            $this->Data_prediksi_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('data_prediksi'));
        }
    }

    public function delete($id)
    {
        $row = $this->Data_prediksi_model->get_by_id($id);

        if ($row) {
            $this->Data_prediksi_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('data_prediksi'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('data_prediksi'));
        }
    }

    public function empty_data()
    {
        $this->Data_prediksi_model->empty_data();
        $this->session->set_flashdata('message', 'Delete Data Success');
        redirect(site_url('data_prediksi'));
    }

    public function _rules()
    {
        $this->form_validation->set_rules('nama', 'nama', 'trim|required');
        $this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
        $this->form_validation->set_rules('nim', 'nim', 'trim|required');
        $this->form_validation->set_rules('usia', 'usia', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('ips_1', 'ips 1', 'trim|required|numeric');
        $this->form_validation->set_rules('ips_2', 'ips 2', 'trim|required|numeric');
        $this->form_validation->set_rules('ips_3', 'ips 3', 'trim|required|numeric');
        $this->form_validation->set_rules('ips_4', 'ips 4', 'trim|required|numeric');
        $this->form_validation->set_rules('result', 'result', 'trim|required');

        $this->form_validation->set_rules('id', 'id', 'trim');
        $this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

    public function excel()
    {
        $this->load->helper('exportexcel');
        $namaFile = "tb_data_prediksi.xls";
        $judul = "tb_data_prediksi";
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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "Nim");
        xlsWriteLabel($tablehead, $kolomhead++, "Usia");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Ips 1");
        xlsWriteLabel($tablehead, $kolomhead++, "Ips 2");
        xlsWriteLabel($tablehead, $kolomhead++, "Ips 3");
        xlsWriteLabel($tablehead, $kolomhead++, "Ips 4");
        xlsWriteLabel($tablehead, $kolomhead++, "Result");

        foreach ($this->Data_prediksi_model->get_all() as $data) {
            $kolombody = 0;

            //ubah xlsWriteLabel menjadi xlsWriteNumber untuk kolom numeric
            xlsWriteNumber($tablebody, $kolombody++, $nourut);
            xlsWriteLabel($tablebody, $kolombody++, $data->nama);
            xlsWriteLabel($tablebody, $kolombody++, $data->jenis_kelamin);
            xlsWriteLabel($tablebody, $kolombody++, $data->nim);
            xlsWriteNumber($tablebody, $kolombody++, $data->usia);
            xlsWriteLabel($tablebody, $kolombody++, $data->alamat);
            xlsWriteNumber($tablebody, $kolombody++, $data->ips_1);
            xlsWriteNumber($tablebody, $kolombody++, $data->ips_2);
            xlsWriteNumber($tablebody, $kolombody++, $data->ips_3);
            xlsWriteNumber($tablebody, $kolombody++, $data->ips_4);
            xlsWriteLabel($tablebody, $kolombody++, $data->result);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }
}

/* End of file Data_prediksi.php */
/* Location: ./application/controllers/Data_prediksi.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-05-14 01:41:52 */
/* http://harviacode.com */