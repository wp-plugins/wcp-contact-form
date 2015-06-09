<?php

class SCFP_FormEntries extends Agp_Module {
    
    /**
     * @var object The single instance of the class 
     */
    protected static $_instance = null;    
    
	/**
	 * Main Instance
	 *
     * @return Visualizer
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;
	}    
    
	/**
	 * Cloning is forbidden.
	 */
	public function __clone() {
	}

	/**
	 * Unserializing instances of this class is forbidden.
	 */
	public function __wakeup() {
    }        
    
    public function __construct($baseDir) {
        parent::__construct($baseDir);        
        
        add_filter( 'post_row_actions', array( $this, 'changeRowActions' ), 10, 2 );        
        add_action( 'admin_menu', array( $this, 'disableNewPost' ) );                
        add_action( 'init', array( $this, 'customPostStatus' ) );   
        add_action( 'admin_footer-post.php', array( $this, 'appendPostStatusList' ) );        
        add_action( 'admin_footer-edit.php', array( $this, 'appendCustomBulkActions' ) );                
        add_filter( 'display_post_states', array( $this, 'displayUnreadState' ) ); 
        add_filter( 'bulk_actions-edit-form-entries', array( $this, 'changeBulkActions') );        
        add_action( 'load-post.php', array( $this, 'customActions' ) );       
        add_action( 'load-edit.php', array( $this, 'customBulkActions' ) );               
        add_action( 'admin_notices', array( $this, 'customAdminNotices' ) ); 
        add_filter( 'views_edit-form-entries', array( $this, 'changeViews') ); 
        
        add_action( 'admin_menu', array( $this, 'appendViewPage' ) ); 
        
        add_filter('manage_form-entries_posts_columns', array( $this, 'entrieColumns' ) );
        add_filter('manage_form-entries_posts_custom_column', array( $this, 'fillEntrieColumns' ) );
        add_filter('manage_edit-form-entries_sortable_columns', array( $this, 'addSortableColumns' ) );
        
        add_action( 'pre_get_posts', array( $this, 'manageEntriesPreGetPosts' ) );
        
        add_action( 'trashed_post', array( $this, 'redirectAfterTrashing' ), 10 );
        
        add_filter( 'get_edit_post_link', array( $this, 'getEditPostLink' ), 10, 3 );
        
        add_action( 'admin_init', array( $this, 'markRead' ));
    }

    
    public function appendViewPage () {
        add_submenu_page( 'admin.php', 'Entry', 'Entry', 'manage_options', 'view-entry', array( $this, 'displayViewPage' ) );        
    }
    
    public function displayViewPage () {
        if (!empty($_GET['post'])) {
            $post = get_post($_GET['post']);
            echo $this->getTemplate('admin/form-view', $post);    
        }
        
    }
    
    public function disableNewPost() {
        global $submenu;
        unset($submenu['edit.php?post_type=form-entries'][10]);

        if (isset($_GET['post_type']) && $_GET['post_type'] == 'form-entries') {
            echo '<style type="text/css">
            #favorite-actions, .add-new-h2 { display:none; }
            </style>';
        }
    }  
    
    public function customPostStatus(){
        register_post_status( 'read', array(
                'label'                     => _x( 'Read', 'form-entries' ),
                'public'                    => true,
                'exclude_from_search'       => true,
                'show_in_admin_all_list'    => true,
                'show_in_admin_status_list' => true,
                'label_count'               => _n_noop( 'Read <span class="count">(%s)</span>', 'Read <span class="count">(%s)</span>' ),
            ) 
        );
        
        register_post_status( 'unread', array(
                'label'                     => _x( 'Unread', 'form-entries' ),
                'public'                    => true,
                'exclude_from_search'       => true,
                'show_in_admin_all_list'    => true,
                'show_in_admin_status_list' => true,
                'label_count'               => _n_noop( 'Unread <span class="count">(%s)</span>', 'Unread <span class="count">(%s)</span>' ),
            ) 
        );
    }
    
    
    public function appendPostStatusList(){
        global $post;
        $unread_complete = $read_complete = '';
        $unread_label = $read_label = '';
        if($post->post_type == 'form-entries') :
            if($post->post_status == 'unread') {
                 $unread_complete = ' selected="selected"';
                 $unread_label = '<span id="post-status-display"> Unread</span>';
            }
            if($post->post_status == 'read') {
                 $read_complete = ' selected="selected"';
                 $read_label = '<span id="post-status-display"> Read</span>';
            }            
        ?>    
            <script type="text/javascript">
            jQuery(document).ready(function($){
                 $("select#post_status").append('<option value="unread"<?php echo $unread_complete; ?>>Unread</option>');
                 $(".misc-pub-section label").append('<?php echo $unread_label; ?>');
                 $("select#post_status").append('<option value="read"<?php echo $read_complete; ?>>Read</option>');
                 $(".misc-pub-section label").append('<?php echo $read_label; ?>');                 
            });
            </script>
        <?php            
        endif;
    }    
    
