<?php
/**
 * Template Name: E-commerce Home
 * 
 * @package Graphedia
 */

get_header();
?>

<style>
/* Reset e estilos base */
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    line-height: 1.6;
    color: #333;
    background-color: #fafafa;
}

/* Navbar */
.navbar {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    padding: 1rem 0;
    position: sticky;
    top: 0;
    z-index: 1000;
}

.navbar-container {
    max-width: 1200px;
    margin: 0 auto;
    padding: 0 2rem;
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.logo {
    font-size: 1.8rem;
    font-weight: bold;
    color: #2563eb;
    text-decoration: none;
}

.logo:hover {
    color: #1d4ed8;
}

.nav-menu {
    display: flex;
    list-style: none;
    gap: 2rem;
    align-items: center;
}

.nav-menu a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    transition: color 0.3s;
}

.nav-menu a:hover {
    color: #2563eb;
}

.cart-icon {
    position: relative;
    font-size: 1.2rem;
}

.cart-count {
    position: absolute;
    top: -8px;
    right: -8px;
    background: #ef4444;
    color: white;
    border-radius: 50%;
    width: 20px;
    height: 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 0.75rem;
    font-weight: bold;
}

/* Hero Section */
.hero {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    text-align: center;
    padding: 4rem 2rem;
}

.hero h1 {
    font-size: 3rem;
    margin-bottom: 1rem;
    font-weight: 700;
}

.hero p {
    font-size: 1.2rem;
    margin-bottom: 2rem;
    opacity: 0.9;
}

.cta-button {
    background: white;
    color: #667eea;
    padding: 1rem 2rem;
    border-radius: 50px;
    text-decoration: none;
    font-weight: 600;
    transition: transform 0.3s;
    display: inline-block;
}

.cta-button:hover {
    transform: translateY(-2px);
}

/* Produtos */
.produtos-section {
    max-width: 1200px;
    margin: 0 auto;
    padding: 4rem 2rem;
}

.section-title {
    text-align: center;
    font-size: 2.5rem;
    margin-bottom: 3rem;
    color: #1f2937;
}

.produtos-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 2rem;
    margin-bottom: 3rem;
}

.produto-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
}

.produto-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.produto-imagem {
    width: 100%;
    height: 250px;
    object-fit: cover;
}

.produto-info {
    padding: 1.5rem;
}

.produto-titulo {
    font-size: 1.25rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #1f2937;
}

.produto-preco {
    font-size: 1.5rem;
    font-weight: bold;
    color: #2563eb;
    margin-bottom: 1rem;
}

.add-to-cart {
    background: #2563eb;
    color: white;
    border: none;
    padding: 0.75rem 1.5rem;
    border-radius: 8px;
    cursor: pointer;
    font-weight: 600;
    width: 100%;
    transition: background 0.3s;
}

.add-to-cart:hover {
    background: #1d4ed8;
}

/* Footer */
.footer {
    background: #1f2937;
    color: white;
    padding: 3rem 2rem 2rem;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
    gap: 2rem;
}

.footer-section h3 {
    margin-bottom: 1rem;
    color: #fbbf24;
}

.footer-section p, .footer-section a {
    color: #d1d5db;
    text-decoration: none;
    line-height: 1.8;
}

.footer-section a:hover {
    color: #fbbf24;
}

.footer-bottom {
    text-align: center;
    margin-top: 2rem;
    padding-top: 2rem;
    border-top: 1px solid #374151;
    color: #9ca3af;
}

/* Responsivo */
@media (max-width: 768px) {
    .navbar-container {
        flex-direction: column;
        gap: 1rem;
    }
    
    .nav-menu {
        gap: 1rem;
    }
    
    .hero h1 {
        font-size: 2rem;
    }
    
    .section-title {
        font-size: 2rem;
    }
    
    .produtos-grid {
        grid-template-columns: 1fr;
    }
}
</style>

