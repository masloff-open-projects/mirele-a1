<?php


namespace Mirele\Framework;


class WPGNU
{

    function construct () {
        if(!class_exists( 'WP_List_Table' ) ) {
            require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
        }
    }

    static private function _WPTable () {
        $class = new class extends \WP_List_Table
        {

            private $bulk = array();
            private $bulkActions = array();
            private $columns = array();
            private $hidden_columns = array();
            private $sortable_columns = array();
            private $data = array();
            private $perPage = 10;
            private $actionOnID = array();

            public function __construct($props=array(
                'singular' => 'singular_form',
                'plural'   => 'plural_form',
                'ajax'     => true
            ))

            {

                global $status, $page;

                parent::__construct($props);
            }

            function display() {

                /**
                 * Adds a nonce field
                 */
                wp_nonce_field( 'ajax-custom-list-nonce', '_ajax_custom_list_nonce' );

                /**
                 * Adds field order and orderby
                 */
                echo '<input type="hidden" id="order" name="order" value="' . $this->_pagination_args['order'] . '" />';
                echo '<input type="hidden" id="orderby" name="orderby" value="' . $this->_pagination_args['orderby'] . '" />';

                parent::display();
            }

            public function render() {
                return $this->display();
            }


            /**
             * @param array $sortable_columns
             */
            public function setSortableColumns($sortable_columns)
            {
                $this->sortable_columns = (array) $sortable_columns;
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
            public function setActionsOnID($data=array())
            {
                $this->actionOnID = $data;
            }

            public function column_id ($item) {

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

                return sprintf('%1$s %2$s', $item['id'], $this->row_actions($actions) );
            }


            /**
             * @param array $data
             */
            public function appendData ($data)
            {
                return array_push($this->data, $data);
            }

            /**
             * @param mixed $hidden_columns
             */
            public function setHiddenColumns($hidden_columns)
            {
                $this->hidden_columns = (array) $hidden_columns;
            }

            /**
             * @param mixed $perPage
             */
            public function setPerPage($perPage)
            {
                $this->perPage = (integer) $perPage;
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

            public function process_bulk_action() {

                // security check!
                if ( isset( $_POST['_wpnonce'] ) && ! empty( $_POST['_wpnonce'] ) ) {

                    $nonce  = filter_input( INPUT_POST, '_wpnonce', FILTER_SANITIZE_STRING );
                    $action = 'bulk-' . $this->_args['plural'];

                    if ( ! wp_verify_nonce( $nonce, $action ) )
                        wp_die( 'Nope! Security check failed!' );

                }

                $action = $this->current_action();

                return;
            }

            function column_cb($item){
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
                usort( $data, array( &$this, 'sort_data' ) );

                $perPage = $this->perPage;
                $currentPage = $this->get_pagenum();
                $totalItems = count($data);

                $this->set_pagination_args( array(
                    'total_items' => $totalItems,
                    'per_page'    => $perPage,
                    'total_pages' => ceil($totalItems/$perPage)
                ) );

                $data = array_slice($data,(($currentPage-1)*$perPage),$perPage);

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
             * @param  Array $item        Data
             * @param  String $column_name - Current column name
             *
             * @return Mixed
             */
            protected function column_default( $item, $column_name )
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
            protected function sort_data( $a, $b )
            {
                // Set defaults
                $orderby = 'title';
                $order = 'asc';

                // If orderby is set, use this as the sort column
                if(!empty($_GET['orderby']))
                {
                    $orderby = $_GET['orderby'];
                }

                // If order is set use this as the order
                if(!empty($_GET['order']))
                {
                    $order = $_GET['order'];
                }


                $result = strcmp( $a[$orderby], $b[$orderby] );

                if($order === 'asc')
                {
                    return $result;
                }

                return -$result;
            }

            protected function get_bulk_actions() {
                return $this->bulk;
            }

        };
        return $class;
    }

    public static function Table () {
        return self::_WPTable();
    }


}