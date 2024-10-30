@extends('layouts.darc')
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('index') }}">Home</a></li>
                <li>Blog</li>
            </ol>
            <h2>Blog</h2>

        </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Blog Section ======= -->
    <section id="blog" class="blog">
        <div class="container" data-aos="fade-up">

            <div class="row">

                <div class="col-lg-8 entries">

                    <!-- Blog entry -->
                    @if (!$posts->isEmpty())
                        @foreach ($posts as $post)
                            <article class="entry">
                                <div class="entry-img">
                                    <img src="{{ $post->getFirstMediaUrl('main_image', 'webp') }}" alt=""
                                        class="img-fluid">
                                </div>

                                <h2 class="entry-title">
                                    <a href="{{ route('post', $post->id) }}">{{ $post->title }}</a>
                                </h2>

                                <div class="entry-meta">
                                    <ul>
                                        <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                                href="{{ route('author.show', $post->user->id) }}">{{ $post->user->name }}</a>
                                        </li>
                                        <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                                href="{{ route('post', $post->id) }}"><time
                                                    datetime="{{ $post->created_at }}">{{ $post->created_at->format('M j, Y') }}</time></a>
                                        </li>
                                        <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                                href="{{ route('post', $post->id) }}">{{ $post->comments_count }}
                                                Comments</a></li>
                                    </ul>
                                </div>

                                <div class="entry-content">
                                    <p>
                                        {!! htmlspecialchars_decode($post->excerpt, ENT_QUOTES) !!} <!-- Si tienes un campo 'excerpt' en tu modelo Post -->
                                    </p>
                                    <div class="read-more">
                                        <a href="{{ route('post', $post->id) }}">Leer más</a>
                                    </div>
                                </div>
                            </article>

                        @endforeach

                        <div class="blog-pagination">
                            <ul class="justify-content-center">
                                @foreach ($posts->links()->elements[0] as $page => $url)
                                    @if (is_string($page))
                                        <li class="disabled"><span>{{ $page }}</span></li>
                                    @else
                                        <li class="{{ $posts->currentPage() == $page ? 'active' : '' }}">
                                            <a href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach
    
                                @if ($posts->hasMorePages())
                                    <li><a href="{{ $posts->nextPageUrl() }}" rel="next"> > </a></li>
                                @else
                                    {{-- <li><span> <a href="#" rel="next"> > </a></span></li> --}}
                                @endif
                            </ul>
                        </div>
                        
                    @else

                        <article class="entry">
                            <h2 class="entry-title">
                                Actualmente no hay novedades disponibles. ¡Vuelve pronto para más actualizaciones!                            </h2>
                        </article>

                    @endif
                    <!-- End blog entry -->



                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Buscar</h3>
                        <div class="sidebar-item search-form">
                            <form action="{{ route('blog') }}" method="GET">
                                <input type="text" name="search" value="{{ request('search') }}">
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
                                    <h4><a href="{{ route('post', $recentPost->id) }}">{{ $recentPost->title }}</a>
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
                                            <a href="{{ route('blog', ['clear_tag' => $tag->name]) }}" class="selected">
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
    </section><!-- End Blog Section -->

    </main><!-- End #main -->
@endsection
