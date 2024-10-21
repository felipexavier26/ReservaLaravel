# Sistema de Reservas de Salas

## Descrição

Este projeto é uma API REST desenvolvida em Laravel que permite realizar operações CRUD para reservas de salas. Os usuários podem criar, editar, excluir e visualizar reservas. A API garante que as salas não sejam reservadas duas vezes no mesmo horário e que as reservas não possam ser feitas para o passado.

## Tecnologias Utilizadas

- **Backend:** Laravel
- **Banco de Dados:** PostgreSQL
- **PHP:** 8.x

## Ambiente Necessário

- **PHP:** >= 8.0
- **Composer:** (para gerenciar dependências do PHP)
- **PostgreSQL:** >= 12.x

## Instruções de Instalação

### Backend (Laravel)

1. **Clone o repositório:**
   ```bash
   git clone https://github.com/felipexavier26/ReservaLaravel.git

2. **Navegue até o diretório do projeto:**
   ```bash
   cd ReservaLaravel

3. **Execute as migrações para criar as tabelas no banco de dados**
   ```bash
   php artisan migrate

4. **Crie um arquivo .env a partir do arquivo .env.example:**
   ```bash
   cp .env.example .env


5. **SQL para Criação da Database e Tabelas no PostgreSQL**
   ```bash
   -- Criar a database
   CREATE DATABASE reserva_smart;

   -- Conectar à database
    \c reserva_smart;

   -- Criar a tabela salas
    CREATE TABLE salas (
        id SERIAL PRIMARY KEY,
        nome_sala VARCHAR(255) NOT NULL
    );
    -- Criar a tabela reserva_salas
    CREATE TABLE reserva_salas (
        id SERIAL PRIMARY KEY,
        nome_sala VARCHAR(255) NOT NULL,
        dt_hr_inicio TIMESTAMP NOT NULL,
        dt_hr_termino TIMESTAMP NOT NULL,
        nome_responsavel VARCHAR(255) NOT NULL,
        status BOOLEAN DEFAULT TRUE,
        FOREIGN KEY (nome_sala) REFERENCES salas(nome_sala) ON DELETE CASCADE
    );


6. **Endpoints da API REST**<br>
   ```bash
    Rotas para a API de reserva_salas
   
    GET /api/reserva_salas: Lista todas as reservas de salas.
    GET /api/reserva_salas/{salas}: Obtém uma reserva específica pelo ID.
    POST /api/reserva_salas: Cria uma nova reserva.
    PUT /api/reserva_salas/{salas}: Atualiza uma reserva existente.
    DELETE /api/reserva_salas/{salas}: Deleta uma reserva.

    Rotas para a API de salas

    GET /api/salas: Lista todas as salas disponíveis.
    GET /api/salas/{sala}: Obtém informações de uma sala específica pelo ID.
    POST /api/salas: Cria uma nova sala.
    PUT /api/salas/{id}: Atualiza informações de uma sala existente.
    DELETE /api/salas/{sala}: Deleta uma sala.


7. **Exemplo de Chamadas com cURL**
   ```bash
    curl -X POST http://localhost:8000/api/reserva_salas \
    -H "Content-Type: application/json" \
    -d '{
        "nome_sala": "Sala 101",
        "dt_hr_inicio": "2024-09-30 10:00:00",
        "dt_hr_termino": "2024-09-30 12:00:00",
        "nome_responsavel": "João Silva"
    }'

8. **Listar todas as reservas**
   ```bash
    curl -X GET http://localhost:8000/api/reserva_salas

9. **Deletar uma reserva**
   ```bash
    curl -X DELETE http://localhost:8000/api/reserva_salas/{salas}


   

