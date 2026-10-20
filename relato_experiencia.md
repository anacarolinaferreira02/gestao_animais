# INSTITUTO FEDERAL DE RONDÔNIA
## Campus Porto Velho Calama — Desenvolvimento de Sistemas
### RELATO DE EXPERIÊNCIA: DESENVOLVIMENTO DE SISTEMAS COM APOIO DE IA

---

### Identificação
- **Título do Relato:** Desenvolvendo o Sistema Minha Patinha com Apoio de Inteligência Artificial: Um Relato de Experiência no Ensino Técnico
- **Autora:** Ana Carolina Ferreira
- **Instituição / Curso / Componente Curricular:** Instituto Federal de Educação, Ciência e Tecnologia de Rondônia (IFRO) – Campus Porto Velho Calama / Curso Técnico em Informática Integrado ao Ensino Médio / Desenvolvimento de Sistemas
- **Professor Orientador:** Prof. Rafael Pitwak
- **Data:** Outubro de 2026
- **Repositório no GitHub:** https://github.com/anacarolinaferreira02/gestao_animais
- **Aplicação em Produção:** http://gestao-animais.infinityfreeapp.com

---

### Resumo
Este trabalho relata a experiência prática do desenvolvimento do sistema web **Minha Patinha**, concebido para gerenciar resgates comunitários georreferenciados de animais perdidos e em situação de rua em Porto Velho (RO), além de centralizar a gestão clínica e os processos de adoção responsável de abrigos de animais. O projeto foi executado sob a metodologia pedagógica de desenvolvimento assistido por Inteligência Artificial estabelecida no componente curricular de Desenvolvimento de Sistemas do IFRO Campus Porto Velho Calama. O percurso metodológico seguiu as fases propostas na apostila da disciplina: elaboração da especificação de requisitos estruturada (Anexo A), isolamento de credenciais locais de banco de dados, desenvolvimento iterativo em PHP 8 com PDO e MySQL com suporte do agente Google Antigravity, testes de integridade, auditoria de segurança eliminatória (Anexo B) e implantação no provedor gratuito InfinityFree com versionamento contínuo no GitHub. O principal desafio enfrentado residiu na necessidade de intervenção humana crítica para rejeitar modelos conceituais simplificados gerados pela IA e contornar inconsistências lógicas de variáveis de sessão e links de rotas. A vivência demonstrou que o desenvolvimento com IA altera substancialmente a atuação discente: a tarefa manual de digitação de código é secundarizada pela capacidade analítica de arquitetura, validação de regras de negócio e postura de supervisão técnica ativa.

**Palavras-chave:** Inteligência Artificial; Desenvolvimento de Sistemas; Ensino Técnico; Auditoria de Software; Proteção Animal.

---

### 1. Introdução
O município de Porto Velho, capital do estado de Rondônia, convive historicamente com desafios estruturais relativos ao abandono de animais domésticos e à escassez de canais centralizados para localização ágil de animais perdidos. Diante desse cenário de relevância social, surgiu a proposta do sistema web **Minha Patinha**, idealizado para conectar cidadãos e protetores independentes por meio de chamados de socorro (SOS) georreferenciados em mapa interativo, assegurando simultaneamente o controle cadastral, o prontuário veterinário e o fluxo formal de adoção responsável dos animais acolhidos.

O objetivo precípuo deste relato de experiência não se resume à apresentação técnica das funcionalidades do sistema, mas concentra-se em analisar e refletir criticamente sobre o processo formativo de projetar, codificar, depurar e publicar uma aplicação web com o auxílio de um agente de Inteligência Artificial generativa (Google Antigravity). Todo o processo foi balizado por um método explícito de engenharia de software fundamentado em sete fases (planejamento, configuração, desenvolvimento modular, testes, correção de defeitos, auditoria de segurança e deploy em nuvem).

Registrar academicamente essa vivência é relevante porque o desenvolvimento assistido por modelos generativos de linguagem representa uma profunda ruptura de paradigma na educação profissional e tecnológica. Longe de caracterizar mero automatismo, a prática em ambiente escolar revela como os estudantes precisam desenvolver maturidade crítica para atuar como auditores, decisores e avaliadores do código gerado pela máquina.

---

### 2. Referencial Teórico
O desenvolvimento de software assistido por Inteligência Artificial constitui uma abordagem em que modelos de linguagem de grande escala (LLMs), integrados a ambientes interativos ou IDEs, atuam como pares colaborativos de programação (*pair programming*). Ao contrário das ferramentas tradicionais de preenchimento automático de sintaxe, os agentes contemporâneos são capazes de interpretar intenções expressas em linguagem natural, analisar árvores de dependência de projetos e sintetizar blocos completos de código backend, interfaces de usuário e instruções de banco de dados.

