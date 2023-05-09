<?php
class Layout_login
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
            $data['content'] = $this->_var->load->view('auth/layouts/_content', $data, TRUE);
            echo $data['Layout'] = $this->_var->load->view('auth/layouts/main', $data, TRUE);
        }
    }
}
