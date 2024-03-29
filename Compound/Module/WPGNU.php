<?php


namespace Mirele\Framework;

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');
}

/**
 * Class TT_Example_List_Table
 * @package Mirele\Framework
 */
class TT_Example_List_Table extends \WP_List_Table
{

    /**
     * Displays the search box.
     *
     * @param string $text The 'submit' button label.
     * @param string $input_id ID attribute value for the search input field.
     * @since 3.1.0
     *
     */
//    public function search_box($text, $input_id)
//    {
//        return parent::search_box($text, $input_id); // TODO: Change the autogenerated stub
//    }

    /**
     * TT_Example_List_Table constructor.
     */
    function __construct()
    {
        global $status, $page;

        //Set parent defaults
        parent::__construct(array(
            'singular' => 'page',     //singular name of the listed records
            'plural' => 'pages',    //plural name of the listed records
            'ajax' => false       //does this table support ajax?
        ));

    }

    /**
     * @param object $item
     * @param string $column_name
     * @return mixed|string|void
     */
    function column_default($item, $column_name)
    {
        switch ($column_name) {
            case 'status':
                return $item->post_status;
            case 'rating':
            case 'date':
                $_format = !empty($format) ? $format : get_option('date_format');
                $the_date = get_post_time($_format, false, $item, true);
                return apply_filters('get_the_date', $the_date, '', $item);
            case 'comments':
                if ($item->comment_count > 0) {
                    return $item->comment_count;
                } else {
                    return '—';
                }
            case 'author':
                $user = get_userdata($item->post_author);
                return $user->user_login;
            case 'director':
                return $item->{$column_name};
            default:
                if (isset($item->{$column_name})) {
                    return $item->{$column_name}; //Show the whole array for troubleshooting purposes
                }
        }
    }

    /**
     * @param $item
     * @return string
     */
    function column_title($item)
    {

        //Build row actions
        $actions = array(
            'edit' => sprintf('<a href="?page=%s&action=%s&page_id=%s">Edit</a>', $_REQUEST['page'], 'edit', $item->ID),
            'delete' => sprintf('<a href="?page=%s&action=%s&page_id=%s">Delete</a>', $_REQUEST['page'], 'delete', $item->ID),
        );

        //Return the title contents
        return sprintf('%1$s <span style="color:silver">(id:%2$s)</span>%3$s',
            /*$1%s*/ $item->post_title,
            /*$2%s*/ $item->ID,
            /*$3%s*/ $this->row_actions($actions)
        );
    }

    /**
     * @param object $item
     * @return string|void
     */
    function column_cb($item)
    {
        return sprintf(
            '<input type="checkbox" name="%1$s[]" value="%2$s" />',
            /*$1%s*/ $this->_args['singular'],  //Let's simply repurpose the table's singular label ("page")
            /*$2%s*/ $item->ID                //The value of the checkbox should be the record's id
        );
    }

    /**
     * @return array|string[]
     */
    function get_columns()
    {
        $columns = array(
            'cb' => '<input type="checkbox" />',
            'title' => 'Title',
            'status' => 'Status',
            'author' => 'Author',
            'comments' => '<span class="dashicons dashicons-admin-comments"></span>',
            'date' => 'Date',
        );
        return $columns;
    }


    /**
     * @return array|array[]
     */
    function get_sortable_columns()
    {
        $sortable_columns = array(
            'title' => array('title', false),
            'status' => array('status', false),
            'author' => array('author', false),
            'date' => array('date', false)
        );
        return $sortable_columns;
    }

