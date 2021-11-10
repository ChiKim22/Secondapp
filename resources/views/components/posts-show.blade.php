<div>
    <div class="card" class="md:w-auto">
        @if($post->image)
            <img src="{{ '/storage/image/'.$post->image }}" class="card-img-top md:w-auto" alt="Card image cap">
        @else
            <span>No Image...</span>
        @endif
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->content }}</p>
          <div class="mt-10">
            {{-- Like Button --}}
            <like-button 
            :post="{{ $post }}" 
            :loginuser = "{{ auth()->user()->id }}"/> 
            {{-- 현재 로그인한 사용자의 id --}}
          </div>
        </div>
        <ul class="list-group list-group-flush">
          <li class="list-group-item">등록일 : {{ $post->created_at->diffForHumans() }}</li>
          <li class="list-group-item">수정일 : {{ $post->updated_at }}</li>
          <li class="list-group-item">작성자 : {{ $post->writer->name }}</li>
        </ul>

        <div class="card-body flex">
          {{-- 수정, 삭제 버튼이 작성자일때만 표시 @can --}}
          @can('update', $post)
            <a href="{{ route('posts.edit', ['post' => $post->id]) }}" class="card-link">Edit</a>
          @endcan

          @can('delete', $post)
            <form id="form" class="ml-2" method="post" onsubmit="event.preventDefault(); confirmDelete(event)">
              @csrf
              @method('delete')
              {{-- <input type="hidden" name="_method" value="delete"> --}}
              <button type="submit">Delete</button>
              {{-- <a href="{{ route('posts.destroy') }}" class="card-link">Delete</a> --}}
            </form>
          @endcan
      </div>
          <div class="card" style="width: 90%; margin:0 auto;">
            <comment-list :post="{{ $post }}" 
            :loginuser="{{ auth()->user()->id }}"/>
          </div>
</div>