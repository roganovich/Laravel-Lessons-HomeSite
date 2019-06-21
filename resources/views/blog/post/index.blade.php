<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Blog Post</title>

    </head>
    <body>
        <div class="flex-center position-ref full-height">
            <table>
                @foreach($items as $item)
                <tr>
                    <td>{{$item->id}}</td>
                    <td>{{$item->title}}</td>
                    <td>{{$item->created_at}}</td>
                </tr>
                @endforeach
            </table>
        </div>
    </body>
</html>
