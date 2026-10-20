# Especificação do Sistema (spec.md)
## Minha Patinha — Gestão de Animais e Ocorrências SOS

**Instituto Federal de Educação, Ciência e Tecnologia de Rondônia — IFRO Campus Porto Velho Calama**  
**Curso Técnico em Informática Integrado ao Ensino Médio — Componente: Desenvolvimento de Sistemas**  
**Professor:** Rafael Pitwak  
**Aluna:** Ana Carolina Ferreira  
**Repositório Oficial no GitHub:** https://github.com/anacarolinaferreira02/gestao_animais  
**Aplicação em Produção (Nuvem):** http://gestao-animais.infinityfreeapp.com  

---

## 1. Objetivo
O **Minha Patinha** é um sistema web voltado para cidadãos, protetores independentes e abrigos de animais na cidade de Porto Velho (RO). O objetivo primordial da plataforma é agilizar o resgate de animais perdidos e em situação de vulnerabilidade através de chamados georreferenciados (SOS) com coordenadas geográficas exatas e fotos do local. 

Além do módulo de socorro imediato, o sistema centraliza e organiza a rotina operacional do abrigo de animais, fornecendo controle cadastral completo, prontuário clínico veterinário (consultas, exames, vacinas, medicações e evolução de peso) e gestão integrada de todo o ciclo de adoção responsável (solicitação, entrevistas de perfil e acompanhamento pós-adoção). Com moderação ativa da equipe antes da publicação no mapa interativo, a plataforma garante a veracidade das informações, combate o abandono e fortalece a rede de proteção animal no município.

---

## 2. Usuários
O sistema atende a dois perfis principais de usuários:

- **Cidadão (Usuário Comum / Adotante):**
  Pode se cadastrar livremente com nome, e-mail, telefone e senha; efetuar login e logout; registrar chamados SOS de animais perdidos ou encontrados anexando fotos e marcando o ponto exato no mapa; acompanhar o status de moderação de suas ocorrências na aba "Minhas Ocorrências" (com visualização do motivo caso o chamado seja rejeitado); explorar o mapa público interativo de ocorrências aprovadas; navegar pelo catálogo de animais acolhidos pelo abrigo; e submeter solicitações formais de adoção preenchendo o questionário de aptidão.

- **Administrador (Protetor / Equipe do Abrigo):**
  Possui acesso restrito ao painel administrativo (`/admin`); gerencia a fila de moderação de ocorrências SOS, avaliando as informações e podendo aprovar o chamado (disponibilizando-o imediatamente no mapa público) ou rejeitá-lo informando obrigatoriamente a justificativa; cadastra, edita e gerencia os animais acolhidos pela organização; registra o prontuário de saúde completo (consultas, vacinas, laudos de exames, prescrições e pesagens); gerencia as solicitações de adoção recebidas, agendando entrevistas e aprovando termos; realiza acompanhamentos pós-adoção com fotos do animal no novo lar; e visualiza a relação geral de usuários cadastrados no sistema.

---

