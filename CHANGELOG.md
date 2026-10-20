# Registro de Decisões e Alterações (CHANGELOG)
## Projeto: Minha Patinha — Gestão de Animais e Ocorrências SOS

**Instituto Federal de Educação, Ciência e Tecnologia de Rondônia — IFRO Campus Porto Velho Calama**  
**Curso Técnico em Informática Integrado ao Ensino Médio — Componente: Desenvolvimento de Sistemas**  
**Professor:** Rafael Pitwak  
**Aluna:** Ana Carolina Ferreira  
**Repositório Oficial no GitHub:** https://github.com/anacarolinaferreira02/gestao_animais  
**Aplicação em Produção (Nuvem):** http://gestao-animais.infinityfreeapp.com  

Este documento registra todas as decisões técnicas, revisões humanas sobre o que o agente de inteligência artificial (Google Antigravity) propôs, correções de bugs, auditorias de segurança e evoluções arquiteturais do sistema, em estrita conformidade com o método da apostila *"Programar com IA de forma responsável"* (Fases 1 a 7 e Anexos A e B) do Professor Rafael Pitwak.

---

### [1.4.0] - 2026-10-20
#### Versão Final de Entrega: Consolidação Operacional, Roteiro de Execução Local e Nuvem
- **Documentação de Funcionamento Ponta a Ponta:**
  - Inclusão detalhada dos dois fluxos operacionais completos na documentação oficial:
    1. *Fluxo do Cidadão:* Cadastro, autenticação com Bcrypt, abertura de chamado SOS com foto e marcação de coordenadas no mapa interativo (Leaflet.js / OpenStreetMap), acompanhamento de moderação em "Minhas Ocorrências" e envio de proposta de adoção responsável.
    2. *Fluxo da Equipe do Abrigo:* Painel restrito `/admin/`, moderação de ocorrências SOS (com aprovação imediata para o mapa ou rejeição com justificativa obrigatória), prontuário clínico veterinário (consultas, vacinas com reforço, exames e receitas), controle de pesos e vistorias pós-adoção.
- **Roteiro Exato de Execução no Computador Local (XAMPP):**
  - Documentação passo a passo de como a aplicação roda no ambiente de desenvolvimento do aluno:
    - Inicialização dos módulos Apache e MySQL via **XAMPP Control Panel** no Windows.
    - Estrutura de arquivos em `C:\xampp\htdocs\gestao_animais`.
    - Importação das tabelas e administrador padrão pelo phpMyAdmin local (`http://localhost/phpmyadmin`) a partir do arquivo `schema.sql`.
    - Execução e teste no navegador em `http://localhost/gestao_animais/index.php` e script de teste de banco `teste.php`.
- **Refatoração da Conexão PDO (`config/conexao.php`):**
  - **Problema Detectado em Testes Locais:** O script `config/conexao.php` realizava a leitura de `getenv("DB_PASS")` antes da inclusão de `config/local_env.php`. Caso o MySQL do XAMPP exigisse senha local (`alunoifro`), a variável era atribuída como string vazia antes do `putenv()`, gerando erro `1045 Access denied`.
  - **Solução Implementada:** Reordenamento cirúrgico da checagem: o arquivo `config/local_env.php` agora é carregado no topo absoluto do script, garantindo que as variáveis de ambiente locais sejam registradas antes de qualquer avaliação de conexão pelo PDO.
  - **Resultado:** Conexão local validada com 100% de sucesso via `teste.php` sem expor senhas no código versionado.
- **Roteiro de Produção na Nuvem (InfinityFree):**
  - Documentação completa da hospedagem em nuvem: domínio `http://gestao-animais.infinityfreeapp.com`, banco remoto `sql311.infinityfree.com` (`if0_42984854_gestao_animais`), variáveis de ambiente configuradas no servidor e script de banco `importar_infinityfree.sql`.
- **Geração de Entregáveis Finais:**
  - Exportação da `spec.md` e do `CHANGELOG.md` em formatos Markdown e PDF limpos (sem grades/quadrados) tanto no diretório do projeto (`C:\xampp\htdocs\gestao_animais`) quanto na pasta de documentos da aluna (`C:\Users\Aluno\Documents`).

---

### [1.3.0] - 2026-10-20
#### Expansão do Modelo de Dados e Cobertura Clínica Completa
- **Decisão Arquitetural:** Ampliação do escopo do sistema para além do módulo de resgate SOS, integrando a gestão clínica completa do abrigo e o ciclo de adoção responsável com acompanhamento pós-adoção.
- **Estruturação do Banco de Dados (19 Tabelas Reais):**
  - *Módulo de Usuários e Comunicação:* `usuarios`, `notificacoes`.
  - *Módulo de Animais e Identificação:* `animais`, `fotos_animais`, `historico_status_animal`.
  - *Módulo SOS e Resgate Georreferenciado:* `ocorrencias_sos`, `historico_status_sos`.
  - *Módulo de Prontuário Clínico Veterinário:* `consultas`, `exames`, `vacinas`, `medicamentos`, `alergias`, `pesos_animais`, `historico_medico`, `saude_animais`.
  - *Módulo de Adoções e Vistorias:* `adocoes`, `entrevistas_adocao`, `acompanhamentos_adocao`.
