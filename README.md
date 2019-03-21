blog

How install:
1. `git clone https://github.com/linux815/blog.git`
3. `cd laradock && cp env-example .env `
4. `cd ../ && cp .env.example .env`
5. `./start.sh` or `cd laradock && docker-compose up -d nginx postgres`
6. `./bash.sh` or `cd laradock && docker-compose exec workspace bash`
7. `composer install`
8. `npm install` or `npm install --unsafe-perm`
9. `php artisan key:generate`
10. `php artisan migrate`
11. `php artisan db:seed`
12. (optional) `chown laradock:laradock -R storage/logs/`
13. `cd client && npm run dev`
14. run browser and enter `yourip:3000`

Так как тестовое задание удавалось делать только по вечерам, я не успел доделать фронт (CRUD). Плюс разворачивал всё с нуля и с nuxt.js ранее не работал.
В целом сервер готов, права настроил по ТЗ с помощью laratrust, тексты во *.vue и php файлах не стал выносить в переводы.
На фронт вывел все данные, прокинул права доступа. Данные заполняются с помощью seeds (при db:seed нужно нажать yes)

