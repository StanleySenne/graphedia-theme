<?php
/**
 * Template Name: Carrinho Personalizado
 * 
 * @package Graphedia
 */

// Verificar se o WooCommerce está ativo
if (!class_exists('WooCommerce')) {
    wp_die('WooCommerce não está ativo. Por favor, instale e ative o WooCommerce.');
}

// Verificar se o carrinho está disponível
if (!function_exists('WC') || !WC()->cart) {
    wp_die('Carrinho não disponível.');
}

// Verificar se as funções necessárias existem
if (!function_exists('wc_price') || !function_exists('wc_get_page_id')) {
    wp_die('Funções do WooCommerce não disponíveis.');
}

get_header();
?>

<style>
/* Estilos específicos para a página do carrinho */
.cart-page {
    max-width: 1200px;
    margin: 0 auto;
    padding: 2rem;
    font-family: 'Inter', sans-serif;
}

.cart-header {
    text-align: center;
    margin-bottom: 3rem;
    padding: 2rem 0;
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    color: white;
    border-radius: 12px;
}

.cart-header h1 {
    font-size: 2.5rem;
    margin-bottom: 0.5rem;
    font-weight: 700;
}

.cart-header p {
    font-size: 1.1rem;
    opacity: 0.9;
}

.cart-container {
    display: grid;
    grid-template-columns: 2fr 1fr;
    gap: 2rem;
    margin-bottom: 2rem;
}

.cart-items {
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    overflow: hidden;
}

.cart-item {
    display: grid;
    grid-template-columns: 100px 2fr 1fr 1fr auto;
    gap: 1rem;
    padding: 1.5rem;
    border-bottom: 1px solid #e5e7eb;
    align-items: center;
}

.cart-item:last-child {
    border-bottom: none;
}

.cart-item-image {
    width: 80px;
    height: 80px;
    object-fit: cover;
    border-radius: 8px;
}

.cart-item-details h3 {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #1f2937;
}

.cart-item-details .sku {
    font-size: 0.9rem;
    color: #6b7280;
}

.cart-item-price {
    font-size: 1.2rem;
    font-weight: bold;
    color: #2563eb;
}

.cart-item-quantity {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.quantity-input {
    width: 60px;
    padding: 0.5rem;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    text-align: center;
    font-size: 1rem;
}

.quantity-btn {
    background: #f3f4f6;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
    transition: background 0.3s;
}

.quantity-btn:hover {
    background: #e5e7eb;
}

.cart-item-remove {
    display: flex;
    align-items: center;
    justify-content: center;
}

.remove-cart-item {
    background: #ef4444;
    color: white;
    border: none;
    border-radius: 6px;
    padding: 0.5rem 1rem;
    cursor: pointer;
    font-size: 0.9rem;
    transition: all 0.3s;
    font-weight: 500;
}

.remove-cart-item:hover {
    background: #dc2626;
    transform: translateY(-1px);
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.cart-summary {
    background: white;
    border-radius: 12px;
    padding: 2rem;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
    height: fit-content;
    position: sticky;
    top: 2rem;
}

.cart-summary h2 {
    font-size: 1.5rem;
    margin-bottom: 1.5rem;
    color: #1f2937;
    border-bottom: 2px solid #e5e7eb;
    padding-bottom: 1rem;
}

.cart-totals {
    margin-bottom: 2rem;
}

.cart-total-row {
    display: flex;
    justify-content: space-between;
    padding: 0.75rem 0;
    border-bottom: 1px solid #f3f4f6;
}

.cart-total-row:last-child {
    border-bottom: none;
    font-weight: bold;
    font-size: 1.2rem;
    color: #2563eb;
}

.cart-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
}

.cart-action-btn {
    padding: 1rem 1.5rem;
    border-radius: 8px;
    font-weight: 600;
    text-decoration: none;
    text-align: center;
    transition: all 0.3s;
    border: none;
    cursor: pointer;
    font-size: 1rem;
}

.btn-primary {
    background: #2563eb;
    color: white;
}

.btn-primary:hover {
    background: #1d4ed8;
    transform: translateY(-2px);
}

.btn-secondary {
    background: #f3f4f6;
    color: #374151;
    border: 1px solid #d1d5db;
}

.btn-secondary:hover {
    background: #e5e7eb;
}

.empty-cart {
    text-align: center;
    padding: 4rem 2rem;
    background: white;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0,0,0,0.1);
}

.empty-cart-icon {
    font-size: 4rem;
    margin-bottom: 1rem;
    opacity: 0.5;
}

