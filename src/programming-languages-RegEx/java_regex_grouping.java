// Este programa hace lo mismo que el anterior, con la diferencia que busca otro patrón y usamor "agrupation" ej Java usando la sintaxis 'matcher.group(2)'
import java.io.BufferedReader;                                                      
import java.io.FileReader;
import java.io.IOException;
import java.util.regex.Matcher;                                                     
import java.util.regex.Pattern;     

public class java_regex_grouping {
	public static void main(String[] args) {
    String file = "../data-sources/soccer-matches-data.csv";

    Pattern pat = Pattern.compile("^(18\\d\\d\\-.*),(.*),(.*),(\\d+),(\\d+),([\\w\\s]+),.*$");

    try {
      BufferedReader br = new BufferedReader(new FileReader(file));
      String line;

      while((line = br.readLine()) != null) {
        Matcher matcher = pat.matcher(line);
        if(matcher.find()) {
          System.out.println("Fecha: " + matcher.group(1));
          System.out.println(matcher.group(2) + " (" + matcher.group(4)+" - "+ matcher.group(5)+ ") " + matcher.group(3) );
          System.out.println("Torneo: " + matcher.group(6));
          System.out.println("-------------------------------------------------------------\n");
        }
      }
    } catch(Exception e) {
      System.out.println("Error");
    }
  }
}