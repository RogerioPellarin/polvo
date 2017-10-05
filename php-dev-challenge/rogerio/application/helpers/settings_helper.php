<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');


/**
 * Funcao de debug
 */
if (!function_exists('easyPrint')) {

    function easyPrint($data, $die = 0) {
        print "<pre>";
        print_r($data);
        print "</pre>";
        $die == 1 ? die : "";
    }

}


/**
 * Converte uma data humana: 20/01/1980 em data 1980-01-20.
 * Caso a data nao esteja no formato: dd/mm/YYYY, o sistema retorna a data atual
 * 
 * @param string $date
 * @return date
 */
if (!function_exists('human_date_to_date')) {

    function human_date_to_date($date, $null = 0) {
        $pattern = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3}|[0-9]{2})$/';
        if (preg_match($pattern, $date)) {
            $h_date = explode("/", $date);
            $year   = $h_date[2] < 100 ? '20' . $h_date[2] : $h_date[2];
            return $year . "-" . $h_date[1] . "-" . $h_date[0];
        }
        else {
            if ($null == 0) {
                return date("Y-m-d");
            }
            else {
                return NULL;
            }
        }
    }

}


/**
 * Converte uma data de timestamp para dd/mm/YYYY
 * 
 * @param string $date
 * @return string
 */
if (!function_exists('date_to_human_date')) {

    function date_to_human_date($date, $current = false) {
        if (trim($date) != "" && preg_match('/^(19|20)\d\d[-](0[1-9]|1[012])[-](0[1-9]|[12][0-9]|3[01])$/', $date)) {
            return date("d/m/Y", strtotime($date));
        }
        elseif ($current) {
            return date("d/m/Y");
        }
        return "";
    }

}



/**
 * Funcao de validacao de CPF
 * @param type $cpf
 * @return boolean
 */
if (!function_exists('validar_cpf')) {

    function validar_cpf($cpf) { // Verifiva se o número digitado contém todos os digitos
        $cpf = str_pad(preg_replace('[^0-9]', '', $cpf), 11, '0', STR_PAD_LEFT);

        // Verifica se nenhuma das sequências abaixo foi digitada, caso seja, retorna falso
        if (strlen($cpf) != 11 || $cpf == '00000000000' || $cpf == '11111111111' || $cpf == '22222222222' || $cpf == '33333333333' || $cpf == '44444444444' || $cpf == '55555555555' || $cpf == '66666666666' || $cpf == '77777777777' || $cpf == '88888888888' || $cpf == '99999999999') {
            return false;
        }
        else {   // Calcula os números para verificar se o CPF é verdadeiro
            for ($t = 9; $t < 11; $t++) {
                for ($d = 0, $c = 0; $c < $t; $c++) {
                    $d += $cpf{$c} * (($t + 1) - $c);
                }

                $d = ((10 * $d) % 11) % 10;

                if ($cpf{$c} != $d) {
                    return false;
                }
            }
            return true;
        }
    }

}


if (!function_exists('retorna_mes')) {

    function retorna_mes($mes) {
        switch ($mes + 0) {
            case 1: return 'Janeiro';
            case 2: return 'Fevereiro';
            case 3: return 'Março';
            case 4: return 'Abril';
            case 5: return 'Maio';
            case 6: return 'Junho';
            case 7: return 'Julho';
            case 8: return 'Agosto';
            case 9: return 'Setembro';
            case 10: return 'Outubro';
            case 11: return 'Novembro';
            case 12: return 'Dezembro';
        }
    }

}

if (!function_exists('retorna_estados')) {

    function retorna_estados() {
        return array(
            'AC' => 'ACRE',
            'AL' => 'ALAGOAS',
            'AP' => 'AMAPÁ',
            'AM' => 'AMAZONAS',
            'BA' => 'BAHIA',
            'CE' => 'CEARÁ',
            'DF' => 'DISTRITO FEDERAL',
            'ES' => 'ESPÍRITO SANTO',
            'GO' => 'GOIÁS',
            'MA' => 'MARANHÃO',
            'MT' => 'MATO GROSSO',
            'MS' => 'MATO GROSSO DO SUL',
            'MG' => 'MINAS GERAIS',
            'PA' => 'PARÁ',
            'PB' => 'PARAÍBA',
            'PR' => 'PARANÁ',
            'PE' => 'PERNAMBUCO',
            'PI' => 'PIAUÍ',
            'RJ' => 'RIO DE JANEIRO',
            'RN' => 'RIO GRANDE DO NORTE',
            'RS' => 'RIO GRANDE DO SUL',
            'RO' => 'RONDÔNIA',
            'RR' => 'RORAIMA',
            'SC' => 'SANTA CATARINA',
            'SP' => 'SÃO PAULO',
            'SE' => 'SERGIPE',
            'TO' => 'TOCANTINS'
        );
    }

}



