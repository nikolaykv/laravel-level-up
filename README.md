<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/d/total.svg" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/v/stable.svg" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://poser.pugx.org/laravel/framework/license.svg" alt="License"></a>
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

###Журнал изменений 

[Laravel level up от Framework Team](https://docs.google.com/document/d/1iyhYo-xlRT5Xq-p8wzOwyY6d79zZiGhoDhbj18J215g/edit#heading=h.3qvtvhi25eb4):

    1. initial commit
        - Новые миграции;
        - Новые фабрики;
        - Новые модели;
        - Новые seeders;
    2. В текущем коммите:
        - Организована связь Один ко многим (между моделью группа и студент). В одной группе может быть несколько студентов.
        - Также организована обратная связь Один ко многим (можно получить информацию о группе, в которой находиться тот или иной студент)
    3. В текущем коммите:
        - Организовать связть один к одному между моделями Student and Subject;
        - Subject на Student - обратное отношение;
        - Миграции и seeders - в рамках задания №2 (Laravel, миграции и модели)
    4. В текщуем коммите:
        - Student - модель пользователя, с полями по дефолту как у User;
        - Для регистрации используем FormRequest;
        - шаблоны для авторизации и регистрации, npm сборка, composer.phar и обновление зависимостей, языковые файлы;
        - стандартная ui bootsrtap аутенфикация переделана под нужны проекта;
