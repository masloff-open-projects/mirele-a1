<?php

/**
 * Class MVersion
 * Class for version control
 *
 * @version: 1.0.0
 * @author: Mirele
 * @package: Mirele
 */

abstract class MVersion {

    public function register ($package='core', $version=1) {

        global $mirele_versions;

        if (empty($mirele_versions[$package])) {
            return $mirele_versions[$package] = $version;
        } else {
            return false;
        }

    }

    public function all () {

        global $mirele_versions;

        return $mirele_versions;

    }

    public function get_version ($package='core') {

        global $mirele_versions;

        if (!empty($mirele_versions[$package])) {
            return $mirele_versions[$package];
        } else {
            return false;
        }

    }

}