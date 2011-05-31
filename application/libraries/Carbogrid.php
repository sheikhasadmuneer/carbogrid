<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Carbogrid
{
    /**
     * @todo
     * Filters control by type
     * Parse date + format date
     * Datetimepicker
     * Allow add/edit/delete conditional
     * Go to page + page size textfield
     *
     * After add/edit go to page and higlight
     * Horizontal scrolling
    **/

    public $id = 'datagrid';
    public $url = '';
    public $params = '';
    public $params_before = '';
    public $params_after = '';
    public $uri_param = 'none';
    public $uri_segment = 3;
    public $nested = FALSE;

    // Custom function to populate the grid
    public $get_data = '';

    public $allow_add = TRUE;
    public $allow_edit = TRUE;
    public $allow_delete = TRUE;
    public $allow_filter = TRUE;
    public $allow_columns = TRUE;
    public $allow_select = TRUE;
    public $allow_pagination = TRUE;
    public $allow_sort = TRUE;
    public $allow_multisort = FALSE;

    public $language_id = 1;
    public $total = 0;
    public $limit = 10;
    public $page_size = 10;
    public $page = 1;
    public $offset = 0;
    public $pagination_links = 5;
    public $max_cell_length = 50;
    public $show_empty_rows = TRUE;

    public $order_string = 'none';
    public $filter_string = 'all';
    public $column_string = 'all';

    public $hard_filters = array();
    public $filters = array();
    public $order = array();
    public $limits = array(5 => 5, 10 => 10, 20 => 20, 50 => 50);

    public $columns = array();
    public $data = array();
    public $columns_visible = array();
    public $selected_ids = array();

    public $commands = array();
    public $command = NULL;
    public $command_arg = NULL;
    public $confirm = FALSE;
    public $confirm_command = NULL;
    public $confirm_arg = NULL;
    public $confirm_title = '';
    public $confirm_text = '';
    public $render_table = TRUE;

    public $show_col_list = FALSE;

    public $page_max = 0;
    public $page_curr = 1;
    public $page_start = 1;
    public $page_nr = 0;

    public $first_link;
    public $prev_link;
    public $next_link;
    public $last_link;
    public $page_links = array();

    public $item_start = 0;
    public $item_end = 0;

    public $filter_nr = 0; // Number of filters, if none, we render no filter row
    public $headers = array();
    public $ajax = TRUE;
    public $ajax_history = TRUE;

    public $is_ajax = FALSE;
    public $response = NULL;

    public $table = NULL;
    public $table_id_name = 'id';


    // Default column settings
    private $column_defaults = array(
        'name'              => '',
        'type'              => '',
        'header'            => '',
        'display'           => '',
        'visible'           => TRUE,
        //'filter'            => NULL,
        'allow_filter'      => TRUE,
        'allow_sort'        => TRUE,
        // Date type settings
        'date_format'       => 'm/d/Y',
        // URL type settings
        'url_target'        => '_self',
        // File upload settings
        'upload_path'       => './files',
        'upload_path_temp'  => './files/temp',
        'allowed_types'     => 'gif|jpg|png',
        'max_size'          => '1024',
        // Foreign key settings
        'ref_table_id_name' => 'id',
        'ref_table_db_name' => '',
        'ref_field_db_name' => '',
        'ref_field_type'    => '',
        // Form settings
        'group'             => '',
        'form_visible'      => TRUE,
        'form_default'      => '',
        'form_control'      => 'text_long',
        // Validation settings
        'validation'        => '',
        'min_length'        => NULL,
        'max_length'        => NULL,
        'required'          => FALSE,
        'unique'            => FALSE
    );
    // Default command settings
    private $command_defaults = array(
        'name'              => '',
        'text'              => '',
        'url'               => '',
        'function'          => '',
        'icon'              => '',
        'type'              => 'dialog', // dialog, post, link...
        'toolbar'           => FALSE,
        'multi'             => FALSE,
        'grid'              => TRUE,
        'ajax'              => TRUE,
        'confirm'           => FALSE,
        'confirm_title'     => '',
        'confirm_text'      => '',
        'confirm_yes'       => '',
        'confirm_no'        => '',
        'dialog_save'       => '',
        'dialog_cancel'     => ''
    );
    // Default dialog settings
    public $dialog = array(
        'title'             => '&nbsp;',
        'class'             => 'cg-dialog-confirm',
        'content'           => '',
        'yes'               => '',
        'no'                => '',
        'visible'           => FALSE
    );

    function __construct($params = array())
    {
        $this->CI = & get_instance();

        $this->CI->load->language('carbo');

        $this->CI->load->helper('carbo');

        $this->CI->load->model('Carbo_model');

        $this->filter_operators = array(
            'like'          => lang('cg_filter_like'),
            'notlike'       => lang('cg_filter_not_like'),
            'starts'            => lang('cg_filter_starts'),
            'ends'        => lang('cg_filter_ends'),
            'eq'            => '=',
            'noteq'         => '!=',
            'lt'            => '<',
            'lte'           => '<=',
            'gt'            => '>',
            'gte'           => '>=',
            //'in'            => lang('cg_filter_in'),
            //'not_in'        => lang('cg_filter_not_in'),
        );

        // Get selected ids
        if (is_array($item_ids = $this->CI->input->post('cg_' . $this->id . '_item_ids')))
        {
            $this->selected_ids = $item_ids;
        }

        // Set parameters
        foreach ($params as $key => $value)
        {
            $this->$key = $value;
        }

        // Do we have an ajax call?
        $this->is_ajax = ($this->CI->input->post('cg_ajax_' . $this->id) === '1');

        // Set initial filters
        if ($this->allow_filter)
        {
            $this->filter_string = '';
            foreach ($this->filters as $key => $filter)
            {
                $op = isset($filter['operator']) ? $filter['operator'] : 'eq';
                $this->filter_string .= $key . ':' . $this->encode($filter['value']) . ':' . $op . '_';
            }
            $this->filter_string = $this->filter_string ? rtrim($this->filter_string, '_') : 'all';
        }

        // Set initial order
        if ($this->allow_sort)
        {
            $this->order_string = '';
            foreach ($this->order as $key => $dir)
            {
                $dir = (strtolower($dir) == 'desc') ? 'desc' : 'asc';
                $this->order_string .= $key . ':' . $dir . '_';
            }
            $this->order_string = $this->order_string ? rtrim($this->order_string, '_') : 'none';
        }

        // Parse uri parameter
        //$uri_param = $this->CI->uri->segment($this->uri_segment);
        $uri_param = $this->uri_param;
        if ($uri_param)
        {
            $uri_param = explode('-', $uri_param);
            if (isset($uri_param[0]))
                $this->page_size = $uri_param[0];
            if (isset($uri_param[1]))
                $this->page = $uri_param[1];
            if (isset($uri_param[2]))
                $this->column_string = $uri_param[2];
            if (isset($uri_param[3]))
                $this->order_string = $uri_param[3];
            if (isset($uri_param[4]))
                $this->filter_string = $uri_param[4];
        }
        /*foreach ($this->CI->uri->segment_array() as $key => $segment)
        {
            if ($key < $this->uri_segment)
            {
                $this->params_before .= $segment . '/';
            }
            elseif ($key > $this->uri_segment)
            {
                $this->params_after .= '/' . $segment;
            }
        }
        $this->url = '';*/
        $this->params_before = $this->params_before ? (rtrim($this->params_before, '/') . '/') : '';
        $this->params_after = $this->params_after ? ('/' . ltrim($this->params_after, '/')) : '';

        // Ensure trailing slash to the url end
        $this->url = rtrim($this->url, '/') . '/';

        // Dialog settings
        $this->dialog = (object) $this->dialog;

        // Setup headers, all columns are visible by default
        $this->filter_nr = 0;
        $this->columns_visible = array();
        foreach ($this->columns as $key => $column)
        {
            $this->columns[$key] = array_merge($this->column_defaults, (array) $column);
            // Set unique name
            if ($this->columns[$key]['type'] == '1-n')
            {
                $this->columns[$key]['unique_name'] = $this->columns[$key]['ref_table_db_name'] . '_' . $this->columns[$key]['ref_field_db_name'];
                $this->columns[$key]['where_name'] = $this->columns[$key]['ref_table_db_name'] . '.' . $this->columns[$key]['ref_field_db_name'];
            }
            else
            {
                $this->columns[$key]['unique_name'] = $this->table . '_' . $this->columns[$key]['db_name'];
                $this->columns[$key]['where_name'] = $this->table . '.' . $this->columns[$key]['db_name'];
            }

            // Convert columns to objects
            $this->columns[$key] = (object) $this->columns[$key];

            // Count filters
            if ($this->columns[$key]->allow_filter !== FALSE)
            {
                $this->filter_nr++;
            }
            $this->headers[$key] = $this->columns[$key]->header;
            //$this->columns_visible[$key] = TRUE;
            $this->columns_visible[] = $key;
        }

        // Set limit and offset
        if ($this->allow_pagination)
        {
            $this->page_size = ($this->page_size == 'all') ? 'all' : (is_numeric($this->page_size) ? $this->page_size : 10);
            $this->limit = (is_numeric($this->page_size)) ? $this->page_size : NULL;
            //$this->offset = (is_numeric($this->offset)) ? $this->offset : 0;
            $this->offset = $this->limit * ($this->page - 1);
        }
        else
        {
            $this->page_size = 'all';
            $this->page = 1;
            $this->limit = NULL;
            $this->offset = 0;
        }

        // ---------------------------------------------------------------------

        // Set default commands
        if ($this->allow_add)
        {
            $defaults = array(
                'type'          => 'dialog',
                'text'          => lang('cg_add'),
                'name'          => 'add',
                'icon'          => 'circle-plus',
                'toolbar'       => TRUE,
                'grid'          => FALSE,
                'dialog_save'   => lang('cg_save'),
                'dialog_cancel' => lang('cg_cancel')
            );
            $this->commands['add'] = isset($this->commands['add']) ? array_merge($this->commands['add'], $defaults) : $defaults;
        }
        else
        {
            unset($this->commands['add']);
        }
        if ($this->allow_edit)
        {
            $defaults = array(
                'type'          => 'dialog',
                'text'          => lang('cg_edit'),
                'name'          => 'edit',
                'icon'          => 'pencil',
                'dialog_save'   => lang('cg_save'),
                'dialog_cancel' => lang('cg_cancel')
            );
            $this->commands['edit'] = isset($this->commands['edit']) ? array_merge($this->commands['edit'], $defaults) : $defaults;
        }
        else
        {
            unset($this->commands['edit']);
        }
        if ($this->allow_delete)
        {
            $defaults = array(
                'type'          => 'post',
                'text'          => lang('cg_delete'),
                'name'          => 'delete',
                'icon'          => 'trash',
                'toolbar'       => TRUE,
                'multi'         => TRUE,
                'confirm'       => TRUE,
                'confirm_title' => lang('cg_confirm_delete_title'),
                'confirm_text'  => lang('cg_confirm_delete'),
                'confirm_yes'   => lang('cg_yes'),
                'confirm_no'    => lang('cg_no')
            );
            $this->commands['delete'] = isset($this->commands['delete']) ? array_merge($this->commands['delete'], $defaults) : $defaults;
        }
        else
        {
            unset($this->commands['delete']);
        }

        // Init commands
        foreach ($this->commands as $key => $command)
        {
            $this->commands[$key] = array_merge($this->command_defaults, $command);
        }

        // Handle commands
        foreach ($this->commands as $key => $command)
        {
            // Peform command if posted
            if (($arg = $this->CI->input->post('cg_' . $this->id . '_command_' . $command['name'])) !== FALSE)
            {
                // Get arguments
                if (($arg === $command['text'] OR $arg === ''))
                {
                    $arg = NULL;
                }
                // Get selected arguments if command can handle multiple arguments
                if ($command['multi'])
                {
                    if (is_array($item_ids = $this->CI->input->post('cg_' . $this->id . '_item_ids')))
                    {
                        //$arg = implode(':', $item_ids);
                        $arg = $item_ids;
                    }
                }
                if ($command['confirm'])
                {
                    if (is_null($arg) OR $this->CI->input->post('cg_' . $this->id . '_dialog_no') !== FALSE)
                    {
                        // Command was rejected
                        break;
                    }
                    else if ($this->CI->input->post('cg_' . $this->id . '_dialog_yes') === FALSE)
                    {
                        $this->dialog->visible = TRUE;
                        $this->dialog->class = 'cg-dialog-confirm';
                        $this->dialog->command = $command['name'];
                        $this->dialog->command_arg = $arg;
                        $this->dialog->title = $command['confirm_title'];
                        $this->dialog->yes = lang('cg_yes');
                        $this->dialog->no = lang('cg_no');
                        $this->dialog->content = $this->CI->load->view('carbo/carbo_confirm', array('text' => $command['confirm_text']), TRUE);
                        // Wait for confirmation, break command
                        break;
                    }
                }
                // Execute command
                $this->command = $command['name'];
                $this->command_arg = $arg;
                if ($command['url'])
                {
                    if ($this->is_ajax)
                    {
                        $this->response->redirect = rtrim($command['url'], '/') . '/' . $arg;
                    }
                    else
                    {
                        redirect(rtrim($command['url'], '/') . '/' . $arg);
                    }
                    return FALSE;
                }
                elseif (method_exists($this->CI, $command['function']))
                {
                    if ($command['type'] == 'dialog')
                    {
                        if ($this->CI->input->post('cg_' . $this->id . '_dialog_no') !== FALSE)
                        {
                            break;
                        }

                        $validate = $this->CI->input->post('cg_' . $this->id . '_dialog_yes') !== FALSE;
                        $result = $this->CI->{$command['function']}($validate, $arg, $this);

                        if ($result === TRUE)
                        {
                            $this->render_table = TRUE;
                        }
                        elseif ($this->CI->input->post('cg_' . $this->id . '_dialog_no') === FALSE)
                        {
                            $this->render_table = !$this->is_ajax;
                            $this->dialog->visible = TRUE;
                            $this->dialog->class = 'cg-dialog-form';
                            $this->dialog->command = $this->command;
                            $this->dialog->command_arg = $this->command_arg;
                            $this->dialog->title = is_null($arg) ? lang('cg_add') : lang('cg_edit');
                            $this->dialog->yes = lang('cg_save');
                            $this->dialog->no = lang('cg_cancel');
                            $this->dialog->content = $result;
                        }
                    }
                    else
                    {
                        $this->CI->{$command['function']}($arg);
                    }
                }
                else
                {
                    switch ($command['name'])
                    {
                        case 'add':
                            $this->form();
                            break;

                        case 'edit':
                            $this->form($arg);
                            break;

                        case 'delete':
                            $this->delete($arg);
                            break;

                        // Custom command
                        default:
                            redirect(rtrim($command['url'], '/') . '/' . $arg);
                            return FALSE;
                    }
                }
                break;
            }
        }

        // ---------------------------------------------------------------------

        // Show columns visibility list
        if ($this->CI->input->post('cg_' . $this->id . '_columns') !== FALSE)
        {
            $this->show_col_list = TRUE;
        }

        // Init visible columns array
        if ($this->allow_columns)
        {
            if ($this->CI->input->post('cg_' . $this->id . '_columns_list') !== FALSE)
            {
                $this->columns_visible = $this->CI->input->post('cg_' . $this->id . '_columns_visible');
                $this->column_string = (count($this->columns_visible) == count($this->headers)) ? 'all' : (is_array($this->columns_visible) ? implode(':', $this->columns_visible) : 'none');
                if (!$this->is_ajax)
                {
                    //redirect($this->url . $this->limit . '/' . $this->offset . '/' . $this->column_string . '/' . $this->order_string . '/' . $this->filter_string);
                    redirect($this->url . $this->params_before . $this->page_size . '-' . $this->page . '-' . $this->column_string . '-' . $this->order_string . '-' . $this->filter_string . $this->params_after);
                    return FALSE;
                }
                $this->show_col_list = FALSE;
            }
            elseif ($this->column_string == 'none')
            {
                $this->columns_visible = array();
            }
            elseif ($this->column_string != 'all')
            {
                $this->columns_visible = explode(':', $this->column_string);
            }
        }

        // ---------------------------------------------------------------------

        // Handle page size change
        if ($this->CI->input->post('cg_' . $this->id . '_change_page_size') !== FALSE)
        {
            $this->page_size = $this->CI->input->post('cg_' . $this->id . '_page_size');
            $this->limit = (is_numeric($this->page_size)) ? $this->page_size : NULL;
            //redirect($this->url . $this->limit . '/' . $this->offset . '/' . $this->column_string . '/' . $this->order_string . '/' . $this->filter_string);
            redirect($this->url . $this->params_before . $this->page_size . '-' . $this->page . '-' . $this->column_string . '-' . $this->order_string . '-' . $this->filter_string . $this->params_after);
            return FALSE;
        }

        // ---------------------------------------------------------------------

        // Set filters
        if ($this->allow_filter)
        {
            if ($this->CI->input->post('cg_' . $this->id . '_apply_filter') !== FALSE)
            {
                $this->filter_string = '';
                foreach ($this->columns as $key => $column)
                {
                    if (($value = $this->CI->input->post('cg_' . $this->id . '_filter_' . $key)) !== FALSE && ($value !== ''))
                    {
                        $op = $this->CI->input->post('cg_' . $this->id . '_filter_op_' . $key);
                        $this->filters[$key]['field'] = $column->where_name;
                        $this->filters[$key]['operator'] = $op;
                        $this->filters[$key]['value'] = $value;
                        $this->filter_string .= $key . ':' . $this->encode($value) . ':' . $op . '_';
                    }
                }
                $this->filter_string = $this->filter_string ? rtrim($this->filter_string, '_') : 'all';
                if (!$this->is_ajax)
                {
                    //redirect($this->url . $this->limit . '/0/' . $this->column_string . '/' . $this->order_string . '/' . $this->filter_string);
                    redirect($this->url . $this->params_before . $this->page_size . '-1-' . $this->column_string . '-' . $this->order_string . '-' . $this->filter_string . $this->params_after);
                    return FALSE;
                }
            }
            elseif ($this->filter_string != 'all')
            {
                $filters = explode('_', $this->filter_string);
                $filt = array();
                foreach ($filters as $f)
                {
                    $f = explode(':', $f);
                    if (array_key_exists($f[0], $this->headers) AND isset($f[1]) AND ($f[1] !== ''))
                    {
                        $filt[$f[0]]['field'] = $this->columns[$f[0]]->where_name;
                        $filt[$f[0]]['value'] = $this->decode($f[1]);
                        $filt[$f[0]]['operator'] = isset($f[2]) ? $f[2] : 'eq';
                    }
                }
                $this->filters = $filt;
            }
            else
            {
                $this->filters = array();
            }
        }
        else
        {
            $this->filters = array();
        }

        // ---------------------------------------------------------------------

        // Set order
        if ($this->allow_sort)
        {
            if ($this->order_string !== NULL && $this->order_string !== 'none')
            {
                $order = explode('_', $this->order_string);
                $ord = array();
                foreach ($order as $o)
                {
                    $o = explode(':', $o);
                    if (array_key_exists($o[0], $this->headers))
                    {
                        if (!isset($o[1]) OR ($o[1] != 'desc'))
                        {
                            $ord[$o[0]] = 'ASC';
                        }
                        else
                        {
                            $ord[$o[0]] = 'DESC';
                        }
                        // Stop on first if multiple column sort is not allowed
                        if (!$this->allow_multisort) break;
                    }
                }
                $this->order = $ord;
            }
        }
        else
        {
            $this->order = array();
        }

        // ---------------------------------------------------------------------

        // Get data
        if ($this->render_table)
        {
            if (method_exists($this->CI, $this->get_data))
            {
                $this->CI->{$this->get_data}($this);
            }
            else
            {
                $this->get_data();
            }
        }
    }


    function get_data()
    {
        $filters = array();
        foreach ($this->filters as $filter)
        {
            $filters[] = $filter;
        }
        foreach ($this->hard_filters as $filter)
        {
            $f['field'] = $this->columns[$filter['field']]->where_name;
            $f['value'] = $filter['value'];
            $f['operator'] = isset($filter['operator']) ? $filter['operator'] : 'eq';
            $filters[] = $f;
        }

        $this->total = $this->CI->Carbo_model->count_items($this->table, $this->table_id_name, $this->columns, $filters);
        $this->data = $this->CI->Carbo_model->get_items($this->table, $this->table_id_name, $this->columns, NULL, $filters, $this->limit, $this->offset, $this->order);
    }

    function render()
    {
        // Calculate page numbers and pagination links
        if ($this->allow_pagination && $this->render_table)
        {
            $limit = is_null($this->limit) ? $this->total : $this->limit;
            $this->page_max = $this->total ? ceil($this->total / $limit) : 1;
            $this->page_curr = ceil(($this->offset + 1) / $limit);
            $this->page_curr = ($this->page_curr > $this->page_max) ? $this->page_max : $this->page_curr;
            $this->page_curr = ($this->page_curr < 1) ? 1 : $this->page_curr;
            $this->page_start = (($this->page_curr - ceil($this->pagination_links / 2) + 1) < 1) ? 1 : ($this->page_curr - ceil($this->pagination_links / 2) + 1);
            $this->page_nr = ($this->page_start + $this->pagination_links < $this->page_max) ? $this->page_start + $this->pagination_links : $this->page_max + 1;
            $this->offset = ($this->page_curr - 1) * $limit;
            $this->item_start = ($this->total > 0) ? $this->offset + 1 : 0;
            $this->item_end = ($this->offset + $limit > $this->total) ? $this->total : $this->offset + $limit;

            $grid_param = $this->page_size . '-1-' . $this->column_string . '-' . $this->order_string . '-' . $this->filter_string;
            $this->first_link = $this->url . $this->params_before . $grid_param . $this->params_after . '#1';// . $grid_param;
            $grid_param = $this->page_size . '-' . ($this->page_curr - 1) . '-' . $this->column_string . '-' . $this->order_string . '-' . $this->filter_string;
            $this->prev_link = $this->url . $this->params_before . $grid_param . $this->params_after . '#' . ($this->page_curr - 1);//. $grid_param;
            $grid_param = $this->page_size . '-' . ($this->page_curr + 1) . '-' . $this->column_string . '-' . $this->order_string . '-' . $this->filter_string;
            $this->next_link = $this->url . $this->params_before . $grid_param . $this->params_after . '#' . ($this->page_curr + 1);//. $grid_param;
            $grid_param = $this->page_size . '-' . ($this->page_max) . '-' . $this->column_string . '-' . $this->order_string . '-' . $this->filter_string;
            $this->last_link = $this->url . $this->params_before . $grid_param . $this->params_after . '#'  . ($this->page_max);// . $grid_param;

            for ($i = $this->page_start; $i < $this->page_nr; $i++)
            {
                $grid_param = $this->page_size . '-' . ($i) . '-' . $this->column_string . '-' . $this->order_string . '-' . $this->filter_string;
                $this->page_links[$i] = ($i == $this->page_curr) ? '' : ($this->url . $this->params_before . $grid_param . $this->params_after . '#' . $i);
            }
        }

        // Export to PDF
        /*if ($this->CI->input->post('export') !== FALSE)
        {
            $this->CI->load->plugin('dompdf');
            $dompdf = new DOMPDF();
            $html =  $this->CI->load->view('carbogrid/datagrid_print', array('grid' => $this), TRUE);
            //echo $html;
            $dompdf->load_html($html);
            $dompdf->render();
            $dompdf->stream('datagrid.pdf');
        }*/

        if ($this->is_ajax)
        {
            if ($this->render_table)
                $this->response->table = $this->CI->load->view('carbo/carbo_grid', array('grid' => $this), TRUE);
            if ($this->dialog->visible)
                $this->response->dialog = $this->dialog->content;
            // If form is posted via iframe (when uploading files), wrap json content between <textarea> tags (handled by the jquery form plugin)
            $output = '';
            if (!carbo_is_ajax()) $output .= '<textarea>';
            $output .= json_encode($this->response);
            if (!carbo_is_ajax()) $output .= '</textarea>';
            $this->CI->output->set_output($output);
            return TRUE;
        }
        else
        {
            return $this->CI->load->view('carbo/carbo_grid', array('grid' => $this), TRUE);
        }
    }

    function form($item_id = NULL)
    {
        if ($this->CI->input->post('cg_' . $this->id . '_dialog_no') !== FALSE)
        {
            $this->form = NULL;
            return TRUE;
        }

        $this->render_table = !$this->is_ajax;

        $params = array(
            'id' => $this->id,
            'table' => $this->table,
            'table_id_name' => $this->table_id_name,
            'item_id' => $item_id,
            'language_id' => $this->language_id,
            'is_ajax' => $this->is_ajax,
            'columns' => $this->columns,
            'nested' => TRUE
        );

        $this->CI->load->library('carboform', $params, 'cf_' . $this->id);

        $this->form = $this->CI->{'cf_' . $this->id};

        if ($this->form->run($this->CI->input->post('cg_' . $this->id . '_dialog_yes') !== FALSE) === TRUE)
        {
            $this->render_table = TRUE;
            return TRUE;
        }

        if ($this->CI->input->post('cg_' . $this->id . '_dialog_no') === FALSE)
        {
            $this->dialog->visible = TRUE;
            $this->dialog->class = 'cg-dialog-form';
            $this->dialog->command = $this->command;
            $this->dialog->command_arg = $this->command_arg;
            $this->dialog->title = is_null($item_id) ? lang('cg_add') : lang('cg_edit');
            $this->dialog->yes = lang('cg_save');
            $this->dialog->no = lang('cg_cancel');
            $this->dialog->content = $this->form->render();
        }

        return FALSE;
    }

    function delete($item_ids)
    {
        //$item_ids = explode(':', $item_ids);
        $this->CI->Carbo_model->delete_items($this->table, $this->table_id_name, $item_ids);
    }

    function create_order_url($params)
    {
        //$order = array_merge($this->order, $params['order']);
        if ($this->allow_multisort)
        {
            $order = $this->order;
        }
        else
        {
            $order = array();
        }
        foreach ($params['order'] as $name => $dir)
        {
            $order[$name] = $dir;
        }
        $order_str = '';
        foreach ($order as $name => $dir)
        {
            if ($dir !== NULL)
            {
                $order_str .= '_' . $name . ':' . strtolower($dir);
            }
        }
        $order_str = ltrim($order_str, '_');
        $order_str = $order_str ? $order_str : 'none';
        //return $this->url . ($this->params ? ($this->params . '/') : '') . (is_null($this->limit) ? 'all' : $this->limit) . '/' . $this->offset . '/' . $this->column_string . '/' . $order_str . '/' . $this->filter_string . '#' . ($this->params ? ($this->params . '/') : '') . (is_null($this->limit) ? 'all' : $this->limit) . '/' . $this->offset . '/' . $this->column_string . '/' . $order_str . '/' . $this->filter_string;

        $grid_param = $this->page_size . '-' . $this->page . '-' . $this->column_string . '-' . $order_str . '-' . $this->filter_string;
        return $this->url . $this->params_before . $grid_param . $this->params_after . '#' . $order_str;
    }

    function encode($string)
    {
        return strtr(base64_encode($string), '+/=', '%.~');
    }

    function decode($string)
    {
        return base64_decode(strtr($string, '%.~', '+/='));
    }

}

/* End of file Carbogrid.php */
/* Location: ./application/libraries/Carbogrid.php */
