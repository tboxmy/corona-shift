# codespaces environment

Added dev container php and mariadb

## Mariadb

username: mariadb
password: mariadb
server: 127.0.0.1

Access mysql
https://tboxmy-opulent-waffle-49qq6656q3jvpp-3306.preview.app.github.dev/

InnoDB engine is required for advanced db functions

in config/datase.php edit mysql section
```
'engine' => "innodb",
```