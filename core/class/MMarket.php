<?php

/**
 * A pseudo high level class.
 * Class combines other classes for working with the FS and the repository ..
 *
 * @author: Mirele
 * @version: 1.0.0
 * @package: Mirele
 */

abstract class MMarket {


    /**
     * The function receives a list of applications in the market
     * and searches for all possible parameters.
     * If the search phrase converges with the parameters,
     * such an object will fall into the filter of found objects
     *
     * @param string $type
     * @param string $search
     * @param bool $offset
     * @param bool $length
     * @return object
     */

    static public function search ($type='blocks', $search="mirele", $offset=false, $length=false) {

         $installed = [];

         foreach (initialize_templates(true) as $path) {
             $installed[] = basename($path->filename, '.php');
         }

         $all = array();

         foreach (array_merge([ROSEMARY_GIT], get_option('rosemary_gits', array())) as $git) {

             $repository = new MRepository($git);
             $packages = array();

             if (is_array($repository->market()) or is_object($repository->market())) {
                 foreach ($repository->market() as $package) {

                     if (is_object($package) and $search) {

                         if (

                             isset($package->title) and
                             isset($package->description) and
                             isset($package->author)

                         ) {

                             if (

                                 strpos(strtolower($package->title), strtolower($search)) !== false or
                                 strpos(strtolower($package->description), strtolower($search)) !== false or
                                 strpos(strtolower($package->author), strtolower($search)) !== false

                             ) {

                                 $packages[] = (object) array_merge((array) $package, array(
                                     'installed' => in_array(md5($package->source), $installed)
                                 ));

                             }
                         }
                     }

                 }
             }

             $all = array_merge($all, $packages);

         }

         if ($offset == false and $length == false) {

             return (object) array(
                 'items' => $all,
                 'pages' => 0,
                 'page' => 0
             );

         } else {

             return (object) array(
                 'items' => array_slice($all, $offset, $length),
                 'pages' => round(count($all) / $length),
                 'page' => round($offset / $length)
             );

         }



    }


    /**
     * Function for installing a package using an external link
     *
     * @param string $url
     * @return array
     */

    static public function install_from_url ($url='localhost') {

        if (get_option ('mirele_allow_install_from_repo', 'false') != 'true') {
            return array (
                'message' => 'Downloading files from external sources is not available, since you have prohibited installing products from the repository',
                'code' => 209
            );
        }

        $ch = curl_init($url);
        $name = md5($url);

        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_ENCODING, '');
        curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
        curl_setopt($ch, CURLOPT_TIMEOUT, 4);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        if ( !file_exists(ROSEMARY_TEMPLATES_DIR . '/market/' . $name . '.php') ) {

            $fp = fopen(ROSEMARY_TEMPLATES_DIR . '/market/' . $name . '.php', 'w+');
            $r = fwrite($fp, curl_exec($ch));
            fclose($fp);

            if ($r) {
                return array (
                    'message' => 'Installation was successful',
                    'code' => 201,
                    'param' => $r
                );
            } else {
                return array (
                    'message' => 'File cannot be written to file.',
                    'code' => 212
                );
            }

        } else {

            return array (
                'message' => 'File already exists and cannot be overwritten.',
                'code' => 209
            );

        }

    }


    /**
     * Function for installing a package
     * from the archive.
     * At the input, it takes an archive in the form
     * of a specific variable $_FILES
     *
     * @param null $FILE
     * @return array
     */

    static public function install_from_zip_file ($FILE=null) {

        if ($FILE['type'] == 'application/zip') {
            if (class_exists('ZipArchive')) {

                $zip = new ZipArchive;
                $res = $zip->open($FILE["tmp_name"]);

                if ($res === TRUE) {

                    try {

                        $zip->extractTo(ROSEMARY_TEMPLATES_DIR . '/import/');
                        $zip->close();

                        return array (
                            'message' => 'Import completed successfully without errors!',
                            'code' => 201
                        );

                    } catch (Exception $e) {

                        return array (
                            'message' => 'Error in unzip: ' . $e->getMessage(),
                            'code' => 202
                        );

                    }

                } else {

                    return array (
                        'message' => 'Error unpacking the archive. Check the write permissions in the directory ' . ROSEMARY_TEMPLATES_DIR . '/import/',
                        'code' => 204
                    );

                }

            } else {

                return array (
                    'message' => 'You don\'t have a module installed for working with archives',
                    'code' => 203
                );

            }


        } else {

            return array (
                'message' => 'Your file is not a .ZIP format',
                'code' => 206
            );

        }

    }

}