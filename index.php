<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <h1>Countries</h1>
    <?php
$countries = [
    [
        "name" => "France",
        "capital" => "Paris",
        "area" => 640679,
        "population" => [
            "2000" => 59278000,
            "2010" => 59278000,
        ],
    ],
    [
        "name" => "England",
        "capital" => "London",
        "area" => 130395,
        "population" => [
            "2000" => 58800000,
            "2010" => 63200000,
        ],
    ],
    [
        "name" => "Deutschland",
        "capital" => "Berlin",
        "area" => 357021,
        "population" => [
            "2000" => 82260000,
            "2010" => 81752000,
        ],
    ],
];

//echo "{$countries[0]['name']} : {$countries[0]['population']['2010']}\n";

function cmp_capital($a, $b)
{ // функція, що визначає спосіб сортування (за назвою столиці)
    if ($a["capital"] < $b["capital"]) {
        return -1;
    } elseif ($a["capital"] == $b["capital"]) {
        return 0;
    } else {
        return 1;
    }
}

function cmp_name($a, $b)
{ // функція, що визначає спосіб сортування (за назвою столиці)
    if ($a["name"] < $b["name"]) {
        return -1;
    } elseif ($a["name"] == $b["name"]) {
        return 0;
    } else {
        return 1;
    }
}

function cmp_area($a, $b)
{ // функція, що визначає спосіб сортування (за назвою столиці)
    if ($a["area"] < $b["area"]) {
        return -1;
    } elseif ($a["area"] == $b["area"]) {
        return 0;
    } else {
        return 1;
    }
}

function cmp_population_2010($a, $b)
{ // функція, що визначає спосіб сортування (за назвою столиці)
    if ($a["population"]['2010'] > $b["population"]['2010']) {
        return -1;
    } elseif ($a["population"]['2010'] == $b["population"]['2010']) {
        return 0;
    } else {
        return 1;
    }
}

function cmp2($a, $b)
{ // функція, що визначає спосіб сортування (за сумою населення за 2000 та за 2010 роки)
    if ((($a["population"]["2000"] + $a["population"]["2010"]) / count($a["population"])) < (($b["population"]["2000"] + $b["population"]["2010"]) / count($a["population"]))) {
        return -1;
    } elseif ((($a["population"]["2000"] + $a["population"]["2010"]) / count($a["population"])) == (($b["population"]["2000"] + $b["population"]["2010"]) / count($a["population"]))) {
        return 0;
    } else {
        return 1;
    }

}

function try_walk($country, $key_country, $data)
{
    static $i = 1; // Статична глобальна змінна-лічильник
    echo "<strong>" . $data . $i . "</strong>";
    foreach ($country as $key => $value) {
        if (!is_array($value)) {
            echo "$key:$value\t";
        } else {
            echo "$key: ";
            foreach ($value as $k => $v) {
                echo "[{$k} рік. - $v] ";
            }
            echo "середнє населення: ".array_sum($value)/count($value);
        }
    }
    echo "<br>\n";
    $i++;
}

function search($countries, $data)
{
    $result = [];
    foreach ($countries as $country_number => $country) {
        foreach ($country as $key => $value) {
            if (!is_array($value)) {
                if (stristr($value, $data)) {
                    $result[] = $country_number;
                }
            } else {
                foreach ($value as $k => $v) {
                    if (stristr($v, $data) || strstr($k, $data)) {
                        $result[] = $country_number;
                    }
                }
            }
        }
    }

   // $seach_result = array_flip(array_unique($result));
    //$countries_seach_result = array_intersect_key($countries, array_flip(array_unique($result)));
    // return array_unique($result);
    //print_r($result);
    return array_intersect_key($countries, array_flip(array_unique($result)));
}

echo "рядок_для_виведення" . "{$countries[0]['name']} : {$countries[0]['population']['2010']}\n";

echo "<h3>№ Назва\tСтолиця\tПлоща\tНаселення</h3>\n";
array_walk($countries, "try_walk", "№");
echo "\n<br>";
uasort($countries, "cmp_capital");

echo "<h3>№ Назва\tСтолиця\tПлоща\tНаселення</h3>\n";
array_walk($countries, "try_walk", "№");
echo "\n<br>";
uasort($countries, "cmp_name");

uasort($countries, "cmp_population_2010");

echo "<h3>№ Назва\tСтолиця\tПлоща\tНаселення</h3>\n";
array_walk($countries, "try_walk", "№");
echo "\n<br>";
uasort($countries, "cmp2");

echo "<h3>№ Назва\tСтолиця\tПлоща\tНаселення</h3>\n";
array_walk($countries, "try_walk", "№");
echo "\n<br>";
//search($countries, "land");
//$seach_result = array_flip(search($countries, "land"));
//print_r($seach_result);
//$countries_seach_result = array_intersect_key($countries, $seach_result);
//print_r($countries_seach_result);

echo "\nseach result \"land\"<br>\n";
$csr = search($countries, "land");
array_walk($csr, "try_walk", "№");
echo "\n<br>";
$str_form_s = '<h3>Sort:</h3>
    <form action="index.php" name="myform" method="post">
        <select name="sort" size="1">
            <option value="cmp_name">Name</option>
            <option value="cmp_area">Area</option>
            <option value="cmp_capital">Capital</option>
            <option value="cmp2">Middle</option>
        </select>
        <input name="Submit" type=submit value="OK">
    </form>';
echo $str_form_s;
if (isset($_POST["sort"])) {
    uasort($countries, $_POST["sort"]);
    array_walk($countries, "try_walk", "№");
}

$str_search = '<h3>Search:</h3>
<form action="index.php" name="form_search" method="post">
<input type="text" name="search">
<input name="Submit_search" type="submit" value="Search">
</form>';
echo $str_search;
if (isset($_POST["Submit_search"])) {
    $csr = search($countries, $_POST["search"]);
    array_walk($csr, "try_walk", "№");
}
?>

</body>

</html>