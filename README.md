# MoisesVille
Docker mongo:
- La conexion a la base no necesita usuario y debe seguir el siguiente formato
  mongodb://172.22.0.4:27017/moises
 

- Posinstalación  
Luego de instalar mongo se debe habilitar o agregar si no exite, la extencion de mongo en php.ini
/etc/php/7.0/apache2/php.ini 
extension=mongodb.so

instalar drive mongo 
sudo apt-get install php-mongodb o sudo apt-get install php7.0-mongodb


Errores:
Ante un problema de bower-asset correr el siguiente comando
- composer global require "fxp/composer-asset-plugin:^1.4.1"
