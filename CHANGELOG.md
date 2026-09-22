# Registro de Decisões e Alterações (CHANGELOG)
## Projeto: Minha Patinha — Gestão de Animais e Ocorrências SOS

Este documento registra todas as decisões de projeto, revisões de arquitetura, correções de bugs e adequações de segurança realizadas durante o desenvolvimento assistido com IA (Google Antigravity), em conformidade com as diretrizes da atividade de programação responsável.

---

### [1.2.0] - 2026-09-22
#### Segurança e Variáveis de Ambiente (Requisito da Atividade)
- **Remoção de Credenciais Hardcoded:**
  - **Decisão:** Retiradas as credenciais de banco de dados (`root` e senha institucional) diretamente do código de `config/conexao.php`.
  - **Implementação:** Conexão refatorada para utilizar `getenv("DB_HOST")`, `getenv("DB_NAME")`, `getenv("DB_USER")`, `getenv("DB_PASS")` e `getenv("DB_PORT")`.
  - **Ambiente Local e Isolamento:** Criado arquivo `config/local_env.php` adicionado ao `.gitignore` para desenvolvimento local seguro no XAMPP, sem vazar senhas para o repositório público do GitHub.
  - **Exemplo de Configuração:** Criado `.env.example` com template para guiar o deploy em nuvem.
  - **Script de Inicialização:** Criado `schema.sql` contendo o DDL completo para fácil replicação do banco de dados em provedores de nuvem ou avaliação pelo professor.

---

### [1.1.0] - 2026-09-22
#### Correções de Bugs e Inconsistências (Revisão da IA)
- **Correção da Visibilidade do Botão Admin:**
  - **Problema Detectado:** Em `dashboard.php` (linha 60), a verificação de permissão utilizava `$_SESSION["tipo"]`, enquanto `login.php` gravava `$_SESSION["usuario_tipo"]`. Como resultado, administradores logados não conseguiam visualizar o botão "⚙️ Painel Admin".
  - **Solução Aplicada:** Atualizado `dashboard.php` para utilizar `$_SESSION["usuario_tipo"]`.
- **Correção de Erro 404 em Moderação de Ocorrências:**
  - **Problema Detectado:** Na listagem de ocorrências do admin (`admin/ocorrencias.php`, linha 223), o botão "Analisar" apontava para `verificar_ocorrencia.php` (singular), gerando erro 404 de página não encontrada.
  - **Solução Aplicada:** Ajustado o link para `verificar_ocorrencias.php` (plural), restabelecendo o fluxo de análise e aprovação.

---

### [1.0.0] - 2026-09-22
#### Especificação Técnica e Inicialização do Versionamento
- **Geração da Especificação Oficial (`spec.md`):**
  - Levantamento completo dos fluxos de negócio do sistema (cadastro de animais, registro de ocorrências SOS com geolocalização Leaflet, aprovação/rejeição de chamados e catálogo de adoção).
  - Mapeamento detalhado das permissões de usuário e administrador (RBAC).
  - Dicionário de dados relacional e diagramas de sequência/ERD em Mermaid.
- **Configuração de Versionamento:**
  - Inicialização do repositório Git e publicação no GitHub: `https://github.com/anacarolinaferreira02/gestao_animais`.
  - Criação do `.gitignore` para proteção contra commit de arquivos temporários, logs e lixo de SO.
