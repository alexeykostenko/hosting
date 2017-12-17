<!DOCTYPE html>
<html>
    <head>
        <title>Update form</title>
    </head>
    <body>
        <form action="/images" method="post">
            <input name="_method" type="hidden" value="PUT">
            <input type="number" name="id" placeholder="ID изображения">
            <input type="text" name="title" placeholder="Заголовок изображения">
            <input type="text" name="description" placeholder="Описание изображения">
            <button>submit</button>
        </form>
    </body>
</html>
