<?php

/**
 * Class MPager
 *
 * The function responsible for the generation of the page "Quick use".
 * these pages do not require splitting into several large files,
 * which is why they are successfully placed in a class where
 * they are provided with small instructions to facilitate content generation
 *
 *
 * * WP admin page controller
 * * Attention! Not all pages are routed through this page manager.
 *
 * @version: 1.0.0
 * @author: Mirele
 */

class MPager
{

    private $dependencies = array ();

    /**
     * A function that returns a void.
     * Needed to drown out some routing cases.
     */

    static public function void () {

    }


    /**
     * Function to register the page.
     * A function, html code, text, number,
     * or any value that can be displayed on
     * pages is expected as content.
     * This function can also take a value to do do_action
     *
     * @param string $page
     * @param null $content
     */

    public function register ($page='null', $content=null) {
        $this->dependencies[$page][] = $content;
    }


    /**
     * Function to render the page.
     * It loops through the array and
     * checks the values ​​against the types of data received.
     * You can register the page
     * as: function, HTML code, plain text, parameter for do_action
     *
     * @param string $page
     */

    public function execute ($page='null') {
        if (isset($this->dependencies[$page])) {

            if (is_array($this->dependencies[$page]) or is_object($this->dependencies[$page])) {
                foreach ($this->dependencies[$page] as $part) {
                    if (is_array($part) or is_object($part)) {
                        foreach ($part as $do_action) {
                            if (is_callable($do_action)) {
                                echo call_user_func($do_action, (object) array(
                                    'self' => self::class,
                                    'this' => $this
                                ));
                            } else {
                                if (has_action($do_action)) {
                                    echo do_action ($do_action);
                                }
                            }
                        }
                    } elseif (is_callable($part)) {

                        echo call_user_func($part, (object) array(
                            'self' => self::class,
                            'this' => $this,
                            'class' => new MPager()
                        ));

                    } elseif (has_action($part)) {

                        echo do_action ($part);

                    } else {

                        echo htmlspecialchars_decode($part);

                    }
                }
            } elseif (is_callable($this->dependencies[$page])) {
                echo call_user_func($this->dependencies[$page], (object) array(
                    'self' => self::class,
                    'this' => $this,
                    'class' => new MPager()
                ));
            }


        }
    }


    /**
     * A tool for generating settings.
     * The Mirele system has functions for quick and convenient generation
     * of settings that give arrays with a set of parameters.
     * To make it easier for the system to generate data arrays
     * in the usual and familiar settings in the form of HTML
     * forms this function is used
     *
     * @param $fluids
     * @param $id
     * @version: 1.0.0
     * @author: Mirele
     */

