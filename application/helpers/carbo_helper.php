<?php

    /* Utils */

    function carbo_parse_date($date, $format = 'Y-m-d')
    {
        //return strtotime($date_str);
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

        $ret['tm_hour'] = isset($ret['tm_hour']) ? $ret['tm_hour'] : 0;
        $ret['tm_min'] = isset($ret['tm_hour']) ? $ret['tm_hour'] : 0;
        $ret['tm_sec'] = isset($ret['tm_hour']) ? $ret['tm_hour'] : 0;

        return mktime($ret['tm_hour'], $ret['tm_min'], $ret['tm_sec'], $ret['tm_mon'], $ret['tm_mday'], $ret['tm_year']);
    }

    function carbo_format_date($date, $input_format, $output_format)
    {
        // Cast string to date
        /*if (gettype($date) == 'string')
        {
            //$date = carbo_parse_date($date, $format);
            $date = strtotime($date);
        }
        // If we don't have a date object, return the original parameter
        if ($date AND (gettype($date) == 'integer'))
        {
            return date($format, $date);
        }*/
        if (!is_array($date))
        {
            $pformat = preg_replace('/([dDjmMnYyGgHhis])/', '%$1', $input_format);

            $date = carbo_strptime($date, $pformat);

            if ($date === FALSE OR !isset($date['tm_mon']) OR !isset($date['tm_mday']) OR !isset($date['tm_year']))
            {
                return FALSE;
            }

            $date['tm_hour'] = isset($date['tm_hour']) ? $date['tm_hour'] : '00';
            $date['tm_min'] = isset($date['tm_hour']) ? $date['tm_hour'] : '00';
            $date['tm_sec'] = isset($date['tm_hour']) ? $date['tm_hour'] : '00';
        }

        $output_format = preg_replace('/d/', $date['tm_mday'], $output_format);
        $output_format = preg_replace('/m/', $date['tm_mon'], $output_format);
        $output_format = preg_replace('/Y/', $date['tm_year'], $output_format);
        $output_format = preg_replace('/H/', $date['tm_hour'], $output_format);
        $output_format = preg_replace('/h/', ($date['tm_hour'] > 12) ? ($date['tm_hour'] - 12) : ($date['tm_hour'] == 0 ? 12 : $date['tm_hour']), $output_format);
        $output_format = preg_replace('/i/', $date['tm_min'], $output_format);
        $output_format = preg_replace('/s/', $date['tm_sec'], $output_format);
        $output_format = preg_replace('/A/', ($date['tm_hour'] < 12) ? 'AM' : 'PM', $output_format);
        $output_format = preg_replace('/a/', ($date['tm_hour'] < 12) ? 'am' : 'pm', $output_format);

        return $output_format;
    }

    function carbo_strptime($date, $format)
    {
        $search = array(
            '%d', '%D', '%j', // day
            '%m', '%M', '%n', // month
            '%Y', '%y', // year
            '%G', '%g', '%H', '%h', // hour
            '%i', '%s');

        $replace = array(
            '(\d{2})', '(\w{3})', '(\d{1,2})', //day
            '(\d{2})', '(\w{3})', '(\d{1,2})', // month
            '(\d{4})', '(\d{2})', // year
            '(\d{1,2})', '(\d{1,2})', '(\d{2})', '(\d{2})', // hour
            '(\d{2})', '(\d{2})');

        $return = array(
            's' => 'tm_sec', // sec
            'i' => 'tm_min', //min
            'g' => 'tm_hour', 'h' => 'tm_hour', //hour
            'd' => 'tm_mday', 'j' => 'tm_mday', //day
            'm' => 'tm_mon',  'n' => 'tm_mon', //month
            'y' => 'tm_year');

        $pattern = str_replace($search, $replace, $format);

        //echo $pattern . '<br/>';

        if (!preg_match("#$pattern#", $date, $matches))
        {
            return FALSE;
        }
        $dp = $matches;

        if (!preg_match_all('#%(\w)#', $format, $matches))
        {
            return FALSE;
        }
        $id = $matches['1'];

        //print_r($dp);
        //echo '<br/>';

        if (count($dp) != count($id) + 1)
        {
            return FALSE;
        }

        $ret = array();
        for ($i = 0, $j = count($id); $i < $j; $i++)
        {
            $ret[$return[strtolower($id[$i])]] = $dp[$i + 1];
        }

        return $ret;
    }

    function carbo_is_ajax()
    {
        return (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND ($_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest'));
    }
?>
