FROM httpd:2.4.43-alpine
RUN apk update; \
    apk upgrade; \
    apk add krb5-libs; \
    apk add apache-mod-auth-kerb

COPY ./my-httpd.conf /usr/local/apache2/conf/demo.apache.conf

RUN echo "Include /usr/local/apache2/conf/demo.apache.conf" \
  >> /usr/local/apache2/conf/httpd.conf
