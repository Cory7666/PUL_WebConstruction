# Проект " Служба заказа такси "BNT" (Brand New Taxi) "
## Оглавление
1. [Дерево проекта](#Дерево-проекта)
2. [Описание файлов и каталогов](#Описание-файлов-и-каталогов)

## Дерево проекта
site
├── __patterns__
│   ├── __footer__.html
│   ├── __header__.html
│   └── pattern.html
├── account
│   └── index.php
├── actions
│   ├── __db__.php
│   ├── __sessions_and_cookies__.php
│   └── index.php
├── lib
│   ├── bootstrap -> bootstrap-5.1.3-dist
│   ├── bootstrap-5.1.3-dist
│   ├── css
│   │   └── main.css
│   ├── img
│   └── js
├── login
│   └── index.php
├── register
│   └── index.php
├── README.md
├── autoconfig.sh
└── index.php

## Описание файлов и каталогов
- /__patterns__/ -> Шаблоны для header'а и footer'а страниц.
- /lib/ -> Библиотека стилей, изображений и скриптов.
    * ./bootstrap/ -> Bootstrap.
    * ./css/ -> CSS-стили.
    * ./img/ -> Все картинки.
    * ./js/ -> Все скрипты.
- /account/ -> Страница: личный кабинет пользователя.
- /actions/ -> Серверные скрипты: Обработка действий над аккаунтом.
- /login/ -> Страница: Вход в аккаунт.
- /register/ -> Страница: Регистрация нового аккаунта.
- /README.md -> Описание проекта
- /autoconfig.sh -> Установка всех необходимых библиотек и программ.
- /index.php -> Страница: Главная страница сайта.