## 3. Casos de Uso Principais
- **UC01: Cadastrar novo usuário:** Cidadão registra sua conta com nome, e-mail, telefone e senha criptografada.
- **UC02: Autenticar usuário e encerrar sessão:** Usuário realiza login com e-mail e senha, sendo redirecionado conforme seu perfil (comum ou admin), e realiza logout seguro quando desejar.
- **UC03: Registrar ocorrência SOS:** Usuário submete chamado de animal perdido ou encontrado com foto, dados de contato e coordenadas de latitude/longitude capturadas no mapa.
- **UC04: Acompanhar minhas ocorrências:** Usuário consulta a lista de chamados criados por ele, verificando status (Pendente, Aprovada, Rejeitada) e eventuais justificativas.
- **UC05: Consultar mapa interativo público:** Cidadão visualiza no mapa os marcadores georreferenciados de animais com chamados aprovados pela equipe.
- **UC06: Moderar ocorrência SOS:** Administrador avalia evidências do chamado pendente, aprovando para o mapa ou rejeitando com justificativa obrigatória.
- **UC07: Cadastrar e atualizar animais acolhidos:** Administrador inclui novos animais com fotos, características físicas, histórico e status situacional.
- **UC08: Manter prontuário clínico e imunização:** Administrador/Veterinário registra consultas, vacinas aplicadas com data de reforço, exames e medicamentos.
- **UC09: Acompanhar evolução física do animal:** Administrador registra pesagens periódicas e galeria de fotos adicionais do animal no abrigo.
- **UC10: Consultar catálogo de animais e submeter adoção:** Cidadão escolhe um animal disponível e preenche formulário demonstrando condições de acolhimento.
- **UC11: Analisar solicitação de adoção e agendar entrevista:** Equipe avalia questionário do interessado e agenda etapa presencial ou virtual.
- **UC12: Efetivar adoção e registrar termos:** Equipe conclui o processo e atualiza a situação cadastral do animal para "Adotado".
- **UC13: Registrar acompanhamento pós-adoção:** Administrador insere relatórios de vistorias com fotos que comprovem a boa adaptação do animal no novo lar.
- **UC14: Consultar lista de usuários cadastrados:** Administrador visualiza dados de contato e permissões de todos os usuários cadastrados na plataforma.

---

## 4. Requisitos Funcionais (RF)
- **RF01:** O sistema deve permitir o cadastro de novos usuários informando nome, e-mail único, telefone e senha de acesso.
- **RF02:** O sistema deve autenticar usuários por meio de e-mail e senha, direcionando para o Dashboard correspondente ao seu nível de acesso (`usuario` ou `admin`).
- **RF03:** O sistema deve permitir encerramento seguro da sessão ativa (logout), limpando todos os dados de sessão do servidor.
- **RF04:** O sistema deve permitir que usuários autenticados registrem ocorrências SOS (tipo "Perdido" ou "Encontrado"), informando nome/características do animal, descrição, data, horário aproximado, telefone de contato, foto obrigatória e seleção interativa de coordenadas (latitude e longitude) no mapa.
- **RF05:** O sistema deve salvar novas ocorrências com status inicial de moderação "Pendente", impedindo exibição prévia no mapa público.
- **RF06:** O sistema deve permitir que o cidadão consulte suas próprias ocorrências com status em tempo real e visualização da justificativa em caso de rejeição.
- **RF07:** O sistema deve exibir no mapa interativo público apenas as ocorrências com status "Aprovada", utilizando marcadores visuais diferenciados por categoria (Perdido ou Encontrado).
- **RF08:** O sistema deve disponibilizar ao administrador uma fila de moderação para aprovar chamados ou rejeitá-los com preenchimento compulsório de justificativa.
- **RF09:** O sistema deve permitir ao administrador cadastrar animais acolhidos, informando nome, espécie, raça, sexo, idade estimada, porte, cor, peso, data/local de resgate, foto principal e status situacional ("Disponível", "Em tratamento", "Em processo de adoção", "Adotado", "Perdido", "Encontrado").
- **RF10:** O sistema deve permitir o registro de prontuário clínico individual por animal: consultas veterinárias, laudos de exames anexados, vacinas aplicadas com data da próxima dose, medicamentos prescritos com posologia e histórico de alergias.
- **RF11:** O sistema deve permitir o registro de pesagens periódicas e manter uma galeria de fotos adicionais para cada animal.
- **RF12:** O sistema deve permitir que cidadãos autenticados submetam solicitações de adoção para animais disponíveis, respondendo a perguntas sobre tipo de residência, experiência prévia e outros animais na moradia.
- **RF13:** O sistema deve permitir que a equipe do abrigo analise as solicitações de adoção, agende entrevistas e registre a aprovação ou reprovação da proposta.
- **RF14:** O sistema deve permitir o registro de visitas e acompanhamentos pós-adoção com data, situação descritiva do animal e fotos do novo lar.
- **RF15:** O sistema deve registrar notificações internas para os usuários referentes à atualização de status de seus chamados SOS e processos de adoção.
- **RF16:** O sistema deve disponibilizar ao administrador a relação de todos os usuários cadastrados com nome, e-mail, telefone, perfil e data de criação.

