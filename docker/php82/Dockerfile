# Use a imagem oficial do PHP
FROM php:8.2-cli

# Instale dependências e ferramentas úteis
RUN apt-get update \
    && apt-get install -y \
        git \
        unzip

# Instale o Composer globalmente
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instale e habilite o PDO do SQLite
RUN docker-php-ext-install pdo_sqlite

# Defina o diretório de trabalho para /app
WORKDIR /src

# Exponha a porta 8000 para aplicações web (se necessário)
# EXPOSE 8000

# Comando padrão para iniciar o contêiner (pode ser substituído pelo seu próprio comando)
CMD ["php", "-S", "0.0.0.0:8000"]

# Exemplo de como construir a imagem:
# docker build -t sua-imagem-php-com-composer .
