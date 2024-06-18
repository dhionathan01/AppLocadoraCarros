Criando model controller e migration de marca:
`php artisan make:model --migration --controller --resource Marca`
![alt text](image.png)
Criando model controller e migration de modelo:
`php artisan make:model -mcr Modelo`
![alt text](image-1.png)

Criando o model, factory, migration, seeder, controller de Carro com uma unica instrução:
`$ php artisan make:model --all  Carro`
![alt text](image-2.png)

Criando o model, factory, migration, seeder, controller de Cliente com uma unica instrução:
`$ php artisan make:model --all  Cliente`
![alt text](image-3.png)
Criando o model, factory, migration, seeder, controller de Cliente com uma unica instrução:
`$ php artisan make:model -a  Locacao`
![alt text](image-4.png)

* Criando banco de dados:
`CREATE DATABASE lc; `
![alt text](image-5.png)
*Definindo banco lc no .env*
* Executando as migrates:
`php artisan migrate`
![alt text](image-6.png)
![alt text](image-7.png)

* Fazendo um post com o Postman para api:
![alt text](image-8.png)
teste git