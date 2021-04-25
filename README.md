<p align="center">
    <a href="https://laravel.com" target="_blank">
        <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400">
    </a>
</p>

<p align="center">
    <a href="https://travis-ci.org/laravel/framework">
        <img src="https://travis-ci.org/laravel/framework.svg" 
             alt="Build Status">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://poser.pugx.org/laravel/framework/d/total.svg" 
             alt="Total Downloads">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://poser.pugx.org/laravel/framework/v/stable.svg"
             alt="Latest Stable Version">
    </a>
    <a href="https://packagist.org/packages/laravel/framework">
        <img src="https://poser.pugx.org/laravel/framework/license.svg"
             alt="License">
    </a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).


[Laravel level up от Framework Team](https://docs.google.com/document/d/1iyhYo-xlRT5Xq-p8wzOwyY6d79zZiGhoDhbj18J215g/edit#heading=h.3qvtvhi25eb4):

    Журнал изменений:
    1. initial commit
        - Новые миграции;
        - Новые фабрики;
        - Новые модели;
        - Новые seeders;
    2. В текущем коммите:
        - Организована связь Один ко многим (между моделью группа и студент). В одной группе может быть несколько студентов.
        - Также организована обратная связь Один ко многим (можно получить информацию о группе, в которой находиться тот или иной студент)
    3. В текущем коммите:
        - Организовать связь один к одному между моделями Student and Subject;
        - Subject на Student - обратное отношение;
        - Миграции и seeders - в рамках задания №2 (Laravel, миграции и модели)
    4. В текщуем коммите:
        - Student - модель пользователя, с полями по дефолту как у User;
        - Для регистрации используем FormRequest;
        - шаблоны для авторизации и регистрации, npm сборка, composer.phar и обновление зависимостей, языковые файлы;
        - стандартная ui bootsrtap аутенфикация переделана под нужны проекта;
    5. В текущем коммите:
        - Разметка, стили, адаптив, сборка под прод;
    6. В текущем коммите:
        - Миграция для таблицы admins;
        - Новая модель Admin;
        - Новая консольная команда на создание пользователя админа;
        - Правки в шаблоне регистрации пользователей студентов;
    7. В текущем коммите:
        - Наработки по авторизации для админа.
    8. В текущем коммите::
        - Установка и настройка laravel/telescope;
        - Удалил Barryvdh/laravel-debugbar;
        - Отказался полностью от изменений в седьмом коммите.
    9. В текущем коммите:
        - Реализация полиморфных отношений между моделью Student и User;
        - В связи с этим частично переписаны миграции и начальные данные;
        - Отредактирована консольная команда на создание Admin.
    10. В текущем коммите:
        - Миграция на создание таблицы admins;
        - Заполнение prodile_id и profile_type, с учётом полиморфных отношений в консольной команде admin:create;
        - Middleware для маршрутов, их регистрация и назначение в маршрутах;
        - Описание лочернего полиморфного отношения profile для модели Admin;
        - Разделение авторизации Admin и Student, также отдельные шаблоны;
        - Новые языковые переменные;
        - Стили, сборка под прод.
    11. В текущем коммите:
        - Некоторые наработки для CRUD groups (маршруты, контроллер, шаблоны, языковые констатны);
        - Install and include Fontawesome free
    12. В текущем коммите:
        - Продолжаю работу над CRUD groups в интерфейсе админа (шаблоны и логика в ресурсном контроллере GroupController.php)
    13. В текущем коммите:
        - Решено переписать логику ресурсного контроллера GroupController.php с учётом jQuery Ajax запросов в темплейтах. 
          GroupController.php теперь стал апи контроллером.
        - Удалены и редактированы шаблоны, а также маршруты с учётом последних изменений.
    14. В текущем коммите:
        - Новая ветка, попробую юзануть Vue.js + Ларовское АПИ через jQuery Ajax;
        - Установлен Vue.js;
        - Переделаны шаблоны с учётом компонентов vue.
    15. В текущем коммите:
        - Переделаны табы Bootsrap 4 с использованием возможностей Vue.js
    16. В текущем коммите:
        - Реализовал фронт на Vue.js для методов index() и show() для АПИ контролера GroupController;
        - Компонент для отображения учебных групп списком и детально, реализован обмен данными между компонентами;
        - Запрос к АПИ делаются через Ajax.
    17. В текущем коммите:
        - Обработка update а впи контролере через ajax;
        - В целом сгенерирован нормальный АПИ ресурсов - именно АПИ;
        - Переписан для него роутинг;
        - В update методе - валидация с отправкой ошибок на фронт;
        - Немного стилей, разметки и костылей.
    18. В текущем коммите:
        - описал валидацию на изменение имени группы в отдельном классе NewNameFormRequest;
        - чуть переделал вывод информационных сообщений в edit.vue;
        - избавился от vue router в package.json.
    19. В текущем коммите:
        - В миграциях преписал индексы для связей между таблицами как по документациии, для внешних ключей добавлена логика удаление и обновления;
        - Реализован метод destroy() для Api/CRUD/GroupController, а также реалиован vue компонент для этого функционала;
        - Файлы билда, некоторые правки и стили.
    20. В текущем коммите:
        - Закончил crud destroy и фронт в компонентах vue для него;
    21. В текущем коммите:
        - Метод update и фронт для него, общая полировка;
    22. В текущем коммите:
        - Пагинация для group crud на vue.js;
    23. В текущем коммите:
        - Завeрешён CRUD фронт на vue.js для групп, без адаптива;
    24. В текущем коммите:
        - index для CRUD SubjectController и выборка всех предметов через модель User;
        - Пустой API StudentController;
        - Маршрутизация;
        - Переписан GroupSeeder, теперь он запускает фабрику для групп.
    25. В текущем коммите:
        - Универсиализировал пагинацию для сущностей crud, вынес её логику в отдельный компонент.
    26. В текущем коммите:
        - Переименовал компоненты как мне нужно;
        - Нашёл и поправл баг, из за которого пагинция в Учебных группах и Учебных предметах, мешала друг другу;
    27. В текущем коммите:
        - Унверсиализация компонентов show и delete-item;
        - Доработка компонентов index-group и index-subject;
        - show метод для API subjects.
