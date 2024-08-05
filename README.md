# AppLocadoraCarros
Criando um app Rest com Laravel 
Iniciando o app com laravel:
`composer create-project --prefer-dist laravel/laravel app_locadora_carros "8.5.9"`
![alt text](image.png)

* Instalando JWT auth
`$ php composer.phar require tymon/jwt-auth "1.0.2"`
![alt text](image-1.png)
* Publicando o JWT provider
  `php artisan vendor:publish --provider="Tymon\JWTAuth\Providers\LaravelServiceProvider"`
* Gerando a jwt secret:
`php artisan jwt:secret`
![alt text](image-2.png)