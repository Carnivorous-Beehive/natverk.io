<?php

function render_view(string $template, array $params = array(), $layout = null, string $sitename = '') {
    foreach($params as $param => $value) {
        $$param = $value;
    }

    if (array_key_exists('title', $params)) {
        $title = $params['title'];
        if (is_array($title)) {
            $title = implode(' | ', array_merge($title, array($sitename)));
        } else {
            $title = !$sitename ? $title : "$title | $sitename";
        }
    } else {
        $title = $sitename;
    }

    if (!array_key_exists('styles', $params)) {
        $params['styles'] = array();
    }

    $template = APP_PATH . '/views/' . $template . '.php';

    if (!is_null($layout)) {
        include $layout;
    } else {
        include $template;
    }
}
