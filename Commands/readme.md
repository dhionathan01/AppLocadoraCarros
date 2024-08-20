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
* Tratando o método stateless de redirect do validate do laravel, para quando for api,retornar um json e não um redirect:
* É necessário nos headers informar que o client aceita uma requisição json
![alt text](image-9.png)
  
  * Enviando arquivos pelo postman e fazendo a leitura pela API:
  ![alt text](image-10.png)
* Salvando imagens no diretório storange:
![alt text](image-11.png)
* Criando um link simbólico para acessar as imagens no diretório público:
*``
* ![alt text](image-12.png)
* ![alt text](image-13.png)
* Atualizando imagens da marca:
![alt text](image-14.png)
* Criando controller para Autenticação JWT
`php artisan make:controller AuthController`
![alt text](image-15.png)

* Criando um usuário pelo tinker
![alt text](image-16.png)

* Passando jwt nos headers como authorization:
![alt text](image-17.png)

* Recuperando dados do usuario logado com JWT
![alt text](image-18.png)

* Definindo variável global JWT_TTL para 120 para que a o token jwt dure 120 minutos  e não 60 que pe o valor padrão
![alt text](image-19.png)

Instalando laravel ui para começar a trabalhar com vueJs
`php composer.phar laravel/ui:^3.2.1`
![alt text](image-20.png)

Intalando o vueJs com autenticação nativa do laravel:
`$ php artisan ui vue --auth`

Fazendo a instação dos pacotes:
`npm install`
![alt text](image-21.png)

Fazendo o build das views
`npm run dev`

instalando o vue loader:
`npm install vue-loader@^15.9.8 --save-dev --legacy-peer-deps`
![alt text](image-22.png)

instalando o pacote vueX no projeto:
`npm install vuex@3.6.2`
![alt text](image-23.png)