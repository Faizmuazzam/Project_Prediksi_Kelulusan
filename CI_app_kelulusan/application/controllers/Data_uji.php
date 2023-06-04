<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Data_uji extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Data_uji_model');
        $this->load->model('Data_probabilitas_model');
        $this->load->model('Data_latih_model');
        $this->load->library('form_validation');
    }

    public function index()
    {

        $filterData = doubleval($this->input->post('filterDataUji', TRUE));

        $titlePage = 'Data Uji';

        $totalDataLatih = $this->Data_latih_model->total_rows(null);

        $countFilter = round($filterData * $totalDataLatih, 0);

        $resultFilter = $this->Data_uji_model->get_filters_data($countFilter);

        $dataAccuracy = 0;
        $correct = 0;
        $inCorrect = 0;
        $totalDataUji = 0;

        $dataResult = [];

        foreach ($resultFilter as $key => $data_uji) {
            $jenis_kelamin = $data_uji->jenis_kelamin;
            $usia = $data_uji->usia;
            $alamat = $data_uji->alamat;
            $ips_1 = $data_uji->ips_1;
            $ips_2 = $data_uji->ips_2;
            $ips_3 = $data_uji->ips_3;
            $ips_4 = $data_uji->ips_4;

            $clasification = $this->naves_bayes->clasification2($jenis_kelamin, $usia, $alamat, $ips_1, $ips_2, $ips_3, $ips_4);

            $dataResult[$key] = $clasification;
            // if ($data_uji->result == $data_uji->status) {
            //     $correct = $correct + 1;
            // } else {
            //     $inCorrect = $inCorrect + 1;
            // }
            $totalDataUji = $totalDataUji + 1;
            if ($clasification == strtoupper($data_uji->status)) {
                $correct = $correct + 1;
            } else {
                $inCorrect = $inCorrect + 1;
            }
        }

        if (!empty($correct)) {
            $dataAccuracy = ($correct / $totalDataUji) * 100;
        }


        $totalAllData = $this->Data_latih_model->total_rows(null);

        $data_latih = $this->Data_latih_model->get_all();

        $start = 0;

        $probStatus = $this->Data_probabilitas_model->get_all_tb_prob('tb_prob_status');

        $probJenkel = $this->Data_probabilitas_model->get_all_tb_prob('tb_prob_jenkel');

        $probAlamat = $this->Data_probabilitas_model->get_all_tb_prob('tb_prob_alamat');

        // $probUsia = $this->Data_probabilitas_model->get_all_tb_prob('tb_prob_usia');

        // $newPropUsia = $this->naves_bayes->new_data_prob_usia($probUsia);

        $prob_usia = [];
        $prob_ips1 = [];
        $prob_ips2 = [];
        $prob_ips3 = [];
        $prob_ips4 = [];

        if (!empty($probStatus)) {
            $mean_usia = $this->naves_bayes->mean_data('usia');
            $std_usia = $this->naves_bayes->standard_deviasi($mean_usia);
            $prob_usia = ['mean_data' => $mean_usia, 'standard_deviasi' => $std_usia];

            $mean_ips1 = $this->naves_bayes->mean_data('ips_1');
            $std_ips1 = $this->naves_bayes->standard_deviasi($mean_ips1);
            $prob_ips1 = ['mean_data' => $mean_ips1, 'standard_deviasi' => $std_ips1];

            $mean_ips2 = $this->naves_bayes->mean_data('ips_2');
            $std_ips2 = $this->naves_bayes->standard_deviasi($mean_ips2);
            $prob_ips2 = ['mean_data' => $mean_ips2, 'standard_deviasi' => $std_ips2];

            $mean_ips3 = $this->naves_bayes->mean_data('ips_3');
            $std_ips3 = $this->naves_bayes->standard_deviasi($mean_ips3);
            $prob_ips3 = ['mean_data' => $mean_ips3, 'standard_deviasi' => $std_ips3];

            $mean_ips4 = $this->naves_bayes->mean_data('ips_4');
            $std_ips4 = $this->naves_bayes->standard_deviasi($mean_ips4);
            $prob_ips4 = ['mean_data' => $mean_ips4, 'standard_deviasi' => $std_ips4];
        }



        $data = array(
            'start' => $start,
            'titlePage' => $titlePage,
            'totalAllData' => $totalAllData,
            'resultFilter' => $resultFilter,
            'dataResult' => $dataResult,
            'probStatus' => $probStatus,
            'probJenkel' => $probJenkel,
            'probAlamat' => $probAlamat,
            'data_latih' => $data_latih,
            'probUsia' => $prob_usia,
            'probIps1' => $prob_ips1,
            'probIps2' => $prob_ips2,
            'probIps3' => $prob_ips3,
            'probIps4' => $prob_ips4,
            'dataAccuracy' => round($dataAccuracy, 0),
            'totalDataUji' => $totalDataUji,
            'filterData' => $filterData,
            'correct' => $correct,
            'inCorrect' => $inCorrect

        );
        $this->layout->views('data_uji/tb_data_uji_list', $data);
    }

    public function read($id)
    {
        $row = $this->Data_uji_model->get_by_id($id);
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
                'status' => $row->status,
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
            'nama' => set_value('nama'),
            'jenis_kelamin' => set_value('jenis_kelamin'),
            'nim' => set_value('nim'),
            'usia' => set_value('usia'),
            'alamat' => set_value('alamat'),
            'ips_1' => set_value('ips_1'),
            'ips_2' => set_value('ips_2'),
            'ips_3' => set_value('ips_3'),
            'ips_4' => set_value('ips_4'),
            'status' => set_value('status'),
            'result' => set_value('result'),
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
                'nama' => $this->input->post('nama', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'nim' => $this->input->post('nim', TRUE),
                'usia' => $this->input->post('usia', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'ips_1' => $this->input->post('ips_1', TRUE),
                'ips_2' => $this->input->post('ips_2', TRUE),
                'ips_3' => $this->input->post('ips_3', TRUE),
                'ips_4' => $this->input->post('ips_4', TRUE),
                'status' => $this->input->post('status', TRUE),
                'result' => $this->input->post('result', TRUE),
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

                    $nama = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                    $jenis_kelamin = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                    $nim = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                    $usia = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                    $alamat = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                    $ips_1 = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                    $ips_2 = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                    $ips_3 = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                    $ips_4 = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
                    $status = $worksheet->getCellByColumnAndRow(9, $row)->getValue();

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
                        'status' => strval($status),
                        'result' => $clasification
                    );

                    // var_dump($data);
                }
            }

            // foreach ($data as $key => $value) {

            //     $jenis_kelamin = $value['jenis_kelamin'];
            //     $usia = $value['usia'];
            //     $alamat = $value['alamat'];
            //     $ips_1 = $value['ips_1'];
            //     $ips_2 = $value['ips_2'];
            //     $ips_3 = $value['ips_3'];
            //     $ips_4 = $value['ips_4'];

            //     $clasification = $this->naves_bayes->clasification($jenis_kelamin, $usia, $alamat, $ips_1, $ips_2, $ips_3, $ips_4);
            //     // var_dump($clasification);

            //     $data[$key]['result'] = $clasification;
            // }

            // var_dump($data);


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
                'nama' => set_value('nama', $row->nama),
                'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
                'nim' => set_value('nim', $row->nim),
                'usia' => set_value('usia', $row->usia),
                'alamat' => set_value('alamat', $row->alamat),
                'ips_1' => set_value('ips_1', $row->ips_1),
                'ips_2' => set_value('ips_2', $row->ips_2),
                'ips_3' => set_value('ips_3', $row->ips_3),
                'ips_4' => set_value('ips_4', $row->ips_4),
                'status' => set_value('status', $row->status),
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
                'nama' => $this->input->post('nama', TRUE),
                'jenis_kelamin' => $this->input->post('jenis_kelamin', TRUE),
                'nim' => $this->input->post('nim', TRUE),
                'usia' => $this->input->post('usia', TRUE),
                'alamat' => $this->input->post('alamat', TRUE),
                'ips_1' => $this->input->post('ips_1', TRUE),
                'ips_2' => $this->input->post('ips_2', TRUE),
                'ips_3' => $this->input->post('ips_3', TRUE),
                'ips_4' => $this->input->post('ips_4', TRUE),
                'status' => $this->input->post('status', TRUE),
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

    public function empty_data()
    {
        $this->Data_uji_model->empty_data();
        $this->session->set_flashdata('message', 'Delete Data Success');
        redirect(site_url('data_uji'));
    }

    public function empty_data_prob()
    {
        $this->Data_latih_model->empty_data();
        $this->Data_probabilitas_model->empty_data_prob('tb_prob_status');
        $this->Data_probabilitas_model->empty_data_prob('tb_prob_jenkel');
        $this->Data_probabilitas_model->empty_data_prob('tb_prob_alamat');
        $this->Data_probabilitas_model->empty_data_prob('tb_prob_usia');
        $this->Data_probabilitas_model->empty_data_prob('tb_prob_ips1');
        $this->Data_probabilitas_model->empty_data_prob('tb_prob_ips2');
        $this->Data_probabilitas_model->empty_data_prob('tb_prob_ips3');
        $this->Data_probabilitas_model->empty_data_prob('tb_prob_ips4');

        $this->session->set_flashdata('message', 'Delete Data Success');
        redirect(site_url('data_uji'));
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
        $this->form_validation->set_rules('status', 'status', 'trim|required');

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
        xlsWriteLabel($tablehead, $kolomhead++, "Nama");
        xlsWriteLabel($tablehead, $kolomhead++, "Jenis Kelamin");
        xlsWriteLabel($tablehead, $kolomhead++, "Nim");
        xlsWriteLabel($tablehead, $kolomhead++, "Usia");
        xlsWriteLabel($tablehead, $kolomhead++, "Alamat");
        xlsWriteLabel($tablehead, $kolomhead++, "Ips 1");
        xlsWriteLabel($tablehead, $kolomhead++, "Ips 2");
        xlsWriteLabel($tablehead, $kolomhead++, "Ips 3");
        xlsWriteLabel($tablehead, $kolomhead++, "Ips 4");
        xlsWriteLabel($tablehead, $kolomhead++, "Status");

        foreach ($this->Data_uji_model->get_all() as $data) {
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
            xlsWriteLabel($tablebody, $kolombody++, $data->status);

            $tablebody++;
            $nourut++;
        }

        xlsEOF();
        exit();
    }

    public function action_count_prob()
    {
        if (empty($this->Data_probabilitas_model->get_all_tb_prob('tb_prob_status'))) {
            $data_status = $this->naves_bayes->getDataStatus();
            $data_jenkel = $this->naves_bayes->getPropabilitas('jenis_kelamin');
            $data_alamat = $this->naves_bayes->getPropabilitas('alamat');
            $data_usia = $this->naves_bayes->getPropabilitas('usia');
            $data_ips1 = $this->naves_bayes->getPropabilitas('ips_1');
            $data_ips2 = $this->naves_bayes->getPropabilitas('ips_2');
            $data_ips3 = $this->naves_bayes->getPropabilitas('ips_3');
            $data_ips4 = $this->naves_bayes->getPropabilitas('ips_4');

            foreach ($data_status as $key => $value) {
                $dataInsertStatus = [
                    'status' => $value['status'],
                    'count' => intval($value['count']),
                    'result' => doubleval($value['result'])
                ];
                $this->Data_probabilitas_model->insert_tb_prob('tb_prob_status', $dataInsertStatus);
            }


            foreach ($data_jenkel as $key => $value) {
                $data_in_jenkel = [
                    'name' => $value['name'],
                    'countOnTime' => intval($value['countOnTime']),
                    'countLate' => intval($value['countLate']),
                    'countAll' => intval($value['countAll']),
                    'resultOnTime' => doubleval($value['resultOnTime']),
                    'resultLate' => doubleval($value['resultLate']),
                ];

                // var_dump($data_in_jenkelsertJenkel);
                $this->Data_probabilitas_model->insert_tb_prob('tb_prob_jenkel', $data_in_jenkel);
            }


            foreach ($data_alamat as $key => $value) {
                $data_in_alamat = [
                    'name' => $value['name'],
                    'countOnTime' => intval($value['countOnTime']),
                    'countLate' => intval($value['countLate']),
                    'countAll' => intval($value['countAll']),
                    'resultOnTime' => doubleval($value['resultOnTime']),
                    'resultLate' => doubleval($value['resultLate']),
                ];

                // var_dump($data_in_alamatsertJenkel);
                $this->Data_probabilitas_model->insert_tb_prob('tb_prob_alamat', $data_in_alamat);
            }

            foreach ($data_usia as $key => $value) {
                $data_in_usia = [
                    'name' => $value['name'],
                    'countOnTime' => intval($value['countOnTime']),
                    'countLate' => intval($value['countLate']),
                    'countAll' => intval($value['countAll']),
                    'resultOnTime' => doubleval($value['resultOnTime']),
                    'resultLate' => doubleval($value['resultLate']),
                ];

                $this->Data_probabilitas_model->insert_tb_prob('tb_prob_usia', $data_in_usia);
            }

            foreach ($data_ips1 as $key => $value) {
                $data_in_ips1 = [
                    'name' => $value['name'],
                    'countOnTime' => intval($value['countOnTime']),
                    'countLate' => intval($value['countLate']),
                    'countAll' => intval($value['countAll']),
                    'resultOnTime' => doubleval($value['resultOnTime']),
                    'resultLate' => doubleval($value['resultLate']),
                ];

                $this->Data_probabilitas_model->insert_tb_prob('tb_prob_ips1', $data_in_ips1);
            }

            foreach ($data_ips2 as $key => $value) {
                $data_in_ips2 = [
                    'name' => $value['name'],
                    'countOnTime' => intval($value['countOnTime']),
                    'countLate' => intval($value['countLate']),
                    'countAll' => intval($value['countAll']),
                    'resultOnTime' => doubleval($value['resultOnTime']),
                    'resultLate' => doubleval($value['resultLate']),
                ];

                $this->Data_probabilitas_model->insert_tb_prob('tb_prob_ips2', $data_in_ips2);
            }

            foreach ($data_ips3 as $key => $value) {
                $data_in_ips3 = [
                    'name' => $value['name'],
                    'countOnTime' => intval($value['countOnTime']),
                    'countLate' => intval($value['countLate']),
                    'countAll' => intval($value['countAll']),
                    'resultOnTime' => doubleval($value['resultOnTime']),
                    'resultLate' => doubleval($value['resultLate']),
                ];

                $this->Data_probabilitas_model->insert_tb_prob('tb_prob_ips3', $data_in_ips3);
            }

            foreach ($data_ips4 as $key => $value) {
                $data_in_ips4 = [
                    'name' => $value['name'],
                    'countOnTime' => intval($value['countOnTime']),
                    'countLate' => intval($value['countLate']),
                    'countAll' => intval($value['countAll']),
                    'resultOnTime' => doubleval($value['resultOnTime']),
                    'resultLate' => doubleval($value['resultLate']),
                ];

                $this->Data_probabilitas_model->insert_tb_prob('tb_prob_ips4', $data_in_ips4);
            }

            $this->session->set_flashdata('message', 'Data Berhasil Di Buat');
            redirect(base_url('data_uji'));
        } else {
            $this->session->set_flashdata('message', 'Data Sudah Ada');
            redirect(base_url('data_uji'));
        }
    }
}

/* End of file Data_uji.php */
/* Location: ./application/controllers/Data_uji.php */
/* Please DO NOT modify this information : */
/* Generated by Harviacode Codeigniter CRUD Generator 2023-05-13 02:41:27 */
/* http://harviacode.com */