    static public function ui_settings ($fluids=null, $id=null, $formAttr='method="post" enctype="multipart/form-data" action="options.php"') {

        global $msettings;

        ?>

        <form <?php echo $formAttr; ?>>

            <?php settings_fields($fluids); ?>

            <div class="wrap">
                <div class="root">

                    <?php if (!empty($msettings->get($id))): ?>

                        <?php foreach ($msettings->get($id) as $settings_group): ?>

                        <?php foreach ($settings_group as $title => $group): ?>

                            <table width="100%" class="mirele-settings-element">
                                <tbody>
                                    <tr>
                                        <td width="45%" valign="top" class="m-title">
                                            <label>
                                                <?php echo $title; ?>
                                            </label>

                                            <?php if (isset($group['service-note'])): ?>

                                                <br> <small><?php echo $group['service-note']; ?></small>

                                            <?php endif; ?>

                                        </td>
                                        <td width="55%" valign="top" class="m-option">
                                            <?php foreach ($group as $id => $element): ?>

                                                <?php if ($id == 'service-note'): continue; endif; ?>

                                                <?php if ($element['type'] == 'radio'): ?>

                                                    <div>

                                                        <?php if(isset($element['text'])): ?>
                                                            <p><?php echo $element['text']; ?></p>
                                                        <?php endif; ?>

                                                        <?php foreach ($element['value'] as $v): ?>

                                                            <p>
                                                                <input type="<?php echo $element['type']; ?>" name="<?php echo $id; ?>"
                                                                       value="<?php echo is_array($v) ? $v['value'] : $v; ?>" <?php echo get_option($id, isset($element['default']) ? $element['default'] : 'false') == (is_array($v) ? $v['value'] : $v) ? 'checked' : '' ?>>
                                                                <?php echo is_array($v) ? $v['text'] : $v; ?>
                                                            </p>

                                                        <?php endforeach; ?>

                                                    </div>

                                                <?php elseif ($element['type'] == 'select'): ?>

                                                    <?php if(isset($element['text'])): ?>
                                                        <p><?php echo $element['text']; ?></p>
                                                    <?php endif; ?>

                                                    <select name="<?php echo $id; ?>">

                                                        <?php foreach ($element['value'] as $v): ?>

                                                            <option value="<?php echo is_array($v) ? $v['value'] : $v; ?>" <?php echo get_option($id, isset($element['default']) ? $element['default'] : 'false') == (is_array($v) ? $v['value'] : $v) ? 'selected' : '' ?>>
                                                                <?php echo is_array($v) ? $v['text'] : $v; ?>
                                                            </option>

                                                        <?php endforeach; ?>

                                                    </select>


                                                <?php elseif ($element['type'] == 'range'): ?>

                                                    <?php $value = (object) $element['value']; ?>

                                                    <?php if(isset($element['text'])): ?>
                                                        <p><?php echo $element['text']; ?></p>
                                                    <?php endif; ?>

                                                    <input name="<?php echo $id; ?>" list="tickmarks_<?php echo $id; ?>" type="range" min="<?php echo isset($value->min) ? $value->min : 0 ?>" max="<?php echo isset($value->max) ? $value->max : 0 ?>" step="<?php echo isset($value->step) ? $value->step : 1 ?>" value="<?php echo isset($value->value) ? $value->value : 0 ?>" width="100%">

                                                    <datalist id="tickmarks_<?php echo $id; ?>">

                                                        <?php if(is_numeric(isset($value->min) ? $value->min : 0) and is_numeric(isset($value->max) ? $value->max : 0)): ?>
                                                        <?php for ($i = (isset($value->min) ? $value->min : 0); $i <= (isset($value->max) ? $value->max : 0); $i++): ?>
                                                        <option value="<?php echo $i; ?>" label="<?php echo $i; ?>">
                                                            <?php endfor; ?>
                                                            <?php endif; ?>

                                                    </datalist>

                                                <?php elseif ($element['type'] == 'mirele_theme_render'): ?>

                                                    <div>

                                                        <?php if(isset($element['text'])): ?>
                                                            <p><?php echo $element['text']; ?></p>
                                                        <?php endif; ?>

                                                        <?php foreach ($element['value'] as $id__ => $render): ?>

                                                            <div>

                                                                <p>
                                                                    <input name="<?php echo isset($element['option']) ? $element['option'] : $render->type; ?>" type="radio"
                                                                           value="<?php echo $id__; ?>"
                                                                        <?php echo get_option(isset($element['option']) ? $element['option'] : $render->type, isset($element['default']) ? $element['default'] : 'false') == $id__ ? 'checked' : '' ?>>
                                                                        <?php echo isset($render->title) ? $render->title : $render->type; ?> </input>
                                                                </p>

                                                                <?php if (isset($render->description)): ?>

                                                                    <small style="width: 390px; display: block;"><?php echo $render->description; ?></small>

                                                                <?php endif; ?>

                                                            </div>

                                                        <?php endforeach; ?>

                                                    </div>


                                                <?php elseif ($element['type'] == 'function'): ?>

                                                    <?php

                                                    if (is_callable($element['value'])) {
                                                        echo call_user_func($element['value'], $id);
                                                    }

                                                    ?>

                                                <?php elseif ($element['type'] == 'wp-text'): ?>

                                                    <div>
                                                        <h5 class="wp-text-h5">
                                                            <?php echo $element['text']; ?>
                                                        </h5>

                                                        <input type="text" name="<?php echo $id; ?>"
                                                               value="<?php echo $element['value']; ?>"
                                                               class="input">

                                                    </div>

                                                <?php elseif ($element['type'] == 'wp-textarea'): ?>

                                                    <div>
                                                        <h5 class="wp-text-h5">
                                                            <?php echo $element['text']; ?>
                                                        </h5>

                                                        <textarea type="text" name="<?php echo $id; ?>" class="input" cols="50" rows="8" <?php echo isset($element['hint']) ? 'data-hint="' . $element['hint'] . '"' : '' ?>><?php echo $element['value']; ?></textarea>

                                                        <?php if (isset($element['hints'])): ?>

                                                            <small>
                                                                <?php echo $element['hints']; ?>
                                                            </small>

                                                        <?php endif; ?>

                                                    </div>

                                                <?php elseif ($element['type'] == 'breadcrumbs'): ?>

                                                    <div>
                                                        <small><?php echo isset($element['main']) ? $element['main'] : 'Main' ?></small>
                                                        <?php foreach ($element['value'] as $link): ?>
                                                            <small> /
                                                                <a href="#breadcrumb-<?php echo $link; ?>"><?php echo $link; ?></a>
                                                            </small>
                                                        <?php endforeach; ?>
                                                    </div>

                                                <?php elseif ($element['type'] == 'checkbox'): ?>

                                                    <div>

                                                        <input type='hidden' value='false' name='<?php echo $id; ?>'>

                                                        <label class="switch">
                                                            <input type="checkbox" name="<?php echo $id; ?>" value="<?php echo $element['value']; ?>" <?php echo get_option($id, isset($element['default']) ? $element['default'] : 'false') == $element['value'] ? 'checked' : '' ?>>
                                                            <span class="slider round"></span>
                                                        </label>

                                                        <p>
                                                            <?php echo $element['text']; ?>
                                                        </p>

                                                    </div>

                                                <?php else: ?>

                                                    <div>

                                                        <p>
                                                            <input type='hidden' value='false' name='<?php echo $id; ?>'>

                                                            <input type="<?php echo $element['type']; ?>" name="<?php echo $id; ?>"
                                                                   value="<?php echo $element['value']; ?>" <?php echo get_option($id, isset($element['default']) ? $element['default'] : 'false') == $element['value'] ? 'checked' : '' ?>>
                                                            <?php echo $element['text']; ?>
                                                        </p>

                                                    </div>

                                                <?php endif; ?>

                                                <?php if (isset($element['note'])): ?>

                                                    <small>
                                                        <?php echo $element['note']; ?>
                                                    </small>

                                                <?php endif; ?>

                                            <?php endforeach; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                        <?php endforeach; ?>

                    <?php endforeach; ?>

                    <?php else: ?>

                        <h3>Settings not register</h3>

                    <?php endif; ?>

                </div>

                <hr style="margin-top: 24px">

                <input type="submit" value="Save the settings" class="button-primary">

            </div>

        </form>

        <?php

    }


