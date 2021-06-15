# Laravel like a pro

### Mantieni il tuo progetto pronto a funzionare in locale
- cp .env.example .env.
- php composer.phar install
- php artisan key:generate
- docker-compose up (MySQL) + crea il database `deliveroo`
- php artisan migrate
- php artisan db:seed

___

feat-1.patch
Problemi:
- Seed mancanti
- Ordine dei seed 
- Devono essere idempotenti
