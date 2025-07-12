/**
 * Graphedia E-commerce JavaScript
 */

jQuery(document).ready(function($) {
    
    // Adicionar ao carrinho via AJAX
    $('.add-to-cart').on('click', function(e) {
        e.preventDefault();
        
        var $button = $(this);
        var $originalText = $button.text();
        var productId = $button.data('product_id');
        var quantity = $button.data('quantity') || 1;
        
        // Desabilitar botão e mostrar loading
        $button.prop('disabled', true).text('Adicionando...');
        
        $.ajax({
            url: graphedia_ajax.ajax_url,
            type: 'POST',
            data: {
                action: 'graphedia_add_to_cart',
                product_id: productId,
                quantity: quantity,
                nonce: graphedia_ajax.nonce
            },
            success: function(response) {
                if (response.success) {
                    // Atualizar contador do carrinho
                    $('.cart-count').text(response.data.cart_count);
                    
                    // Mostrar mensagem de sucesso
                    showNotification('Produto adicionado ao carrinho!', 'success');
                    
                    // Atualizar botão
                    $button.text('Adicionado!').addClass('added');
                    
                    setTimeout(function() {
                        $button.prop('disabled', false).text($originalText).removeClass('added');
                    }, 2000);
                    
                } else {
                    showNotification('Erro ao adicionar produto.', 'error');
                    $button.prop('disabled', false).text($originalText);
                }
            },
            error: function() {
                showNotification('Erro de conexão.', 'error');
                $button.prop('disabled', false).text($originalText);
            }
        });
    });
    
    // Função para mostrar notificações
    function showNotification(message, type) {
        var $notification = $('<div class="notification notification-' + type + '">' + message + '</div>');
        
        // Adicionar estilos
        $notification.css({
            position: 'fixed',
            top: '20px',
            right: '20px',
            padding: '1rem 1.5rem',
            borderRadius: '8px',
            color: 'white',
            fontWeight: '600',
            zIndex: '9999',
            transform: 'translateX(100%)',
            transition: 'transform 0.3s ease',
            backgroundColor: type === 'success' ? '#10b981' : '#ef4444',
            boxShadow: '0 4px 6px rgba(0,0,0,0.1)'
        });
        
        $('body').append($notification);
        
        // Animar entrada
        setTimeout(function() {
            $notification.css('transform', 'translateX(0)');
        }, 100);
        
        // Remover após 3 segundos
        setTimeout(function() {
            $notification.css('transform', 'translateX(100%)');
            setTimeout(function() {
                $notification.remove();
            }, 300);
        }, 3000);
    }
    
    // Smooth scroll para links internos
    $('a[href^="#"]').on('click', function(e) {
        e.preventDefault();
        
        var target = $(this.getAttribute('href'));
        if (target.length) {
            $('html, body').stop().animate({
                scrollTop: target.offset().top - 80
            }, 1000);
        }
    });
    
    // Menu mobile toggle
    $('.mobile-menu-toggle').on('click', function() {
        $('.nav-menu').toggleClass('active');
        $(this).toggleClass('active');
    });
    
    // Fechar menu ao clicar fora
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.navbar').length) {
            $('.nav-menu').removeClass('active');
            $('.mobile-menu-toggle').removeClass('active');
        }
    });
    
    // Lazy loading para imagens
    if ('IntersectionObserver' in window) {
        const imageObserver = new IntersectionObserver((entries, observer) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const img = entry.target;
                    img.src = img.dataset.src;
                    img.classList.remove('lazy');
                    imageObserver.unobserve(img);
                }
            });
        });
        
        document.querySelectorAll('img[data-src]').forEach(img => {
            imageObserver.observe(img);
        });
    }
    
    // Animações ao scroll
    function animateOnScroll() {
        $('.produto-card, .hero, .section-title').each(function() {
            var elementTop = $(this).offset().top;
            var elementBottom = elementTop + $(this).outerHeight();
            var viewportTop = $(window).scrollTop();
            var viewportBottom = viewportTop + $(window).height();
            
            if (elementBottom > viewportTop && elementTop < viewportBottom) {
                $(this).addClass('animate-in');
            }
        });
    }
    
    // Executar animações no scroll
    $(window).on('scroll', animateOnScroll);
    animateOnScroll(); // Executar na carga inicial
    
    // Adicionar estilos CSS para animações
    $('<style>')
        .prop('type', 'text/css')
        .html(`
            .produto-card, .hero, .section-title {
                opacity: 0;
                transform: translateY(30px);
                transition: opacity 0.6s ease, transform 0.6s ease;
            }
            
            .produto-card.animate-in, .hero.animate-in, .section-title.animate-in {
                opacity: 1;
                transform: translateY(0);
            }
            
            .add-to-cart.added {
                background-color: #10b981 !important;
            }
            
            .mobile-menu-toggle {
                display: none;
                flex-direction: column;
                cursor: pointer;
                padding: 0.5rem;
            }
            
            .mobile-menu-toggle span {
                width: 25px;
                height: 3px;
                background-color: #333;
                margin: 3px 0;
                transition: 0.3s;
            }
            
            .mobile-menu-toggle.active span:nth-child(1) {
                transform: rotate(-45deg) translate(-5px, 6px);
            }
            
            .mobile-menu-toggle.active span:nth-child(2) {
                opacity: 0;
            }
            
            .mobile-menu-toggle.active span:nth-child(3) {
                transform: rotate(45deg) translate(-5px, -6px);
            }
            
            @media (max-width: 768px) {
                .mobile-menu-toggle {
                    display: flex;
                }
                
                .nav-menu {
                    position: absolute;
                    top: 100%;
                    left: 0;
                    right: 0;
                    background: white;
                    flex-direction: column;
                    padding: 1rem;
                    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
                    transform: translateY(-100%);
                    opacity: 0;
                    visibility: hidden;
                    transition: all 0.3s ease;
                }
                
                .nav-menu.active {
                    transform: translateY(0);
                    opacity: 1;
                    visibility: visible;
                }
            }
        `)
        .appendTo('head');
    
    // Adicionar botão mobile menu se não existir
    if ($('.mobile-menu-toggle').length === 0) {
        $('.navbar-container').append(`
            <div class="mobile-menu-toggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        `);
    }
    
}); 