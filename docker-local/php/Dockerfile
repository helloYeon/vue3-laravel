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
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '55ce33d7678c5a611085589f1f3ddf8b3c52d662cd01d4ba75c0ee0459970c2200a51f492d557530c71c15d8dba01eae') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
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