- **Revisão Humana sobre a IA:** 
  - A IA inicialmente havia proposto um DER resumido de apenas 3 tabelas (`usuarios`, `animais`, `ocorrencias`). 
  - **Decisão:** Rejeitada a proposta simplificada e exigida a inclusão das tabelas reais de prontuário e adoção para refletir com fidelidade as regras de negócio de um abrigo real.
- **Atualização da Spec:** Seções 3 (Casos de uso), 4 (Requisitos funcionais), 6 (Modelo de dados) e 7 (Critérios de aceite) reescritas para cobrir integralmente os fluxos clínicos e de adoção.

---

### [1.2.0] - 2026-09-22
#### Segurança da Aplicação e Isolamento de Credenciais (Checklist do Anexo B)
- **Auditoria de Segurança (Eliminatória da Atividade):**
  - **Problema:** O arquivo original `config/conexao.php` continha o usuário `root` e a senha `alunoifro` diretamente em texto puro no código-fonte, o que violaria o critério de reprovação imediata ao subir para o GitHub.
  - **Intervenção e Solução:** Refatoração da conexão PDO para utilizar `getenv()` e `$_ENV` (`DB_HOST`, `DB_NAME`, `DB_USER`, `DB_PASS`, `DB_PORT`).
  - **Isolamento de Ambiente Local:** Criação do arquivo `config/local_env.php` e inclusão estrita no `.gitignore` para permitir testes locais no XAMPP sem vazar senhas.
  - **Deploy em Nuvem:** Criação do arquivo de exemplo `.env.example` e do script DDL `schema.sql` (e `importar_infinityfree.sql`) para importação sem erros de permissão no phpMyAdmin do servidor remoto.

---

### [1.1.0] - 2026-09-22
#### Diagnóstico e Correção de Inconsistências Críticas no Código
- **Correção da Visibilidade do Painel Administrativo:**
  - **Causa Raiz:** O arquivo `login.php` gravava o tipo do usuário na sessão como `$_SESSION["usuario_tipo"] = $usuario["tipo"]`, mas a barra de navegação de `dashboard.php` verificava `$_SESSION["tipo"]`. Administradores logados não conseguiam visualizar o botão "⚙️ Painel Admin".
  - **Correção:** Ajustado `dashboard.php` para checar `$_SESSION["usuario_tipo"] === "admin"`.
- **Correção de Erro 404 na Fila de Moderação:**
  - **Causa Raiz:** O link de análise no arquivo `admin/ocorrencias.php` apontava para `verificar_ocorrencia.php` (no singular), enquanto o arquivo real no disco chamava-se `verificar_ocorrencias.php` (no plural).
  - **Correção:** Link ajustado no arquivo, restabelecendo o fluxo de análise e aprovação de chamados SOS.
- **Revisão Humana de Código:** A IA inicialmente propôs renomear o arquivo no disco; a decisão humana adotada foi manter o padrão de pluralidade de arquivos do projeto (`animais.php`, `ocorrencias.php`, `usuarios.php`) e corrigir apenas o hiperlink na view, mantendo a consistência do padrão de nomenclatura.

---

### [1.0.0] - 2026-09-22
#### Planejamento Inicial, Versionamento e Deploy
- **Elaboração da Spec Inicial (Fase 1):** Levantamento das 8 seções obrigatórias conforme Anexo A da apostila (Objetivo, Usuários, Casos de Uso, RFs, RNFs, DER simples, Critérios de Aceite no formato "Dado que/Quando/Então", e Decisão de Stack/Deploy).
- **Versionamento no Git e GitHub (Fase 2):**
  - Criação do repositório público: `https://github.com/anacarolinaferreira02/gestao_animais`.
  - Configuração do `.gitignore` eliminando cache do SO (`Thumbs.db`, `.DS_Store`) e arquivos de ambiente sensíveis.
  - Primeiro commit com histórico real de desenvolvimento da Fase 2 à Fase 6.
- **Deploy em Produção (Fase 6):**
  - Publicação no provedor gratuito **InfinityFree** no domínio ativo `http://gestao-animais.infinityfreeapp.com`.
  - Configuração do banco de dados remoto MySQL e importação com sucesso das tabelas e do administrador padrão via phpMyAdmin.
