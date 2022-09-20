<?php

// Сначало создадим обстракный класс животного, от которого будут наследовать конкретные животные
abstract class animal
{
    // Статическая переменая для хранения ключа
    static $id = 1;
    // номер животного
    public $idAnimal = 1;

    // сколько дает
    public abstract function getProduct();

    // вернуть
    public function getNameOfClass()
    {
        return static::class;
    }
}

/**
 * Класс курица
 */
class chicken extends animal
{
    // коснтруктор класса, задаем уникальный номер
    function __construct()
    {
        // Задаем уникальный номер
        $this->idAnimal = parent::$id++;
    }

    // сколько может дать яиц курица
    public function getProduct()
    {
        return rand(0, 1);
    }

}

/**
 * Класс корова
 */
class cow extends animal
{
    // коснтруктор класса, задаем уникальный номер
    function __construct()
    {
        // задаем номер уникальный
        $this->idAnimal = parent::$id++;
    }

    // сколько может дать корова молоко
    public function getProduct()
    {
        return rand(8, 12);
    }
}

/**
 * Класс фабрики
 */
class Factory
{
    // Регистриурем курицу
    public function createСhicken(): chicken
    {
        return new chicken;
    }

    // Регистрируем корову
    public function createCow(): cow
    {
        return new cow;
    }
}


// Создаем фабирку
$factory = new Factory();

// Представим, что этот массив это холев
$a = array();

// Количество коров и куриц
$k = 0;
$c = 0;

// Создаем 10 коров
for ($i = 1; $i <= 10; $i++) {
    $a[] = $factory->createCow();
    $k++;
}

// Создаем 20 кур
for ($i = 1; $i <= 20; $i++) {
    $a[] = $factory->createСhicken();
    $c++;
}

echo "Всего коров в хлеву - " . $k . "\n";
echo "Всего куриц в хлеву - " . $c . "\n";

// Корзина первой недели
$firstWeekMilk = 0;
$firstWeekEgg = 0;

// Всего продукции
$milk = 0;
$egg = 0;

// Сбор пробукции за первую неделю
for ($i = 1; $i <= 7; $i++) {
    foreach ($a as $value) {
        // в зависемости от животного слаживаем проудкцию
        switch ($value->getNameOfClass()) {
            case "cow":
                $firstWeekMilk += $value->getProduct();
                break;
            case "chicken":
                $firstWeekEgg += $value->getProduct();
                break;
        }
    }
}
echo "Молока за первую неделю - " . $firstWeekMilk . "\n";
echo "Яиц за первую неделю - " . $firstWeekEgg . "\n";

// Корзина второй недели
$SecondWeekMilk = 0;
$SecondWeekEgg = 0;

// Создаем еще 1 корову
for ($i = 1; $i <= 1; $i++) {
    $a[] = $factory->createCow();
    $k++;
}

// Создаем еще 5 кур
for ($i = 1; $i <= 5; $i++) {
    $a[] = $factory->createСhicken();
    $c++;
}

echo "Всего коров в хлеву после похода в магаз за ними - " . $k . "\n";
echo "Всего куриц в хлеву после похода в магаз за ними - " . $c . "\n";

// Сбор пробукции за вторую неделю
for ($i = 1; $i <= 7; $i++) {
    foreach ($a as $value) {
        switch ($value->getNameOfClass()) {
            case "cow":
                $SecondWeekMilk += $value->getProduct();
                $milk += $SecondWeekMilk;
                break;
            case "chicken":
                $SecondWeekEgg += $value->getProduct();
                $egg += $SecondWeekMilk;
                break;
        }
    }
}

echo "Молока за вторую неделю - " . $SecondWeekMilk . "\n";
echo "Яиц за вторую неделю - " . $SecondWeekEgg . "\n";

$milk = $SecondWeekMilk + $firstWeekMilk;
$egg = $firstWeekEgg + $SecondWeekEgg;

echo "Всего за две недели было собрано " . $milk . " литров молока и " . $egg . " штук яиц с фермы.";
