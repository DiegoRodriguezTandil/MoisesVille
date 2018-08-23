# MoisesVille
Docker mongo:
- La conexion a la base no necesita usuario y debe seguir el siguiente formato
  mongodb://172.22.0.4:27017/moises

- Posinstalación  
Luego de instalar mongo se debe habilitar la misma en php.ini
extension=mongodb.so

Errores:
Ante un problema de bower-asset correr el siguiente comando
- composer global require "fxp/composer-asset-plugin:^1.4.1"
