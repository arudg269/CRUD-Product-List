# Usa uma imagem oficial do PHP 8.2
FROM php:8.2

# Instala dependências do sistema e extensões do PHP necessárias para o Laravel e Postgres
RUN apt-get update -y && apt-get install -y \
    openssl \
    zip \
    unzip \
    git \
    libonig-dev \
    libpq-dev \
    && docker-php-ext-install pdo mbstring pdo_pgsql

# Instala o Composer (gerenciador de pacotes do PHP)
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Define a pasta de trabalho
WORKDIR /app

# Copia os arquivos do projeto para dentro do container
COPY . /app

# Instala as dependências do Laravel
RUN composer install --no-dev --optimize-autoloader

# Comando para iniciar o servidor usando a porta que o Render der ($PORT)
CMD php artisan serve --host=0.0.0.0 --port=$PORT