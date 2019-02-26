#### Тестовое задание.

Вы получаете файл data.json с ежемесячными данными о заявках на обучение по 5 программам школы за год.
Ваша задача представить эти данные на странице в виде таблицы и в виде графика.
Требования: 

* PHP 7.0.
* index.php (любой web-сервер).
* Объектно-ориентированный подход.
* Сохранение настроек графика.
* Возможность сменить библиотеку построения графиков (предусмотрено в архитектуре).
* Возможность изменить источник данных (предусмотрено в приложении).
* Приятный интерфейс и все на английском, включая документацию.


### Документация
1. sent files are uploaded to the "front/upload" directory.
2. change the type of graphics is done through the jquery, method “post” to method “update_type_chart” of “main” class.
3. database - sqlite. used tables: type_graph, reports. database is stored in the "front/DB/app.db" directory.

### Инструкция
    1. report upload
    2. view report
    2.1 selection of the type of graphics

    1. to download the report click + on “RECEPT REPORTS"

    1.2. On the page that open, select .json file from your pc and click Upload


    after successful uploading, this file will appear in the “RECEPT REPORTS” list.

    2.1 to display the report - click on report file in the list menu “RECEPT REPORTS”.
    2.2 If need, you can change the type of the displayed chart by selecting its type in the upper right corner of the page.




    2.3 If need to display a graph for individual data, remove the extra elements by clicking on the line names.

полная инструкция лежит в корне instruction*.docx