.empty-cart h2 {
    font-size: 2rem;
    margin-bottom: 1rem;
    color: #1f2937;
}

.empty-cart p {
    font-size: 1.1rem;
    color: #6b7280;
    margin-bottom: 2rem;
}

.continue-shopping {
    background: #2563eb;
    color: white;
    padding: 1rem 2rem;
    border-radius: 8px;
    text-decoration: none;
    font-weight: 600;
    display: inline-block;
    transition: background 0.3s;
}

.continue-shopping:hover {
    background: #1d4ed8;
    color: white;
}

/* Responsivo */
@media (max-width: 768px) {
    .cart-container {
        grid-template-columns: 1fr;
        gap: 1rem;
    }
    
    .cart-item {
        grid-template-columns: 80px 1fr;
        gap: 1rem;
        padding: 1rem;
    }
    
    .cart-item-details {
        grid-column: 2;
    }
    
    .cart-item-price,
    .cart-item-quantity,
    .cart-item-remove {
        grid-column: 2;
        justify-self: start;
        margin-top: 0.5rem;
    }
    
    .cart-summary {
        position: static;
    }
    
    .cart-header h1 {
        font-size: 2rem;
    }
}

/* Animações */
.cart-item {
    animation: slideIn 0.5s ease;
}

@keyframes slideIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Loading states */
.cart-item.updating {
    opacity: 0.6;
    pointer-events: none;
    position: relative;
}

.cart-item.updating::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 20px;
    height: 20px;
    margin: -10px 0 0 -10px;
    border: 2px solid #f3f4f6;
    border-top: 2px solid #2563eb;
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<div class="cart-page">
    <div class="cart-header">
        <h1>🛒 Your Cart</h1>
        <p>Review your items before completing the purchase.</p>
    </div>

    <?php if (!WC()->cart->is_empty()) : ?>
        <div class="cart-container">
            <div class="cart-items">
                <?php
                foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
                    $_product   = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                        ?>
                        <div class="cart-item" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                            <div class="cart-item-image">
                                <?php
                                // Pegar a imagem do produto
                                $product_image_id = $_product->get_image_id();
                                if ($product_image_id) {
                                    $image_url = wp_get_attachment_image_url($product_image_id, 'thumbnail');
                                    $image_alt = $_product->get_name();
                                    echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr($image_alt) . '" class="cart-item-image">';
                                } else {
                                    // Imagem padrão se não houver
                                    echo '<img src="https://via.placeholder.com/80x80/2563eb/ffffff?text=Produto" alt="Produto" class="cart-item-image">';
                                }
                                ?>
                            </div>

                            <div class="cart-item-details">
                                <h3>
                                    <?php
                                    if (!$product_permalink) {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                    } else {
                                        echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                    }
                                    ?>
                                </h3>
                                <?php if ($_product->get_sku()) : ?>
                                    <div class="sku">SKU: <?php echo esc_html($_product->get_sku()); ?></div>
                                <?php endif; ?>
                            </div>

                            <div class="cart-item-price">
                                <?php
                                echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key);
                                ?>
                            </div>

                            <div class="cart-item-quantity">
                                <button type="button" class="quantity-btn minus" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">-</button>
                                <input type="number" 
                                       class="quantity-input" 
                                       name="cart[<?php echo esc_attr($cart_item_key); ?>][qty]" 
                                       value="<?php echo esc_attr($cart_item['quantity']); ?>" 
                                       min="0" 
                                       max="<?php echo esc_attr($_product->get_max_purchase_quantity()); ?>" 
                                       data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                <button type="button" class="quantity-btn plus" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">+</button>
                            </div>

                            <div class="cart-item-remove">
                                <button type="button" class="remove-cart-item" data-cart-item-key="<?php echo esc_attr($cart_item_key); ?>">
                                    Remove
                                </button>
                            </div>
                        </div>
                        <?php
                    }
                }
                ?>
            </div>

            <div class="cart-summary">
                <h2>📋 Order Summary</h2>
                <div class="cart-totals">
                    <div class="cart-total-row">
                        <span>Subtotal:</span>
                        <span><?php echo WC()->cart->get_cart_subtotal(); ?></span>
                    </div>

                    <?php if (WC()->cart->get_coupons()) : ?>
                        <?php foreach (WC()->cart->get_coupons() as $code => $coupon) : ?>
                            <div class="cart-total-row">
                                <span>Cupom (<?php echo esc_html($code); ?>):</span>
                                <span>-<?php echo wc_price(WC()->cart->get_coupon_discount_amount($code)); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (WC()->cart->needs_shipping() && WC()->cart->show_shipping()) : ?>
                        <div class="cart-total-row">
                            <span>Frete:</span>
                            <span><?php echo WC()->cart->get_cart_shipping_total(); ?></span>
                        </div>
                    <?php endif; ?>

                    <?php if (WC()->cart->get_fee_total()) : ?>
                        <?php foreach (WC()->cart->get_fees() as $fee) : ?>
                            <div class="cart-total-row">
                                <span><?php echo esc_html($fee->name); ?></span>
                                <span><?php echo wc_price($fee->total); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>

                    <?php if (wc_tax_enabled() && !WC()->cart->display_prices_including_tax()) : ?>
                        <div class="cart-total-row">
                            <span>Taxes:</span>
                            <span><?php echo wc_price(WC()->cart->get_taxes_total()); ?></span>
                        </div>
                    <?php endif; ?>

                    <div class="cart-total-row order-total">
                        <span>Total:</span>
                        <span><?php echo WC()->cart->get_total(); ?></span>
                    </div>
                </div>

                <div class="cart-actions">
                    <a href="<?php echo esc_url(WC()->cart->get_checkout_url()); ?>" class="cart-action-btn btn-primary">
                        🛒 Checkout
                    </a>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="cart-action-btn btn-secondary">
                        🛍️ Continue shopping
                    </a>
                </div>
            </div>
        </div>

    <?php else : ?>
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h2>Your cart is empty.</h2>
            <p>Add some items to proceed with your purchase.</p>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="continue-shopping">
                🛍️ Continue shopping
            </a>
        </div>
    <?php endif; ?>
