<?php

$file = fopen("../data-sources/soccer-matches-data.csv", "r");      # Abrimos el archivo en modo lectura con el método "fopen()"

$matches = 0;                                                       # Declaramos variables para llevar el conteo de las lineas que hicieron y no hiciron match
$noMatches = 0;


while (!feof($file)) {                                              # Iteramos los registros del archivo CSV
  $line = fgets($file);                                             # Traemos los valores de las lineas del archivo

  if(preg_match(                                                    # Validamos que nuestra sentencia RegEx hace match, para hacer match de RegEx en PHP utilizamos la función "preg_match"
      '/^2018\-01\-(\d\d),.*$/',                                    # Como primer parámetro de la función "preg_match" va la sentencia RegEx con el formato que quiero que haga match, la agrupación (\d\d) sera el dia que se hizo el partido, al ser una agrupación ese valor se guardará en el index 1 del Array del match
      $line,                                                        # El segundo parametro va a ser la linea con la cual va a buscar si hace match o no
      $matchArray                                                   # El tercer parametro sera un Array donde iran cada uno de los matches, el indice 0 de este Array es el registro entero y le siguen los otros matches de agrupaciones como (\d\d)
    )
  ) {
    print_r($matchArray);                                           # Imprimimos los Arrays que hicieron match con nuestra sentencia RegEx, en el index 0 del Array se guardará toda la linea del registro que hizo Match
    $matches++;
  } else {
    $noMatches++;
  }
  #echo $line;                                                      # Con 'echo' hacemos print de todas las lineas del archivo CSV que estan guardadas en la variable $line
}

fclose($file);                                                      # Cerramos el archivo CSV

printf("\n\nmatches: %d\nno matches: %d\n",                         # Imprimimos con el formato deseado la información de las lineas que hiciero y no hicieron Match
$matches, $noMatches);                                              # Reemplazamos las variables temporales con los valores correspondientesd




# Ejemplo de registro para hacer pruebas de nuestra sentencia RegEx:
# 2018-01-30,Jamaica,Korea Republic,2,2,Friendly,Antalya,Turkey,TRUE