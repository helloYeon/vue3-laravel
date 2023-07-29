```bash
$cd {WorkDir}
$docker-compose exec php composer install
$docker-compose exec php php artisan migrate
$docker-compose exec php php artisan db:seed
$cd {WorkDir}\src
$npm install
$cd {WorkDir}/src
$npm run dev
```