---

## 5. Requisitos Não Funcionais (RNF)
- **Segurança da Informação e Criptografia:**
  - Todas as senhas dos usuários devem ser armazenadas obrigatoriamente utilizando hash criptográfico seguro (Bcrypt), nunca em texto plano.
  - Todas as consultas ao banco de dados devem utilizar exclusivamente a extensão PDO com Prepared Statements e vinculação de parâmetros, eliminando vulnerabilidades de injeção de SQL (SQL Injection).
  - Nenhuma credencial de banco de dados, chave de API ou senha sensível deve constar em texto puro no código versionado no repositório GitHub. O carregamento de credenciais locais é feito via arquivo `config/local_env.php` (estritamente ignorado no `.gitignore`), e em produção é configurado diretamente nas variáveis de ambiente do servidor web.
  - Todas as rotas administrativas sob o diretório `/admin/` devem verificar a integridade da sessão do usuário (`$_SESSION["usuario_tipo"] === 'admin'`), barrando acessos não autorizados e redirecionando para a área pública.
- **Desempenho, Usabilidade e Compatibilidade:**
  - A interface deve ser plenamente responsiva, adaptada para smartphones, tablets e desktops (Mobile-First via Flexbox/CSS Grid), permitindo a seleção de coordenadas no mapa com toques na tela móvel.
  - O upload de imagens deve ser restrito a arquivos de até 5 MB nos formatos JPEG, PNG e WebP, gerando nomes únicos e aleatórios no servidor para evitar colisões e sobrescrita maliciosa de arquivos.

---

## 6. Modelo de Dados (DER Simples)
O banco de dados relacional MySQL é composto por 19 tabelas organizadas em 5 módulos de negócio integrados por chaves primárias e estrangeiras:

### Módulo 1: Usuários e Notificações
- **usuarios:** id (int, PK, AI), nome (varchar 100), email (varchar 150, Unique), senha (varchar 255), telefone (varchar 20), tipo (enum 'admin', 'usuario'), ativo (tinyint 1), criado_em (timestamp).
  *Finalidade: Autenticação, controle de permissões e dados cadastrais dos usuários.*
- **notificacoes:** id (int, PK, AI), usuario_id (int, FK usuarios.id), titulo (varchar 150), mensagem (text), lida (tinyint 1), criada_em (timestamp).
  *Finalidade: Avisos e atualizações emitidas pela plataforma diretamente ao usuário.*

### Módulo 2: Animais e Identificação
- **animais:** id (int, PK, AI), nome (varchar 100), especie (varchar 50), raca (varchar 50), sexo (enum 'Macho', 'Femea'), idade (int), peso (decimal 5,2), cor (varchar 50), porte (enum 'Pequeno', 'Medio', 'Grande'), data_resgate (date), local_resgate (varchar 255), foto (varchar 255), status (enum 'Disponível', 'Em tratamento', 'Em processo de adoção', 'Adotado', 'Perdido', 'Encontrado'), descricao (text), criado_em (timestamp), atualizado_em (timestamp).
  *Finalidade: Registro central dos animais acolhidos pela organização.*
- **fotos_animais:** id (int, PK, AI), animal_id (int, FK animais.id), arquivo (varchar 255), legenda (varchar 150), enviada_em (timestamp).
  *Finalidade: Galeria de imagens adicionais de cada animal ao longo de sua estadia.*
- **historico_status_animal:** id (int, PK, AI), animal_id (int, FK animais.id), status_anterior (varchar 50), status_novo (varchar 50), observacao (text), usuario_id (int, FK usuarios.id), alterado_em (timestamp).
  *Finalidade: Auditoria de transições de situação cadastral do animal.*

