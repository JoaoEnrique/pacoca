FROM wyveo/nginx-php-fpm:latest

# Copiar os arquivos do projeto
COPY . /usr/share/nginx/html

# Copiar o arquivo de configuração do Nginx
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Configurações do ambiente
ENV SKIP_COMPOSER 1
ENV WEBROOT /usr/share/nginx/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr
ENV COMPOSER_ALLOW_SUPERUSER 1

# Instalar vim (opcional)
# RUN apt-get update && apt-get install -y vim

# Criar link simbólico para a pasta public
RUN ln -s /usr/share/nginx/html/public /usr/share/nginx/html/html

# Expor a porta 80
EXPOSE 80

# Definir o diretório de trabalho
WORKDIR /usr/share/nginx/html

# Executar o script de inicialização
CMD ["/start.sh"]
