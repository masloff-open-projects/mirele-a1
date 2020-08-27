<?php

/**
 * MWPUI independent class for working with WordPress elements.
 * It makes it easy to work with standard rendering classes of UI WordPress elements,
 * such as tables, lists, etc.
 */

namespace Mirele\Framework;

require_once MIRELE_CORE_DIR  . '/ui/mwpui/table.php';

class MWPUI
{

    static public function Table () {
        return new _WPTable ();
    }

}