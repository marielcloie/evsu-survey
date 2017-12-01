<?php

class Upload extends CI_Controller {

        public function __construct()
        {
                parent::__construct();
                $this->load->helper(array('form', 'url'));
        }

        public function do_upload($schoolID)
        {
                $config['upload_path']          = './uploads/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 100;
                $config['max_width']            = 1024;
                $config['max_height']           = 768;          
                
                $this->load->library('upload', $config);

                if ( ! $this->upload->do_upload('userfile'))
                {
                        $this->session->mark_as_flash('message');
                        $this->session->set_flashdata('message', [
                                        'status' => 'danger',
                                        'message' => $this->upload->display_errors()
                                ]);

                        redirect(base_url('principal/school_features'));
                }
                else
                {
                        $imagename= $this->upload->data('file_name');
                        $this->User->insert_schoolfile($schoolID,$imagename);
                        $this->session->mark_as_flash('message');
                        $this->session->set_flashdata('message', [
                                        'status' => 'success',
                                        'message' => 'Successfully uploaded'
                                ]);
                        redirect(base_url('principal/school_features'));
                }
        }
}
?>