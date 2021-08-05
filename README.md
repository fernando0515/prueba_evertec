# Instalación

### Instalación

Clonar repositorio

```sh
$ git clone https://github.com/fernando0515/prueba_evertec 
```
Ingresar al directorio para actualizar dependencias
```sh
composer update
```

Copiar .env.example como .env
```sh
cp .env.example .env
```

Generar llave del aplicativo
```sh
php artisan key:generate --ansi
```


Configuar datos de placetopay en el .env
```sh
PLACETOPAY_LOGIN=6dd490faf9cb87a9862245da41170ff2
PLACETOPAY_SECRETKEY=024h1IlD
PLACETOPAY_BASE_URL=https://test.placetopay.com/redirection/
PLACETOPAY_BASE_PSE_URL=https://test.placetopay.com/soap/pse/v11/?wsdl
```
