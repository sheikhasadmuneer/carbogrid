<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Sample extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        //$this->output->enable_profiler(TRUE);
    }

    //function index($limit = 10, $offset = 0, $cols = 'all', $order = 'none', $filter_string = 'all')
    function single($grid = 'none')
    {
        $columns = array(
            0 => array(
                'name' => 'Username',
                'db_name' => 'username',
                'header' => 'Username',
                'group' => 'User',
                'form_control' => 'text_long',
                'type' => 'string'),
            1 => array(
                'name' => 'Age',
                'db_name' => 'age',
                'header' => 'Age',
                'group' => 'User',
                'required' => TRUE,
                'form_control' => 'text_short',
                'type' => 'integer'),
            2 => array(
                'name' => 'Birthday',
                'db_name' => 'birthday',
                'header' => 'Birthday',
                'group' => 'User',
                'form_control' => 'datepicker',
                'type' => 'date'),
            3 => array(
                'name' => 'Active',
                'db_name' => 'active',
                'header' => 'Active',
                'group' => 'User',
                'allow_filter' => FALSE,
                'form_control' => 'checkbox',
                'type' => 'boolean'),
            4 => array(
                'name' => 'City',
                'db_name' => 'city',
                'header' => 'City',
                'group' => 'User',
                'allow_filter' => FALSE,
                'ref_table_db_name' => 'cm_city',
                'ref_field_db_name' => 'name',
                'ref_field_type' => 'string',
                'form_control' => 'dropdown',
                'type' => '1-n'),
            5 => array(
                'name' => 'Comment',
                'db_name' => 'opinion',
                'header' => 'Comment',
                'group' => 'Comment',
                'form_control' => 'textarea',
                'type' => 'text')
        );

        $params = array(
            'id' => 'users',
            'table' => 'cm_user',
            'url' => 'sample/single',
            'uri_param' => $grid,
            'columns' => $columns,
            'ajax' => TRUE
        );

        $this->load->library('carbogrid', $params);

        if ($this->carbogrid->is_ajax)
        {
            $this->carbogrid->render();
            return FALSE;
        }

        // Pass grid to the view
        $data->page_grid = $this->carbogrid->render();

        $this->load->view('container', $data);
    }

    function multiple($grid1 = 'none', $grid2 = 'none')
    {
        if ($this->input->post('activate'))
        {
            $ids = $this->input->post('cg_users1_item_ids');

            if (count($ids))
            {
                $this->db->set('active', 1)->where_in('id', $ids)->update('cm_user');
            }
        }
        if ($this->input->post('unactivate'))
        {
            $ids = $this->input->post('cg_users2_item_ids');

            if (count($ids))
            {
                $this->db->set('active', 0)->where_in('id', $ids)->update('cm_user');
            }
        }

        // Grid 1
        $columns = array(
            0 => array(
                'name' => 'Username',
                'db_name' => 'username',
                'header' => 'Username',
                'group' => 'User',
                'form_control' => 'text_long',
                'type' => 'string'),
            1 => array(
                'name' => 'Birthday',
                'db_name' => 'birthday',
                'header' => 'Birthday',
                'group' => 'User',
                'form_default' => '01/01/1980',
                'form_control' => 'datepicker',
                'date_format' => 'm/d/Y h:i A',
                'type' => 'date'),
            2 => array(
                'name' => 'Active',
                'db_name' => 'active',
                'header' => 'Active',
                'group' => 'User',
                'allow_filter' => FALSE,
                'form_visible' => FALSE,
                'form_control' => 'checkbox',
                'type' => 'boolean')
        );

        $params = array(
            'id' => 'users1',
            'table' => 'cm_user',
            'url' => 'sample/multiple',
            'uri_param' => $grid1,
            'params_after' => $grid2,
            'columns' => $columns,
            'order' => array(0 => 'desc'),
            'hard_filters' => array(
                array('field' => 2, 'value' => 0)
            ),
            'allow_add' => TRUE,
            'allow_edit' => TRUE,
            'allow_delete' => FALSE,
            'nested' => TRUE,
            'ajax' => TRUE
        );

        $this->load->library('carbogrid', $params, 'grid1');

        if ($this->grid1->is_ajax)
        {
            $this->grid1->render();
            return FALSE;
        }

        // Grid 2
        $columns = array(
            0 => array(
                'name' => 'Username',
                'db_name' => 'username',
                'header' => 'Username',
                'group' => 'User',
                'form_control' => 'text_long',
                'type' => 'string'),
            1 => array(
                'name' => 'Age',
                'db_name' => 'age',
                'header' => 'Age',
                'group' => 'User',
                'required' => TRUE,
                'form_control' => 'text_short',
                'type' => 'integer'),
            2 => array(
                'name' => 'Active',
                'db_name' => 'active',
                'header' => 'Active',
                'group' => 'User',
                'allow_filter' => FALSE,
                'form_control' => 'checkbox',
                'type' => 'boolean')
        );

        $params = array(
            'id' => 'users2',
            'table' => 'cm_user',
            'url' => 'sample/multiple',
            'uri_param' => $grid2,
            'params_before' => $grid1,
            'columns' => $columns,
            'hard_filters' => array(
                array('field' => 2 , 'value' => 1)
            ),
            'allow_add' => FALSE,
            'allow_edit' => FALSE,
            'allow_delete' => FALSE,
            'nested' => TRUE,
            'ajax' => TRUE
        );

        $this->load->library('carbogrid', $params, 'grid2');

        if ($this->grid2->is_ajax)
        {
            $this->grid2->render();
            return FALSE;
        }

        // Pass grid to the view
        $data->page = 'multiple';
        $data->grid1 = $this->grid1->render();
        $data->grid2 = $this->grid2->render();

        $this->load->view('container', $data);
    }

}

/* End of file judges.php */
/* Location: ./application/controllers/admin/judges.php */
