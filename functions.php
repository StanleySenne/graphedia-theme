<?php
/**
 * Graphedia E-commerce functions and definitions
 *
 * @package Graphedia
 */

// Prevenir acesso direto ao arquivo
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Configurações do tema - Função principal de setup
 */
function graphedia_setup() {
    // Suporte a título dinâmico do WordPress
    add_theme_support('title-tag');
    
    // Suporte a logo personalizada no customizer
    add_theme_support('custom-logo', array(
        'height'      => 100, // Altura máxima da logo
        'width'       => 400, // Largura máxima da logo
        'flex-height' => true, // Permite altura flexível
        'flex-width'  => true, // Permite largura flexível
    ));
    
    // Suporte a miniaturas de post (featured images)
    add_theme_support('post-thumbnails');
    
    // Suporte a HTML5 para elementos específicos
    add_theme_support('html5', array(
        'search-form', // Formulário de busca
        'comment-form', // Formulário de comentários
        'comment-list', // Lista de comentários
        'gallery', // Galeria de imagens
        'caption', // Legendas
        'style', // Tags de estilo
        'script', // Tags de script
    ));
    
    // Suporte completo ao WooCommerce
    add_theme_support('woocommerce'); // Suporte básico
    add_theme_support('wc-product-gallery-zoom'); // Zoom na galeria de produtos
    add_theme_support('wc-product-gallery-lightbox'); // Lightbox na galeria
    add_theme_support('wc-product-gallery-slider'); // Slider na galeria
    
    // Registrar menus de navegação
    register_nav_menus(array(
        'primary' => esc_html__('Menu Principal', 'graphedia'), // Menu principal do site
        'footer'  => esc_html__('Menu Rodapé', 'graphedia'), // Menu do rodapé
    ));
}
add_action('after_setup_theme', 'graphedia_setup'); // Executa após o tema ser carregado

/**
 * Registrar scripts e estilos - Carrega CSS e JS
 */
function graphedia_scripts() {
    // Estilo principal do tema
    wp_enqueue_style('graphedia-style', get_stylesheet_uri(), array(), '1.0.0');
    
    // Google Fonts - Fonte Inter para o tema
    wp_enqueue_style('graphedia-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap', array(), null);
    
    // Script principal do tema
    wp_enqueue_script('graphedia-script', get_template_directory_uri() . '/js/main.js', array('jquery'), '1.0.0', true);
    
    // Localizar script para AJAX - Dados para JavaScript
    wp_localize_script('graphedia-script', 'graphedia_ajax', array(
        'ajax_url' => admin_url('admin-ajax.php'), // URL para requisições AJAX
        'nonce'    => wp_create_nonce('graphedia_nonce'), // Token de segurança
    ));
}
add_action('wp_enqueue_scripts', 'graphedia_scripts'); // Executa no frontend

/**
 * Registrar sidebars - Áreas de widgets
 */
function graphedia_widgets_init() {
    // Sidebar principal do site
    register_sidebar(array(
        'name'          => esc_html__('Sidebar Principal', 'graphedia'), // Nome da sidebar
        'id'            => 'sidebar-1', // ID único da sidebar
        'description'   => esc_html__('Adicione widgets aqui.', 'graphedia'), // Descrição
        'before_widget' => '<section id="%1$s" class="widget %2$s">', // HTML antes do widget
        'after_widget'  => '</section>', // HTML depois do widget
        'before_title'  => '<h2 class="widget-title">', // HTML antes do título
        'after_title'   => '</h2>', // HTML depois do título
    ));
    
    // Sidebar específica para WooCommerce
    register_sidebar(array(
        'name'          => esc_html__('Sidebar WooCommerce', 'graphedia'), // Nome da sidebar
        'id'            => 'sidebar-woocommerce', // ID único da sidebar
        'description'   => esc_html__('Sidebar para páginas do WooCommerce.', 'graphedia'), // Descrição
        'before_widget' => '<section id="%1$s" class="widget %2$s">', // HTML antes do widget
        'after_widget'  => '</section>', // HTML depois do widget
        'before_title'  => '<h2 class="widget-title">', // HTML antes do título
        'after_title'   => '</h2>', // HTML depois do título
    ));
}
add_action('widgets_init', 'graphedia_widgets_init'); // Executa na inicialização de widgets

/**
 * Customizar WooCommerce - Configurações específicas do e-commerce
 */
function graphedia_woocommerce_setup() {
    // Remover estilos padrão do WooCommerce para usar os nossos
    add_filter('woocommerce_enqueue_styles', '__return_empty_array');
    
    // Adicionar suporte a funcionalidades da galeria de produtos
    add_theme_support('woocommerce-product-gallery-zoom'); // Zoom nas imagens
    add_theme_support('woocommerce-product-gallery-lightbox'); // Lightbox
    add_theme_support('woocommerce-product-gallery-slider'); // Slider
    
    // Adicionar suporte a templates personalizados do WooCommerce
    add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'graphedia_woocommerce_setup'); // Executa após setup do tema

/**
 * Customizar número de produtos por página - Configuração da loja
 */
function graphedia_products_per_page() {
    return 12; // Retorna 12 produtos por página
}
add_filter('loop_shop_per_page', 'graphedia_products_per_page'); // Filtro do WooCommerce

/**
 * Customizar número de colunas de produtos - Layout da grade
 */
