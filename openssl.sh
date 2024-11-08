#!/bin/bash

echo 'Ingrese modo (e/d):'
read -r modo

if [ "$modo" = "e" ]; then
    if [ -f ".env" ]; then
        echo 'Ingrese su contrasena:'
        read -s contrasena
        echo "$contrasena" | openssl enc -e -aes-256-cbc -a -pbkdf2 -iter 1000000 -pass stdin -in ".env" -out ".env.enc"
        contrasena=""
    else
        echo 'No existe el archivo .env para encriptar'
    fi
elif [ "$modo" = "d" ]; then
    if [ -f ".env.enc" ]; then
        echo 'Ingrese su contrasena:'
        read -s contrasena
        echo "$contrasena" | openssl enc -d -aes-256-cbc -a -pbkdf2 -iter 1000000 -pass stdin -in ".env.enc" -out ".env"
        contrasena=""
    else
        echo 'No existe el archivo .env.enc para desencriptar'
    fi
else
    echo "Modo inválido. Use 'e' para encriptar o 'd' para desencriptar."
fi
