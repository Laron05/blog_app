    FROM php:8.2-apache

    # Install system dependencies
    RUN apt-get update && apt-get install -y \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        && docker-php-ext-configure gd --with-freetype --with-jpeg \
        && docker-php-ext-install gd \
        && apt-get install -y --no-install-recommends \
        git \
        zip \
        unzip \
        && apt-get clean && rm -rf /var/lib/apt/lists/*

    # Create a non-root directory for Symfony
    RUN mkdir -p /app

    # Install Composer
    RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
        && composer --version  # Verify Composer installation
        
    # RUN composer self-update 2.6.6
    # Install Symfony CLI
    RUN curl -sS https://get.symfony.com/cli/installer | bash \
        && mv /root/.symfony*/bin/symfony /usr/local/bin/symfony \
        && symfony -v  
        # Check Symfony version

    # Set working directory
    WORKDIR /app

    # Admin permissions for composer
    ENV COMPOSER_ALLOW_SUPERUSER=1

    # Copy composer.json first to leverage Docker cache
    # COPY composer.json ./
    COPY . .
    # COPY .env.dev .env

    # Install dependencies
    RUN composer --working-dir=/app install -o \
        symfony server:ca:install

    # Executing the command to start an instance of the Symfony application
    CMD ["symfony", "server:start"]

    # Expose the port the app runs on
    EXPOSE 80