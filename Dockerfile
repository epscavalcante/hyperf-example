# ----------------------------
# Hyperf 8.3 Alpine - Dev Minimal
# ----------------------------
FROM hyperf/hyperf:8.3-alpine-v3.21-swoole-slim

RUN chmod a+rx /usr/local/bin/composer

# --- Build args para compatibilidade com host ---
ARG USER=application
ARG UID=1000
ARG GID=1000

# Cria grupo e usuário compatíveis com host
RUN addgroup -g ${GID} ${USER} \
    && adduser -D -u ${UID} -G ${USER} ${USER}

# Diretórios necessários
RUN mkdir -p /var/www /home/${USER}/.composer \
    && chown -R ${USER}:${USER} /var/www /home/${USER}

# --- Diretório de trabalho ---
WORKDIR /var/www

# --- Copia arquivos do host ---
COPY . /var/www
# RUN chown -R ${USERNAME}:${USERNAME} /var/www

# --- Instala Composer (já vem no Hyperf) e dependências de PCOV ---
#ENV COMPOSER_ALLOW_SUPERUSER=1

# --- Instala PCOV ---
RUN apk add --no-cache php83-pecl-pcov

RUN echo "pcov.enabled=1" > /etc/php83/conf.d/50_pcov.ini \
    && echo "pcov.directory=/var/www" >> /etc/php83/conf.d/50_pcov.ini \
    && echo "pcov.exclude=\"~vendor~\"" >> /etc/php83/conf.d/50_pcov.ini

# --- Git safe directory (para testes com CI ou composer) ---
RUN git config --global --add safe.directory /var/www

EXPOSE 9501

USER ${USERNAME}

CMD ["tail", "-f", "/dev/null"]