    public function appendCustomBulkActions () {
        global $post_type;

        if ($post_type == 'form-entries') {
            $post_status = !empty($_GET['post_status']) ? $_GET['post_status'] : '';
            
        ?>
            <script type="text/javascript">
            jQuery(document).ready(function($){
                <?php if (empty($post_status) || $post_status == 'unread' || $post_status == 'all') :?>
                    $('<option>').val('read').text('<?php _e('Mark as Read')?>').insertBefore("select[name='action'] option[value=trash]");
                    $('<option>').val('read').text('<?php _e('Mark as Read')?>').insertBefore("select[name='action2'] option[value=trash]");
                <?php endif;?>                        
                <?php if (empty($post_status) || $post_status == 'read' || $post_status == 'all') :?>
                    $('<option>').val('unread').text('<?php _e('Mark as Unread')?>').insertBefore("select[name='action'] option[value=trash]");
                    $('<option>').val('unread').text('<?php _e('Mark as Unread')?>').insertBefore("select[name='action2'] option[value=trash]");
                <?php endif;?>                        
            });
            </script>
        <?php
        }        
    }
    
    public function displayUnreadState( $states ) {
        global $post;
        $arg = get_query_var( 'post_status' );
        if( $arg != 'unread' ){
             if($post->post_status == 'unread'){
                  return array('Unread');
             }
        }
        return $states;
    }

    
    public function changeRowActions( $actions, $post ) {
        if ( get_post_type() === 'form-entries' ) {
            $post_status = !empty($_GET['post_status']) ? $_GET['post_status'] : '';
            $res = array();                            
            switch ($post_status) {
                case '':
                case 'all':                    
                case 'read':
                case 'unread':             
                    $res['view'] = '<a title="View" href="'.admin_url( 'admin.php?post='. $post->ID .'&page=view-entry' ).'">View</a>';
                    if ($post->post_status == 'unread') {
                        $res['read'] = '<a title="Mark as Read" href="'.admin_url( 'post.php?post='. $post->ID .'&action=read'.(!empty($post_status) ? '&post_status='.$post_status : '') ).'">Mark as Read</a>';    
                    } else {
                        $res['unread'] = '<a title="Mark as Unread" href="'.admin_url( 'post.php?post='. $post->ID .'&action=unread'.(!empty($post_status) ? '&post_status='.$post_status : '') ).'">Mark as Unread</a>';    
                    }
                    $res['trash'] = $actions['trash'];                
                    break;
                default :
                    $res = $actions;
                    break;
            }
            
            $actions = $res;
        }
        return $actions;
    }        
    
    public function changeBulkActions ($actions) {
        $post_status = !empty($_GET['post_status']) ? $_GET['post_status'] : '';
        switch ($post_status) {
            case '':
            case 'all':                                    
            case 'read':                
            case 'unread':                
                $res = array(
                    'trash' => $actions['trash'],                
                );
                break;
            default :
                $res = $actions;
                break;
        }
        return $res;
    }

