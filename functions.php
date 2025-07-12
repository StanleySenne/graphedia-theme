<?php
/**
 * Graphedia E-commerce functions and definitions
 *
 * @package Graphedia
 */

// Prevenir acesso direto
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configurações do tema
 */
function graphedia_setup() {
    // Suporte a título dinâmico
    add_theme_support('title-tag');
    
    // Suporte a logo personalizada
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 400,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    
    // Suporte a miniaturas de post
    add_theme_support('post-thumbnails');
    
    // Suporte a HTML5
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    ));
    
    // Suporte a WooCommerce
    add_theme_support('woocommerce');
    add_theme_support('wc-product-gallery-zoom');
    add_theme_support('wc-product-gallery-lightbox');
    add_theme_support('wc-product-gallery-slider');
    
    // Registrar menus
    register_nav_menus(array(
        'primary' => esc_html__('Menu Principal', 'graphedia'),
        'footer'  => esc_html__('Menu Rodapé', 'graphedia'),
    ));
}
add_action('after_setup_theme', 'graphedia_setup');

/**
 * Registrar scripts e estilos
 */
function graphedia_scripts() {
    // Estilo principal
    wp_enqueue_style('graphedia-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Google Fonts
    wp_enqueue_style('graphedia-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Script principal
    wp_enqueue_script('graphedia-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localizar script para AJAX
    wp_localize_script('graphedia-script', 'graphedia_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'nonce'    => wp_create_nonce('graphedia_nonce'),
    ));
}
add_action('wp_enqueue_scripts', 'graphedia_scripts');

/**
 * Registrar sidebars
 */
function graphedia_widgets_init() {
    register_sidebar(array(
        'name'          => esc_html__('Sidebar Principal', 'graphedia'),
        'id'            => 'sidebar-1',
        'description'   => esc_html__('Adicione widgets aqui.', 'graphedia'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
    
    register_sidebar(array(
        'name'          => esc_html__('Sidebar WooCommerce', 'graphedia'),
        'id'            => 'sidebar-woocommerce',
        'description'   => esc_html__('Sidebar para páginas do WooCommerce.', 'graphedia'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2>',
    ));
}
add_action('widgets_init', 'graphedia_widgets_init');

/**
 * Customizar WooCommerce
 */
function graphedia_woocommerce_setup() {
    // Remover estilos padrão do WooCommerce
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    
    // Adicionar suporte a miniaturas de produto
    add_theme_support('woocommerce-product-gallery-zoom');
    add_theme_support('woocommerce-product-gallery-lightbox');
    add_theme_support('woocommerce-product-gallery-slider');
    
    // Adicionar suporte a templates personalizados
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'graphedia_woocommerce_setup');

/**
 * Customizar número de produtos por página
 */
function graphedia_products_per_page() {
    return 12;
}
add_filter('loop_shop_per_page', 'graphedia_products_per_page');

/**
 * Customizar número de colunas de produtos
 */
function graphedia_loop_columns() {
    return 3;
}
add_filter('loop_shop_columns', 'graphedia_loop_columns');

/**
 * Adicionar classe personalizada ao body
 */
function graphedia_body_classes($classes) {
    if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) {
        $classes[] = 'woocommerce-page';
    }
    
    return $classes;
}
add_filter('body_class', 'graphedia_body_classes');

/**
 * Adicionar suporte a WooCommerce AJAX
 */
function graphedia_add_to_cart_ajax() {
    check_ajax_referer('graphedia_nonce', 'nonce');
    
    $product_id = intval($_POST['product_id']);
    $quantity   = intval($_POST['quantity']);
    
    $result = WC()->cart->add_to_cart($product_id, $quantity);
    
    if ($result) {
        wp_send_json_success(array(
            'message' => 'Produto adicionado ao carrinho!',
            'cart_count' => WC()->cart->get_cart_contents_count(),
        ));
    } else {
        wp_send_json_error('Erro ao adicionar produto ao carrinho.');
    }
}
add_action('wp_ajax_graphedia_add_to_cart', 'graphedia_add_to_cart_ajax');
add_action('wp_ajax_nopriv_graphedia_add_to_cart', 'graphedia_add_to_cart_ajax');

/**
 * Função para obter a URL da página do carrinho personalizada
 */
function graphedia_get_cart_url() {
    // Primeiro, tenta encontrar a página pelo slug 'carrinho'
    $cart_page = get_page_by_path('carrinho');
    
    if ($cart_page) {
        return get_permalink($cart_page->ID);
    }
    
    // Se não encontrar, tenta pelo título
    $cart_page = get_page_by_title('Carrinho');
    
    if ($cart_page) {
        return get_permalink($cart_page->ID);
    }
    
    // Se não encontrar, usa a URL padrão do WooCommerce
    return wc_get_cart_url();
}

/**
 * Adicionar parâmetros do carrinho para JavaScript
 */
function graphedia_cart_params() {
    if (is_page_template('cart.php')) {
        wp_localize_script('graphedia-script', 'wc_cart_params', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'update_cart_nonce' => wp_create_nonce('update_cart_nonce'),
            'remove_cart_nonce' => wp_create_nonce('remove_cart_nonce')
        ));
    }
}
add_action('wp_enqueue_scripts', 'graphedia_cart_params');

/**
 * AJAX para atualizar quantidade do carrinho
 */
function graphedia_update_cart_ajax() {
    check_ajax_referer('update_cart_nonce', 'security');
    
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    $quantity = intval($_POST['quantity']);
    
    if ($quantity <= 0) {
        // Se quantidade for 0 ou menor, remover item
        WC()->cart->remove_cart_item($cart_item_key);
    } else {
        // Atualizar quantidade
        WC()->cart->set_quantity($cart_item_key, $quantity);
    }
    
    // Calcular totais
    WC()->cart->calculate_totals();
    
    wp_send_json_success(array(
        'message' => 'Carrinho atualizado com sucesso'
    ));
}
add_action('wp_ajax_woocommerce_update_cart', 'graphedia_update_cart_ajax');
add_action('wp_ajax_nopriv_woocommerce_update_cart', 'graphedia_update_cart_ajax');

/**
 * AJAX para remover item do carrinho
 */
function graphedia_remove_cart_item_ajax() {
    check_ajax_referer('remove_cart_nonce', 'security');
    
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    
    WC()->cart->remove_cart_item($cart_item_key);
    WC()->cart->calculate_totals();
    
    wp_send_json_success(array(
        'message' => 'Item removido com sucesso'
    ));
}
add_action('wp_ajax_woocommerce_remove_cart_item', 'graphedia_remove_cart_item_ajax');
add_action('wp_ajax_nopriv_woocommerce_remove_cart_item', 'graphedia_remove_cart_item_ajax'); 