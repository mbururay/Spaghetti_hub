<?php
$data = [
    "Game of Thrones" => ["Jaime Lannister", "Catelyn Stark", "Cersei Lannister"],
    "Black Mirror" => ["Namette Cole", "Selena Telse", "Karim Parke"]
];

echo "<pre>";
print_r($data);
echo "</pre>";
echo "FAMOUS MOVIE TITLES AND THE ACTORS". "<br>";

foreach ($data as $title => $actors) {
    echo "<p><b>$title</b></p>";
    echo "<ul>";
    foreach ($actors as $actor) {
        echo "<li>$actor</li>";
    }
    echo "</ul>";
}

echo "this is a github test";
echo "This is a cnagng";
?>
