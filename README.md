# Projeto SuporteTech
## Descrição

Este projeto consiste em um sistema para gerenciar atendimentos e informações de clientes utilizando PHP e MySQL. Ele inclui funcionalidades como cadastro de clientes, visualização de dados, e a associação de peças e atendimentos a clientes.

## Estrutura do Projeto

O projeto é composto pelos seguintes arquivos principais:

- `config.php`: Arquivo de configuração do banco de dados.
- `formulariobt.php`: Formulário para cadastro de novos clientes.
- `editarbt.php`: Formulário para edição de dados de clientes.
- `saveEditar.php`: Script para salvar alterações feitas nos dados dos clientes.
- `visualizar.php`: Página para visualizar os dados dos clientes.

Além disso, existe um arquivo HTML (`inicial.html`) que serve como ponto de entrada para o sistema.

## Banco de Dados

O projeto utiliza um banco de dados MySQL chamado `SuporteTech`. A estrutura do banco de dados é definida no arquivo SQL incluído no projeto. O banco de dados contém as seguintes tabelas:

- `Pessoa`
- `Telefone`
- `Física`
- `Jurídica`
- `Funcionário`
- `Atendimento`
- `Peça`
- `equipamentoCliente`
- `utiliza`

## Configuração

1. **Importe o Banco de Dados**: 
   - Utilize o arquivo SQL incluído no projeto para criar o banco de dados `SuporteTech` e as suas respectivas tabelas.

2. **Configure a Conexão com o Banco de Dados**:
   - Atualize o arquivo `config.php` com as credenciais do banco de dados MySQL.

3. **Ajuste o Caminho no Arquivo HTML Inicial**:
   - **IMPORTANTE:** Altere o caminho dos arquivos PHP referenciados no arquivo `inicial.html` para refletir o nome, pasta e referência do seu ambiente de desenvolvimento.

## Execução

Após realizar as configurações necessárias, você pode acessar o sistema pelo navegador, utilizando o arquivo `inicial.html` como ponto de partida. Certifique-se de que o servidor PHP (como o XAMPP ou WAMP) esteja configurado corretamente.

## Integrantes do Projeto

- Aron
- Gabriel Jardim de Souza
- Kauê de Oliveira
- Paulo Henrique dos Anjos Silveira
- Thiago Ferreira

## Licença

Este projeto foi desenvolvido como parte da disciplina GCC214 - Introdução a Sistemas de Banco de Dados da Universidade Federal de Lavras (UFLA).


