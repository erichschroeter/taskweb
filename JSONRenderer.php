<?php
include 'Renderer.php';

class JSONRenderer implements Renderer {

    /** The JSON file exported from taskwarrior. */
    private $f;

    function __construct($f) {
        $this->f = $f;
    }

    function render() {
        echo '<div class="tasks container_12">';
        while (($line = fgets($this->f)) !== FALSE) {
            // remove whitespace/line endings
            $line = trim($line);
            // remove comma if exists
            if ($line[strlen($line)-1] == ',') {
                $line = rtrim($line, ',');
            }
            $task = json_decode($line);
            switch (json_last_error()) {
                case JSON_ERROR_DEPTH:
                    echo ' - Maximum stack depth exceeded';
                break;
                case JSON_ERROR_STATE_MISMATCH:
                    echo ' - Underflow or the modes mismatch';
                break;
                case JSON_ERROR_CTRL_CHAR:
                    echo ' - Unexpected control character found';
                break;
                case JSON_ERROR_SYNTAX:
                    echo ' - Syntax error, malformed JSON';
                break;
                case JSON_ERROR_UTF8:
                    echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
                break;
                case JSON_ERROR_NONE:
                default:
                break;
            }
            echo '<div class="task grid_12">';
            echo '<div class="status grid_2">' . $task->{'status'} . '</div>';
            echo '<div class="description grid_10">' . $task->{'description'} . '</div>';
            echo '<div class="clear"></div>';
            echo '<div class="meta">';
            // decrement columns when a value is present
            $cols = 12;

            if (isset($task->{'project'})) {
                $cols -= 3;
                echo '<label class="grid_1">Project:</label>';
                echo '<div class="project grid_2">';
                if (isset($task->{'project'})) {
                    $project = $task->{'project'};
                    echo $project;
                }
                echo '</div>';
            }

            if (isset($task->{'priority'})) {
                $cols -= 2;
                echo '<label class="grid_1">Priority:</label>';
                echo '<div class="priority grid_1">';
                if (isset($task->{'priority'})) {
                    $priority = $task->{'priority'};
                    echo $priority;
                }
                echo '</div>';
            }

            if (isset($task->{'due'})) {
                $cols -= 3;
                echo '<label class="grid_1">Due:</label>';
                echo '<div class="due grid_2">';
                if (isset($task->{'due'})) {
                    $due = $task->{'due'};
                    echo date('D, j M', strtotime($due));
                }
                echo '</div>';
            }

            echo '<div class="grid_' . $cols . '"></div>';

            if (isset($task->{'tags'})) {
                $tags = $task->{'tags'};
                echo '<div class="clear"></div>';
                echo '<h3>Tags</h3>';
                echo '<div class="tags grid_12">';
                foreach ($tags as $tag) {
                    echo '<span class="tag">' . $tag . '</span>';
                }
                echo '</div>';
            }

            if (isset($task->{'annotations'})) {
                $annotations = $task->{'annotations'};
                echo '<div class="clear"></div>';
                echo '<h3>Annotations</h3>';
                echo '<div class="annotations grid_12">';
                foreach ($annotations as $entry => $annotation) {
                    echo '<span class="annotation">' . $annotation->{'description'} . '</span>';
                }
                echo '</div>';
            }
            echo '</div></div>';
        }
        echo '</div>';
    }
}