</div>

<script>
jQuery(document).ready(function($) {
    // Atualizar quantidade
    $('.quantity-btn').on('click', function() {
        var $btn = $(this);
        var $input = $btn.siblings('.quantity-input');
        var currentQty = parseInt($input.val());
        var cartItemKey = $input.data('cart-item-key');
        
        if ($btn.hasClass('plus')) {
            $input.val(currentQty + 1);
        } else if ($btn.hasClass('minus') && currentQty > 1) {
            $input.val(currentQty - 1);
        }
        
        // Atualizar carrinho
        updateCartItem(cartItemKey, $input.val());
    });
    
    // Atualizar ao mudar input
    $('.quantity-input').on('change', function() {
        var $input = $(this);
        var cartItemKey = $input.data('cart-item-key');
        updateCartItem(cartItemKey, $input.val());
    });
    
    // Remover item do carrinho
    $('.remove-cart-item').on('click', function() {
        var $btn = $(this);
        var cartItemKey = $btn.data('cart-item-key');
        
        if (confirm('Tem certeza que deseja remover este item do carrinho?')) {
            removeCartItem(cartItemKey);
        }
    });
    
    function updateCartItem(cartItemKey, quantity) {
        var $cartItem = $('[data-cart-item-key="' + cartItemKey + '"]');
        $cartItem.addClass('updating');
        
        $.ajax({
            url: wc_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'woocommerce_update_cart',
                cart_item_key: cartItemKey,
                quantity: quantity,
                security: wc_cart_params.update_cart_nonce
            },
            success: function(response) {
                if (response.success) {
                    // Recarregar página para garantir valores corretos
                    location.reload();
                } else {
                    $cartItem.removeClass('updating');
                    alert('Erro ao atualizar carrinho');
                }
            },
            error: function() {
                $cartItem.removeClass('updating');
                alert('Erro ao atualizar carrinho');
            }
        });
    }
    
    function removeCartItem(cartItemKey) {
        var $cartItem = $('[data-cart-item-key="' + cartItemKey + '"]');
        $cartItem.addClass('updating');
        
        $.ajax({
            url: wc_cart_params.ajax_url,
            type: 'POST',
            data: {
                action: 'woocommerce_remove_cart_item',
                cart_item_key: cartItemKey,
                security: wc_cart_params.remove_cart_nonce
            },
            success: function(response) {
                if (response.success) {
                    // Recarregar página para garantir valores corretos
                    location.reload();
                } else {
                    $cartItem.removeClass('updating');
                    alert('Erro ao remover item do carrinho');
                }
            },
            error: function() {
                $cartItem.removeClass('updating');
                alert('Erro ao remover item do carrinho');
            }
        });
    }
    

});
</script>

<?php get_footer(); ?> 