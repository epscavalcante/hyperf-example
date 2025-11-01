# ----------------------------
# Hyperf 8.3 Alpine - Dev Minimal
# ----------------------------
FROM hyperf/hyperf:8.3-alpine-v3.21-swoole-slim

# --- Build args para compatibilidade com host ---
ARG USERNAME=application
ARG UID=1000
ARG GID=1000

# --- Criação do usuário compatível com host ---
RUN addgroup -g ${GID} ${USERNAME} \
 && adduser -D -u ${UID} -G ${USERNAME} ${USERNAME} \
 && mkdir -p /home/${USERNAME}/.composer /var/www \
 && chown -R ${USERNAME}:${USERNAME} /home/${USERNAME}/.composer /var/www

# --- Diretório de trabalho ---
WORKDIR /var/www

# --- Copia arquivos do host ---
COPY . /var/www
RUN chown -R ${USERNAME}:${USERNAME} /var/www

# --- Instala Composer (já vem no Hyperf) e dependências de PCOV ---
ENV COMPOSER_ALLOW_SUPERUSER=1
RUN apk add --no-cache php84-pecl-pcov \
 && echo "pcov.enabled=1" > /etc/php84/conf.d/50_pcov.ini \
 && echo "pcov.directory=/var/www" >> /etc/php84/conf.d/50_pcov.ini \
 && echo "pcov.exclude=\"~vendor~\"" >> /etc/php84/conf.d/50_pcov.ini

# --- Git safe directory (para testes com CI ou composer) ---
RUN git config --global --add safe.directory /var/www

# --- Exposição de porta padrão Hyperf ---
EXPOSE 9501

# --- Usuário padrão para desenvolvimento ---
USER ${USERNAME}

# --- Comando default (mantém o container ativo para dev) ---
CMD ["tail", "-f", "/dev/null"]