    public function customActions () {
        $post_id = !empty($_GET['post']) ? $_GET['post'] : NULL;        
        $action = !empty($_GET['action']) ? $_GET['action'] : NULL;        
        $post_status = !empty($_GET['post_status']) ? $_GET['post_status'] : NULL;        
        
        switch ($action) {
            case 'read':
                if (!empty($post_id)) {
                    $post = get_post($post_id);
                    
                    $args = array(
                        'ID' => $post_id,
                        'post_status' => 'read',
                    );
                    wp_update_post($args);
                    
                    $count_posts = wp_count_posts($post->post_type);
                    $sendback = add_query_arg( array('post_type' => $post->post_type), admin_url( 'edit.php' ) );
                    if (!empty($post_status) && $count_posts->$post_status > 0) {
                        $sendback = add_query_arg( array('post_status' => $post_status), $sendback );    
                    }
                    $sendback = add_query_arg( array('readed' => 1, 'ids' => $post_id ), $sendback );                        
                    
                    wp_redirect($sendback);
                    exit();                
                }
                break;
            case 'unread':
                if (!empty($post_id)) {
                    $post = get_post($post_id);

                    $args = array(
                        'ID' => $post_id,
                        'post_status' => 'unread',
                    );
                    wp_update_post($args);
                    
                    $count_posts = wp_count_posts($post->post_type);
                    $sendback = add_query_arg( array('post_type' => $post->post_type), admin_url( 'edit.php' ) );
                    if (!empty($post_status) && $count_posts->$post_status > 0) {
                        $sendback = add_query_arg( array('post_status' => $post_status), $sendback );    
                    }
                    $sendback = add_query_arg( array('unreaded' => 1, 'ids' => $post_id ), $sendback );                        
                    
                    wp_redirect($sendback);
                    exit();                
                }
                break;
        }
    }

    public function customBulkActions() {
        $post_ids = !empty($_GET['post']) ? $_GET['post'] : NULL;
        $post_type = !empty($_GET['post_type']) ? $_GET['post_type'] : NULL;
        
        if (!empty($post_ids)) {
            check_admin_referer('bulk-posts');
            $action = ($_GET['action'] == -1) ? $_GET['action2'] : $_GET['action'];
            
            switch($action) {
                case 'read':
                    $process = 0;
                    foreach( $post_ids as $post_id ) {
                        $post = get_post($post_id);                        
                        
                        $args = array(
                            'ID' => $post_id,
                            'post_status' => 'read',
                        );
                        wp_update_post($args);
                        $process++;
                    }

                    $count_posts = wp_count_posts($post_type);
                    $sendback = add_query_arg( array('post_type' => $post_type), admin_url( 'edit.php' ) );
                    if (!empty($post_status) && $count_posts->$action > 0) {
                        $sendback = add_query_arg( array('post_status' => $action), $sendback );    
                    }
                    $sendback = add_query_arg( array('readed' => $process, 'ids' => join(',', $post_ids) ), $sendback );                        
                    
                    wp_redirect($sendback);
                    exit();                 
                    break;
                case 'unread':
                    $process = 0;
                    foreach( $post_ids as $post_id ) {
                        $post = get_post($post_id);                        
                        
                        $args = array(
                            'ID' => $post_id,
                            'post_status' => 'unread',
                        );
                        wp_update_post($args);
                        $process++;
                    }

                    $count_posts = wp_count_posts($post_type);
                    $sendback = add_query_arg( array('post_type' => $post_type), admin_url( 'edit.php' ) );
                    if (!empty($post_status) && $count_posts->$action > 0) {
                        $sendback = add_query_arg( array('post_status' => $action), $sendback );    
                    }
                    $sendback = add_query_arg( array('unreaded' => $process, 'ids' => join(',', $post_ids) ), $sendback );                        
                    
                    wp_redirect($sendback);
                    exit();                 
                    break;                
                default: return;
            }
        }
    }
    
        
    public function customAdminNotices() {

        global $post_type, $pagenow;

        if ( $pagenow == 'edit.php' && $post_type == 'form-entries' ) {
            if (isset($_REQUEST['readed']) && (int) $_REQUEST['readed'] > 1) {
                $message = $_REQUEST['readed'] . ' entries was marked as Read';
                echo '<div class="updated"><p>'.$message.'</p></div>';
            } elseif (isset($_REQUEST['readed']) && (int) $_REQUEST['readed'] = 1) {
                $message = $_REQUEST['readed'] . ' entry was marked as Read';
                echo '<div class="updated"><p>'.$message.'</p></div>';
            } elseif (isset($_REQUEST['unreaded']) && (int) $_REQUEST['unreaded'] > 1) {
                $message = $_REQUEST['unreaded'] . ' entries was marked as Unread';
                echo '<div class="updated"><p>'.$message.'</p></div>';
            } elseif (isset($_REQUEST['unreaded']) && (int) $_REQUEST['unreaded'] = 1) {
                $message = $_REQUEST['unreaded'] . ' entry was marked as Unread';
                echo '<div class="updated"><p>'.$message.'</p></div>';
            }
        }
    }    

