@extends('layouts.darc')
@section('content')
<style>
    .entry-content img {
    max-width: 100%; 
    height: auto; 
    display: block; 
    margin: 0 auto;
}
</style>
    <main id="main">

        <!-- ======= Breadcrumbs ======= -->
        <section id="breadcrumbs" class="breadcrumbs">
            <div class="container">

                <ol>
                    <li><a href="index.html">Home</a></li>
                    <li><a href="blog.html">Blog</a></li>
                </ol>
                <h2>{{ $post->title }}</h2>

            </div>
        </section><!-- End Breadcrumbs -->

        <!-- ======= Blog Single Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="row">

                    <div class="col-lg-8 entries">

                        <article class="entry entry-single">
                            <div class="entry-img">
                                <img src="{{ $post->getFirstMediaUrl('main_image', 'webp') }}" alt="{{ $post->title }}"
                                    class="img-fluid">
                            </div>
                            <h2 class="entry-title">
                                <a href="{{ route('post', $post->id) }}">{{ $post->title }}</a>
                            </h2>
                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="blog-single.html">{{ $post->user->name }}</a></li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href="blog-single.html"><time
                                                datetime="{{ $post->created_at }}">{{ $post->created_at->format('M j, Y') }}</time></a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                            href="blog-single.html">{{ $post->comments_count }} Comments</a></li>
                                </ul>
                            </div>
                            <div class="entry-content">
                                {!! htmlspecialchars_decode($post->body, ENT_QUOTES) !!}
                            </div>
                            <div class="entry-footer">
                                <i class="bi bi-folder"></i>
                                <ul class="cats">
                                    <li><a href="#">{{ $post->category->name }}</a></li>
                                </ul>
                                <i class="bi bi-tags"></i>
                                <ul class="tags">
                                    @foreach ($post->tags as $tag)
                                        <li><a href="#">{{ $tag->name }}</a></li>
                                    @endforeach
                                </ul>
                            </div>
                        </article><!-- End blog entry -->
                        <div class="blog-author d-flex align-items-center">
                            <img src="{{asset('img/logo_top.png')}}" class="rounded-circle float-left" alt="Museo Eva Perón">
                            <div>
                                <h4>{{ $post->user->name }}</h4>
                                {{-- <div class="social-links">
                                    <a href="https://twitters.com/#"><i class="bi bi-twitter"></i></a>
                                    <a href="https://facebook.com/#"><i class="bi bi-facebook"></i></a>
                                    <a href="https://instagram.com/#"><i class="bi bi-instagram"></i></a>
                                </div> --}}
                                <p>
                                </p>
                            </div>
                        </div><!-- End blog author bio -->

                    </div>

                    <div class="col-lg-4">

                        <div class="sidebar">

                            <h3 class="sidebar-title">Buscar</h3>
                            <div class="sidebar-item search-form">
                                <form action="">
                                    <input type="text">
                                    <button type="submit"><i class="bi bi-search"></i></button>
                                </form>
                            </div><!-- End sidebar search formn-->

                            <h3 class="sidebar-title">Categorias</h3>
                            <div class="sidebar-item categories">
                                <ul>
                                    @foreach ($categories as $category)
                                        @if (isset($selectedCategory) && $category->id === $selectedCategory->id)
                                            <li>
                                                <a href="{{ route('blog', ['clear_category' => $category->name]) }}"
                                                    class="selected">
                                                    <strong>{{ $category->name }}</strong>
                                                    <span>({{ $category->posts->count() }})</span>
                                                    <strong>X</strong>
                                                </a>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('blog', ['category' => $category->name]) }}">
                                                    {{ $category->name }}
                                                    <span>({{ $category->posts->count() }})</span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar categories-->

                            <h3 class="sidebar-title">Ultimas Novedades</h3>
                            <div class="sidebar-item recent-posts">
                                @foreach ($recentPosts as $recentPost)
                                    <div class="post-item clearfix">
                                        <img src="{{ $recentPost->getFirstMediaUrl('main_image', 'thumb') }}" alt="">
                                        <h4><a
                                                href="{{ route('post', $recentPost->id) }}">{{ $recentPost->title }}</a>
                                        </h4>
                                        <time
                                            datetime="{{ $recentPost->created_at }}">{{ $recentPost->created_at->format('M j, Y') }}</time>
                                    </div>
                                @endforeach
                            </div><!-- End sidebar recent posts-->

                            <h3 class="sidebar-title">Tags</h3>
                            <div class="sidebar-item tags">
                                <ul>
                                    @foreach ($tags as $tag)
                                        @if (isset($selectedTag) && $selectedTag->id === $tag->id)
                                            <li>
                                                <a href="{{ route('blog', ['clear_tag' => $tag->name]) }}"
                                                    class="selected">
                                                    {{ $tag->name }} <strong> X </strong>
                                                </a>
                                            </li>
                                        @else
                                            <li>
                                                <a href="{{ route('blog', ['tag' => $tag->name]) }}">
                                                    {{ $tag->name }}
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div><!-- End sidebar tags-->

                        </div><!-- End sidebar -->

                    </div><!-- End blog sidebar -->
                </div>
            </div>
        </section><!-- End Blog Single Section -->

    </main><!-- End #main -->
@endsection