Essa transformação modifica radicalmente a rotina do desenvolvedor. Conforme sistematizado por Pitwak (2026), na metodologia *"Programar com IA de forma responsável"*, o estudante deixa de operar primordialmente como um digitador de comandos e passa a desempenhar as funções de arquiteto de software, especificador de requisitos e auditor de qualidade. O ato de programar passa a demandar domínio da engenharia de prompts, compreensão conceitual rigorosa dos mecanismos da linguagem e verificação contínua das soluções propostas.

O referencial do componente adverte enfaticamente para os riscos inerentes à confiança cega na IA: geração de códigos vulneráveis a injeção de SQL, vazamento acidental de credenciais sensíveis em repositórios públicos e alucinações lógicas sutis em que a IA gera rotas ou parâmetros que não correspondem à realidade da aplicação. Por essa razão, a metodologia adotada impõe critérios eliminatórios de avaliação (Anexo B), exigindo dos alunos auditorias documentadas e o registro minucioso de todas as correções e divergências técnicas em um histórico estruturado de alterações (*CHANGELOG*).

---

### 3. Metodologia / Percurso da Experiência
A condução prática do projeto desenvolveu-se ao longo do terceiro bimestre letivo, estruturada rigorosamente nas fases preconizadas na apostila da disciplina:

