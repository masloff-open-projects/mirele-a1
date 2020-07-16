<?php

/**
 * Class for system update
 *
 * A class for downloading and installing components
 * from the Git repository.
 * The method of such an update is not the safest,
 * but the number of code checks at the time of
 * unpacking is enough to interrupt the installation in case of errors
 *
 * @version: 1.0.0
 * @author: Mirele
 * @package: Mirele
 */

class MUpgrade
{

    private $errors = [];
    private $success = [];
    private $packages = [];

    /**
     * @param array $list
     * @return bool
     */

    public function upgrade_components ($list=array()) {

        if (is_object($list) and !empty($list)) {

            foreach ($list as $name => $package) {

                if (isset($package->url)) {

                    $ch = curl_init($package->url);

                    curl_setopt($ch, CURLOPT_HEADER, 0);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_ENCODING, '');
                    curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
                    curl_setopt($ch, CURLOPT_TIMEOUT, 12);
                    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
                    curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
                    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");

                    $code = curl_exec($ch);

                    if (MFile::write(get_template_directory() . '/upgrade/' . $name . '.php', $code)) {

                        if (strpos(MFile::read(get_template_directory() . '/upgrade/' . $name . '.php'), '<?php') !== false) {

                            $this->success[] = (object) array (
                                'name' => $name,
                                'message' => 'Package update was successful'
                            );

                        } else {

                            $this->errors[] = (object) array (
                                'name' => $name,
                                'message' => 'The file is damaged'
                            );

                        }

                    } else {

                        $this->errors[] = (object) array (
                            'name' => $name,
                            'message' => 'File write error: ' . (get_template_directory() . '/upgrade/' . $name . '.php')
                        );

                    }

                } else {

                    $this->errors[] = (object) array (
                        'name' => $name,
                        'message' => 'This package does not have a new download reference defined'
                    );

                }

            }

        } else {

            return false;

        }

    }

    /**
     * @return array
     */

    public function getErrors()
    {
        return $this->errors;
    }


    /**
     * @return array
     */

    public function getSuccess()
    {
        return $this->success;
    }

}