### Módulo 3: Ocorrências e SOS (Resgate Georreferenciado)
- **ocorrencias_sos:** id (int, PK, AI), animal_id (int, FK animais.id, Opcional), usuario_id (int, FK usuarios.id), tipo (enum 'Perdido', 'Encontrado'), nome_animal (varchar 100), especie (varchar 50), raca (varchar 50), sexo (enum 'Macho', 'Femea', 'Nao identificado'), cor (varchar 50), porte (enum 'Pequeno', 'Medio', 'Grande'), foto (varchar 255), data_ocorrencia (date), hora_ocorrencia (time), descricao (text), local_desaparecimento (varchar 255), latitude (decimal 10,8), longitude (decimal 11,8), telefone_contato (varchar 20), status (enum 'Pendente', 'Aprovada', 'Rejeitada', 'Resolvido'), motivo_rejeicao (text), moderada_por (int, FK usuarios.id), moderada_em (datetime), criado_em (timestamp), atualizado_em (timestamp).
  *Finalidade: Chamados georreferenciados de emergência SOS para exibição no mapa interativo.*
- **historico_status_sos:** id (int, PK, AI), ocorrencia_id (int, FK ocorrencias_sos.id), usuario_id (int, FK usuarios.id), status_anterior (varchar 50), status_novo (varchar 50), observacao (text), alterado_em (timestamp).
  *Finalidade: Histórico de moderação e evolução do atendimento do chamado.*

### Módulo 4: Prontuário Clínico Veterinário
- **consultas:** id (int, PK, AI), animal_id (int, FK animais.id), veterinario (varchar 150), data_consulta (date), motivo (varchar 255), diagnostico (text), observacoes (text).
  *Finalidade: Registro de consultas e atendimentos clínicos periódicos.*
- **exames:** id (int, PK, AI), animal_id (int, FK animais.id), tipo (varchar 100), data_exame (date), resultado (text), veterinario (varchar 150), arquivo (varchar 255).
  *Finalidade: Laudos de exames laboratoriais e complementares.*
- **vacinas:** id (int, PK, AI), animal_id (int, FK animais.id), nome_vacina (varchar 150), data_aplicacao (date), proxima_dose (date), veterinario (varchar 150), observacoes (text).
  *Finalidade: Carteira de vacinação e agendamento de reforço de doses.*
- **medicamentos:** id (int, PK, AI), animal_id (int, FK animais.id), nome (varchar 150), dosagem (varchar 100), frequencia (varchar 100), data_inicio (date), data_fim (date), veterinario (varchar 150), observacoes (text).
  *Finalidade: Prescrições ativas e histórico medicamentoso do animal.*
- **alergias:** id (int, PK, AI), animal_id (int, FK animais.id), alergia (varchar 150), descricao (text).
  *Finalidade: Cadastro de alergias e contraindicações terapêuticas.*
- **pesos_animais:** id (int, PK, AI), animal_id (int, FK animais.id), peso (decimal 5,2), data_registro (date), observacao (varchar 255).
  *Finalidade: Curva de evolução de peso corporal do animal.*
- **historico_medico:** id (int, PK, AI), animal_id (int, FK animais.id), data_atendimento (date), tipo (varchar 100), descricao (text), veterinario (varchar 150), peso (decimal 5,2), observacao (text), criado_em (timestamp).
  *Finalidade: Linha do tempo unificada de intervenções clínicas.*
- **saude_animais:** id (int, PK, AI), animal_id (int, FK animais.id), tipo (varchar 100), descricao (text), veterinario (varchar 150), data_atendimento (date), proximo_atendimento (date), observacao (text), criado_em (timestamp).
  *Finalidade: Acompanhamentos de rotina e lembretes de retorno.*

### Módulo 5: Adoções e Acompanhamento Pós-Adoção
- **adocoes:** id (int, PK, AI), animal_id (int, FK animais.id), usuario_id (int, FK usuarios.id), nome_completo (varchar 150), cpf (varchar 14), telefone (varchar 20), endereco (varchar 255), tipo_residencia (enum 'Casa', 'Apartamento', 'Chacara/Sitio'), experiencia_animais (tinyint 1), outros_animais (text), status (enum 'Solicitação', 'Em análise', 'Entrevista', 'Aprovada', 'Reprovada', 'Concluída'), observacoes (text), data_solicitacao (datetime), data_conclusao (datetime).
  *Finalidade: Processo formal e legal de adoção responsável.*
