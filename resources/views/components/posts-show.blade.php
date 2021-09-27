<div>
    <div class="card" style="width: 100%; margin:10px; mr-10">
        @if($post->image)
            <img src="{{ '/storage/image/'.$post->image }}" class="card-img-top" alt="Card image cap">
        @else
            <span>No Image...</span>
        @endif
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->content }}</p>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">등록일 : {{ $post->created_at->diffForHumans() }}</li>
          <li class="list-group-item">수정일 : {{ $post->updated_at }}</li>
          <li class="list-group-item">작성자 : {{ $post->writer->name }}</li>
        </ul>
        <div class="card-body flex">
          <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="card-link">Edit</a>
          <form id="form" class="ml-2" method="post" onsubmit="event.preventDefault(); confirmDelete()" }}">
            @csrf
            @method('delete')
            {{-- <input type="hidden" name="_method" value="delete"> --}}
            <button type="submit">Delete</button>
            {{-- <a href="{{ route('posts.destroy') }}" class="card-link">Delete</a> --}}
          </form>
        </div>
      </div>

      <script>
        function confirmDelete(e) {
          myForm = document.getElementById('form'); // form 이란 id 를 가진 dom 객체를 가져옴.
          confirm = confirm("Are You Sure?");

          if(confirm == true){
            //서버에 서브밋
            myForm.submit();
          }
          // e.preventDefault(); // form이 서버로 전달되는 것을 막아준다.
        }
      </script>
</div>