1. **Fase 1 — Planejamento e Especificação Técnica (`spec.md`):** Definição prévia e formal dos 8 eixos obrigatórios estabelecidos no Anexo A (Objetivo, Perfis de Usuários, Casos de Uso UC01 a UC14, Requisitos Funcionais RF01 a RF16, Requisitos Não Funcionais de segurança e usabilidade, Modelo Entidade-Relacionamento com 19 tabelas reais, Critérios de Aceite no padrão "Dado que / Quando / Então" e Decisão de Stack/Deploy).
2. **Fase 2 — Versionamento e Gestão de Ambiente:** Inicialização do repositório no Git e publicação remota no GitHub (`anacarolinaferreira02/gestao_animais`). Configuração minuciosa do arquivo `.gitignore` para impedir que arquivos temporários do sistema operacional e credenciais locais vazassem para a nuvem.
3. **Fase 3 & 4 — Desenvolvimento Modular com o Google Antigravity:** Implementação da arquitetura backend modular em PHP 8 orientada a objetos PDO, modelagem e manipulação do banco de dados relacional MySQL, criação das views em HTML5/CSS3 responsivo e integração da biblioteca [Leaflet.js](https://leafletjs.com/) sobre os mapas públicos do OpenStreetMap.
4. **Fase 5 — Testes, Auditoria e Registro de Decisões (`CHANGELOG.md`):** Realização de testes de caixa preta com as regras de negócio e checagem ponto a ponto do Checklist de Segurança do Anexo B da apostila, documentando todas as correções aplicadas e as ocasiões em que as decisões humanas divergiram das propostas da IA.
5. **Fase 6 — Deploy e Homologação em Produção:** Publicação bem-sucedida da aplicação no provedor de hospedagem em nuvem gratuita InfinityFree, com importação do banco de dados via phpMyAdmin remoto e homologação de funcionamento local em ambiente Windows/XAMPP.
6. **Fase 7 — Consolidação Documental:** Geração dos artefatos técnicos finais em múltiplos formatos legíveis (Markdown, PDF limpo sem grades e texto puro TXT) e relatório reflexivo final.

Quanto ao nível de autonomia do agente no Google Antigravity, optou-se expressamente pelo modelo de **autonomia supervisionada** (*Human-in-the-loop*). A cada bloco de código ou script SQL sugerido pela ferramenta, realizou-se leitura criteriosa do diff proposto antes da aprovação, evitando comandos automáticos que pudessem desestruturar a arquitetura modular estabelecida no projeto.

---

### 4. Relato da Experiência
Durante o ciclo de desenvolvimento, a interação com o assistente inteligente alternou entre momentos de elevado ganho de produtividade e episódios críticos em que a fiscalização humana foi decisiva para o sucesso do projeto.

Um primeiro momento marcante ocorreu durante a modelagem do banco de dados na Fase 1. Ao solicitar que a IA estruturasse o Modelo Entidade-Relacionamento do sistema, o agente gerou uma proposta minimalista composta por apenas três tabelas genéricas (`usuarios`, `animais`, `ocorrencias`). Embora essa estrutura atendesse aos fluxos básicos de resgate na rua, ela ignorava completamente o escopo de gestão do abrigo, inviabilizando prontuários clínicos veterinários, controle de vacinas com datas de reforço, exames e acompanhamento de adoções. A intervenção humana foi imediata: a proposta da IA foi expressamente rejeitada e forneceu-se como instrução uma diretriz detalhada com os atributos reais necessários para compor os cinco módulos de negócio (19 tabelas relacionais com chaves estrangeiras íntegras).

Outro momento de rica aprendizagem deu-se na depuração das permissões de acesso ao painel administrativo. Na codificação inicial, o agente gerou o fluxo de autenticação em `login.php` gravando o tipo do usuário na sessão como `$_SESSION["usuario_tipo"] = $usuario["tipo"]`. Contudo, ao implementar a tela `dashboard.php`, a IA programou a validação da barra de navegação consultando a variável `$_SESSION["tipo"]`. Em decorrência dessa divergência de nomenclatura, os administradores autenticados não conseguiam visualizar o botão de acesso ao `/admin/`. A estudante identificou o erro por meio da inspeção de variáveis globais de sessão no navegador e corrigiu a instrução condicional.

Ademais, na fila de moderação de ocorrências, o hiperlink gerado no arquivo `admin/ocorrencias.php` direcionava para `verificar_ocorrencia.php` (no singular), enquanto o arquivo existente no diretório físico denominava-se `verificar_ocorrencias.php` (no plural). Diante do erro 404, a IA sugeriu apressadamente renomear o arquivo do disco para o singular; contudo, a estudante optou por preservar o padrão de nomenclatura adotado em todo o projeto (`animais.php`, `usuarios.php`, `ocorrencias.php`) e alterou cirurgicamente o link na view, demonstrando a importância de manter a consistência arquitetural acima da conveniência imediata.

Por fim, no ajuste do ambiente de conexão local, constatou-se que o script `config/conexao.php` lia as variáveis de ambiente com `getenv("DB_PASS")` antes de chamar o arquivo `config/local_env.php`. Quando o MySQL local do XAMPP exigia senha (`alunoifro`), a tentativa de conexão falhava com o código de erro *1045 Access denied*. A estudante reordenou a estrutura lógica do script, forçando a importação do arquivo de configuração no início da execução, garantindo conexão estável tanto no ambiente escolar quanto em produção na nuvem.

---

### 5. Dificuldades e Desafios Enfrentados
A condução do trabalho expôs dificuldades técnicas e metodológicas que representaram os pontos de maior consolidação de competências do semestre:

1. **Desafio de Segurança e o Critério Eliminatório de Senhas (Anexo B):**
   * *O que aconteceu:* Na primeira versão gerada pelo assistente, o arquivo de conexão PDO continha o usuário `root` e a senha local gravados diretamente em texto plano no código-fonte. Pelo regulamento da atividade avaliativa, a presença de credenciais sensíveis versionadas no GitHub acarretaria reprovação sumária do projeto.
   * *Percepção:* Ao revisar o checklist do Anexo B antes de efetuar o commit inicial, a aluna identificou a vulnerabilidade eliminatória.
   * *Resolução:* Implementou-se uma arquitetura baseada em variáveis de ambiente, criando o template seguro `.env.example`, criando o script de ambiente local protegido `config/local_env.php` e adicionando-o categoricamente ao arquivo `.gitignore`.

2. **Limitações de Infraestrutura no Provedor Remoto Gratuito (Deploy no InfinityFree):**
   * *O que aconteceu:* Ao tentar executar o arquivo original `schema.sql` via phpMyAdmin no servidor do InfinityFree, o MySQL remoto rejeitou comandos avançados de criação de rotinas, views parametrizadas e certas restrições de tabelas por políticas de compartilhamento de recursos da hospedagem gratuita.
   * *Percepção:* O banco remoto retornava códigos de erro de permissão insuficiente (*Access denied for procedure / DDL limitations*), impedindo a inicialização da base remota.
   * *Resolução:* A estudante criou um script SQL derivado e otimizado denominado `importar_infinityfree.sql`, compatível com a infraestrutura remota compartilhada, permitindo a correta subida das tabelas e do usuário administrador padrão sem violar as diretrizes do provedor.

3. **Compreensão da Geolocalização e Captura de Coordenadas (Leaflet.js):**
   * *O que aconteceu:* A captura da posição do animal no mapa dependia da interação do usuário com a API de mapas do Leaflet. Inicialmente, a lógica gerada pela IA disparava múltiplos marcadores concorrentes no mapa a cada toque na tela do smartphone, gravando valores nulos de latitude e longitude no formulário caso o usuário clicasse fora do raio delimitado.
   * *Percepção:* Em testes funcionais manuais, as ocorrências salvas não apareciam no mapa porque os campos de coordenadas estavam vazios no banco.
   * *Resolução:* A estudante analisou o código do script JavaScript (`script.js`), compreendeu o ciclo de eventos `map.on('click')` e implementou uma rotina que remove marcadores anteriores, atualiza os campos ocultos de input com precisão decimal (`toFixed(8)`) e foca automaticamente o mapa na localização selecionada.

---

### 6. Resultados e Reflexões
A utilização de inteligência artificial generativa aliada a um roteiro metodológico rígido produziu resultados expressivos. A plataforma **Minha Patinha** atingiu plenamente seus objetivos operacionais: está homologada e acessível publicamente via web no domínio do InfinityFree, roda com estabilidade no ambiente local sob o XAMPP no Windows, possui código versionado no GitHub e conta com especificação e documentação de alterações concluídas.

Em termos de processo de aprendizagem, sobressaíram pontos positivos claros e reflexões críticas:
- **O que funcionou com excelência:** A velocidade na geração de código estrutural e formulários repetitivos foi notável. Rotinas que demandariam dias de digitação manual (como tabelas HTML, campos de formulários com validações de regex e estrutura base de classes de conexão) foram elaboradas em minutos, permitindo dedicar tempo substancial ao desenho de regras de negócio, testes de segurança e usabilidade móvel.
- **O que seria feito de forma diferente:** Numa oportunidade futura, o Modelo Entidade-Relacionamento completo (as 19 tabelas) seria estipulado e validado antes mesmo do primeiro comando de programação do backend. O retrabalho de expansão das tabelas intermediárias no decorrer do projeto ensinou que a falta de um escopo de dados inicial detalhado onera a manutenção do código.
- **Comparação com o processo tradicional sem IA:** Em relação aos bimestres iniciais do curso técnico, programar com IA revelou-se paradoxalmente mais veloz e cognitivamente mais exigente. Escrever o código à mão exige lembrar sintaxes exatas de funções e palavras-chave da linguagem; programar com IA, por outro lado, exige **leitura crítica profunda, capacidade de investigação de bugs complexos, visão arquitetural holística e rigor investigativo**. A estudante precisou saber muito mais do que apenas escrever PHP: precisou entender segurança defensiva, isolamento de variáveis, integridade de sessões e parametrização SQL para não ser enganada por soluções aparentemente corretas, porém estruturalmente frágeis.

---

### 7. Considerações Finais
A experiência vivenciada no desenvolvimento do sistema Minha Patinha demonstrou de maneira categórica que a Inteligência Artificial não substitui a formação técnica do desenvolvedor, mas eleva o nível intelectual de sua atuação prática. O método delineado pelo Professor Rafael Pitwak provou que a inteligência artificial, quando submetida a um processo disciplinado de planejamento e auditoria humana, capacita estudantes do ensino técnico a conceber e entregar aplicações completas, funcionais e seguras.

Como recomendação para as futuras turmas de Informática que vivenciarem este componente curricular, sugere-se nunca delegar as decisões arquiteturais à IA: formule primeiro a especificação técnica em detalhe, questione cada arquivo gerado antes de executá-lo, audite periodicamente o repositório contra vazamento de credenciais e exerça a responsabilidade humana sobre cada linha de código entregue.

---

### Referências
- ANTIGRAVITY. *Google Antigravity Documentation and Architecture Guide*. Mountain View: Google DeepMind, 2026.
- ASSOCIAÇÃO BRASILEIRA DE NORMAS TÉCNICAS (ABNT). *NBR 6022: Informação e documentação: Artigo em publicação periódica técnica e/ou científica: Apresentação*. Rio de Janeiro: ABNT, 2018.
- LEAFLET. *Leaflet: An open-source JavaScript library for mobile-friendly interactive maps*. Disponível em: <https://leafletjs.com/>. Acesso em: 20 out. 2026.
- PHP GROUP. *PHP: Hypertext Preprocessor Documentation (PHP 8 with PDO)*. Disponível em: <https://www.php.net/manual/pt_BR/>. Acesso em: 20 out. 2026.
- PITWAK, Rafael. *Programar com IA de forma responsável: Guia prático para o desenvolvimento consciente de software*. Porto Velho: Instituto Federal de Educação, Ciência e Tecnologia de Rondônia (IFRO), 2026.
- THE MARIADB/MYSQL FOUNDATION. *MySQL 8.0 Reference Manual: Relational Database Management System*. 2026.
