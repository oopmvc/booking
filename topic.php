<?php

require 'TopicData.php';
include 'header.php';

$data = new TopicData();
$data->connect();

$topics = $data->getAllTopics();

echo '<div class="container pt-4 pb-4">';
    foreach ($topics as $topic) {
        echo "<h3>" . $topic['first_name'] . " " . $topic['last_name'] . "</h3>";
        echo "<p>" . $topic['description'] . "</p>";
    }
    $topic = $data->getTopic(1);
    echo "ID risorsa singola: " . $topic['id_resource'];
echo '</div>';

include 'footer.php';

?>