- **entrevistas_adocao:** id (int, PK, AI), adocao_id (int, FK adocoes.id), data_entrevista (datetime), responsavel (varchar 150), resultado (enum 'Aprovado', 'Reprovado', 'Pendente'), observacoes (text).
  *Finalidade: Avaliação qualitativa de perfil do adotante.*
- **acompanhamentos_adocao:** id (int, PK, AI), adocao_id (int, FK adocoes.id), data_acompanhamento (date), responsavel (varchar 150), situacao (text), observacoes (text), foto (varchar 255).
  *Finalidade: Vistorias pós-adoção garantindo o bem-estar do animal no novo lar.*

### Relacionamentos Estruturais por Chave Estrangeira (FK)
- `ocorrencias_sos.usuario_id` referencia `usuarios.id`
- `ocorrencias_sos.animal_id` referencia `animais.id` (relacionamento opcional 0..1)
- `ocorrencias_sos.moderada_por` referencia `usuarios.id`
- `historico_status_sos.ocorrencia_id` referencia `ocorrencias_sos.id`
- `historico_status_sos.usuario_id` referencia `usuarios.id`
- `adocoes.animal_id` referencia `animais.id`
- `adocoes.usuario_id` referencia `usuarios.id`
- `entrevistas_adocao.adocao_id` referencia `adocoes.id`
- `acompanhamentos_adocao.adocao_id` referencia `adocoes.id`
- `consultas`, `exames`, `vacinas`, `medicamentos`, `alergias`, `pesos_animais`, `fotos_animais`, `historico_medico`, `saude_animais` possuem chave estrangeira `animal_id` referenciando `animais.id`.
- `notificacoes.usuario_id` referencia `usuarios.id`

---

## 7. Critérios de Aceite (Formato "Dado que / Quando / Então")
- **CA01 — Autenticação com credenciais válidas:** Dado que o usuário possui conta ativa no sistema, quando ele informa e-mail e senha corretos na tela de login e submete o formulário, então o sistema autentica a sessão e o redireciona para a página inicial (Dashboard).
- **CA02 — Tentativa de autenticação com dados inválidos:** Dado que o usuário informa e-mail inexistente ou senha incorreta, quando submete o formulário de login, então o sistema impede o acesso, permanece na tela de login e exibe mensagem de alerta amigável, sem detalhar qual campo falhou.
- **CA03 — Proteção contra acesso indevido à área administrativa:** Dado que um usuário com perfil comum tenta acessar manualmente qualquer URL sob o diretório `/admin/`, quando a requisição chega ao servidor, então o sistema bloqueia o carregamento e o redireciona automaticamente para a página pública.
- **CA04 — Envio de ocorrência SOS com coordenadas geográficas:** Dado que o usuário preenche a ocorrência com dados obrigatórios, anexa foto válida e clica no mapa Leaflet gerando latitude e longitude, quando confirma o envio, então a ocorrência é gravada no banco com status "Pendente" e o chamado entra na fila de análise da equipe.
- **CA05 — Moderação com aprovação da ocorrência:** Dado que o administrador analisa uma ocorrência pendente e clica em "Aprovar ocorrência", quando a requisição é concluída, então o status muda para "Aprovada" e a ocorrência passa a ser exibida imediatamente no mapa público com marcador georreferenciado.
- **CA06 — Moderação com rejeição e justificativa obrigatória:** Dado que o administrador decide recusar uma ocorrência e informa a justificativa textual no campo correspondente, quando submete a decisão, então o status muda para "Rejeitada", a ocorrência não é exibida no mapa público e o motivo fica disponível para o autor em "Minhas Ocorrências".
- **CA07 — Bloqueio de rejeição sem justificativa:** Dado que o administrador tenta rejeitar uma ocorrência sem informar o motivo, quando clica em enviar, então o sistema bloqueia a requisição e exige que a justificativa seja devidamente preenchida.
- **CA08 — Cadastro de novo animal acolhido:** Dado que o administrador preenche o formulário de animais com foto e dados cadastrais válidos, quando salva o formulário, então o registro é persistido na tabela `animais` e passa a constar na listagem geral da organização.
- **CA09 — Inclusão de atendimento no prontuário veterinário:** Dado que o profissional cadastra uma vacina ou consulta para um animal, quando envia os dados clínicos, então o registro é gravado com vínculo por chave estrangeira àquele animal e passa a compor seu histórico de saúde.
- **CA10 — Submissão de proposta de adoção:** Dado que um cidadão autenticado clica em um animal com status "Disponível" e envia o questionário de adoção preenchido, quando submete o pedido, então o sistema cria o registro na tabela `adocoes` com status "Solicitação" e disponibiliza a proposta para análise da equipe.
- **CA11 — Acompanhamento pós-adoção:** Dado que a equipe realiza visita de adaptação ao novo lar, quando anexa fotos e relato no formulário de acompanhamento, então o registro é gravado com vínculo à adoção para fins de comprovação e monitoramento.

