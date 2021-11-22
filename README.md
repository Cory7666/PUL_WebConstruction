# Проект " Служба заказа такси "BNT" (Brand New Taxi) "
## Оглавление
1. [Дерево проекта](#Дерево-проекта)
2. [Описание файлов и каталогов](#Описание-файлов-и-каталогов)

## Дерево проекта

```
site
├── account
│   ├── __forms__.html
│   └── index.php
├── actions
│   ├── __db__.php
│   ├── index.php
│   ├── old.index.php
│   └── __sessions_and_cookies__.php
├── lib
│   ├── bootstrap -> bootstrap-5.1.3-dist
│   ├── bootstrap-5.1.3-dist
│   ├── css
│   │   └── main.css
│   ├── img
│   │   ├── favicons
│   │   │   └── symbol.svg
│   │   └── BNT.png
│   └── js
├── __patterns__
│   ├── __footer__.html
│   ├── __header__.html
│   └── pattern.html
├── autoconfig.sh
├── index.php
└── README.md
```

## Описание файлов и каталогов
- /__patterns__/ -> Шаблоны для header'а и footer'а страниц.
- /lib/ -> Библиотека стилей, изображений и скриптов.
    * ./bootstrap/ -> Bootstrap.
    * ./css/ -> CSS-стили.
    * ./img/ -> Все картинки.
    * ./js/ -> Все скрипты.
- /account/ -> Страница: личный кабинет пользователя и выполнение действий над аккаунтом.
- /actions/ -> Серверные скрипты: Обработка действий над аккаунтом.
- /README.md -> Описание проекта
- /autoconfig.sh -> Установка всех необходимых библиотек и программ.
- /index.php -> Страница: Главная страница сайта.
