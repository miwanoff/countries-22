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
    echo $data . $i . " ";
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
    echo "\n";
    $i++;
}

echo "№ Назва\tСтолиця\tПлоща\tНаселення\n";
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