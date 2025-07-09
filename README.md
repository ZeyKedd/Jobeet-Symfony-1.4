# Jobeet - Symfony 1.4 Job Board

Este es un proyecto de ejemplo basado en el tutorial oficial de Symfony 1.4: **Jobeet**, una bolsa de empleos desarrollada para aprender el framework.

## ⚙️ Requisitos

- PHP 5.4
- Symfony 1.4 (incluido en `/lib/vendor/symfony`)
- Servidor web (se usó **IIS** en desarrollo)
- Base de datos PostgreSQL (o SQLite/MySQL si se configura distinto)
- Extensión PDO habilitada para la base de datos elegida

## 📦 Instalación

1. Clonar o copiar este proyecto en tu equipo.
2. Configurar el archivo `config/databases.yml` con tus credenciales.
3. Crear y poblar la base de datos:

```bash
php symfony doctrine:build --all --and-load
