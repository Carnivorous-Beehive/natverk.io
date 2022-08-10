<?php

function render_view(string $template, array $args = array(), $layout = null) {
    foreach($args as $arg => $value) {
        $$arg = $value;
    }

    $template = APP_PATH . '/views/' . $template . '.php';

    if (!is_null($layout)) {
        include $layout;
    } else {
        include $template;
    }
}
