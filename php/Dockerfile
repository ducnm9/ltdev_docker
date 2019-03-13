FROM php:7.3.2-fpm-alpine3.9

ENV PHPIZE_DEPS \
    autoconf \
    dpkg-dev dpkg \
    cmake \
    file \
    g++ \
    gcc \
    libc-dev \
    pcre-dev \
    make \
    git \
    pkgconf \
    re2c \
    # for GD
    freetype-dev \
    libpng-dev  \
    libjpeg-turbo-dev \
    libxslt-dev

# persistent / runtime deps
RUN apk add --no-cache \
        ca-certificates \
        curl \
        tar \
        xz \
# https://github.com/docker-library/php/issues/494
        openssl

RUN set -xe \
    && apk add --update \
        icu \
    && apk add --no-cache --virtual .php-deps \
        make \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
        zlib-dev \
        icu-dev \
        g++ \
    && docker-php-ext-configure intl \
    && docker-php-ext-install \
        intl \
    && docker-php-ext-enable intl \
    && { find /usr/local/lib -type f -print0 | xargs -0r strip --strip-all -p 2>/dev/null || true; } \
    && apk del .build-deps \
    && rm -rf /tmp/* /usr/local/lib/php/doc/* /var/cache/apk/*

RUN apk add --no-cache --virtual .persistent-deps \
    # for soap
#    libxml2-dev \
    # for amqp
    libressl-dev \
    # for GD
    freetype \
    libpng \
    libjpeg-turbo

RUN set -xe \
    # workaround for rabbitmq linking issue
    && ln -s /usr/lib /usr/local/lib64 \
    && apk add --no-cache --virtual .build-deps \
        $PHPIZE_DEPS \
    && docker-php-ext-configure gd \
        --with-gd \
        --with-freetype-dir=/usr/include/ \
        --with-png-dir=/usr/include/ \
        --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-configure bcmath --enable-bcmath \
    && docker-php-ext-configure pcntl --enable-pcntl \
    && docker-php-ext-configure mysqli --with-mysqli \
    && docker-php-ext-configure pdo_mysql --with-pdo-mysql \
    && docker-php-ext-configure mbstring --enable-mbstring \
#    && docker-php-ext-configure soap --enable-soap \
    && docker-php-ext-install -j$(nproc) \
        gd \
        bcmath \
        pcntl \
        mysqli \
        pdo_mysql \
#        xml \
#        soap \
        iconv


RUN apk add --no-cache libpng-dev zlib-dev libzip-dev \
    && docker-php-ext-configure zip --with-libzip \
    && docker-php-ext-install zip

RUN pecl install redis \
    && docker-php-ext-enable redis

RUN docker-php-ext-install exif xsl opcache
RUN docker-php-ext-enable mysqli

RUN apk del .build-deps \
    && rm -rf /tmp/*


ENV COMPOSER_HOME /root/composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
ENV PATH $COMPOSER_HOME/vendor/bin:$PATH





# mailing
#RUN echo "http://dl-cdn.alpinelinux.org/alpine/edge/testing" >> /etc/apk/repositories
#RUN apk update \
#    && apk add --no-cache mailutils

# Install postfix
# Install postfix first to get the first account (101)
#RUN        true && \
#           apk add --no-cache postfix cyrus-sasl cyrus-sasl-plain && \
#           apk add --no-cache ca-certificates tzdata rsyslog && \
#           apk add --no-cache --upgrade musl musl-utils && \
#           (rm "/tmp/"* 2>/dev/null || true) && (rm -rf /var/cache/apk/* 2>/dev/null || true)
#ENTRYPOINT "postfix start" && /bin/bash