<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);



/*** Redux Framework ***/
require_once get_template_directory().'/admin/init.php';

/*** Theme Framework ***/
require_once get_template_directory().'/framework/init.php';	

function create_client_diary_post_type() {
    $labels = array(
        'name'               => _x( 'Client Diaries', 'post type general name', 'your-textdomain' ),
        'singular_name'      => _x( 'Client Diary', 'post type singular name', 'your-textdomain' ),
        'menu_name'          => _x( 'Client Diaries', 'admin menu', 'your-textdomain' ),
        'name_admin_bar'     => _x( 'Client Diary', 'add new on admin bar', 'your-textdomain' ),
        'add_new'            => _x( 'Add New', 'Client Diary', 'your-textdomain' ),
        'add_new_item'       => __( 'Add New Client Diary', 'your-textdomain' ),
        'new_item'           => __( 'New Client Diary', 'your-textdomain' ),
        'edit_item'          => __( 'Edit Client Diary', 'your-textdomain' ),
        'view_item'          => __( 'View Client Diary', 'your-textdomain' ),
        'all_items'          => __( 'All Client Diaries', 'your-textdomain' ),
        'search_items'       => __( 'Search Client Diaries', 'your-textdomain' ),
        'parent_item_colon'  => __( 'Parent Client Diaries:', 'your-textdomain' ),
        'not_found'          => __( 'No Client Diaries found.', 'your-textdomain' ),
        'not_found_in_trash' => __( 'No Client Diaries found in Trash.', 'your-textdomain' )
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'client-diary' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array( 'title', 'editor', 'thumbnail' ),
    );

    register_post_type( 'client_diary', $args );
}
add_action( 'init', 'create_client_diary_post_type' );
function enqueue_media_uploader() {
    wp_enqueue_media();
}
add_action( 'admin_enqueue_scripts', 'enqueue_media_uploader' );

function client_diary_admin_scripts() {
    wp_enqueue_script( 'client-diary-admin-script', get_template_directory_uri() . '/js/client-diary-admin.js', array('jquery'), null, true );
}
add_action( 'admin_enqueue_scripts', 'client_diary_admin_scripts' );

// Add custom meta boxes
function client_diary_add_meta_boxes() {
    add_meta_box(
        'client_diary_product_link',
        'Product Link',
        'client_diary_product_link_callback',
        'client_diary',
        'normal',
        'high'
    );

    add_meta_box(
        'client_diary_images',
        'Client Diary Images',
        'client_diary_images_callback',
        'client_diary',
        'normal',
        'high'
    );
}
add_action( 'add_meta_boxes', 'client_diary_add_meta_boxes' );

function client_diary_product_link_callback( $post ) {
    wp_nonce_field( 'save_client_diary_product_link', 'client_diary_product_link_nonce' );

    $value = get_post_meta( $post->ID, '_client_diary_product_link', true );

    echo '<label for="client_diary_product_link">Product Link: </label>';
    echo '<input type="url" id="client_diary_product_link" name="client_diary_product_link" value="' . esc_attr( $value ) . '" size="25" />';
}

function client_diary_images_callback( $post ) {
    wp_nonce_field( 'save_client_diary_images', 'client_diary_images_nonce' );

    $images = get_post_meta( $post->ID, '_client_diary_images', true );

    echo '<a href="#" class="upload-client-diary-images button button-primary">Upload Images</a>';
    echo '<ul id="client-diary-images-list">';
    if ( !empty( $images ) ) {
        foreach ( $images as $image ) {
            echo '<li><img src="' . esc_url( $image ) . '" style="max-width: 150px; max-height: 150px;" /><a href="#" class="remove-image">Remove</a><input type="hidden" name="client_diary_images[]" value="' . esc_url( $image ) . '" /></li>';
        }
    }
    echo '</ul>';
}

function save_client_diary_meta_boxes( $post_id ) {
    if ( ! isset( $_POST['client_diary_product_link_nonce'] ) || ! wp_verify_nonce( $_POST['client_diary_product_link_nonce'], 'save_client_diary_product_link' ) ) {
        return;
    }

    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['client_diary_product_link'] ) ) {
        update_post_meta( $post_id, '_client_diary_product_link', sanitize_text_field( $_POST['client_diary_product_link'] ) );
    }

    if ( ! isset( $_POST['client_diary_images_nonce'] ) || ! wp_verify_nonce( $_POST['client_diary_images_nonce'], 'save_client_diary_images' ) ) {
        return;
    }

    if ( isset( $_POST['client_diary_images'] ) ) {
        $images = array_map( 'esc_url', $_POST['client_diary_images'] );
        update_post_meta( $post_id, '_client_diary_images', $images );
    } else {
        delete_post_meta( $post_id, '_client_diary_images' );
    }
}
add_action( 'save_post', 'save_client_diary_meta_boxes' );

// Shortcode to display sold out products in grid format
function sold_out_products_shortcode() {
    ob_start();
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => -1,
        'meta_query' => array(
            array(
                'key' => '_stock_status',
                'value' => 'outofstock'
            )
        )
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) {
        echo '<ul class="products columns-5">'; // Added 'columns-5' class for 5 columns
        while ($query->have_posts()) : $query->the_post();
            wc_get_template_part('content', 'product'); // This loads the WooCommerce product template
        endwhile;
        echo '</ul>';
    } else {
        echo '<p>No sold-out products found.</p>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode('sold_out_products', 'sold_out_products_shortcode');


remove_action('wp_head', 'wp_generator');


add_filter('woocommerce_order_item_name', 'add_sku_to_order_email', 10, 3);

function add_sku_to_order_email($item_name, $item, $is_visible) {
    // Only modify email content
    if (is_admin()) return $item_name;

    $product = $item->get_product();
    if ($product && $product->get_sku()) {
        $sku = $product->get_sku();
        $item_name .= '<br><small><strong>SKU:</strong> ' . $sku . '</small>';
    }

    return $item_name;
}



add_filter( 'woocommerce_cart_calculate_fees', 'custom_mrp_based_shipping_fee', 20, 1 );

function custom_mrp_based_shipping_fee( $cart ) {
    if ( is_admin() && ! defined( 'DOING_AJAX' ) ) return;

    $total_mrp = $cart->get_subtotal(); // This is total price of products without coupons or shipping

    if ( $total_mrp <= 2000 ) {
        $fee = 150;
    } elseif ( $total_mrp <= 5000 ) {
        $fee = 250;
    } else {
        $fee = 0;
    }

    $cart->add_fee( 'Courier Charge', $fee, true );
}

add_action('init', function () {
    if (isset($_SERVER['QUERY_STRING']) && preg_match('/^goods\/.*\.html$/', $_SERVER['QUERY_STRING'])) {
        global $wp_query;
        $wp_query->set_404();
        status_header(404);
        nocache_headers();
        include(get_query_template('404'));
        exit;
    }
});




add_filter('woocommerce_get_image', 'force_product_image_alt_tag', 10, 5);

function force_product_image_alt_tag($image, $attachment_id, $size, $icon, $attr) {

        global $product;
        if ($product && $attachment_id) {
            $alt = esc_attr($product->get_name());
            
            // Inject alt into <img> tag
            $image = preg_replace('/alt="[^"]*"/', 'alt="' . $alt . '"', $image);
            if (!preg_match('/alt="[^"]*"/', $image)) {
                // Add alt if it doesn't exist
                $image = str_replace('<img ', '<img alt="' . $alt . '" ', $image);
            }
        }

    return $image;
}
