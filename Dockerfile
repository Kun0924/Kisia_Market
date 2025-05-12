FROM php:8.2-apache

# 시스템 패키지 설치
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# PHP 확장 프로그램 설치
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Apache 모듈 활성화
RUN a2enmod rewrite

# Composer 설치
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 웹 서버 사용자 설정
RUN usermod -u 1000 www-data && groupmod -g 1000 www-data

# 작업 디렉토리 설정
WORKDIR /var/www/html

# 파일 권한 설정
RUN chown -R www-data:www-data /var/www/html 

# mysqli 설치 추가
RUN docker-php-ext-install mysqli

# sendmail 설치
RUN apt-get update && apt-get install -y sendmail

# php.ini 설정 추가 (파일 업로드 + sendmail)
RUN echo "upload_max_filesize=20M\npost_max_size=20M" > /usr/local/etc/php/conf.d/uploads.ini \
 && echo "sendmail_path = /usr/sbin/sendmail -S mailhog:1025" > /usr/local/etc/php/conf.d/mailhog.ini
 
# Composer 복사
COPY composer.json composer.lock ./

# 의존성 설치
RUN composer install