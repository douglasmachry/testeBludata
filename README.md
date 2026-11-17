# Bludata PHP Challenge — Company & Supplier Management

A PHP/MySQLi CRUD application created as a developer recruitment challenge. The task is to manage companies and their suppliers, including variable-length telephone lists and business-rule validation.

> **Status:** Historical coding challenge from August 2020. This repository is useful as a compact example of a PHP CRUD exercise, not as a production-ready business system.

## Requirements implemented by the challenge

### Companies

Each company has:
- State (UF)
- Trade name
- CNPJ

### Suppliers

Each supplier belongs to a company and has:
- Name
- CPF or CNPJ
- Registration date/time
- One or more optional telephone numbers
- RG and date of birth when the supplier is an individual

The challenge also specifies that an individual supplier under the age of 18 must not be registered for a company in Paraná.

The application provides company and supplier listing, creation, editing and deletion flows. Supplier screens are scoped to the selected company.

## Technology

- PHP 7.4-era application code
- MySQLi
- MariaDB 10.4 (the included SQL dump's original environment)
- Bootstrap and custom CSS
- jQuery for client-side interaction and input masks
- SQL schema and seed records in `model/testebludata.sql`

## Project structure

```text
config.php
index.php
ctrl/
  database.php
  ctrl-empresas.php
  ctrl-fornecedores.php
  validaCpfCnpj.class.php
model/
  testebludata.sql
view/
  empresas/
  fornecedores/
  css/
  js/
```

## Running locally

1. Create a MariaDB/MySQL database named `testebludata`.
2. Import `model/testebludata.sql`.
3. Configure the local database connection in `config.php` (use a dedicated least-privilege account).
4. Serve the project with a compatible PHP environment and open `index.php`.

Do not use production credentials or expose the database to the public internet.

## Security and production-readiness

The challenge contains legacy query-building patterns that concatenate values into SQL statements. A production implementation should use prepared statements, validate and authorize every company/supplier relationship on the server, add CSRF protection, escape output, enforce unique constraints at database level and keep configuration outside the repository. The code has not been security-audited or validated with a current framework/toolchain.
