<?php

/**
 * Class MSafe
 * A small antivirus code that checks the PHP source code for malicious code.
 * This class is not abstract, it contains information about virus blocks that can write to the system
 *
 * @version 1.0.0
 * @author Mirele
 * @package Mirele
 */

class MSafe {

    private $warning_functions = array();
    private $dangerous_functions = array();
    private $virus_branches = array();
    private $normal_branches = array();
    private $harshness = 0;
    private $time = 1;

    /**
     * Function for checking source code for malicious functions
     *
     * Attention!
     * Just checking through this method is not a basis for
     * concluding that the file is secure,
     * since it can be circumvented by using different methods,
     * such as: 'file'() or $f = 'file'; $f()
     *
     * @param $file
     * @param $code
     * @return bool
     *
     * @executetime 0.0000028610229492188 s
     * @executetime 0.0000050067901611328 s
     */

    public function verify_source_code ($file, $code) {

        preg_match_all ('/\block;/', $code, $v_selflock);
        preg_match_all ('/\brunkit_function_rename\((.*?)\)|\brename_function\((.*?)\)/', $code, $v_rename);
        preg_match_all ('/\bfopen\((.*?)\)|\btmpfile\((.*?)\)|\bbzopen\((.*?)\)|\bgzopen\((.*?)\)|\bchgrp\((.*?)\)|\bchmod\((.*?)\)|\bchown\((.*?)\)|\bcopy\((.*?)\)|\bfile_put_contents\((.*?)\)|\blchgrp\((.*?)\)|\blchown\((.*?)\)|\blink\((.*?)\)|\bmkdir\((.*?)\)|\bmove_uploaded_file\((.*?)\)|\brename\((.*?)\)|\brmdir\((.*?)\)|\bsymlink\((.*?)\)|\btempnam\((.*?)\)|\btouch\((.*?)\)|\bunlink\((.*?)\)|\bimagepng\((.*?)\)|\bimagewbmp\((.*?)\)|\bimage2wbmp\((.*?)\)|\bimagejpeg\((.*?)\)|\bimagexbm\((.*?)\)|\bimagegif\((.*?)\)|\bimagegd\((.*?)\)|\bimagegd2\((.*?)\)|\biptcembed\((.*?)\)|\bftp_get\((.*?)\)|\bftp_nb_get\((.*?)\)|\bfile_exists\((.*?)\)|\bfile_get_contents\((.*?)\)|\bfile\((.*?)\)|\bfileatime\((.*?)\)|\bfilectime\((.*?)\)|\bfilegroup\((.*?)\)|\bfileinode\((.*?)\)|\bfilemtime\((.*?)\)|\bfileowner\((.*?)\)|\bfileperms\((.*?)\)|\bfilesize\((.*?)\)|\bfiletype\((.*?)\)|\bglob\((.*?)\)|\bis_dir\((.*?)\)|\bis_executable\((.*?)\)|\bis_file\((.*?)\)|\bis_link\((.*?)\)|\bis_readable\((.*?)\)|\bis_uploaded_file\((.*?)\)|\bis_writable\((.*?)\)|\bis_writeable\((.*?)\)|\blinkinfo\((.*?)\)|\blstat\((.*?)\)|\bparse_ini_file\((.*?)\)|\bpathinfo\((.*?)\)|\breadfile\((.*?)\)|\breadlink\((.*?)\)|\brealpath\((.*?)\)|\bstat\((.*?)\)|\bgzfile\((.*?)\)|\breadgzfile\((.*?)\)|\bgetimagesize\((.*?)\)|\bimagecreatefromgif\((.*?)\)|\bimagecreatefromjpeg\((.*?)\)|\bimagecreatefrompng\((.*?)\)|\bimagecreatefromwbmp\((.*?)\)|\bimagecreatefromxbm\((.*?)\)|\bimagecreatefromxpm\((.*?)\)|\bftp_put\((.*?)\)|\bftp_nb_put\((.*?)\)|\bexif_read_data\((.*?)\)|\bread_exif_data\((.*?)\)|\bexif_thumbnail\((.*?)\)|\bexif_imagetype\((.*?)\)|\bhash_file\((.*?)\)|\bhash_hmac_file\((.*?)\)|\bhash_update_file\((.*?)\)|\bmd5_file\((.*?)\)|\bsha1_file\((.*?)\)|\bhighlight_file\((.*?)\)|\bshow_source\((.*?)\)|\bphp_strip_whitespace\((.*?)\)|\bget_meta_tags\((.*?)\)/', $code, $v_writes);
        preg_match_all ('/\bmysql_connect\((.*?)\)|\bmysqli_connect\((.*?)\)/', $code, $v_sql);
        preg_match_all ('/\beval\((.*?)\)|\bassert\((.*?)\)|\bpreg_replace\((.*?)\)|\bcreate_function\((.*?)\)|\binclude\((.*?)\)|\binclude_once\((.*?)\)|\brequire\((.*?)\)|\brequire_once\((.*?)\)|\beval\((.*?)\)|\bexec\((.*?)\)|\bexpect_popen\((.*?)\)|\bpassthru\((.*?)\)|\bsystem\((.*?)\)|\bshell_exec\((.*?)\)|\bpopen\((.*?)\)|\bproc_open\((.*?)\)|\bpcntl_exec\((.*?)\)/', $code, $v_eval);
        preg_match_all ('/\bpcntl_alarm\((.*?)\)|\bpcntl_exec\((.*?)\)|\bpcntl_fork\((.*?)\)|\bpcntl_fork\((.*?)\)|\bpcntl_get_last_error\((.*?)\)|\bpcntl_getpriority\((.*?)\)|\bpcntl_setpriority\((.*?)\)|\bpcntl_signal\((.*?)\)|\bpcntl_signal_dispatch\((.*?)\)|\bpcntl_sigprocmask\((.*?)\)|\bpcntl_sigtimedwait\((.*?)\)|\bpcntl_sigwaitinfo\((.*?)\)|\bpcntl_strerror\((.*?)\)|\bpcntl_wait\((.*?)\)|\bpcntl_waitpid\((.*?)\)|\bpcntl_wexitstatus\((.*?)\)|\bpcntl_wifcontinued\((.*?)\)|\bpcntl_wifexited\((.*?)\)|\bpcntl_wifsignaled\((.*?)\)|\bpcntl_wifstopped\((.*?)\)|\bpcntl_wstopsig\((.*?)\)|\bpcntl_wtermsig\((.*?)\)/', $code, $v_process);
        preg_match_all ('/\bphpinfo\((.*?)\)|\bposix_mkfifo\((.*?)\)|\bposix_getlogin\((.*?)\)|\bposix_ttyname\((.*?)\)|\bgetenv\((.*?)\)|\bget_current_user\((.*?)\)|\bproc_get_status\((.*?)\)|\bget_cfg_var\((.*?)\)|\bdisk_free_space\((.*?)\)|\bdisk_total_space\((.*?)\)|\bdiskfreespace\((.*?)\)|\bgetcwd\((.*?)\)|\bgetlastmo\((.*?)\)|\bgetmygid\((.*?)\)|\bgetmyinode\((.*?)\)|\bgetmypid\((.*?)\)|\bgetmyuid\((.*?)\)/', $code, $v_info);
        preg_match_all ('/\beval\((.*?)\)|\bassert\((.*?)\)|\bstr_rot13\((.*?)\)|\bbase64_decode\((.*?)\)|\bgzinflate\((.*?)\)|\bgzuncompress\((.*?)\)|\bpreg_replace\((.*?)\)|\bchr\((.*?)\)|\bhexdec\((.*?)\)|\bdecbin\((.*?)\)|\bbindec\((.*?)\)|\bord\((.*?)\)|\bstr_replace\((.*?)\)|\bsubstr\((.*?)\)|\bgoto\((.*?)\)|\bunserialize\((.*?)\)|\btrim\((.*?)\)|\brtrim\((.*?)\)|\bltrim\((.*?)\)|\bexplode\((.*?)\)|\bstrchr\((.*?)\)|\bstrstr\((.*?)\)|\bchunk_split\((.*?)\)|\bstrtok\((.*?)\)|\baddcslashes\((.*?)\)|\brunkit_function_rename\((.*?)\)|\brename_function\((.*?)\)|\bcall_user_func_array\((.*?)\)|\bcall_user_func\((.*?)\)|\bregister_tick_function\((.*?)\)|\bregister_shutdown_function\((.*?)\)|\b/', $code, $v_obfuscate);
        preg_match_all ('/\bextract\((.*?)\)|\bparse_str  \((.*?)\)|\bputenv\((.*?)\)|\bini_set\((.*?)\)|\bmail\((.*?)\)|\bheader\((.*?)\)|\bproc_nice\((.*?)\)|\bproc_terminate\((.*?)\)|\bproc_close\((.*?)\)|\bpfsockopen\((.*?)\)|\bfsockopen\((.*?)\)|\bapache_child_terminate\((.*?)\)|\bposix_kill\((.*?)\)|\bposix_mkfifo\((.*?)\)|\bposix_setpgid\((.*?)\)|\bposix_setsid\((.*?)\)|\bposix_setuid\((.*?)\)/', $code, $v_other);

        if (!empty($v_selflock[0])) {

            $this->virus_branches[] = (object) [
                'file' => $file,
                'short_description' => "The pattern desired to be blocked",
                'description' => "The `" . join($v_selflock[0], ', ') . "` function is used when the template is being worked on and changes may harm the site. In this case the developers voluntarily block the template with antivirus software"
            ];

            return false;

        }

        if (!empty($v_rename[0])) {

            $this->virus_branches[] = (object) [
                'file' => $file,
                'short_description' => "The block calls the function renaming function. This method may be called to bypass filters for dangerous functions",
                'description' => "The `" . join($v_rename[0], ', ') . "` functions are not needed for most blocks, since all the necessary functions are passed to the environment and renaming any of the functions is unacceptable and pointless"
            ];

            return false;

        }

        if (!empty($v_writes[0])) {

            $this->virus_branches[] = (object) [
                'file' => $file,
                'short_description' => "The block attempts to write data to a file in an unsafe manner.",
                'description' => "The block tries to write to a file by using the `" . join($v_writes[0], ', ') . "` function. If you are a block developer, please read the documentation for safe use of the file system"
            ];

            return false;

        }

        if (!empty($v_sql[0])) {

            $this->virus_branches[] = (object) [
                'file' => $file,
                'short_description' => "The block tries to make an unsecure connection to the database by using the SQL function",
                'description' => "The block uses the `" . join($v_sql[0], ', ') . "` function to connect to the WordPress database. This is not a secure connection method, since the code can delete the database"
            ];

            return false;

        }

        if (!empty($v_eval[0])) {

            $this->virus_branches[] = (object) [
                'file' => $file,
                'short_description' => "The block tries to execute custom code.",
                'description' => "The `" . join($v_eval[0], ', ') . "` function is not secure. It often happens that programmers use it to create a \"Backdoor\". This function also has access to your shell"
            ];

            return false;

        }

        if (!empty($v_process[0])) {

            $this->virus_branches[] = (object) [
                'file' => $file,
                'short_description' => "The block tries to manage the process.",
                'description' => "Process control functions are not allowed for blocks. This block calls the functions `" . join($v_process[0], ', ') . "` who have access to process management"
            ];

            return false;

        }

        if (!empty($v_info[0])) {

            $this->virus_branches[] = (object) [
                'file' => $file,
                'short_description' => "The block tries to get information about your system.",
                'description' => "Functions `" . join($v_info[0], ', ') . "` they disclose information about your system and can make it much easier to attack other software. They can also become a source of confidential data leaks"
            ];

            return false;

        }

        if ($this->harshness > 0) {
            if (!empty($v_obfuscate[0])) {

                $this->virus_branches[] = (object) [
                    'file' => $file,
                    'short_description' => "An assumed attempt to obfuscate the code was found",
                    'description' => "This function `" . join($v_obfuscate[0], ', ') . "` often used to mask already known PHP-shell from antivirus programs and from prying eyes."
                ];

                return false;

            }
        }

        if ($this->harshness > 0) {

            if (!empty($v_other[0])) {

                $this->virus_branches[] = (object) [
                    'file' => $file,
                    'short_description' => "This is probably an PHP Exploit",
                    'description' => "The `" . join($v_other[0], ', ') . "` functions are often used in exploits that can break the entire system and steal your personal data"
                ];

                return false;

            }

        }

        $this->normal_branches[] = (object) [
            'file' => $file
        ];

        return true;

    }

