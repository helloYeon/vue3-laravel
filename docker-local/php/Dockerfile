FROM centos:7
WORKDIR /usr/share/nginx/html/
RUN ln -sf /usr/share/zoneinfo/Asia/Tokyo /etc/localtime

RUN yum -y update

RUN yum install -y https://rpms.remirepo.net/enterprise/remi-release-7.rpm

ENV PHP_VERSION="82"

RUN yum -y install --enablerepo=remi,remi-php${PHP_VERSION} \
    php \
    php-devel \
    php-pdo \
    php-fpm \
    php-mysqlnd \
    php-mbstring \
    php-xml \
    php-pear

RUN pecl install xdebug-3.2.0alpha3
RUN useradd nginx
RUN yum -y install gcc make jq curl git zip unzip

RUN yum -y install mysql

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'a5c698ffe4b8e849a443b120cd5ba38043260d5c4023dbf93e1558871f1f07f58274fc6f4c93bcfd858c6bd0775cd8d1') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('dcomposer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

ENV NODEJS_VERSION="14.17.0"
RUN curl -sL https://rpm.nodesource.com/setup_14.x | bash -
RUN yum -y install --enablerepo=nodesource nodejs-${NODEJS_VERSION}

RUN yum clean all

RUN echo 'alias cd_doc_root="cd /usr/share/nginx/html/"' >> ~/.bashrc
RUN echo 'alias at="php artisan"' >> ~/.bashrc
RUN echo 'alias ll="ls -al"' >> ~/.bashrc

EXPOSE 9000

CMD ["/usr/sbin/php-fpm", "--nodaemonize"]
