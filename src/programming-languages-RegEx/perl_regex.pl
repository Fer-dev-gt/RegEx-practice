#!/usr/bin/perl                                                                       # Esta linea todos los scripts de UNIX lo deben de tener

use strict;                                                                           # Implementamos el 'strict mode'
use warnings;                                                                         # Le decimos que nos muestre los Warnings

my $t = time;                                                                         # Guardamos en una variable una función que nos ayudará para medir el tiempo que tarda nuestro programa en hacer todos los matches y transformaciones (Se tardara muy poquito tiempo), al invocar 'time' guardamos el valor de tiempo EPOCH que es el numero de segundos que han pasado desde (1970-01-01)
my $match = 0;                                                                        # Declaramos e inicializamos variable para registrar cuantos Match encontro nuestra RegEx
my $noMatch = 0;                                                                      # Declaramos e inicializamos variable para ver cuantos registros no hicieron Match (minimo 1 por la primera fila que será el nombre de las columnas)

open(my $file, "<../data-sources/soccer-matches-data.csv") or die ("no hay archivo"); # Abrimos nuestro archivo CSV y lo guardamos en la variable $file indicandole el Path de la ubicación con el signo de apertura de lectura "<" para abrir el archivo, tambien mostramos un mensaje si no logra encontrar el archivo usando función 'die'

while(<$file>) {                                                                      # Vamos a iterar sobre cada una de las lineas de nuestro CSV unando un 'While'
  chomp;                                                                              # Con 'chomp' hacemos que se quitan lineas con "caracteres raros" como saltos de linea '\n'
  if(m/^([\d]{4,4})\-.*?,(.*?),(.*?),(\d+),(\d+),.*$/) {                              # Dentro de un If vamos a utilizar nuestras RegEx al colocar lo que queremos que haga Match dentro de m/RegEx/. Incluso podemos hacer agrupaciones y expresiones complejas y largas con signos ^$ para que solo haga un matcha por fila del CSV
    if($5 > $4) {                                                                     # Realizamos otra validación para saber cuando el visitante le gano al local, usamos las agrupaciones "$" para agarrar los valores del marcador, el numero de agrupación es el numero de gruopo donde se usaron los parentesis
      printf("%s: %s (%d) - (%d) %s\n",                                               # Usamos 'printf' para imprimir con un formato "más bonito" y definido el formato de muestro de nuestros resultados usadon el simbolo "%", si es '%s' es una "mascara" para valores String y '%d' es una "mascara" para un valor Int. Al final le damos un salto de linea
        $1, $2, $4, $5, $3)                                                           # Finalmente reemplazamos los valores por su lugar de agrupación correspondiente. El formato sera: Año del partido, pais local, marcador local, marcador visitante, pais visitante
    }
    $match++;
    #print $_."\n";                                                                   # Esta es una variable por defecto que nos otorga Pearl, en este caso la usamos para imprimir todas las lineas del archivo CSV. Tambie concateno un salte de linea '\n' usando el . para concatenar
  } else {
    $noMatch++;
  }
}

close($file);                                                                         # Cerramos el archivo CSV

printf("Se encontraron \n - %d matches\n - %d no matches\nTardo %d segundos",         # Le damos formato al mensaje de reporte de nuestro programa, como cuantos registros hizo y no hizo match, utilizamos el signo '%' como una variable temporal al que despues le damos el valor a mostrar
$match, $noMatch, time() - $t);                                                       # Aqui le asignamos en order el valor a las "variable temporales" de arriba, para la ultima variable de 'time' medimo el tiempo haciendo una simple resta usando 



# Ejemplo de registros para practicar el formato de nuestras RegEx: 
# 2018-06-02,Kenya,New Zealand,2,1,Friendly,Mumbai,India,TRUE
