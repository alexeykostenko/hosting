<!DOCTYPE html>
<html>
    <head>
        <title>Create form</title>
    </head>
    <body>
        <form enctype="multipart/form-data" action="/images" method="post">
            <input name="_method" type="hidden" value="POST">
            <input type="file" name="images[]" title="Загрузите 1-5 изображений" required multiple>
            <button>submit</button>
        </form>
    </body>
</html>
