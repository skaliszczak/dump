<?php

/**
 * @package     Debug tools
 * @author      INTELLIGENT DESIGN Sławomir Kaliszczak
 * @copyright	INTELLIGENT DESIGN 2014
 */
define('_DUMP_STYLE_', ' style="white-space: pre; font-family: \'Curier new\', monospace; background-color: white"');
define('_DUMP_FILE', 'dump.log');

/**
 * Dump enable
 */
function dump_on() {
    $GLOBALS['_DUMP_OFF_'] = false;
}

/**
 * Dump disable
 */
function dump_off() {
    $GLOBALS['_DUMP_OFF_'] = true;
}

/**
 * Prints named information in pre tags
 * @param type $varible
 * @param type $name
 */
function dump($varible, $name = null) {

    if (strlen($name) > 0) {
        $name = '<b>' . $name . '</b> = ';
    }

    if ((array_key_exists('_DUMP_OFF_', $GLOBALS) && !$GLOBALS['_DUMP_OFF_']) || !array_key_exists('_DUMP_OFF_', $GLOBALS)) {
        echo '<pre' . _DUMP_STYLE_ . '>' . $name . print_r($varible, true) . '</pre>';
    }
}

/**
 * Prints named information in pre tags
 * @param type $varible
 * @param type $name
 */
function dump_date($timestamp, $name = null, $format = null) {

    if (strlen($name) > 0) {
        $name = '<b>' . $name . '</b> = ';
    }

    if ($format === null) {
        $format = 'H:i:s d-m-Y';
    }

    if ((array_key_exists('_DUMP_OFF_', $GLOBALS) && !$GLOBALS['_DUMP_OFF_']) || !array_key_exists('_DUMP_OFF_', $GLOBALS)) {
        echo '<pre' . _DUMP_STYLE_ . '>' . $name . date($format, $timestamp) . '</pre>';
    }
}

/**
 * Prints named information in pre tags
 * @param type $varible
 * @param type $name
 */
function dump_datet($timestamp, $name = null, $format = null) {

    if (strlen($name) > 0) {
        $name = $name . ' = ';
    }

    if ($format === null) {
        $format = 'H:i:s d-m-Y';
    }

    if ((array_key_exists('_DUMP_OFF_', $GLOBALS) && !$GLOBALS['_DUMP_OFF_']) || !array_key_exists('_DUMP_OFF_', $GLOBALS)) {
        echo $name . date($format, $timestamp) . PHP_EOL;
    }
}

/**
 * Prints named information in raw mode
 * @param type $varible
 * @param type $name
 */
function dumpt($varible, $name = null) {

    if (strlen($name) > 0) {
        $name = $name . ' = ';
    }

    if ((array_key_exists('_DUMP_OFF_', $GLOBALS) && !$GLOBALS['_DUMP_OFF_']) || !array_key_exists('_DUMP_OFF_', $GLOBALS)) {
        echo $name . print_r($varible, true) . "\n";
    }
}

/**
 * Prints named information in raw mode
 * @param type $varible
 * @param type $name
 */
function dumptd($varible, $name = null) {

    dumpt($varible, $name);
    die('-----------END------------');
}

/**
 * Prints named information in pre tags with htmlspecialchars function
 * @param type $varible
 * @param type $name
 */
function dumph($varible, $name = null) {

    if (strlen($name) > 0) {
        $name = '<b>' . $name . '</b> = ';
    }

    if ((array_key_exists('_DUMP_OFF_', $GLOBALS) && !$GLOBALS['_DUMP_OFF_']) || !array_key_exists('_DUMP_OFF_', $GLOBALS)) {
        echo '<pre' . _DUMP_STYLE_ . '>' . $name . htmlspecialchars(print_r($varible, true), ENT_QUOTES, 'UTF-8') . '</pre>';
    }
}

/**
 * Prints named var_dump in pre tags
 * @param mixed $varible
 * @param string $name
 */
function dumpv($varible, $name = null) {

    ob_start();
    var_dump($varible);
    $out = ob_get_clean();
    $out = preg_replace('/=>\s*/', ' =&gt; ', $out);
    $out = str_replace(array("<pre class='xdebug-var-dump' dir='ltr'>", '</pre>'), array('', ''), $out);

    if (strlen($name) > 0) {
        $name = '<b>' . $name . '</b> = ';
    }

    if ((array_key_exists('_DUMP_OFF_', $GLOBALS) && !$GLOBALS['_DUMP_OFF_']) || !array_key_exists('_DUMP_OFF_', $GLOBALS)) {
        echo '<pre' . _DUMP_STYLE_ . '>' . $name . $out . '</pre>';
    }
}

/**
 * Prints named var_dump in pre tags
 * @param mixed $varible
 * @param string $name
 */
function dumpvf($varible, $name = null) {

    ob_start();
    var_dump($varible);
    $out = ob_get_clean();
    $out = preg_replace('/\s*=>\s*/', ' => ', $out);
    $out = str_replace(array("<pre class='xdebug-var-dump' dir='ltr'>", '</pre>'), array('', ''), $out);

    file_put_contents(
            _DUMP_FILE, $name . ' = ' . $out . PHP_EOL, FILE_APPEND
    );
}

/**
 * Prints named var_dump in pre tags
 * @param mixed $varible
 * @param string $name
 */
function dumpvt($varible, $name = null) {

    ob_start();
    var_dump($varible);
    $out = ob_get_clean();
    $out = preg_replace('/\s*=>\s*/', ' => ', $out);
    $out = str_replace(array("<pre class='xdebug-var-dump' dir='ltr'>", '</pre>'), array('', ''), $out);

    if (strlen($name) > 0) {
        $name = $name . ' = ';
    }

    if ((array_key_exists('_DUMP_OFF_', $GLOBALS) && !$GLOBALS['_DUMP_OFF_']) || !array_key_exists('_DUMP_OFF_', $GLOBALS)) {
        echo $name . $out . PHP_EOL;
    }
}

/**
 * Prints named var_dump in pre tags
 * @param mixed $varible
 * @param string $name
 */
function dump_stackf() {

    ob_start();
    debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
    $out = ob_get_clean();

    file_put_contents(
            _DUMP_FILE, $out . PHP_EOL, FILE_APPEND
    );
}

function dump_stack() {

    if ((array_key_exists('_DUMP_OFF_', $GLOBALS) && !$GLOBALS['_DUMP_OFF_']) || !array_key_exists('_DUMP_OFF_', $GLOBALS)) {
        echo '<pre' . _DUMP_STYLE_ . '>';
        debug_print_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS);
        echo '</pre>';
    }
}

function dumpf($varible, $name = null) {

    if (strlen($name) > 0) {
        $name = $name . ' = ';
    }

    file_put_contents(
            'dump.log', $name . print_r($varible, true) . PHP_EOL, FILE_APPEND
    );
}

function dumpf_clear() {

    file_put_contents('dump.log', '');
}
