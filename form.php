<!DOCTYPE html>
<html>
    <head>
        <title>form</title>
    </head>
    <body>
        <form action="/images" method="post">
            <input name="_method" type="hidden" value="POST">
            <input type="file" name="images[]" title="Загрузите загрузить 1-5 изображений" required multiple>
            <button>submit</button>
        </form>
    </body>
</html>
