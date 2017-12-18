<!DOCTYPE html>
<html>
    <head>
        <title>Delete form</title>
    </head>
    <body>
        <form action="/images" method="post">
            <input name="_method" type="hidden" value="DELETE">
            <input type="number" name="id" placeholder="ID изображения">
            <button>submit</button>
        </form>
    </body>
</html>