---

## 8. Decisão de Stack, Funcionamento Prático e Roteiro de Execução

### 8.1 Stack Tecnológica Adotada
- **Backend:** PHP 8 (arquitetura modular com conexão PDO, validação estrita no servidor e Prepared Statements).
- **Banco de Dados:** MySQL / MariaDB (integridade referencial por chaves primárias e estrangeiras, charset UTF-8 mb4).
- **Frontend:** HTML5 semântico, CSS3 responsivo (Flexbox e CSS Grid nativos) e JavaScript puro (ES6+).
- **Mapas e Geolocalização:** Leaflet.js v1.9.4 integrado à camada de tiles do OpenStreetMap.
- **Versionamento:** Git e repositório público no GitHub: https://github.com/anacarolinaferreira02/gestao_animais
- **Hospedagem em Nuvem:** Provedor gratuito InfinityFree (Apache + PHP 8 + MySQL remoto).

### 8.2 Como o Sistema Funciona na Prática (Fluxos Operacionais)
O sistema opera através de dois ciclos operacionais integrados:

1. **Ciclo do Cidadão (Resgate e Adoção):**
   - O cidadão acessa o sistema pelo computador ou celular.
   - Ao presenciar um animal perdido ou em risco na rua, clica em "Registrar Ocorrência", preenche as características, adiciona a foto tirada pelo celular e clica no mapa Leaflet para fixar as coordenadas exatas da rua/bairro em Porto Velho.
   - O chamado é registrado e aguarda verificação da equipe do abrigo para evitar trotes ou dados falsos. O cidadão pode consultar "Minhas Ocorrências" a qualquer momento para acompanhar a evolução do chamado.
   - No mapa público, qualquer pessoa pode visualizar animais perdidos e encontrados na sua região com fotos e telefone de contato para devolução.
   - Cidadãos interessados em adotar consultam a galeria de animais acolhidos e submetem propostas pelo formulário online.

2. **Ciclo da Equipe do Abrigo (Gestão e Atendimento Clínico):**
   - A equipe faz login com credenciais de administrador e visualiza o painel de controle restrito (`/admin`).
   - Na fila de moderação SOS, checa as ocorrências pendentes enviadas pelos cidadãos. Se aprovada, o animal passa a figurar no mapa público; se rejeitada (ex: foto ilegível ou trote), a justificativa é registrada e notificada ao usuário.
   - No módulo de animais, a equipe cadastra todos os animais acolhidos, mantém fotos e atualiza o status situacional.
   - Na área clínica, o veterinário registra cada consulta realizada, laudos de exames, peso, medicamentos e controle de vacinação (com data de aplicação e data prevista para a próxima dose).
   - No módulo de adoção, a equipe avalia as propostas dos cidadãos, agenda entrevistas e, após a aprovação, registra termos e acompanhamentos periódicos pós-adoção com fotos de vistoria no novo lar.

