<div>
    <!-- Well begun is half done. - Aristotle -->
    <h1>My Name is {{ $name }}.</h1>
    @foreach ($posts as $post)
        <div class="my-2">
            <p>
                {{ $post->content }}
            </p>
        </div>
    @endforeach
</div>