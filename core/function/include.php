<?php

function include_upgrade ($file, $reinclude=true) {

    if ($reinclude) {
        if (file_exists(MIRELE_UPGRADE_DIR . '/' . basename($file)) and !empty(MFile::read(MIRELE_UPGRADE_DIR . '/' . basename($file))) and filesize(MIRELE_UPGRADE_DIR . '/' . basename($file)) > 0) {
            include MIRELE_UPGRADE_DIR . '/' . basename($file);
        } else {
            include $file;
        }
    } else {
        include $file;
    }

}