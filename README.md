## Развертывание
1. Запустить: `docker-compose up -d --build`  в корневой директории проекта
2.  Запустить `docker exec -it ecommerce-task_php chown -R www-data:www-data ./storage ./bootstrap/cache`
3.  Запустить дамп `structure.sql`

## Условия задачи
1.  Изменить структуру базы данных ([Дамп структуры бд MySQL](https://drive.google.com/file/d/1dsc7Gg7TCUF6-858c9aNcAoZcY2dYK7q/view?usp=sharing)) так, чтобы:
    

-   Из данных таблицы `route`(Хранит структуру роутинга и навигации) можно было построить дерево вида:
    

-   Root
    

-   Log-in
    
-   Log-out
    
-   Dashboard
    
-   News
    
-   Comments
    
-   Control panel
    

-   Users
    
-   Analytic
    

-   Из данных таблицы `role`(Хранит структуру ролей) можно было получить дерево вида:
    

-   Guest
    

-   User
    

-   Manager
    
-   Admin
    

2.  Назначить отношение записей таблицы `role` к записям таблицы `route`
    

-   Root - Guest
    
-   Log-in - Guest (Не доступен для User)
    
-   Log-out - User
    
-   Dashboard - User
    
-   News - User
    
-   Comments - Manager
    
-   Control panel - Admin
    

-   Users - Admin
    
-   Analytic - Admin, Manager
    

3.  Вывести в браузер дерево со ссылками из таблицы `route`(Отображается на всех страницах):
    

-   Root (ссылка: “/”)
    
-   Dashboard (ссылка: “/dashboard”)
    
-   News (ссылка: “/news”)
    
-   Comments (ссылка: “/comment”)
    
-   Control panel
    

-   Users (ссылка: “/admin/users”)
    
-   Analytic (ссылка: “/admin/stat”)
    

4.  Вывести в браузер выпадающий список с записями из таблицы `role`(Отображается на всех страницах)
    
5.  При изменении значения выпадающего списка перестраивать дерево ссылок, для каждой роли.
    
6.  Для каждой ссылки дерева роутов сделать индивидуальные страницы, при переходе по любой из ссылок дерева роутов на странице должно быть отображено название роута.
    
7.  В результате для ролей должны отображаться следующие ссылки:
    

  

Роль

Роуты

Guest

-   Root
    
-   Log-in
    

User

-   Root
    
-   Dashboard
    
-   Log-out
    
-   News
    

Manager

-   Root
    
-   Dashboard
    
-   Log-out
    
-   News
    
-   Comments
    
-   Control panel
    

-   Analytic
    

Admin

-   Root
    
-   Dashboard
    
-   Log-out
    
-   News
    
-   Comments
    
-   Control panel
    

-   Users
    
-   Analytic
    

  
  

Результат задания загрузить на GitHub/BitBucket.

