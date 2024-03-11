# Zotlo Challenge API App

## Install
`docker compose -f "docker-compose.yml" up -d --build`

`./vendor/bin/sail php artisan migrate --seed`

## Usage
#### Get all users  

```http
  GET /api/user
```  
Tüm kullanıcıların şifreleri password olarak tanımlanır.

  