if (!function_exists('get_array_from_object')) {

    function get_array_from_object($obj) {
        $return = array();
        foreach ($obj as $key => $value) {
            if ($value !== "") {
                $return[substr($key, 1)] = $value;
            }
        }
        unset($return['status_active']);
        unset($return['status_inactive']);
        unset($return['status_deleted']);
        return $return;
    }

}

if (!function_exists('set_object_from_array')) {

    function set_object_from_array($array, $obj) {
        foreach ($array[0] as $key => $value) {
            if ($value !== "") {
                $obj["_".$key] = $value;
            }
        }
        return $obj;
    }

}



/**
 * Returns the amount of weeks into the month a date is
 * @param $date a YYYY-MM-DD formatted date
 * @param $rollover The day on which the week rolls over
 */
if (!function_exists('getWeeks')) {

    function getWeeks($date, $rollover) {
        $cut    = substr($date, 0, 8);
        $daylen = 86400;

        $timestamp = strtotime($date);
        $first     = strtotime($cut . "00");
        $elapsed   = ($timestamp - $first) / $daylen;

        $weeks = 1;

        for ($i = 1; $i <= $elapsed; $i++) {
            $dayfind      = $cut . (strlen($i) < 2 ? '0' . $i : $i);
            $daytimestamp = strtotime($dayfind);

            $day = strtolower(date("l", $daytimestamp));

            if ($day == strtolower($rollover))
                $weeks ++;
        }

        return $weeks;
    }

}


if (!function_exists('directory_copy')) {

    function directory_copy($source, $destination, $move = 0) {
        if (!copy($source, $destination)) {
            return false;
        }
        else {
            if ($move == 1) {
                unlink($source);
            }
            return true;
        }
    }

}

if (!function_exists('checkEmail')) {

    function checkEmail($email) {
        $pattern = preg_match("/^(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){255,})(?!(?:(?:\x22?\x5C[\x00-\x7E]\x22?)|(?:\x22?[^\x5C\x22]\x22?)){65,}@)(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22))(?:\.(?:(?:[\x21\x23-\x27\x2A\x2B\x2D\x2F-\x39\x3D\x3F\x5E-\x7E]+)|(?:\x22(?:[\x01-\x08\x0B\x0C\x0E-\x1F\x21\x23-\x5B\x5D-\x7F]|(?:\x5C[\x00-\x7F]))*\x22)))*@(?:(?:(?!.*[^.]{64,})(?:(?:(?:xn--)?[a-z0-9]+(?:-[a-z0-9]+)*\.){1,126}){1,}(?:(?:[a-z][a-z0-9]*)|(?:(?:xn--)[a-z0-9]+))(?:-[a-z0-9]+)*)|(?:\[(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){7})|(?:(?!(?:.*[a-f0-9][:\]]){7,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,5})?)))|(?:(?:IPv6:(?:(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){5}:)|(?:(?!(?:.*[a-f0-9]:){5,})(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3})?::(?:[a-f0-9]{1,4}(?::[a-f0-9]{1,4}){0,3}:)?)))?(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))(?:\.(?:(?:25[0-5])|(?:2[0-4][0-9])|(?:1[0-9]{2})|(?:[1-9]?[0-9]))){3}))\]))$/iD", $email);
        $isValid = ($pattern == 1) ? true : false;
        return $isValid;
    }

}

if (!function_exists('check_dir_exists')) {

    function check_dir_exists($dir_name) {
        if (!is_dir($dir_name)) {
            mkdir($dir_name, 0777, true);
        }
    }

}


/**
 * Retorna a quantidade de horas de um mês, pela data informada
 * Caso houver alguma inconsistência, será devolvido 0.
 * 
 * @param str $date (dd/mm/yyyy)
 * @param str $estado
 * @return int 
 */
if (!function_exists('hours_of_month')) {

    function hours_of_month($date, $estado = "DF") {
        (int) $hours   = 0;
        $pattern = '/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[012])\/([12][0-9]{3}|[0-9]{2})$/';
        if (preg_match($pattern, $date)) {
            list($dd, $mm, $yyyy) = explode('/', $date);
            if (checkdate($mm, $dd, $yyyy)) {
                $qtd_dias                  = date("t", strtotime($yyyy . $mm . $dd));
                $hours                     = $qtd_dias * 24;
                $estados_com_horario_verao = array(
                    "MT",
                    "DF",
                    "GO",
                    "MS",
                    "ES",
                    "RJ",
                    "SP",
                    "SC",
                    "MG",
                    "PR",
                    "RS"
                );
                if ($mm == 2 || $mm == 10) {
                    if (in_array($estado, $estados_com_horario_verao)) {
                        $hours = $mm == 2 ? ++$hours : --$hours;
                    }
                }
            }
        }

        return $hours;
    }

}


