### Test Users
 ## Backend

Развертывание:
1. Нужно создать бд mysql test_users, без пароля, кодеровка utf8_general_ci
2. Перейти в папку 
   
   **cd source-code**
   
3. Запустить composer
   
   **composer install**
   
4. При использовании Openserver можно использовать следующую конфигурацию компонентов:

**PHP-7.4,Mysql-8.0, Apache_2.4-PHP-7.2-7**
   
  При использовании nginx конфиг(local) :

     server {
     server_name dima2.local;
        root /home/test-users/source-code/backend/web;
        index index.php;
        error_log /var/log/nginx/dima_error.log;

        location / {
                index index.php;
                try_files $uri $uri/ /index.php?$args;
        }

        gzip on;
        gzip_types text/plain text/css application/json application/x-javascript text/xml application/xml application/xml+rss text/javascript application/javascript;

        location ~ \.(js|css|png|jpg|gif|swf|ico|pdf|mov|fla|zip|rar)$ {
                # включать только после  прочтения этого
                # expires max;
                try_files $uri =404;
        }

        location ~ ^/(protected|framework|themes/\w+/views) {
                deny  all;
        }

        location ~* \.(php)$ {
                fastcgi_pass unix:/var/run/php/php7.4-fpm.sock;
                fastcgi_index index.php;
                include fastcgi_params;
                fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
                fastcgi_param PATH_INFO $fastcgi_path_info;
        }

        location ~ /\. {
                deny all;
                log_not_found off;
        } }





5. Запускаем миграции
   
   **yii migrate**
   
6. Переходим по URL:
   
   http://test-users/source-code/backend/web/site/login

7. пароль и логин от входа в админку: admin  
