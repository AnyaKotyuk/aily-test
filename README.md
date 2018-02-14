# aily-test

Для работы скрипта необходимо указать правильные доступы з базе данных в /core/database.php:
$USER, $PASSWORD, $DATABASE, $HOST

Гостевая книга


Гостевая книга предоставляет возможность пользователям сайта оставлять сообщения на сайте. Все данные введенные пользователем сохраняются в БД MySQL, также в базе данных сохраняются данные о IP пользователя и его браузере.
Форма добавления записи в гостевую книгу должна иметь следующие поля:
User Name (цифры и буквы латинского алфавита) – обязательное поле
E-mail (формат email) — обязательное поле
Homepage (формат url) – необязательное поле
CAPTCHA (цифры и буквы латинского алфавита) – изображение и обязательное поле (http://ru.wikipedia.org/wiki/CAPTCHA)
Text (непосредственно сам текст сообщения, HTML тэги недопустимы) – обязательное поле
 
Сообщения должны выводится в виде таблицы, с возможностью сортировки по следующим полям: Username, e-mail, и дата добавления (как в порядке убывания, так и в обратном). Сообщения должны разбиваться на страницы по 25 сообщений на каждой. Сортировка по умолчанию – DESC.
При написании проекта следует обратить внимание на защиту от XSS атак и SQL –инъекций. (http://ru.wikipedia.org/wiki/Межсайтовый_скриптинг и http://ru.wikipedia.org/wiki/Инъекция_SQL)
Приветствуется создания простейшего дизайна с использованием CSS
Гостевая книга. JavaScript и работа с файлами.
К базовой функциональности, следует добавить следующие возможности:
К сообщению пользователь может добавить картинку или текстовый файл
Изображение должно быть не более 320х240 пикселей, при попытке залить изображение большего размера, картинка должна быть пропорционально уменьшена до заданных размеров, допустимые форматы файлов: JPG, GIF, PNG
Текстовый файл не должен быть больше чем 100кб, формат TXT
Просмотр файлов должен сопровождаться визуальными эффектами (для примера можно посмотреть http://www.huddletogether.com/projects/lightbox/ )



