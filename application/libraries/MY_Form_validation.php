<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class MY_Form_validation extends CI_Form_validation {

    function __construct() {

        parent::__construct();

        $this->CI = & get_instance();

        $this->CI->load->language('carbo');
    }

    function carbo_check_unique($value, $str) {
        $str = explode(':', $str);
        $table = $str[0];
        $field = $str[1];
        $item_id = isset($str[2]) ? $str[2] : NULL;

        if ($this->CI->Carbo_model->get_duplicate($table, 'id', $field, $value, $item_id))
        {
            return TRUE;
        }
        else
        {
            $this->set_message('carbo_check_unique', lang('cg_check_unique'));
            return FALSE;
        }
    }

    function carbo_check_upload($value, $str)
    {
        return $this->CI->carboform->check_upload($value, $str);
    }

    function carbo_check_date($date, $format)
    {
        $this->set_message('carbo_check_date', lang('cg_check_date'));

        if (!$format)
        {
            $format = 'm/d/Y';
        }

        $pformat = preg_replace('/([dDjmMnYyGgHhis])/', '%$1', $format);

        $ret = carbo_strptime($date, $pformat);

        if ($ret === FALSE OR !isset($ret['tm_mon']) OR !isset($ret['tm_mday']) OR !isset($ret['tm_year']))
        {
            return FALSE;
        }

        if (!checkdate($ret['tm_mon'], $ret['tm_mday'], $ret['tm_year']))
        {
            return FALSE;
        }

        //return date($format, mktime($ret['tm_hour'], $ret['tm_min'], $ret['tm_sec'], $ret['tm_mon'], $ret['tm_mday'], $ret['tm_year']));
        return carbo_format_date($ret, $format, $format);
    }

    function carbo_check_daterange($value, $params)
    {
        $params = explode(':', $params);
        $params[2] = isset($params[2]) ? $params[2] : 'm/d/Y';

        $from = carbo_parse_date($this->CI->input->post($params[0]), $params[2]);
        $to = carbo_parse_date($this->CI->input->post($params[1]), $params[2]);

        if ($from === FALSE)
        {
            $this->set_message('carbo_check_daterange', 'Invalid start date.');
            return FALSE;
        }

        if ($to === FALSE)
        {
            $this->set_message('carbo_check_daterange', 'Invalid end date.');
            return FALSE;
        }

        if ($to < $from)
        {
            $this->set_message('carbo_check_daterange', 'End date is before start date.');
            return FALSE;
        }

        return TRUE;
    }

    function upload_check($value, $params)
    {
        $params = explode(':', $params);
        $field = $params[0];
        $types = isset($params[1]) ? $params[1] : 'gif|jpg|png';
        $max_size = isset($params[2]) ? $params[2] : '1024';

        if (isset($_FILES[$field]) && $_FILES[$field]['name'])
        {
            $config['upload_path'] = './files/temp';
            $config['allowed_types'] = str_replace(',', '|', $types);
            $config['max_size'] = $max_size;
            $config['file_name'] = random_string('unique');

            $this->CI->load->library('upload', $config);

            if (!$this->CI->upload->do_upload($field))
            {
                $this->set_message('upload_check', $this->CI->upload->display_errors('', ''));
                return FALSE;
            }
            else
            {
                $data = $this->CI->upload->data();
                return $data['file_name'];
            }
        }
    }

}

/* End of file MY_Form_validation.php */
/* Location: ./system/application/libraries/MY_Form_validation.php */
