<center> <b>Пример 5: чекбоксы</b> </center>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    echo ('Мой любимый предмет: <i>' . $_POST['kurs'] . '</i><br>');
    $favorite_times = count($times);
    if ($favorite_times <= 1) {
        $times_message = 'не ботан';
    } elseif ($favorite_times > 1 && $favorite_times < 4) {
        $times_message = 'ботаю иногда';
    } else {
        $times_message = 'ботан';
    }
    echo ('Я <i>'. $times_message . '</i><br>');
}
?>
<P>

<form action="index.php" method="post">
    <input type='radio' name='kurs' value='КТБД'>Конструкторско-технологические базы данных<br>
    <input type='radio' name='kurs' value='СФМ'>Системы функционально моделирования<br>
    <input type='radio' name='kurs' value='СИИ'>Системы искусственного интелекта<br>

    <br>
    Когда вы предпочитате его изучать:<br>
    <input type='checkbox' name='times' value='m'>За завтраком<br>
    <input type='checkbox' name='times' value='n'>В обед<br>
    <input type='checkbox' name='times' value='d'>За ужином<br>
    <input type='checkbox' name='times' value='l'>Поздно ночью<br>

<p>
<input type='hidden' name='stage' value='results'>
<input type='submit' value='Всегда'>
</form>