    /**
     * @return array|string[]
     */
    function get_bulk_actions()
    {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    /**
     *
     */
    function process_bulk_action()
    {

        //Detect when a bulk action is being triggered...
        if ('delete' === $this->current_action()) {
            wp_die('Items deleted (or they would be if we had items to delete)!');
        }

    }

    /**
     *
     */
    function prepare_items()
    {
        global $wpdb; //This is used only if making any database queries

        /**
         * First, lets decide how many records per page to show
         */
        $per_page = 14;


        /**
         * REQUIRED. Now we need to define our column headers. This includes a complete
         * array of columns to be displayed (slugs & titles), a list of columns
         * to keep hidden, and a list of columns that are sortable. Each of these
         * can be defined in another method (as we've done here) before being
         * used to build the value for our _column_headers property.
         */
        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();


        /**
         * REQUIRED. Finally, we build an array to be used by the class for column
         * headers. The $this->_column_headers property takes an array which contains
         * 3 other arrays. One for all columns, one for hidden columns, and one
         * for sortable columns.
         */
        $this->_column_headers = array($columns, $hidden, $sortable);


        /**
         * Optional. You can handle your bulk actions however you see fit. In this
         * case, we'll handle them within our package just to keep things clean.
         */
        $this->process_bulk_action();


        /**
         * Instead of querying a database, we're going to fetch the example data
         * property we created for use in this plugin. This makes this example
         * package slightly different than one you might build on your own. In
         * this example, we'll be using array manipulation to sort and paginate
         * our data. In a real-world implementation, you will probably want to
         * use sort and pagination data to build a custom query instead, as you'll
         * be able to use your precisely-queried data immediately.
         */
        $data = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => COMPOUND_CANVAS
        ));

        /**
         * REQUIRED for pagination. Let's figure out what page the user is currently
         * looking at. We'll need this later, so you should always include it in
         * your own package classes.
         */
        $current_page = $this->get_pagenum();

        /**
         * REQUIRED for pagination. Let's check how many items are in our data array.
         * In real-world use, this would be the total number of items in your database,
         * without filtering. We'll need this later, so you should always include it
         * in your own package classes.
         */
        $total_items = count($data);

        /**
         * The WP_List_Table class does not handle pagination for us, so we need
         * to ensure that the data is trimmed to only the current page. We can use
         * array_slice() to
         */
        $data = array_slice($data, (($current_page - 1) * $per_page), $per_page);

        /**
         * REQUIRED. Now we can add our *sorted* data to the items property, where
         * it can be used by the rest of the class.
         */
        $this->items = $data;


        /**
         * REQUIRED. We also have to register our pagination options & calculations.
         */
        $this->set_pagination_args(array(
            'total_items' => $total_items,                  //WE have to calculate the total number of items
            'per_page' => $per_page,                     //WE have to determine how many items to show on a page
            'total_pages' => ceil($total_items / $per_page)   //WE have to calculate the total number of pages
        ));
    }

}

/**
 * Class WPGNU
 * @package Mirele\Framework
 */
class WPGNU
{

    /**
     *
     */
    function construct()
    {
        if (!class_exists('WP_List_Table')) {
            require_once(ABSPATH.'wp-admin/includes/class-wp-list-table.php');
        }
    }

    /**
     * @return \WP_List_Table|__anonymous@8654
     */
    static private function _WPTable()
    {
        $class = new class extends \WP_List_Table {

            private $bulk = array();
            private $bulkActions = array();
            private $columns = array();
            private $hidden_columns = array();
            private $sortable_columns = array();
            private $data = array();
            private $perPage = 10;
            private $actionOnID = array();

            public function __construct($props = array(
                'singular' => 'singular_form',
                'plural' => 'plural_form',
                'ajax' => true
            ))

            {

                global $status, $page;

                parent::__construct($props);
            }

            function display()
            {

                /**
                 * Adds a nonce field
                 */
                wp_nonce_field('ajax-custom-list-nonce', '_ajax_custom_list_nonce');

                /**
                 * Adds field order and orderby
                 */
                echo '<input type="hidden" id="order" name="order" value="' . $this->_pagination_args['order'] . '" />';
                echo '<input type="hidden" id="orderby" name="orderby" value="' . $this->_pagination_args['orderby'] . '" />';

                parent::display();
            }

            public function render()
            {
                return $this->display();
            }


            /**
             * @param array $sortable_columns
             */
            public function setSortableColumns($sortable_columns)
            {
                $this->sortable_columns = (array)$sortable_columns;
            }

            /**
             * @param array $bulk
             */
            public function setBulk(array $bulk)
            {
                $this->bulk = $bulk;
            }

            /**
             * @param array
             */
            public function setActionsOnID($data = array())
            {
                $this->actionOnID = $data;
            }

            public function column_id($item)
            {

                foreach ($this->actionOnID as $type => $data) {
                    $actions[$type] = str_replace([
                        "{ID}",
                        "{URL}",
                        "{PAGE}",
                    ], [
                        $item['id'],
                        MIRELE_URL,
                        MIRELE_GET['page']
                    ], $data);
                }

                return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions));
            }


