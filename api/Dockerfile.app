FROM php:fpm-alpine3.19

ARG UUID
ARG GID
ENV UUID=${UUID:-1000}
ENV GID=${GID:-1000}


RUN apk update && apk add --no-cache curl \
    wget \
    postgresql-dev

RUN docker-php-ext-install pdo pdo_pgsql

COPY --from=composer:2.7.6 /usr/bin/composer /usr/bin/composer

RUN addgroup -g $GID appgroup && \
    adduser -D -u $UUID -G appgroup appuser
USER appuser

WORKDIR /app
RUN chown -R appuser:appgroup /app

CMD [ "php", "-S", "0.0.0.0:8000", "-t", "/app/public"]
