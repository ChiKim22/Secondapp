<!DOCTYPE html>
  <head>
    <!-- ... --->
   <meta charset="UTF-8" />
   <meta name="viewport" content="width=device-width, initial-scale=1.0" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

  </head>

<div class="bg-white dark:bg-gray-800 m-4 p-4">
    <!-- Well begun is half done. - Aristotle -->
    <table class="table">
        <thead>
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Writer</th>
            <th scope="col">Created at</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr class="bg-emerald-200">
                <td><a href="{{ route('posts.show', ['post' => $post->id ]) }}">{{ $post->title }}</a></td>
                <td>{{ $post->writer->name }}</td>
                <td>{{ $post->created_at->diffForHumans() }}</td>
            </tr>
            @endforeach
        </tbody>
      </table>
</div>
  {{ $posts->links() }} 
  {{-- 페이지 표시 --}}
</html>