    public function changeViews ($views) {
        global $post_type, $pagenow;
        if ( $pagenow == 'edit.php' && $post_type == 'form-entries' ) {

            $key = 'trash';
            if (array_key_exists($key, $views)) {
                $value = $views[$key];
                unset($views[$key]);
                array_unshift($views, $value);
            }            

            $key = 'read';
            if (array_key_exists($key, $views)) {
                $value = $views[$key];
                unset($views[$key]);
                array_unshift($views, $value);
            }                        
            
            $key = 'unread';
            if (array_key_exists($key, $views)) {
                $value = $views[$key];
                unset($views[$key]);
                array_unshift($views, $value);
            }                                    
            
            $key = 'all';
            if (array_key_exists($key, $views)) {
                $value = $views[$key];
                unset($views[$key]);
                array_unshift($views, $value);
            }                                                
        }
        
        return $views;
    }

    public function entrieColumns( $columns ){
        unset( $columns['title'] );

        $fields = SCFP_Form::getFormFields();
        
        $results['cb'] = '<input type="checkbox" />';
        
        $results['title'] = 'ID';
        
        if( !empty( $fields['name'] ) ){
            $results['name'] = 'Name';
        }
        
        if( !empty( $fields['email'] ) ){
            $results['email'] = 'Email';
        }
        
        if( !empty( $fields['phone'] ) ){
            $results['phone'] = 'Phone';
        }
        
        if( !empty( $fields['subject'] ) ){
            $results['subject'] = 'Subject';
        }
        $results['date'] = $columns['date']; 

        return $results;
    }
    
    public function fillEntrieColumns( $column ){
        global $post;
        
        switch ( $column ) {
            
            case 'title' :
                echo get_post_meta( $post->ID, 'entry_id', true );
                break;
            
            case 'name' :
                echo get_post_meta( $post->ID, 'scfp_name', true );
                break;            
            
            case 'subject' :
                echo get_post_meta($post->ID, 'scfp_subject', true);
                break;

            case 'email' :
                echo get_post_meta($post->ID, 'scfp_email', true);
                break;
            
            case 'phone' :
                echo get_post_meta($post->ID, 'scfp_phone', true);
                break;
        }
    }
    
    public function addSortableColumns($sortable_columns){
        $sortable_columns['id'] = 'id';
        $sortable_columns['subject'] = 'subject';
        $sortable_columns['email'] = 'email';
        $sortable_columns['phone'] = 'phone';
        $sortable_columns['name'] = 'name';
        $sortable_columns['date'] = 'date';
        
        return $sortable_columns;
    }
    
    public function manageEntriesPreGetPosts($query){
        if( ! is_admin() )
        return;
 
        $orderby = $query->get( 'orderby');

        if( 'entry_id' == $orderby ) {
            $query->set('meta_key','entry_id');
            $query->set('orderby','meta_value_num');
        }
      
    }
    
    public function getEntryId($post_id){
        return get_post_meta( $post_id, 'entry_id', true );
    }
    
    public function redirectAfterTrashing( $post_id ) {
        global $pagenow;

        if( get_post_type( $post_id ) == 'form-entries' && $pagenow == 'post.php'){
            wp_redirect( admin_url("edit.php?post_type=form-entries") );
            exit;
        }
    }
    
    public function getEditPostLink($link, $post_id, $context) {
        global $pagenow;
        
        if( get_post_type( $post_id ) == 'form-entries' && $pagenow == 'edit.php'){
            $link = admin_url( 'admin.php?post='. $post_id .'&page=view-entry' );
        }
        
        return $link;
    }
    
    public function markRead($a) {
        global $pagenow ;
        if ($pagenow == 'admin.php' && !empty($_REQUEST['page']) && $_REQUEST['page'] == 'view-entry') {
            if (!empty($_REQUEST['post'])) {
                wp_update_post( array(
                        'ID'           => $_REQUEST['post'],
                        'post_status'   =>  'read',
                    )
                );                            
            }    
        }
        
    }
}

