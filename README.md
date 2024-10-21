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
   cd ReservaLaravel

