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
    if ($a["name"] < $b["capital"]) {
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
    if ((($a["population"]["2000"] + $a["population"]["2010"]) / 2) < (($b["population"]["2000"] + $b["population"]["2010"]) / 2)) {
        return -1;
    } elseif ((($a["population"]["2000"] + $a["population"]["2010"]) / 2) == (($b["population"]["2000"] + $b["population"]["2010"]) / 2)) {
        return 0;
    } else {
        return 1;
    }

}

function try_walk($country, $key_country, $data)
{
    static $i = 1; // Статична глобальна змінна-лічильник
    echo "<strong>".$data . $i . "</strong>";
    foreach ($country as $key => $value) {
        if (!is_array($value)) {
            echo "$key:$value\t";
        } else {
            echo "$key: ";
            foreach ($value as $k => $v) {
                echo "[{$k} рік. - $v] ";
            }
        }
    }
    echo "<br>\n";
    $i++;
}

function search($countries, $data) {
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
    return array_unique($result);
    //print_r($result);
}


echo "<h3>№ Назва\tСтолиця\tПлоща\tНаселення</h3>\n";
array_walk($countries, "try_walk", "№");

uasort($countries, "cmp_capital");

echo "№ Назва\tСтолиця\tПлоща\tНаселення\n";
array_walk($countries, "try_walk", "№");
uasort($countries, "cmp_name");

uasort($countries, "cmp_population_2010");

echo "№ Назва\tСтолиця\tПлоща\tНаселення\n";
array_walk($countries, "try_walk", "№");

uasort($countries, "cmp2");

echo "№ Назва\tСтолиця\tПлоща\tНаселення\n";
array_walk($countries, "try_walk", "№");

//search($countries, "land");
$seach_result = array_flip(search($countries, "land"));
//print_r($seach_result);
$countries_seach_result = array_intersect_key($countries, $seach_result);
//print_r($countries_seach_result);
echo "\nseach result \"land\"\n";

array_walk($countries_seach_result, "try_walk", "№");
?>
    <?= "рядок_для_виведення"."{$countries[0]['name']} : {$countries[0]['population']['2010']}\n" ?>
</body>

</html>