            /**
             * @param array $data
             */
            public function appendData($data)
            {
                return array_push($this->data, $data);
            }

            /**
             * @param mixed $hidden_columns
             */
            public function setHiddenColumns($hidden_columns)
            {
                $this->hidden_columns = (array)$hidden_columns;
            }

            /**
             * @param mixed $perPage
             */
            public function setPerPage($perPage)
            {
                $this->perPage = (integer)$perPage;
            }

            /**
             * @param mixed $columns
             */
            public function setColumns($columns)
            {
                $this->columns = $columns;
            }

            /**
             * @param mixed $data
             */
            public function setData($data)
            {
                $this->data = $data;
            }

            public function process_bulk_action()
            {

                // security check!
                if (isset($_POST['_wpnonce']) && !empty($_POST['_wpnonce'])) {

                    $nonce = filter_input(INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING);
                    $action = 'bulk-' . $this->_args['plural'];

                    if (!wp_verify_nonce($nonce, $action))
                        wp_die('Nope! Security check failed!');

                }

                $action = $this->current_action();

                return;
            }

            function column_cb($item)
            {
                return sprintf(
                    '<input type="checkbox" name="%1$s[]" value="%2$s" />',
                    /*$1%s*/ $this->_args['singular'],
                    /*$2%s*/ isset($item['id']) ? $item['id'] : (isset($item['ID']) ? $item['ID'] : (''))
                );
            }

            /**
             * Prepare the items for the table to process
             *
             * @return Void
             */
            public function prepare_items()
            {
                $columns = $this->get_columns();
                $hidden = $this->get_hidden_columns();
                $sortable = $this->get_sortable_columns();

                $data = $this->table_data();
                usort($data, array(&$this, 'sort_data'));

                $perPage = $this->perPage;
                $currentPage = $this->get_pagenum();
                $totalItems = count($data);

                $this->set_pagination_args(array(
                    'total_items' => $totalItems,
                    'per_page' => $perPage,
                    'total_pages' => ceil($totalItems / $perPage)
                ));

                $data = array_slice($data, (($currentPage - 1) * $perPage), $perPage);

                $this->_column_headers = array($columns, $hidden, $sortable);
                $this->items = $data;

                $this->process_bulk_action();

            }

            /**
             * Override the parent columns method. Defines the columns to use in your listing table
             *
             * @return Array
             */
            public function get_columns()
            {
                return $this->columns;
            }

            /**
             * Define which columns are hidden
             *
             * @return Array
             */
            public function get_hidden_columns()
            {
                return $this->hidden_columns;
            }

            /**
             * Define the sortable columns
             *
             * @return Array
             */
            protected function get_sortable_columns()
            {
                return $this->sortable_columns;
            }

            /**
             * Get the table data
             *
             * @return Array
             */
            protected function table_data()
            {
                return $this->data;
            }

            /**
             * Define what data to show on each column of the table
             *
             * @param Array $item Data
             * @param String $column_name - Current column name
             *
             * @return Mixed
             */
            protected function column_default($item, $column_name)
            {
                if (isset($item[$column_name]) === true) {
                    return $item[$column_name];
                } else {
                    return 'undefined';
                }
            }

            /**
             * Allows you to sort the data by the variables set in the $_GET
             *
             * @return Mixed
             */
            protected function sort_data($a, $b)
            {
                // Set defaults
                $orderby = 'post_title';
                $order = 'asc';

                // If orderby is set, use this as the sort column
                if (!empty($_GET['orderby'])) {
                    $orderby = $_GET['orderby'];
                }

                // If order is set use this as the order
                if (!empty($_GET['order'])) {
                    $order = $_GET['order'];
                }


                $result = strcmp($a[$orderby], $b[$orderby]);

                if ($order === 'asc') {
                    return $result;
                }

                return -$result;
            }

            protected function get_bulk_actions()
            {
                return $this->bulk;
            }

        };
        return $class;
    }

    /**
     * @return __anonymous|\WP_List_Table|__anonymous@8717
     */
    public static function Table()
    {
        return self::_WPTable();
    }


}