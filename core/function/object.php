<?php

function get_object ($src) {
    try {
        return json_decode(MFile::read($src));
    } catch (Exception $e) {
        return false;
    }
}
