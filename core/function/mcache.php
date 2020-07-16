<?php

/**
 * Abbreviated entry for (new MCache)->set()
 *
 * @author: Mirele
 * @version: 1.0.0
 * @param string $key
 * @param string $value
 * @return mixed|string
 */

function mc_set ($key='default', $value='default') {
    return (new MCache)->set(empty($key) ? 'default' : $key, empty($value) ? 'default' : $value);
}

/**
 * Abbreviated entry for (new MCache)->get()
 *
 * @author: Mirele
 * @version: 1.0.0
 * @param string $key
 * @return bool|mixed
 */

function mc_get ($key='default') {
    return (new MCache)->get(empty($key) ? 'default' : $key);
}

/**
 * Abbreviated entry for (new MCache)->execute()
 *
 * @author: Mirele
 * @version: 1.0.0
 * @param string $key
 * @param null $function
 * @return bool|mixed|string
 */

function mc_execute ($key='default', $function=null) {
    return (new MCache)->execute(empty($key) ? 'default' : $key, is_callable($function) ? $function : function () { return null; });
}