    /**
     * Function for easy registration of the tab bar.
     * The tab bar will display inside .wrap > .root
     *
     * @param array $list
     */

    static public function ui_tabs ($list=array()) {

        global $recent_tabs_object;

        if (empty($recent_tabs_object)) {
            $recent_tabs_object = array();
        }

        if (isset($list) and is_array($list)) {
            ?> <nav class="nav-tab-wrapper woo-nav-tab-wrapper"> <?php
           foreach ($list as $tab) {

               $tab = is_array($tab) ? (object) $tab : (object) array (
                   'content' => $tab,
                   'id' => $tab
               );

               $recent_tabs_object[$tab->id] = $tab;

               $get = $_GET;
               if (in_array('tab', $get)) {
                   unset($get['tab']);
               }

               ?>

                   <a href="<?php echo  MIRELE_URL . "?" . http_build_query($get) . "&tab=" . (isset($tab->id) ? $tab->id : 'default') ?>" class="nav-tab <?php echo  $_GET['tab'] == (isset($tab->id) ? $tab->id : 'default') ? 'nav-tab-active' : '' ?>">
                       <?php echo  isset($tab->content) ? $tab->content : 'default' ?>
                   </a>

               <?php

           }
           ?> </nav> <?php
        }

    }

    static public function ui_filer_tabs ($list=array(), $attrForm='') {

        global $recent_filter_tabs_object;

        if (empty($recent_filter_tabs_object)) {
            $recent_filter_tabs_object = array();
        }

        ?>

        <div class="wp-filter">

            <ul class="filter-links">
                <?php if (isset($list) and is_array($list)): ?>
                    <?php foreach ($list as $item): ?>

                        <?php

                        $get = $_GET;
                        if (in_array('subtab', $get)) {
                            unset($get['subtab']);
                        }

                        $item = is_array($item) ? (object) $item : (object) array (
                            'content' => $item,
                            'id' => $item
                        );

                        $recent_filter_tabs_object[$item->id] = $item;

                        ?>

                        <li class="plugin-install-featured">
                            <a href="<?php echo MIRELE_URL . "?" . http_build_query($get) . "&subtab=" . (isset($item->id) ? $item->id : 'default') ?>" <?php echo (isset($_GET['subtab']) ? $_GET['subtab'] : 'default') == (isset($item->id) ? $item->id : 'default') ? 'class="current"' : '' ?> aria-current="page">
                                <?php echo  isset($item->content) ? $item->content : 'default' ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endif; ?>
            </ul>

            <form class="search-form" method="get" <?php echo $attrForm ?>>
                <input type="hidden" name="tab" value="search">
                <label class="screen-reader-text" for="typeselector">Search by:</label>

                <label><span class="screen-reader-text">Search</span>
                    <input type="search" name="s" value="" class="wp-filter-search" placeholder="Search...">
                </label>

                <input type="submit" id="search-submit" class="button" value="Search">

                <input type="hidden" name="tab" value="<?php echo isset($_GET['tab']) ? $_GET['tab'] : 'default' ?>">
                <input type="hidden" name="page" value="<?php echo isset($_GET['page']) ? $_GET['page'] : 'default' ?>">
                <input type="hidden" name="subtab" value="<?php echo isset($_GET['subtab']) ? $_GET['subtab'] : 'default' ?>">
                <input type="hidden" name="option_page" value="filter_tabs">

            </form>

        </div>

        <?php

    }

