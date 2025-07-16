# Projeto Integrador - Tema Livre - Emissão FAF - Central de Obitos
# 
Projeto Integrador - Universidade do Oeste de Santa Catarina (UNOESC).

## Tecnologias e Ferramentas utilizadas
- PHP
- CSS
- JavaScript
- MariaDB / MySQL
- Proxmox - Virtualização Sistemas
- LXC - Linux Container
- PhpMyAdmin
- Distro Linux
- LetsEncrypt (Geração de certificado digital)
- DNS / Dominio gerado
  
## Como executar o projeto
1. O projeto em si é simples de rodar, contudo, é necessário ter já provisionado uma instalação linux, ou até mesmo XAMP, para que, possa rodar de forma correta. Inicialmente esta idéia rodou em um Raspberry PI4, com o sistema Raspbian (fork do debian para dispositivo ARM).
2. Colocar os arquivos na pasta WWW/HTML ou outra definida no servidor virtual Apache2.
3. Importar para dentro do MariaDB/MySQL, o arquivo cemiterio.sql, o qual, ja esta definido.
4. Abaixo, links para instalação dos sistemas:
5. https://www.server-world.info/en/note?os=Debian_12&p=install (instalação debian)
6. https://www.server-world.info/en/note?os=Debian_12&p=httpd&f=1 (instalação apache/webserver)
7. https://www.server-world.info/en/note?os=Debian_12&p=httpd&f=3 (instalação SSL/webserver)
8. https://www.server-world.info/en/note?os=Debian_12&p=mariadb&f=1 (instalação MAriaDB/MySQL)
9. https://www.server-world.info/en/note?os=Debian_12&p=php&f=1 (instalação PHP)
10. https://pve-proxmox-com.translate.goog/wiki/Installation?_x_tr_sl=en&_x_tr_tl=pt&_x_tr_hl=pt&_x_tr_pto=tc (instalação do PROXMOX - Virtualização - Uso LXC / Linux)

## Problema do Projeto
A ideia veio da necessidade de otimizar o atendimento na parte de central de óbitos do Municipio. Em que pese, ser um trabalho da disciplina Projeto Integrador, e por estar trabalhando em órgão público, vi a necessidade deste setor/serviço. Atualmente é tudo manual, e, com isto, gerasse diversos papeis e demandas desnecessárias ao municipio. Deste modo, veio a ideia de unir o útil ao agradavel, e ir desenvolvendo tal idéia, para ser apresentado a Administração Municipal, para otimizar o tramite, e principalmente retrabalhos.

## Explicação do Projeto
O projeto, vai de encontro a ideia de otimizar processos internos dentro da Administração Municipal. Como ainda esta sendo "trabalhado", e ser validado na disciplina de Projeto Integrador, o mesmo não esta em produção propriamente. Entretanto, o mesmo já está "hospedado" dentro da estrutura da Prefeitura, a qual, também gerencio. Deste modo, é possível ir ajustando a ideia principal aqui apresentada, com a demanda necessária. O mesmo está virtualizado no ambiente interno, com controles e acessos proprios/dedicados, com as devidas separações de seguranças inerentes.

## Resultados
A ideia inicial é, aprovação dentro da disciplina Projeto Integrador, mas, o passo maior, é utiliza-lo dentro a Administração Municipal, para que possa atender as demandas existentes, racionalizando custos, facilitando controles, os quais, por ser um servidor municipal, entendo de forma efetiva, pois, a cobrança sempre vem de todas as partes. E facilitar/informatizar certas partes da administração até então, "obsoletas", é algo a ser pensado. Como já informado previamente, por mais que "obitos" não ocorram com frequencia, as informações aqui contidas, futuramente poderão facilitar tomadas de decisão, e analises por ferramentas de BI.

## Acesso Temporário:
- https://suporte.joacaba.sc.gov.br
Acesso: luiz.vaccari
Senha: 123456
