<?php

function render_view(string $template, array $args = array()) {
    foreach($args as $arg => $value) {
        $$arg = $value;
    }

    include APP_PATH . "/views/" . $template . ".php";
}
