<?php

/**
 * @param $view
 * @param array $data
 * @return string
 */
function view($view = null, array $data = []) {

    return APP_ROOT . '/views/' . $view;
}