<?php
/**
 * Imprime a string com quebra de linha
 * @param $str
 */
function printlog($str)
{
    global $CFG;

    if (date_default_timezone_get() != $CFG->timezone) {
        date_default_timezone_set($CFG->timezone);
    }

    $date = date('Y-m-d H:i:s');
    $eol = defined('PHP_EOL') ? PHP_EOL : "\n";
    echo '[', $date, '] ', $str, $eol;
    flush();
}

/**
 * Debug message
 *
 * @param $pr
 * @param bool $die
 */
function debug($pr, $die = true)
{
    global $CFG;
    if (!$CFG->debug) return;

    if (is_array($pr)) {
        echo '<pre>';
        print_r($pr);
        echo '</pre>';
    } else {
        var_dump($pr);
    }

    if ($die) die;
}

/**
 * Formata uma string para URL (slug)
 *
 * @param $string
 * @param string $separator
 * @return mixed|string
 */
function format_uri($string, $separator = '-')
{
    $string = html_entity_decode($string, ENT_QUOTES, 'UTF-8');
    $accents_regex = '~&([a-z]{1,2})(?:acute|cedil|circ|grave|lig|orn|ring|slash|th|tilde|uml);~i';
    $special_cases = array('&' => 'and', "'" => '');
    $string = mb_strtolower(trim($string), 'UTF-8');
    $string = str_replace(array_keys($special_cases), array_values($special_cases), $string);
    $string = preg_replace($accents_regex, '$1', htmlentities($string, ENT_QUOTES, 'UTF-8'));
    $string = preg_replace("/[^a-z0-9]/u", "$separator", $string);
    $string = preg_replace("/[$separator]+/u", "$separator", $string);
    return $string;
}