<?php

/**
 * Class for working with block repositories.
 * It is based on The github repository.
 *
 * If you decide to change the repository to your own, or find Another supported
 * UNOFFICIAL mirele repository, we do not resolve such issues.
 * Use only official Mirelle repositories
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

class MRepository {

    private $git = false;

    public function __construct($git=false)
    {
        $this->git = $git;
    }

    /**
     * Check for update
     *
     * @version: 1.0.0
     */

    public function version () {

        return mc_execute('repo_git_version', function () {

            $git = ROSEMARY_GIT;

            $ch = curl_init("https://raw.githubusercontent.com/$git/master/update/last.json");

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $json = curl_exec($ch);

            curl_close($ch);

            return json_decode($json);

        });

    }


    /**
     * Checking compatibility of components
     *
     * @version: 1.0.0
     */

    public function components_versions () {

        if (get_option('mirele_forbid_updates', true)) { return false; }

        return mc_execute('repo_git_components_versions', function () {

            $git = ROSEMARY_GIT;

            $ch = curl_init("https://raw.githubusercontent.com/$git/master/update/components.json");

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $json = curl_exec($ch);

            curl_close($ch);

            return json_decode($json);

        });

    }


    /**
     * Get all packages
     *
     * @version: 1.0.0
     */

    public function market () {

        $git = ($this->git == false ? ROSEMARY_GIT : $this->git);

        if (mc_get('repository_' . $git)) {

            return mc_get('repository_' . $git);

        } else {

            $ch = curl_init("https://raw.githubusercontent.com/$git/master/market/market.json");

            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_ENCODING, '');
            curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
            curl_setopt($ch, CURLOPT_TIMEOUT, 4);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

            $json = curl_exec($ch);

            curl_close($ch);

            return mc_set('repository_' . $git, json_decode($json));

        }

    }


}