### 8.3 Como o Sistema Roda no Computador (Ambiente Local com XAMPP)
O sistema foi desenvolvido e validado para rodar no ambiente local Windows por meio do pacote integrado **XAMPP**. O procedimento exato de execução no computador é:

1. **Localização dos Arquivos:**
   - O projeto deve estar alocado dentro do diretório raiz do servidor Apache local:
     `C:\xampp\htdocs\gestao_animais`
   - O repositório pode ser clonado via Git ou os arquivos descompactados diretamente nesta pasta:
     ```powershell
     cd C:\xampp\htdocs
     git clone https://github.com/anacarolinaferreira02/gestao_animais.git
     ```

2. **Inicialização dos Serviços no XAMPP:**
   - Abrir o **XAMPP Control Panel** no Windows.
   - Clicar no botão **Start** correspondente ao módulo **Apache** (porta padrão: 80 / 443).
   - Clicar no botão **Start** correspondente ao módulo **MySQL** (porta padrão: 3306).
   - Ambos os módulos devem exibir indicador verde indicando execução com sucesso.

3. **Criação e Importação da Base de Dados:**
   - Abrir o navegador e acessar o phpMyAdmin local: `http://localhost/phpmyadmin`
   - Clicar em **Novo**, informar o nome da base de dados como `gestao_animais` e selecionar o agrupamento (collation) `utf8mb4_unicode_ci`.
   - Clicar na aba **Importar**, selecionar o arquivo `C:\xampp\htdocs\gestao_animais\schema.sql` e clicar em **Executar**.
   - As tabelas e os dados iniciais do administrador serão criados automaticamente.

4. **Configuração de Conexão Local e Isolamento de Senhas:**
   - O arquivo `config/conexao.php` foi arquitetado para carregar automaticamente o arquivo `config/local_env.php` caso ele exista no computador.
   - Para rodar no ambiente local do aluno com senha no MySQL, basta criar o arquivo `config/local_env.php` contendo:
     ```php
     <?php
     putenv("DB_HOST=localhost");
     putenv("DB_PORT=3306");
     putenv("DB_NAME=gestao_animais");
     putenv("DB_USER=root");
     putenv("DB_PASS=alunoifro"); // ou vazio ("") conforme configurado no XAMPP local
     ```
   - O arquivo `config/local_env.php` está explicitamente incluso no `.gitignore`, cumprindo integralmente as exigências de segurança do Anexo B da apostila (reprovação automática em caso de senhas no GitHub).

5. **Acesso à Aplicação no Navegador:**
   - Página inicial pública: `http://localhost/gestao_animais/index.php`
   - Teste de conexão direta com o banco: `http://localhost/gestao_animais/teste.php` (deve exibir: *"Conexão com o banco realizada com sucesso!"*).
   - Painel Administrativo: `http://localhost/gestao_animais/login.php` autenticando com perfil de administrador.

### 8.4 Como o Sistema Roda na Nuvem (Deploy em Produção no InfinityFree)
Conforme orienta a Fase 6, item 8 da apostila do Professor Rafael Pitwak (*"Caminho alternativo: manter PHP + MySQL e hospedar em um provedor gratuito compatível — nesse caso o Vercel fica de fora do deploy final, mas o GitHub continua sendo usado para versionamento"*), a aplicação está publicada e operacional no provedor gratuito **InfinityFree**:

- **URL Pública do Sistema:** `http://gestao-animais.infinityfreeapp.com`
- **Servidor Web Remoto:** Apache com suporte nativo a PHP 8 e mod_rewrite.
- **Host do Banco de Dados Remoto:** `sql311.infinityfree.com`
- **Nome do Banco Remoto:** `if0_42984854_gestao_animais`
- **Usuário do Banco Remoto:** `if0_42984854`
- **Script de Importação Remoto:** Foi utilizado o script otimizado `importar_infinityfree.sql`, compatível com os limites de permissões de bancos compartilhados.
- **Segurança de Credenciais na Nuvem:** No ambiente remoto, as credenciais são injetadas diretamente por variáveis de ambiente do servidor, assegurando que o código público versionado no GitHub não contenha senhas expostas.
