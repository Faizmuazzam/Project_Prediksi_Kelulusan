<?php
class Layout
{
    protected $_var;
    function __construct()
    {
        $this->_var = &get_instance();
    }

    function views($layout = NULL, $data = NULL)
    {
        if (isset($layout)) {
            $data['main'] = $this->_var->load->view($layout, $data, TRUE);
            $data['navbar'] = $this->_var->load->view('includes/navbar', $data, TRUE);
            $data['sidebar'] = $this->_var->load->view('includes/sidebar', $data, TRUE);
            $data['footer'] = $this->_var->load->view('includes/footer', $data, TRUE);
            $data['content'] = $this->_var->load->view('layouts/_content', $data, TRUE);
            echo $data['Layout'] = $this->_var->load->view('layouts/main', $data, TRUE);
        }
    }
}
