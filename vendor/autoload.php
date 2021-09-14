<?php

class Autoloader
{
    /*карта namespace*/
    protected $map;

    public function addNamespace(string $prefix, string $dir)
    {
        /*когда сюда приходит регистрация prefix и dir где находятся файлы которые относятся к Арр мы их фиксируем
        в виде ключа - значение (либо prefix будет ключем, либо значение)
        таким образом когда мы в $autoload->addNamespace добавляем namespace, то мы  namespace вызываем раньше чем
        регистр таким образом мы накапливаем карты prefix и dir к которым они относятся, таким образом на момент
        загрузки class у нас уже будет соответствующая карта*/
        $this->map[$prefix] = $dir;
    }

    public function register()
    {
        /*этот метод запускается, когда у нас инициализируется новый объект класса
        если мы явно не указали, где находиться этот объект класса (не сделали require_once).
        Эта функция запускает метод autoload текущего класса (autoload($class))*/
        spl_autoload_register(array($this, 'autoload'));
    }

    public function autoload($class)
    {
        /*сюда приходит фрагмент искомого класса*/
        /*загружаем файл через require*/
        $file = null;
        foreach ($this->map as $prefix => $dir) {
            /*ищем в class наш префикс (например Арр)
            и если искомый префикс нашли то формируем имя файла*/
            if (strpos($class, $prefix) !== false) {
                /*далее class который мы ищем
                далее берем текущую директори скокотенируем путь к class
                при этом нужно удалить префик (например Арр)и приписать к полученному фрагменту .PHP
                используя массив*/
                $class = explode('\\', $class);
                array_shift($class);
                /*далее склеиваем массив*/
                $file = (realpath($dir . DIRECTORY_SEPARATOR .
                    implode(DIRECTORY_SEPARATOR, $class) .
                    '.php'));
            }
        }
        if (null !== $file) {
            include $file;
        }
    }
}

/*создаем класс автозагрузчик*/
$autoload = new Autoloader();

/*добавляем в автозагрузчик namespace
когда мы добавляем сюда namespace, то префикс App будет заходить в папку src и дальше будет искать все
что находится под префиксом APP
после чего срабатывает метод function addNamespace далее делаем карту namespace
после как приходит регистрация в addNamespace в $prefix и $dir мы фиксируем их*/
$autoload->addNamespace('App', __DIR__ . DIRECTORY_SEPARATOR . '../src');

/*вызываем этот метод если мы явно не указали, где находиться объект класса(не сделали require_once)
создав объект ($autoload = new Autoloader())*/
$autoload->register();
