# 💋 FofoCast – O Portal dos Babados

FofoCast é um portal de notícias focado em **fofocas, celebridades e entretenimento**, desenvolvido como projeto final.  
O site permite cadastro de usuários, login seguro, publicação de notícias, edição, exclusão e um painel administrativo exclusivo para autores.

Projeto desenvolvido por **Eleanderson Rosa de Morais**.

---

## 🔥 Funcionalidades

### 👤 Usuário
- Cadastro de novo usuário
- Login utilizando `password_hash`
- Controle de sessão em PHP
- Logout seguro

### 📰 Notícias (Fofocas)
- Publicar nova notícia com título, conteúdo e imagem
- Listagem de fofocas na página inicial
- Página individual da notícia
- Editar e excluir notícias
- Exibir autor, data e imagem opcional

### 🔐 Sistema Interno
- Painel administrativo restrito a usuários logados
- Verificação automática via sessão
- Proteção contra acesso não autorizado

---

## 🛠 Tecnologias Utilizadas
- **PHP** (Backend)
- **MySQL** (Banco de dados)
- **HTML + CSS** (Frontend)
- **XAMPP / Apache** como ambiente local
- **password_hash / password_verify** para segurança de senhas

---

## 📁 Estrutura do Projeto

│── conexao.php
│── funcoes.php
│── index.php
│── login.php
│── logout.php
│── cadastro.php
│── dashboard.php
│── usuarios.php
│── nova_noticia.php
│── editar_noticia.php
│── excluir_noticia.php
│── noticia.php
│── style.css

---

## 🗄 Banco de Dados (MySQL)

Crie um banco chamado **fofocast** no phpMyAdmin e use as tabelas abaixo:

### 📌 Tabela `usuarios`
```sql
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE noticias (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    noticia TEXT NOT NULL,
    imagem VARCHAR(255),
    autor INT NOT NULL,
    data TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (autor) REFERENCES usuarios(id)
);
📝 Autor

Matheus Munhoz
Projeto desenvolvido como parte da avaliação final.
