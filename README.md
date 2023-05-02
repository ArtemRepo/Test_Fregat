#__Реестр проверок__

#__Приложение с использованием MVC Codeigniter (php, ajax, search, Datatable, MySQL, PhpSpreadsheet)__#

:white_check_mark: CRUD-приложение на Codeigniter (создание, чтение,редактирование,удаление данных)
:white_check_mark: Поиск данных Datatable
:white_check_mark: Экспорт данных в Excel (PhpSpreadsheet)
:white_check_mark: Импорт данных CSV в директорию проекта



__DATABASE__

database.default.hostname = localhost
database.default.database = ci4_blog
database.default.username = root
database.default.password = ''
database.default.DBDriver = MySQLi
database.default.DBPrefix =
database.default.port = 3306

Run local in browser http://localhost:8080/posts

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(100)  NOT NULL,
  `description` varchar(100) NOT NULL,
  `created_at` date NOT NULL ,
  `updated_at` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;