    /**
     * Function to get information about the current tab.
     * May accept an alternative parameter $_GET.
     * Based on it, the function draws conclusions
     *
     * @param bool $other_get
     * @return object
     */

    static public function ui_current_tab ($other_get=false) {

        global $recent_tabs_object;

        if ($other_get and is_array($other_get) and isset($other_get['tab'])) {

            return (object) array(
                'id' => $other_get['tab'],
                'tab' => isset ($recent_tabs_object[$other_get['tab']]) ? $recent_tabs_object[$other_get['tab']] : (object) array()
            );

        } elseif (isset($_GET['tab'])) {

            return (object) array(
                'id' => $_GET['tab'],
                'tab' => isset ($recent_tabs_object[$_GET['tab']]) ? $recent_tabs_object[$_GET['tab']] : (object) array()
            );

        } else {

            return (object) array(
                'id' => 'main',
                'tab' => isset ($recent_tabs_object['main']) ? $recent_tabs_object['main'] : (object) array()
            );

        }
    }

    static public function ui_current_filer_tab ($other_get=false) {

        global $recent_filter_tabs_object;

        if ($other_get and is_array($other_get) and isset($other_get['subtab'])) {

            return (object) array(
                'id' => $other_get['subtab'],
                'tab' => isset ($recent_filter_tabs_object[$other_get['subtab']]) ? $recent_filter_tabs_object[$other_get['subtab']] : (object) array()
            );

        } elseif (isset($_GET['subtab'])) {

            return (object) array(
                'id' => $_GET['subtab'],
                'tab' => isset ($recent_filter_tabs_object[$_GET['subtab']]) ? $recent_filter_tabs_object[$_GET['subtab']] : (object) array()
            );

        } else {

            return (object) array(
                'id' => 'main',
                'tab' => isset ($recent_filter_tabs_object['main']) ? $recent_filter_tabs_object['main'] : (object) array()
            );

        }
    }


    /**
     * Function for simplified registration
     * of content as part of a function to get
     * it from the frontend by using the `data-mpager-part` attribute
     *
     * @param null $id
     * @param bool $content
     */

    static public function ui_part ($id=null, $content=false) {

        global $majax;
        $majax->register_ajax("mui_$id", $content);

    }

} 