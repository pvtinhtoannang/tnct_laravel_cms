<section class="mn-khkt-single">
    <div class="container">
        <div class="entry-content">
            <h1 class="entry-title">{{$post->post_title}}</h1>
            <div class="post-content">
                @if($post->post_content == '<p><br></p>' || $post->post_content == '')
                    <div class="alert alert-info" role="alert">
                        Nội dung đang được cập nhật!
                    </div>
                @endif
                @if(!empty($post->post_content))
                    {!! $post->post_content !!}
                @endif
            </div>
        </div>
    </div>
</section>