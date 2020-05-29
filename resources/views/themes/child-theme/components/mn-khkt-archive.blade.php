<section class="mn-khkt-archive">
    <div class="container">
        <h1 class="archive-title">{{$term->name}}</h1>
        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-4">
                    <div class="post-box">
                        <a href="/{{ $post->post_name }}" class="mask"></a>
                        <div class="box-img">
                            <img src="{{ get_thumbnail_src($post) }}" alt="{{ $post->post_title }}">
                        </div>
                        <div class="box-content">
                            <h3 class="title" title="{{ $post->post_title }}"><a href="/{{ $post->post_name }}">{{ $post->post_title }}</a></h3>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        {{ $posts->links() }}
    </div>
</section>