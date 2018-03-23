# mvc-php-task

Simple implementation of the MVC Design Patterns Web Framework based on the pure PHP. The application has next pages:

- Login: With option for admin and public user. Admin (admin/1111) use can view, modify and create a new Task (upload image file <= 3MB) record with preview task option. The public user can only view and create a new task record.
- Home page. It contains Task data table records with pagination option with 3 task records per page. User can modify, view task record by clicking button in each row or create a new Task record (upload image file <= 3MB) with preview task option. 

The MVC Framework has next strucure:

- controller classes such as HomeController, IndexController, TaskController extends base classController which contains base routing and low level controller implementation of the MVC pattern
- model classes such as TaskModel. It extends base class Model, which contains all low level database reference implementation for generic CRUD operation.
- view classes and html/php files. They represent view state of the models and have user interface html components. The project has used Bootstrap 4 layout and components.

The demo version can be found: http://mvctask.hellotimeoff.com/
