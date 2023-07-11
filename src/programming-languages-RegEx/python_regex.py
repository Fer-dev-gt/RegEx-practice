#!/usr/bin/python                                                                   # Esta linea todos los scripts de UNIX lo deben de tener, le damos el permiso de ejecución del archivo

import re                                                                           # Importamos la librería 're' para poder trabajar con RegEx

pattern = re.compile(r'^([\d]{4,4})\-\d\d\-\d\d,(.+),(.+),(\d+),(\d+),.*$')         # Guardamos nustra sentencia RegEx en una Compilación "re.compile(RegEx)", aca definis el patron de los partidos que harán match, tambien podemos definir nuestras agrupaciones, la sentencia RegEx debe de estar adentro de r''

file = open("../data-sources/soccer-matches-data.csv", "r")                         # Abrimos el archivo CSV en modo lectura

for line in file:                                                                   # Iteramos cada linea que esta en nuestro archivo CSV que guardamos en la variable 'file'           
  #print (line)                                                                     # Imprimimos cada linea del archivo
  res = re.match(pattern, line)                                                     # Guardo en la variable 'res' true o false si hace Match al 'pattern' de nuestro formato Regex, eso lo mandamos como parametro a la funcion "re.match(patter, line)" como segundo parametro mandamos la linea que va a comparar con nuestra sentencia RegEx
  if res:
    total = int(res.group(4)) + int(res.group(5))                                   # Podemos operar los valores de las agrupaciones que sean numeros (hay castear los valores de un String a Int), es este caso vamos a sumar los goles anotados por el visitante y el local,
    if total > 10:                                                                  # Imprimimos los 'matches' donde el total de goles anotados sea mayor al valor estipulado 
      print("goles anotados: %d, %s %s, %s [%d-%d]" %                               # Damos formato a nuestros Matchs, usamos el simbolo % fuera de las comillas para asignarle el valor correspondiente a las agrupaciones que hicimo en la sentencia RegEx
            (total, res.group(1), res.group(2),                                     # Obtenemos los valores de las agrupaciones usando "res.group(1)" segun el orden en que las declaramos, reemplazamos los valores de las variables por el valor que tenemos en nuestras agrupaciones y de las operaciones que hicimos usando agrupaciones (como la variable 'total')
            res.group(3), int(res.group(4)),                                        # Para los valores de los goles les hacemos un casteo de String a Int
            int(res.group(5))))                                                     # El formato de nuestros resultados es: goles anotados, fecha del partido, pais local, pais visitante, goles local, goles visitante


file.close()                                                                        # Cerramos el archivo CSV




# Esta es otra forma de imprimir los matche con el formato 'print(f"{variable})' de Python3
#print(f"goles anotados: {total}, {res.group(1)} {res.group(2)}, {res.group(1)} [{int(res.group(4))}-{int(res.group(5))}]")


# Ejemplo de registro de un partido, lo usamos para practicar el Match de la sentencia RegEx
# 2018-06-04,Armenia,Moldova,0,0,Friendly,Kematen,Austria,TRUE