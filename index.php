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
    position: relative;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    transition: all 0.3s ease;
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.1) 0%, rgba(59, 130, 246, 0.1) 100%);
    border: 2px solid transparent;
}

.logo:hover {
    color: #1d4ed8;
    transform: translateY(-2px);
    box-shadow: 0 4px 15px rgba(37, 99, 235, 0.2);
    border-color: rgba(37, 99, 235, 0.3);
    background: linear-gradient(135deg, rgba(37, 99, 235, 0.15) 0%, rgba(59, 130, 246, 0.15) 100%);
}

.logo::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #2563eb, #3b82f6);
    border-radius: 6px;
    opacity: 0;
    transition: opacity 0.3s ease;
    z-index: -1;
}

.logo:hover::before {
    opacity: 0.1;
}

/* Estilo para logo em formato de imagem */
.logo img {
    max-height: 40px;
    width: auto;
    transition: transform 0.3s ease;
}

.logo:hover img {
    transform: scale(1.05);
}

/* Animação de entrada para o logo */
@keyframes logoFadeIn {
    from {
        opacity: 0;
        transform: translateY(-10px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.logo {
    animation: logoFadeIn 0.6s ease-out;
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

/* Quem Somos - Nova seção */
.quem-somos {
    max-width: 1200px;
    margin: 0 auto;
    padding: 4rem 2rem;
    background: linear-gradient(135deg, #f8fafc 0%, #e2e8f0 100%);
}

.quem-somos-container {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 5rem;
    align-items: center;
    max-width: 1000px;
    margin: 0 auto;
}

.quem-somos-imagem {
    position: relative;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    height: 500px;
}

.quem-somos-imagem img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.quem-somos-imagem:hover img {
    transform: scale(1.05);
}

.quem-somos-conteudo {
    padding-left: 1rem;
}

.quem-somos-conteudo h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #1f2937;
    margin-bottom: 2rem;
    position: relative;
}

.quem-somos-conteudo h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(90deg, #2563eb, #3b82f6);
    border-radius: 2px;
}

.quem-somos-conteudo p {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #4b5563;
    margin-bottom: 1.5rem;
}

.quem-somos-conteudo .destaque {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    padding: 1.5rem 2rem;
    border-radius: 12px;
    font-weight: 600;
    display: inline-block;
    margin-top: 1.5rem;
    box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
    font-size: 1.1rem;
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
    align-items: start;
    justify-items: center;
}

.produto-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    transition: transform 0.3s, box-shadow 0.3s;
    width: 100%;
    max-width: 350px;
    display: flex;
    flex-direction: column;
}

.produto-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
}

.produto-imagem {
    width: 100%;
    height: 250px;
    object-fit: cover;
    display: block;
    border-radius: 12px 12px 0 0;
    background-color: #f8fafc;
}

/* Fallback para quando a imagem não carrega */
.produto-imagem:not([src]), 
.produto-imagem[src=""] {
    background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #64748b;
    font-size: 1rem;
    font-weight: 500;
}

.produto-info {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
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
    
    .logo {
        font-size: 1.5rem;
        padding: 0.4rem 0.8rem;
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
        justify-items: center;
    }
    
    .produto-card {
        max-width: 100%;
    }
    
    /* Quem Somos responsivo */
    .quem-somos-container {
        grid-template-columns: 1fr;
        gap: 3rem;
        max-width: 100%;
    }
    
    .quem-somos-conteudo {
        padding-left: 0;
        text-align: center;
    }
    
    .quem-somos-conteudo h2 {
        font-size: 2rem;
        text-align: center;
    }
    
    .quem-somos-conteudo h2::after {
        left: 50%;
        transform: translateX(-50%);
    }
    
    .quem-somos-imagem {
        height: 350px;
    }
    
    .quem-somos-imagem img {
        height: 100%;
    }
}
</style>

<!-- Navbar - Barra de navegação -->
<nav class="navbar">
    <div class="navbar-container">
        <a href="<?php echo home_url(); ?>" class="logo"><?php echo get_field('logo_site'); ?></a> <!-- Logo com link para home -->
        <ul class="nav-menu">
            <li><a href="<?php echo home_url(); ?>">Home</a></li> <!-- Link para página inicial -->
            <li><a href="<?php echo wc_get_page_permalink('shop'); ?>">Products</a></li> <!-- Link para loja WooCommerce -->
            <li><a href="<?php echo esc_url(graphedia_get_cart_url()); ?>" class="cart-icon"> <!-- Link para carrinho personalizado -->
                🛒 <!-- Ícone do carrinho -->
                <?php if (WC()->cart && WC()->cart->get_cart_contents_count() > 0): ?> <!-- Verifica se há itens no carrinho -->
                    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span> <!-- Mostra quantidade de itens -->
                <?php endif; ?>
            </a></li>
        </ul>
    </div>
</nav>

<!-- Hero Section - Seção principal -->
<section class="hero">
    <h1><?php echo get_field('title_hero'); ?></h1> <!-- Título principal da loja -->
    <p><?php echo get_field('subtitle_hero'); ?></p> <!-- Subtítulo promocional -->
    <a href="<?php echo wc_get_page_permalink('shop'); ?>" class="cta-button">Ver Produtos</a> <!-- Botão call-to-action para loja -->
</section>

<!-- Quem Somos - Seção sobre a empresa -->
<section class="quem-somos">
    <div class="quem-somos-container">
        <div class="quem-somos-imagem"> 
            <img src="<?php echo get_field('image_about'); ?>" alt="Quem Somos">
        </div>
        <div class="quem-somos-conteudo">
            <h2><?php echo get_field('about_title') ?></h2> <!-- Título do campo ACF ou padrão -->
            <p><?php echo get_field('about_text') ?></p> <!-- Primeiro parágrafo -->
            <p><?php echo get_field('about_text_2')?></p> <!-- Segundo parágrafo -->
            <p class="destaque"><?php echo get_field('about_emphasis') ?></p> <!-- Texto em destaque -->
        </div>
    </div>
</section>

<!-- Produtos em Destaque - Seção de produtos -->
<section class="produtos-section">
    <h2 class="section-title">Products</h2> <!-- Título da seção de produtos -->
    <div class="produtos-grid"> <!-- Container do grid responsivo de produtos -->
        <?php
        $args = array( // Argumentos para buscar produtos do WooCommerce
            'post_type' => 'product', // Tipo: produto WooCommerce
            'posts_per_page' => 2, // Limita a 2 produtos em destaque
            'orderby' => 'date', // Ordena por data de criação
            'order' => 'DESC', // Mais recentes primeiro
        );
        $loop = new WP_Query($args); // Cria query personalizada para produtos
        
        if ($loop->have_posts()) : // Verifica se há produtos cadastrados
            while ($loop->have_posts()) : $loop->the_post(); // Loop pelos produtos encontrados
                global $product; // Variável global do produto WooCommerce
                ?>
                <div class="produto-card"> <!-- Card individual do produto -->
                    <?php 
                    // Sistema inteligente de imagens com fallback
                    if (has_post_thumbnail()) { // Verifica se tem imagem destacada do WordPress
                        $image_url = get_the_post_thumbnail_url(get_the_ID(), 'medium'); // Pega URL da imagem destacada
                        $image_alt = get_the_title(); // Texto alternativo para acessibilidade
                    } else {
                        // Tenta pegar imagem do WooCommerce se não tiver imagem destacada
                        $product_image_id = $product->get_image_id(); // ID da imagem do produto WooCommerce
                        if ($product_image_id) {
                            $image_url = wp_get_attachment_image_url($product_image_id, 'medium'); // URL da imagem do WooCommerce
                            $image_alt = get_the_title(); // Texto alternativo
                        } else {
                            $image_url = 'https://via.placeholder.com/300x250/2563eb/ffffff?text=Produto'; // Imagem placeholder como fallback
                            $image_alt = 'Produto'; // Texto alternativo padrão
                        }
                    }
                    ?>
                    <img src="<?php echo esc_url($image_url); ?>" 
                         alt="<?php echo esc_attr($image_alt); ?>" 
                         class="produto-imagem"
                         loading="lazy">
                    
                    <div class="produto-info"> <!-- Container das informações do produto -->
                        <h3 class="produto-titulo"><?php the_title(); ?></h3> <!-- Nome do produto -->
                        <div class="produto-preco">
                            <?php echo $product->get_price_html(); ?></div> <!-- Preço formatado do WooCommerce -->
                        <?php
                        // Botão adicionar ao carrinho com filtros WooCommerce
                        echo apply_filters('woocommerce_loop_add_to_cart_link',
                            sprintf('<a href="%s" data-quantity="1" class="add-to-cart" data-product_id="%s" data-product_sku="%s" aria-label="%s" rel="nofollow">%s</a>',
                                esc_url($product->add_to_cart_url()), // URL para adicionar ao carrinho
                                esc_attr($product->get_id()), // ID do produto para AJAX
                                esc_attr($product->get_sku()), // Código SKU do produto
                                esc_attr($product->add_to_cart_description()), // Descrição para acessibilidade
                                esc_html($product->add_to_cart_text()) // Texto do botão (ex: "Adicionar ao carrinho")
                            ),
                            $product // Objeto do produto WooCommerce
                        );
                        ?>
                    </div>
                </div>
                <?php
            endwhile;
        else :
            echo '<p style="text-align: center; grid-column: 1 / -1;">Nenhum produto encontrado.</p>'; // Mensagem se não há produtos cadastrados
        endif;
        wp_reset_postdata(); // Limpa dados do loop para evitar conflitos
        ?>
    </div>
</section>

<!-- Footer - Rodapé -->
<footer class="footer">
    <div class="footer-container">
        <div class="footer-section">
            <h3><?php echo get_field('footer_title') ?></h3> <!-- Nome da loja -->
            <p><?php echo get_field('footer_description') ?></p> <!-- Descrição da empresa -->
        </div>
        
        <div class="footer-section">
            <h3><?php echo get_field('footer_contact_title') ?></h3> <!-- Seção de informações de contato -->
            <p><?php echo get_field('footer_contact_email') ?></p> <!-- Email de contato -->
            <p><?php echo get_field('footer_contact_phone') ?></p> <!-- Telefone de contato -->
            <p><?php echo get_field('footer_contact_address') ?></p> <!-- Endereço físico -->
        </div>
        
        <div class="footer-section">
            <h3>🔗 Links</h3> <!-- Links importantes da loja -->
            <p><a href="<?php echo wc_get_page_permalink('shop'); ?>"><?php echo get_field('footer_useful_link_1') ?></a></p> <!-- Link para página de produtos -->
            <p><a href="<?php echo esc_url(graphedia_get_cart_url()); ?>"><?php echo get_field('footer_useful_link_2') ?></a></p> <!-- Link para carrinho personalizado -->
            <p><a href="<?php echo wc_get_page_permalink('myaccount'); ?>"><?php echo get_field('footer_useful_link_3') ?></a></p> <!-- Link para área do cliente -->
        </div>
        
        <div class="footer-section">
            <h3><?php echo get_field('footer_opening_hours_title') ?></h3> <!-- Horários de funcionamento -->
            <p><?php echo get_field('footer_opening_hours_1') ?></p> <!-- Horário dias úteis -->
            <p><?php echo get_field('footer_opening_hours_2') ?></p> <!-- Horário sábado -->
            <p><?php echo get_field('footer_opening_hours_3') ?></p> <!-- Horário domingo -->
        </div>
    </div>
    
    <div class="footer-bottom">
        <p>&copy; 2024 ShopGraphedia.</p> <!-- Copyright da empresa -->
    </div>
</footer>

<?php get_footer(); ?> <!-- Carrega o rodapé padrão do WordPress -->