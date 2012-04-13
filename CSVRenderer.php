<?php
include 'Renderer.php';

class CSVRenderer implements Renderer {

    /** The taskwarrior exported CSV file. */
    private $f;

    function __construct($csv) {
        $this->f = $csv;
    }

    function render() {
        if ($this->f === FALSE) {
            return;
        }
        echo "<table class='tasks'>";

        // handle the header
        if(($csv = fgetcsv($this->f)) !== FALSE) {
          $cols = count($csv);
          echo "<thead><tr>";
          for ($c=0; $c < $cols; $c++) {
            // ignore specified data
            if ($c == 0 || $c == 3 || $c == 4 || $c == 5 || $c == 6  || $c == 7 || $c == 10 || $c == 11) {
              continue;
            }
            $field = str_replace("'", "", $csv[$c]);
            echo "<th>" . $field . "</th>";
          }
          echo "</tr></thead>";
        }

        // handle the data
        while(($csv = fgetcsv($this->f)) !== FALSE) {
          $cols = count($csv);
          echo "<tr>";
          for ($c=0; $c < $cols; $c++) {
            // ignore specified data
            if ($c == 0 || $c == 3 || $c == 4 || $c == 5 || $c == 6  || $c == 7 || $c == 10 || $c == 11) {
              continue;
            }
            $field = str_replace("'", "", $csv[$c]);
            echo "<td>" . $field . "</td>";
          }
          echo "</tr>";
        }
        echo "</tbody></table>";
    }
}