    /**
     * Check the script for errors by using Runkit. In the standard distribution, the function is not used at all
     *
     * @param $file
     * @param $code
     * @return mixed
     */

    public function verify_php_errors ($file, $code) {

        if (function_exists('runkit_lint')) {
            return runkit_lint($code);
        }

    }

    /**
     * The function parses all the
     * code and checks to see if it can cause an error.
     * The function checks whether there is a class called in the code of the block,
     * whether there is a function, whether a method is declared for the class
     *
     * @param $file
     * @param $code
     * @return bool
     * @throws ReflectionException
     *
     * @executetime 0.0031 s
     * @executetime 0.006 s
     * @executetime 0.0018 s
     * @executetime 0.0006 s
     */

    public function verify_signature ($file=null, $code=null, $ignoreExistSignature=false) {

        if (MFile::exist($file . '.signature') and (((time() - MFile::recent_modify($file . '.signature')) / 60 / 60 / 24) < $this->time) and $ignoreExistSignature == false) {

            return true;

        } else {

            $signature = [];
            $classes = [];
            $verify = [];
            $countErrors = 0;

            foreach (token_get_all($code) as $token) {
                if (is_array($token)) {
                    $signature[$token[2]][token_name($token[0])] = $token[1];
                }
            }

            foreach ($signature as $line__ => $__) {

                if (isset($__['T_NEW'])) {

                    if (isset($__['T_VARIABLE'])) {

                        $classes[$__['T_VARIABLE']] = $__['T_STRING'];

                        if (class_exists($__['T_STRING'])) {

                            if (class_exists('ReflectionClass')) {

                                $reflection = new ReflectionClass($__['T_STRING']);
                                $verify[$line__]['class'][$reflection->getName()]['methods'] = $reflection->getMethods();
                                $verify[$line__]['class'][$reflection->getName()]['verify'] = time();
                                $verify[$line__]['class'][$reflection->getName()]['pass'] = false;;

                            } else {

                                $verify[$line__]['class'][$__['T_STRING']]['pass'] = true;

                                $this->virus_branches[] = (object) [
                                    'file' => $file,
                                    'short_description' => "Undeclared class called",
                                    'description' => "A class `" . $__['T_STRING'] . "` was called that was not previously declared in the current environment."
                                ];

                                $countErrors++;

                            }

                        } else {

                            $verify[$line__]['class'][$__['T_STRING']]['pass'] = true;

                            $this->virus_branches[] = (object) [
                                'file' => $file,
                                'short_description' => "Undeclared class called",
                                'description' => "A class `" . $__['T_STRING'] . "` was called that was not previously declared in the current environment."
                            ];

                            $countErrors++;

                        }

                    }

                } elseif (isset($__['T_OBJECT_OPERATOR'])) {

                    if (isset($classes[$__['T_VARIABLE']])) {

                        if (class_exists($classes[$__['T_VARIABLE']]) and method_exists($classes[$__['T_VARIABLE']], $__['T_STRING'])) {

                            if (class_exists('ReflectionClass')) {

                                $reflection = new ReflectionMethod($classes[$__['T_VARIABLE']], $__['T_STRING']);
                                $verify[$line__]['methods'][$classes[$__['T_VARIABLE']]][$__['T_STRING']]['params'] = $reflection->getParameters();
                                $verify[$line__]['methods'][$classes[$__['T_VARIABLE']]][$__['T_STRING']]['pass'] = false;

                            } else {

                                $verify[$line__]['methods'][$classes[$__['T_VARIABLE']]][$__['T_STRING']]['pass'] = true;

                                $this->virus_branches[] = (object) [
                                    'file' => $file,
                                    'short_description' => "Class has no method",
                                    'description' => "The program calls a method `" . $__['T_STRING'] . "` that is not declared for the class  `" . $classes[$__['T_VARIABLE']] . "` ."
                                ];

                                $countErrors++;

                            }

                        } else {

                            $verify[$line__]['methods'][$classes[$__['T_VARIABLE']]][$__['T_STRING']]['pass'] = true;

                            $this->virus_branches[] = (object) [
                                'file' => $file,
                                'short_description' => "Class has no method",
                                'description' => "The program calls a method `" . $__['T_STRING'] . "` that is not declared for the class  `" . $classes[$__['T_VARIABLE']] . "` ."
                            ];

                            $countErrors++;

                        }
                    }

                } elseif (isset($__['T_DOUBLE_COLON'])) {
                    // Ignore
                } elseif (isset($__['T_STRING']) and !empty($__['T_STRING']) and $__['T_STRING'] != 'null') {

                    if (function_exists($__['T_STRING'])) {

                        if (class_exists('ReflectionFunction')) {

                            $reflection = new ReflectionFunction($__['T_STRING']);

                            $verify[$line__]['functions'][$reflection->getName()]['params'] = $reflection->getParameters();
                            $verify[$line__]['functions'][$reflection->getName()]['verify'] = time();
                            $verify[$line__]['functions'][$reflection->getName()]['pass'] = false;;

                        } else {

                            $verify[$line__]['functions'][$__['T_STRING']]['pass'] = true;

                            $this->virus_branches[] = (object) [
                                'file' => $file,
                                'short_description' => "Undeclared function called",
                                'description' => "The program calls the function `" . $__['T_STRING'] . "` but it was not binding for the current environment"
                            ];

                            $countErrors++;

                        }

                    } elseif (defined($__['T_STRING'])) {

                        $verify[$line__]['constants'][$__['T_STRING']]['value'] = constant($__['T_STRING']);
                        $verify[$line__]['constants'][$__['T_STRING']]['verify'] = time();
                        $verify[$line__]['constants'][$__['T_STRING']]['pass'] = false;;

                    } else {

                        $verify[$line__]['functions'][$__['T_STRING']]['pass'] = true;

                        $this->virus_branches[] = (object) [
                            'file' => $file,
                            'short_description' => "Undeclared function called",
                            'description' => "The program calls the function `" . $__['T_STRING'] . "` but it was not binding for the current environment"
                        ];

                        $countErrors++;

                    }
                }

            }

            if ($countErrors > 0) {
                return False;
            } elseif ($countErrors == 0) {
                MFile::write($file . '.signature', json_encode($verify, JSON_PRETTY_PRINT));
                return true;
            }
        }

    }


    /**
     * Get information about investigated files
     *
     * @return object
     */

    public function info () {

        return (object) [
            'virus' => $this->virus_branches,
            'normal' => $this->normal_branches
        ];

    }

}
