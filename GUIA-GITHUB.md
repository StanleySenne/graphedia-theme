# 🚀 Guia Completo - Upload no GitHub

## 📋 Pré-requisitos

1. **Conta no GitHub** - [github.com](https://github.com)
2. **Git instalado** no seu computador
3. **Projeto organizado** (já está!)

---

## 🔧 Passo a Passo

### 1. **Criar Repositório no GitHub**

1. Acesse [github.com](https://github.com)
2. Clique no botão **"New"** ou **"+"** no canto superior direito
3. Escolha **"New repository"**
4. Preencha:
   - **Repository name**: `graphedia-theme`
   - **Description**: `Tema WordPress moderno para e-commerce com WooCommerce e AJAX`
   - **Visibility**: Public (ou Private se preferir)
   - **NÃO** marque "Add a README file" (já temos um)
5. Clique em **"Create repository"**

### 2. **Preparar o Projeto Local**

Abra o terminal/prompt de comando na pasta do seu projeto:

```bash
# Navegar até a pasta do tema
cd /caminho/para/graphedia

# Inicializar o Git (se ainda não foi feito)
git init

# Adicionar todos os arquivos
git add .

# Fazer o primeiro commit
git commit -m "🎉 Versão inicial do tema Graphedia"

# Adicionar o repositório remoto (substitua SEU_USUARIO)
git remote add origin https://github.com/SEU_USUARIO/graphedia-theme.git

# Enviar para o GitHub
git branch -M main
git push -u origin main
```

### 3. **Verificar se Tudo Funcionou**

1. Acesse seu repositório no GitHub
2. Verifique se todos os arquivos estão lá:
   - ✅ `index.php`
   - ✅ `cart.php`
   - ✅ `functions.php`
   - ✅ `style.css`
   - ✅ `header.php`
   - ✅ `footer.php`
   - ✅ `js/main.js`
   - ✅ `README.md`
   - ✅ `RESUMO-PROJETO.md`
   - ✅ `.gitignore`
   - ✅ `LICENSE`

---

## 🎯 **Comandos Git Úteis**

### **Para futuras atualizações:**
```bash
# Ver status dos arquivos
git status

# Adicionar mudanças
git add .

# Fazer commit
git commit -m "📝 Descrição da mudança"

# Enviar para GitHub
git push
```

### **Para ver histórico:**
```bash
# Ver commits
git log --oneline

# Ver diferenças
git diff
```

---

## 📁 **Arquivos que Serão Enviados**

### **✅ Arquivos Incluídos:**
- `index.php` - Página inicial
- `page.php` - Template de página
- `cart.php` - Página do carrinho
- `functions.php` - Funções do tema
- `style.css` - Estilos
- `header.php` - Cabeçalho
- `footer.php` - Rodapé
- `js/main.js` - JavaScript
- `README.md` - Documentação
- `RESUMO-PROJETO.md` - Guia completo
- `LICENSE` - Licença MIT

### **❌ Arquivos Ignorados (.gitignore):**
- Arquivos do WordPress core
- Logs e cache
- Arquivos temporários
- Configurações de IDE
- Uploads de mídia

---

## 🌟 **Após o Upload**

### **1. Personalizar o Repositório**
- Adicione uma descrição detalhada
- Configure tópicos (tags): `wordpress`, `woocommerce`, `ecommerce`, `theme`
- Adicione um site se tiver

### **2. Criar Releases**
Quando fizer atualizações importantes:
1. Vá em **Releases**
2. Clique em **"Create a new release"**
3. Adicione tag (ex: `v1.0.0`)
4. Adicione título e descrição
5. Publique

### **3. Configurar GitHub Pages (Opcional)**
Para criar uma página de demonstração:
1. Vá em **Settings > Pages**
2. Escolha branch `main`
3. Salve

---

## 🔗 **Links Úteis**

### **Para Compartilhar:**
- **Repositório**: `https://github.com/SEU_USUARIO/graphedia-theme`
- **Download**: `https://github.com/SEU_USUARIO/graphedia-theme/archive/main.zip`
- **Issues**: `https://github.com/SEU_USUARIO/graphedia-theme/issues`

### **Para Instalação:**
```bash
# Clone o repositório
git clone https://github.com/SEU_USUARIO/graphedia-theme.git

# Ou baixe ZIP
# Acesse: https://github.com/SEU_USUARIO/graphedia-theme/archive/main.zip
```

---

## 🎉 **Parabéns!**

Seu projeto está agora no GitHub com:
- ✅ Documentação completa
- ✅ Licença MIT
- ✅ README profissional
- ✅ .gitignore configurado
- ✅ Estrutura organizada

**Agora você pode compartilhar, colaborar e contribuir com a comunidade!** 🚀

---

## 💡 **Dicas Extras**

1. **Mantenha commits organizados** com mensagens claras
2. **Use branches** para novas funcionalidades
3. **Responda issues** se receber feedback
4. **Atualize a documentação** quando fizer mudanças
5. **Compartilhe** nas redes sociais e fóruns WordPress

**Boa sorte com seu projeto!** 🎯✨ 