<!-- Navbar -->
<nav class="navbar">
    <div class="navbar-container">
        <a href="<?php echo home_url(); ?>" class="logo">🛍️ ShopGraphedia</a>
        <ul class="nav-menu">
            <li><a href="<?php echo home_url(); ?>">Início</a></li>
            <li><a href="<?php echo wc_get_page_permalink('shop'); ?>">Produtos</a></li>
            <li><a href="<?php echo esc_url(graphedia_get_cart_url()); ?>" class="cart-icon">
                🛒
                <?php if (WC()->cart && WC()->cart->get_cart_contents_count() > 0): ?>
                    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                <?php endif; ?>
            </a></li>
        </ul>
    </div>
</nav>

<!-- Hero Section -->
<section class="hero">
    <h1>Bem-vindo à ShopGraphedia</h1>
    <p>Descubra produtos incríveis com qualidade e preços imbatíveis</p>
    <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="cta-button">Ver Produtos</a>
</section>

<!-- Produtos em Destaque -->
<section class="produtos-section">
    <h2 class="section-title">Produtos em Destaque</h2>
    <div class="produtos-grid">
        <?php
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 2,
            'orderby' => 'date',
            'order' => 'DESC',
        );
        $loop = new WP_Query($args);
        
        if ($loop->have_posts()) :
            while ($loop->have_posts()) : $loop->the_post();
                global $product;
                ?>
                <div class="produto-card">
                    <?php 
                    // Verificar se o produto tem imagem
                    if (has_post_thumbnail()) {
                        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium');
                        $image_alt = get_the_title();
                    } else {
                        // Tentar pegar a imagem do WooCommerce
                        $product_image_id = $product->get_image_id();
                        if ($product_image_id) {
                            $image_url = wp_get_attachment_image_url($product_image_id, 'medium');
                            $image_alt = get_the_title();
                        } else {
                            $image_url = 'https://via.placeholder.com/300x250/2563eb/ffffff?text=Produto';
                            $image_alt = 'Produto';
                        }
                    }
                    ?>
                    <img src="<?php echo esc_url($image_url); ?>" 
                         alt="<?php echo esc_attr($image_alt); ?>" 
                         class="produto-imagem">
                    
                    <div class="produto-info">
                        <h3 class="produto-titulo"><?php the_title(); ?></h3>
                        <div class="produto-preco">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                        <?php
                        echo apply_filters('woocommerce_loop_add_to_cart_link',
                            sprintf('<a href="%s" data-quantity="1" class="add-to-cart" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow">%s</a>',
                                esc_url($product->add_to_cart_url()),
                                esc_attr($product->get_id()),
                                esc_attr($product->get_sku()),
                                esc_attr($product->add_to_cart_description()),
                                esc_html($product->add_to_cart_text())
                            ),
                            $product
                        );
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
        else :
            echo '<p style="text-align: center; grid-column: 1 / -1;">Nenhum produto encontrado.</p>';
        endif;
        wp_reset_postdata();
        ?>
    </div>
</section>

<!-- Footer -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3>🛍️ ShopGraphedia</h3>
            <p>Sua loja online de confiança com produtos de qualidade e atendimento excepcional.</p>
        </div>
        
        <div class="footer-section">
            <h3>📞 Contato</h3>
            <p>📧 contato@shopgraphedia.com</p>
            <p>📱 (11) 99999-9999</p>
            <p>📍 Rua das Flores, 123 - São Paulo, SP</p>
        </div>
        
        <div class="footer-section">
            <h3>🔗 Links Úteis</h3>
            <p><a href="<?php echo wc_get_page_permalink('shop'); ?>">Produtos</a></p>
            <p><a href="<?php echo esc_url(graphedia_get_cart_url()); ?>">Carrinho</a></p>
            <p><a href="<?php echo wc_get_page_permalink('myaccount'); ?>">Minha Conta</a></p>
        </div>
        
        <div class="footer-section">
            <h3>⏰ Horário de Atendimento</h3>
            <p>Segunda a Sexta: 9h às 18h</p>
            <p>Sábado: 9h às 14h</p>
            <p>Domingo: Fechado</p>
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2024 ShopGraphedia. Todos os direitos reservados.</p>
    </div>
</footer>

<?php get_footer(); ?>