# 🐾 Minha Patinha — Gestão de Animais e Ocorrências SOS

Sistema web completo para gestão, acolhimento e resgate comunitário de animais domésticos perdidos e encontrados, com mapa interativo georreferenciado e fluxo de moderação administrativa.

---

## 🚀 Funcionalidades Principais

- **🗺️ Mapa Interativo de Ocorrências (SOS):**
  - Marcação de animais perdidos (vermelho) e encontrados (azul) via **Leaflet.js** e **OpenStreetMap**.
  - Registro interativo clicando no mapa para obter latitude e longitude exatas.
  - Upload de fotos do animal com validação de formato e tamanho.
- **🛡️ Fila de Moderação Administrativa:**
  - Todas as ocorrências enviadas por usuários comuns entram inicialmente com status `Pendente`.
  - Apenas administradores podem avaliar, aprovar (liberando no mapa público) ou rejeitar (com justificativa obrigatória).
- **🐕 Catálogo e Gestão de Animais:**
  - Cadastro de animais para o abrigo com foto, características (espécie, raça, porte, cor, idade) e status (`Perdido`, `Encontrado`, `Disponível para adoção`, `Adotado`).
- **🔐 Autenticação e Níveis de Permissão (RBAC):**
  - Senhas criptografadas com **Bcrypt** (`password_hash` / `password_verify`).
  - Painel Administrativo restrito para usuários com perfil `admin`.

---

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP 8+ (PDO com Prepared Statements)
- **Banco de Dados:** MySQL / MariaDB
- **Frontend:** HTML5, CSS3 moderno, JavaScript ES6+
- **Mapas:** Leaflet.js v1.9.4 & OpenStreetMap
- **Desenvolvimento e Versionamento:** Git, GitHub e Google Antigravity

---

## 📂 Estrutura do Projeto

```text
gestao_animais/
├── admin/                     # Painel administrativo e moderação de ocorrências
│   ├── animais.php
│   ├── index.php
│   ├── ocorrencias.php
│   ├── usuarios.php
│   └── verificar_ocorrencias.php
├── animais/                   # Catálogo público e CRUD de animais
│   ├── cadastrar.php
│   ├── editar.php
│   ├── excluir.php
│   ├── index.php
│   └── visualizar.php
├── assets/                    # Estilos CSS e scripts JS
│   ├── css/style.css
│   └── js/script.js
├── config/                    # Conexão ao banco e controle de autenticação
│   ├── auth.php
│   ├── conexao.php
│   └── local_env.php          # (Ignorado no Git) Variáveis locais
├── mapa/                      # Visualização do mapa público
│   └── index.php
├── ocorrencias/               # Módulo SOS do usuário (cadastro e consulta)
│   ├── cadastrar.php
│   ├── index.php
│   └── visualizar.php
├── uploads/                   # Armazenamento de mídias enviadas
├── .env.example               # Template de variáveis de ambiente
├── .gitignore                 # Arquivos ignorados pelo Git
├── CHANGELOG.md               # Registro de decisões e correções
├── dashboard.php              # Painel inicial do usuário
├── login.php                  # Tela de autenticação
├── logout.php                 # Encerramento de sessão
├── schema.sql                 # Script DDL de criação do banco de dados
├── spec.md                    # Especificação técnica e funcional completa
└── README.md                  # Este documento
```

---

## ⚙️ Como Executar o Projeto Localmente (XAMPP)

1. **Clonar o Repositório:**
   ```bash
   git clone https://github.com/anacarolinaferreira02/gestao_animais.git
   ```
2. **Colocar na pasta do Apache:**
   Copie a pasta para `C:\xampp\htdocs\gestao_animais`.
3. **Importar o Banco de Dados:**
   - Abra o `phpMyAdmin` (`http://localhost/phpmyadmin`).
   - Importe o arquivo `schema.sql` ou execute o script SQL contido nele.
4. **Variáveis de Ambiente:**
   - As credenciais de conexão são obtidas via variáveis de ambiente (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`, `DB_PORT`).
   - Para rodar localmente sem configurar variáveis de sistema, utilize o arquivo `config/local_env.php` (conforme modelo em `.env.example`).
5. **Acessar no Navegador:**
   - Acesse: `http://localhost/gestao_animais`

---

## 👤 Credenciais de Teste para Avaliação

| Tipo de Usuário | E-mail | Senha |
| :--- | :--- | :--- |
| **Administrador** | `admin@minhpatinha.com` | `admin123` |

---

## 📑 Documentos da Atividade

- [Especificação Técnica Completa (`spec.md`)](spec.md)
- [Histórico de Decisões e Revisão da IA (`CHANGELOG.md`)](CHANGELOG.md)
- [Script SQL de Criação das Tabelas (`schema.sql`)](schema.sql)
