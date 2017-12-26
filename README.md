## Image Hosting

### Installation
- clone repository
- add write access to the storage folder
- make DB and import from Database/sql/db.sql
- configure config.php

### Usage
- upload image link http://hosting.loc/views/create.php
- run *php worker* in console
- change title and description image link http://hosting.loc/views/update.php
- remove image link http://hosting.loc/views/delete.php

### Test task
Без использования фреймворков, написать бекенд хостинга картинок, в который можно загрузить 1-5 изображение за раз. Для каждого изображения должна создаваться превью (100х100px). Генерация превью должна осуществляться в очереди. После того, как превью сгенерировано, фронтенд может присылать запросы на изменения тайтла и описания картинки (мета-информация), а также на ее удаление.
