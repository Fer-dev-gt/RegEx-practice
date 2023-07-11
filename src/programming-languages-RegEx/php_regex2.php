<?php

$file = fopen("../data-sources/soccer-matches-data.csv", "r");              # Abrimos el archivo en modo lectura con el método "fopen()"

$matches = 0;                                                               # Declaramos variables para llevar el conteo de las lineas que hicieron y no hiciron match
$noMatches = 0;
$t = time();                                                                # Guardamo la medida de tiempo para calcular cuanto se tarda en mostrar todos los matches PHP


while (!feof($file)) {                                                     # Iteramos los registros del archivo CSV
  $line = fgets($file);                                                    # Traemos los valores de las lineas del archivo

  if(preg_match(                                                           # Validamos que nuestra sentencia RegEx hace match, para hacer match de RegEx en PHP utilizamos la función "preg_match", el formata agrupara valores para mostrar: pais local, pais visitante, goles local, goles visitante
      '/^(\d{4}\-\d\d\-\d\d),(.+),(.+),(\d+),(\d+),.*$/i',                 # Como primer parámetro de la función "preg_match" va la sentencia RegEx con el formato que quiero que haga match, haremos varias agrupaciones para guardarlas en diferentes indexes del Array de matches, colocamos la bancera "i" al final de la expresión para que sea "Case Insesitive" para que trate a mayusculas y minusculas igual
      $line,                                                               # El segundo parametro va a ser la linea con la cual va a buscar si hace match o no
      $matchArray                                                          # El tercer parametro sera un Array donde iran cada uno de los matches, el indice 0 de este Array es el registro entero y le siguen los otros matches de agrupaciones como (\d\d)
    )
  ) {
    if($matchArray[4] == $matchArray[5]) {                                 # Validamos las agrupaciones de los goles anotados por equipo y mostramo el resultado del partido
      echo "empate: ";
    } elseif ($matchArray[4] > $matchArray[5]) {
      echo "local:   ";                                                    # Le damos unos espacios extras para que se alinie con el Tab "\t"
    } else { 
      echo "visitante";
    }

    printf("\t%s, %s [%d-%d]\n",                                           # Mostramos el resultado del partido con los valores de nuestras agrupaciones: pais local, pais visitante, gol local, gol visitante. Le damos formato al texto usando Tab "\t" que corres los espacios hasta el final de los 8 espacios y va al siguiente "carrete"
    $matchArray[2], $matchArray[3], $matchArray[4], $matchArray[5]);       # Colocamos los valores correspondientes de las agrupaciones que hicimos
    #print_r($matchArray);                                                 # Imprimimos los Arrays que hicieron match con nuestra sentencia RegEx, en el index 0 del Array se guardará toda la linea del registro que hizo Match, los demas indexes lo ocuparán las agrupaciones que hicimos en la sentencia RegEx
    $matches++;
  } else {
    $noMatches++;
    #echo $line;                                                           # Imprimimos todas las lineas que no hicieron match (minimo 2, la del nombre de columnas y una linea vacia de espacio)
  }
}

fclose($file);                                                             # Cerramos el archivo CSV

printf("\n\nmatches: %d\nno matches: %d\n",                                # Imprimimos con el formato deseado la información de las lineas que hiciero y no hicieron Match
$matches, $noMatches);                                                     # Reemplazamos las variables temporales con los valores correspondientesd
printf("tiempo: %d\n", time() - $t);                                       # Imprimimos el tiempo que tarde en ejecutarse el programa



# Ejemplo de registro para hacer pruebas de nuestra sentencia RegEx:
# 2018-01-30,Jamaica,Korea Republic,2,2,Friendly,Antalya,Turkey,TRUE