function graphedia_loop_columns() {
    return 3; // Retorna 3 colunas de produtos
}
add_filter('loop_shop_columns', 'graphedia_loop_columns'); // Filtro do WooCommerce

/**
 * Adicionar classe personalizada ao body - Para estilização específica
 */
function graphedia_body_classes($classes) {
    if (is_woocommerce() || is_cart() || is_checkout() || is_account_page()) { // Verifica se é página do WooCommerce
        $classes[] = 'woocommerce-page'; // Adiciona classe para estilização
    }
    
    return $classes; // Retorna classes modificadas
}
add_filter('body_class', 'graphedia_body_classes'); // Filtro das classes do body

/**
 * Adicionar suporte a WooCommerce AJAX - Funcionalidade de adicionar ao carrinho
 */
function graphedia_add_to_cart_ajax() {
    check_ajax_referer('graphedia_nonce', 'nonce'); // Verifica token de segurança
    
    $product_id = intval($_POST['product_id']); // ID do produto (convertido para inteiro)
    $quantity   = intval($_POST['quantity']); // Quantidade (convertida para inteiro)
    
    $result = WC()->cart->add_to_cart($product_id, $quantity); // Adiciona ao carrinho
    
    if ($result) { // Se adicionou com sucesso
        wp_send_json_success(array(
            'message' => 'Product added to cart', // Mensagem de sucesso
            'cart_count' => WC()->cart->get_cart_contents_count(), // Contador de itens
        ));
    } else { // Se houve erro
        wp_send_json_error('Erro ao adicionar produto ao carrinho.'); // Mensagem de erro
    }
}
add_action('wp_ajax_graphedia_add_to_cart', 'graphedia_add_to_cart_ajax'); // Para usuários logados
add_action('wp_ajax_nopriv_graphedia_add_to_cart', 'graphedia_add_to_cart_ajax'); // Para usuários não logados

/**
 * Função para obter a URL da página do carrinho personalizada - Sistema de fallback
 */
function graphedia_get_cart_url() {
    // Primeiro, tenta encontrar a página pelo slug 'carrinho'
    $cart_page = get_page_by_path('carrinho'); // Busca página pelo slug
    
    if ($cart_page) { // Se encontrou a página
        return get_permalink($cart_page->ID); // Retorna URL da página
    }
    
    // Se não encontrar, tenta pelo título
    $cart_page = get_page_by_title('Carrinho'); // Busca página pelo título
    
    if ($cart_page) { // Se encontrou a página
        return get_permalink($cart_page->ID); // Retorna URL da página
    }
    
    // Se não encontrar, usa a URL padrão do WooCommerce
    return wc_get_cart_url(); // Fallback para URL padrão
}

/**
 * Adicionar parâmetros do carrinho para JavaScript - Dados para AJAX do carrinho
 */
function graphedia_cart_params() {
    if (is_page_template('cart.php')) { // Se estiver na página do carrinho
        wp_localize_script('graphedia-script', 'wc_cart_params', array(
            'ajax_url' => admin_url('admin-ajax.php'), // URL para AJAX
            'update_cart_nonce' => wp_create_nonce('update_cart_nonce'), // Token para atualizar
            'remove_cart_nonce' => wp_create_nonce('remove_cart_nonce') // Token para remover
        ));
    }
}
add_action('wp_enqueue_scripts', 'graphedia_cart_params'); // Executa no carregamento de scripts

/**
 * AJAX para atualizar quantidade do carrinho - Funcionalidade de atualizar quantidade
 */
function graphedia_update_cart_ajax() {
    check_ajax_referer('update_cart_nonce', 'security'); // Verifica token de segurança
    
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']); // Chave do item no carrinho
    $quantity = intval($_POST['quantity']); // Nova quantidade
    
    if ($quantity <= 0) { // Se quantidade for 0 ou menor
        // Remove item do carrinho
        WC()->cart->remove_cart_item($cart_item_key);
    } else { // Se quantidade for maior que 0
        // Atualiza quantidade do item
        WC()->cart->set_quantity($cart_item_key, $quantity);
    }
    
    // Recalcula totais do carrinho
    WC()->cart->calculate_totals();
    
    wp_send_json_success(array(
        'message' => 'Cart updated successfully' // Mensagem de sucesso
    ));
}
add_action('wp_ajax_woocommerce_update_cart', 'graphedia_update_cart_ajax'); // Para usuários logados
add_action('wp_ajax_nopriv_woocommerce_update_cart', 'graphedia_update_cart_ajax'); // Para usuários não logados

/**
 * AJAX para remover item do carrinho - Funcionalidade de remover item
 */
function graphedia_remove_cart_item_ajax() {
    check_ajax_referer('remove_cart_nonce', 'security'); // Verifica token de segurança
    
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']); // Chave do item no carrinho
    
    WC()->cart->remove_cart_item($cart_item_key); // Remove item do carrinho
    WC()->cart->calculate_totals(); // Recalcula totais
    
    wp_send_json_success(array(
        'message' => 'Item removido com sucesso' // Mensagem de sucesso
    ));
}
add_action('wp_ajax_woocommerce_remove_cart_item', 'graphedia_remove_cart_item_ajax'); // Para usuários logados
add_action('wp_ajax_nopriv_woocommerce_remove_cart_item', 'graphedia_remove_cart_item_ajax'); // Para usuários não logados 