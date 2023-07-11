import java.io.BufferedReader;                                                      // Importamos las librerias que nos permitiran procesar y leer el archivo CSV, las Exceptions y hacer Input/Output
import java.io.FileReader;
import java.io.IOException;
import java.util.regex.Matcher;                                                     // Importamos las librerías para poder trabajar con RegEx, la librería 'Matcher' se encarga de encontrar el patrón RegEx establecido lo más rapido posible
import java.util.regex.Pattern;                                                     // La libreriá 'Pattern' crea el patrón RegEx y lo compila

public class java_regex {                                                           // Nombre del programa
  public static void main(String[] args) {
    String file = "../data-sources/soccer-matches-data.csv";                        // Guardamos en la variable 'file' el string del Path del archivo CSV

    Pattern pattern = Pattern.compile("^2011\\-.*[zk].*$");                   // Instanciamos un nuevo objeto tipo 'Pattern' y le compilamos nuestra sentencia RegEx que debe de esta declarada dentro de "". Cuando escribimos una sentencia RegEx en Java tenemos que hacer "doble escape" de los metacaracteres reservados, ejemplo para -, seria \\-, el patron va a traer los partidos del 2011 en donde algun pais tiene en su nombre las letras "k" o "z"

    try {                                                                           // Probamos nuestra extracción de datos del CSV dentro de un try/catch como buena práctica
      BufferedReader buffer_reader = new BufferedReader(new FileReader(file));      // Instanciamos un Objeto tipo BufferedReader y le mandamos como parametro una nueva instancia de FileReader(file) con el archivo CSV que queremos que lea
      String line;                                                                  // Declaramos la variable 'line' que va a iterar a cada registro del archivo CSV

      while((line = buffer_reader.readLine()) != null) {                            // Iteramos cada linea del archivo CSV siempre y cuando no sea 'null'
        Matcher matcher = pattern.matcher(line);                                    // Instanciamos un Objeto tipo 'Matcher' que va buscar si hace match con nuestra sentencia RegEx la cual pasaremos como parametro en la Instanciación "pattern.matcher(line)"
        if(matcher.find()) {                                                        // Validamos si nuestro Objeto tipo Match encontro una linea que cumpliera con el patrón RegEx definido, si es true imprimimos los datos
          System.out.println(line);                                                 // Imprimimos las lineas del archiv CSV
        }
      }
    } catch (Exception e) {
      System.out.println("Nope!");
    }
  }

}

