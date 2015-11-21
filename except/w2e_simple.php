<?php ## Преобразование ошибок в исключения.
  require_once "PHP/Exceptionizer.php";

  // Для большей наглядности поместим основной проверочный код в функцию.
  suffer();

  // Убеждаемся, что перехват действительно был отключен.
  echo "<b>Дальше должно идти обычное сообщение PHP.</b>";
  fopen("fork", "r");

  function suffer() {
    // Создаем новый объект-преобразователь. Начиная с этого момента 
    // и до уничтожения переменной $w2e все перехватываемые ошибки 
    // превращаются в одноименные исключения.
    $w2e = new PHP_Exceptionizer(E_ALL);
    try {
      // Открываем несуществующий файл. Здесь будет ошибка E_WARNING.
      fopen("spoon", "r");
    } catch (E_WARNING $e) {
      // Перехватываем исключение класса E_WARNING.
      echo "<pre><b>Перехвачена ошибка!</b>\n", $e, "</pre>";
    }
    // В конце можно явно удалить преобразователь командой:
    // unset($w2e);
    // Но можно этого и не делать - переменная и так удалится при
    // выходе из функции (при этом вызовется деструктор объекта $w2e,
    // отключающий слежение за ошибками).
  }
?>