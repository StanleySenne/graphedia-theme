# 🛒 Graphedia - Tema WordPress E-commerce

Um tema WordPress moderno e responsivo para e-commerce, desenvolvido com WooCommerce e funcionalidades AJAX avançadas.

## ✨ Características

- 🎨 **Design Moderno** - Interface limpa e profissional
- 📱 **Totalmente Responsivo** - Funciona em todos os dispositivos
- ⚡ **AJAX Avançado** - Carrinho dinâmico sem recarregamentos
- 🛒 **Carrinho Personalizado** - Página de carrinho customizada
- 🚀 **Performance Otimizada** - Carregamento rápido
- 🔧 **Fácil Customização** - Código limpo e bem documentado

## 🛠️ Tecnologias

- **WordPress** - CMS base
- **WooCommerce** - E-commerce
- **PHP** - Backend
- **JavaScript/jQuery** - Interatividade
- **CSS3** - Estilos e animações
- **AJAX** - Atualizações dinâmicas

## 📁 Estrutura do Projeto

```
graphedia/
├── index.php          # Página inicial com produtos
├── page.php           # Template de página genérica
├── cart.php           # Página personalizada do carrinho
├── functions.php      # Funções do tema e WooCommerce
├── style.css          # Estilos principais
├── header.php         # Cabeçalho do site
├── footer.php         # Rodapé do site
├── js/
│   └── main.js        # JavaScript principal
├── .gitignore         # Arquivos ignorados pelo Git
├── README.md          # Este arquivo
└── RESUMO-PROJETO.md  # Documentação completa
```

## 🚀 Instalação

### Pré-requisitos
- WordPress 5.0+
- WooCommerce 5.0+
- PHP 7.4+

### Passos
1. **Clone o repositório:**
   ```bash
   git clone https://github.com/seu-usuario/graphedia.git
   ```

2. **Copie para o WordPress:**
   ```bash
   cp -r graphedia /caminho/do/wordpress/wp-content/themes/
   ```

3. **Ative o tema:**
   - Acesse o painel WordPress
   - Vá em **Aparência > Temas**
   - Ative o tema "Graphedia"

4. **Configure o WooCommerce:**
   - Instale e ative o WooCommerce
   - Configure produtos, preços e imagens
   - Crie a página "Carrinho" com slug "carrinho"

## 🎯 Funcionalidades

### Página Inicial
- ✅ Navbar com logo e carrinho
- ✅ Hero section personalizável
- ✅ Grid de produtos responsivo
- ✅ Botões "Adicionar ao Carrinho" com AJAX
- ✅ Footer com informações de contato

### Carrinho Personalizado
- ✅ Lista de produtos no carrinho
- ✅ Controles de quantidade (+/- e input)
- ✅ Botão de remover produtos
- ✅ Resumo do pedido com totais
- ✅ Botões de ação (Finalizar Compra / Continuar Comprando)

### Sistema AJAX
- ✅ Adicionar produtos sem recarregar
- ✅ Atualizar quantidades dinamicamente
- ✅ Remover produtos com confirmação
- ✅ Estados de loading durante operações

## 🎨 Personalização

### Cores
As cores principais podem ser alteradas no arquivo `style.css`:
```css
:root {
  --primary-color: #2563eb;    /* Azul principal */
  --secondary-color: #667eea;  /* Roxo */
  --accent-color: #ef4444;     /* Vermelho */
  --background-color: #f3f4f6; /* Cinza claro */
}
```

### Logo
1. Acesse **Aparência > Personalizar > Identidade do Site**
2. Faça upload da sua logo
3. Ajuste o tamanho conforme necessário

### Textos
- **Hero section**: Edite `index.php`
- **Footer**: Edite `footer.php`
- **Página do carrinho**: Edite `cart.php`

## 📱 Responsividade

O tema é totalmente responsivo e funciona perfeitamente em:
- ✅ Desktop (1200px+)
- ✅ Tablet (768px - 1199px)
- ✅ Mobile (até 767px)

## 🔧 Desenvolvimento

### Estrutura de Arquivos
- **`functions.php`** - Todas as funções PHP do tema
- **`js/main.js`** - JavaScript principal com AJAX
- **`style.css`** - Estilos CSS principais
- **`cart.php`** - Template da página do carrinho

### Funções AJAX Principais
```php
// Adicionar ao carrinho
graphedia_add_to_cart_ajax()

// Atualizar quantidade
graphedia_update_cart_ajax()

// Remover produto
graphedia_remove_cart_item_ajax()
```

## 🐛 Solução de Problemas

### Imagens não aparecem
1. Verifique se o produto tem imagem definida no WordPress
2. Re-upload a imagem se necessário
3. Use o plugin "Regenerate Thumbnails"

### AJAX não funciona
1. Verifique se o WooCommerce está ativo
2. Confirme se o JavaScript está carregando
3. Verifique o console do navegador para erros

### Página do carrinho não funciona
1. Crie uma página com slug "carrinho"
2. Configure o template como "Carrinho Personalizado"
3. Verifique as permissões do WordPress

## 📄 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

## 🤝 Contribuição

1. Faça um fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/AmazingFeature`)
3. Commit suas mudanças (`git commit -m 'Add some AmazingFeature'`)
4. Push para a branch (`git push origin feature/AmazingFeature`)
5. Abra um Pull Request

## 📞 Suporte

Se você encontrar algum problema ou tiver dúvidas:
1. Verifique a documentação em `RESUMO-PROJETO.md`
2. Abra uma issue no GitHub
3. Entre em contato através do email

---

**Desenvolvido com ❤️ para criar experiências de e-commerce incríveis!** 