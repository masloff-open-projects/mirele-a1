<?php

/**
 * Class MBackup
 * A class for creating backup copies of both the entire system and its individual directories
 */

abstract class MBackup {

    /**
     * Use to get all files and subfolders (and files in subfolders).
     *
     * @version: 1.0.0
     * @param $path
     * @return array
     */

    static private function files ($path) {

        $dir = opendir($path);
        $all = array();
        while($file = readdir($dir)){
            if ($file != '.' && $file != '..' && $file[strlen($file)-1] != '~'){

                $ctime = filectime( $path . $file ) . ',' . $file;
                $all[$ctime] = $file;

            }
        }

        closedir($dir);
        krsort($all);

        return $all;

    }


    /**
     * The function of compressing a folder and files in it.
     * This function is based on to compress the folders to be backed up.
     * It also uses static class functions such as getting the maximum file size,
     * getting a password for a backup archive
     *
     * @version: 1.0.0
     * @param $source
     * @param $destination
     * @param $password
     * @return bool
     */

    static private function zip ($source, $destination, $password) {
        if (!extension_loaded('zip') || !MFile::exist($source)) {
            return false;
        }

        $zip = new ZipArchive();
        if (!$zip->open($destination, ZIPARCHIVE::CREATE)) {
            return false;
        }

        $source = str_replace('\\', '/', realpath($source));

        if (is_dir($source) === true) {
            $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($source), RecursiveIteratorIterator::SELF_FIRST);

            foreach ($files as $file) {
                $file = str_replace('\\', '/', $file);

                if (in_array(substr($file, strrpos($file, '/')+1), array('.', '..'))) {
                    continue;
                }

                if (is_file($file) and filesize($file) > self::getMaxSize()) {
                    continue;
                }

                $file = realpath($file);

                if (is_dir($file) === true) {

                    $zip->addEmptyDir(str_replace($source . '/', '', $file . '/'));

                } elseif (is_file($file) === true) {

                    $zip->addFromString(str_replace($source . '/', '', $file), MFile::read($file));

                    if (method_exists($zip, 'setEncryptionName')) {

                        $zip->setPassword($password);

                        $zip->setEncryptionName(str_replace($source . '/', '', $file), ZipArchive::EM_AES_256, $password);

                    }

                }
            }
        } elseif (is_file($source) === true) {
            $zip->addFromString(basename($source), MFile::read($source));

            if (method_exists($zip, 'setEncryptionName')) {

                $zip->setPassword($password);

                $zip->setEncryptionName(basename($source), ZipArchive::EM_AES_256, $password);

            }

        }

        $close = $zip->close();

        try {
            chmod($destination, 0660);
        } catch (Exception $e) {}

        return $close;
    }


    /**
     * A function for obtaining information about a backup file.
     * Typically, the use function exclusively provided statistics on
     * the backup file. It is not used inside the backup and unpack
     * features for security reasons
     *
     * @version: 1.0.0
     * @param $file
     * @return bool|object
     */

    public function info ($file) {

        if (MFile::exist(MIRELE_BACKUPS_DIR . '/' . $file)) {

            return (object) array (
                'stat' => stat(MIRELE_BACKUPS_DIR . '/' . $file),
                'mime_content_type' => mime_content_type(MIRELE_BACKUPS_DIR . '/' . $file),
                'time' => filectime(MIRELE_BACKUPS_DIR . '/' . $file)
            );

        } else {

            return false;

        }

    }


    /**
     * The function returns all of files that are basic to the self::files () function.
     * In general, the function is used to generate tables with a all of current backups.
     *
     * @version: 1.0.0
     * @return array
     */

    public function all () {

        return self::files(MIRELE_BACKUPS_DIR . '/');

    }


    /**
     * The primary function that organizes backup methods.
     * It checks whether the user has ZIP archive methods installed
     * and either creates a backup using the self::zip () function,
     * or issues an error (false) if no archive methods are found on the server.
     * The function ignores large files (the size is determined by the self::getMaxSize () function)
     * because they cause a memory error
     *
     * @version: 1.0.0
     * @param string $dir
     * @param bool $forcibly
     * @return bool
     */

    public function create ($dir='', $forcibly=false, $prefix="theme_") {

        if (class_exists('ZipArchive')) {

            if ($forcibly) {
                return self::zip ($dir, MIRELE_BACKUPS_DIR . '/' . $prefix . time() . '.zip', self::getPassword());
            }

            if (empty(self::all())) {

                return self::zip ($dir, MIRELE_BACKUPS_DIR . '/' . $prefix . time() . '.zip', self::getPassword());

            } else {

                $recentModify = filectime(MIRELE_BACKUPS_DIR . '/'. array_shift (self::all()));

                if ($recentModify != false and time() - $recentModify > self::getFrequency() and mime_content_type(MIRELE_BACKUPS_DIR . '/'. array_shift (self::all())) == 'application/zip') {

                    return self::zip ($dir, MIRELE_BACKUPS_DIR . '/' . $prefix . time() . '.zip', self::getPassword());

                } elseif (mime_content_type(MIRELE_BACKUPS_DIR . '/'. array_shift (self::all())) != 'application/zip') {

                    return self::zip ($dir, MIRELE_BACKUPS_DIR . '/' . $prefix . time() . '.zip', self::getPassword());

                } else {

                    return false;

                }

            }

        } else {

            return false;

        }

    }


    /**
     * The main function that organizes backup unpacking methods.
     * It receives the backup information and the path to the backup file,
     * then checks to see if it is possible to create a folder where the backup will be unpacked.
     * If no errors occur, the function, using the password to unzip the archive (if no password is specified,
     * no error will occur), unzips the data to the newly created folder
     *
     * @version: 1.0.0
     * @param $file
     * @param $password
     * @return bool
     */

    public function expand ($file, $password) {

        if (MFile::exist(MIRELE_BACKUPS_DIR . '/' . $file)) {

            if (mkdir(get_template_directory() . '/../mirele_backup_' . $file . '/')) {

                $zip = new ZipArchive;
                $res = $zip->open(MIRELE_BACKUPS_DIR . '/' . $file);
                if ($res === TRUE) {

                    $zip->setPassword($password);
                    $zip->extractTo(get_template_directory() . '/../mirele_backup_' . $file . '/');
                    $zip->close();

                    return true;

                } else {

                    return false;

                }

            } else {

                return false;

            }

        } else {

            return false;

        }

    }


    /**
     * Gets backup repodiness in seconds
     *
     * @version: 1.0.0
     * @return float|int
     */

    static public function getFrequency ()
    {
        return apply_filters('mirele_backup_frequency', get_option('mirele_frequency_backups_time', false) ? get_option('mirele_frequency_backups_time', false) : 60 * 60 * 24 * 4);
    }


    /**
     * Gets the maximum file size to add in bytes
     *
     * @version: 1.0.0
     * @return float|int
     */

    static public function getMaxSize ()
    {
        return apply_filters('mirele_backup_max_size', 35 * 1024 * 1024);
    }


    /**
     * Get password
     *
     * @version: 1.0.0
     * @return bool
     */

    static public function getPassword ()
    {
        return empty(get_option('mrl_backups_password', false)) or get_option('mrl_backups_password', false) == false ? false : get_option('mrl_backups_password', false);
    }

}