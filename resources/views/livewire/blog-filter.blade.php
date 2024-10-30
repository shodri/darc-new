@extends('layouts.museo')
@section('content')
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
        <div class="container">

            <ol>
                <li><a href="{{ route('front.index') }}">Home</a></li>
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
                    @foreach ($posts as $post)
                        <article class="entry">
                            <div class="entry-img">
                                <img src="{{ $post->getFirstMediaUrl('default') }}" alt="" class="img-fluid">
                            </div>

                            <h2 class="entry-title">
                                <a href="{{ route('front.blog.show', $post->id) }}">{{ $post->title }}</a>
                            </h2>

                            <div class="entry-meta">
                                <ul>
                                    <li class="d-flex align-items-center"><i class="bi bi-person"></i> <a
                                            href="{{ route('front.author.show', $post->user->id) }}">{{ $post->user->name }}</a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-clock"></i> <a
                                            href="{{ route('front.blog.show', $post->id) }}"><time
                                                datetime="{{ $post->created_at }}">{{ $post->created_at->format('M j, Y') }}</time></a>
                                    </li>
                                    <li class="d-flex align-items-center"><i class="bi bi-chat-dots"></i> <a
                                            href="{{ route('front.blog.show', $post->id) }}">{{ $post->comments_count }}
                                            Comments</a></li>
                                </ul>
                            </div>

                            <div class="entry-content">
                                <p>
                                    {{ $post->excerpt }} <!-- Si tienes un campo 'excerpt' en tu modelo Post -->
                                </p>
                                <div class="read-more">
                                    <a href="{{ route('front.blog.show', $post->id) }}">Read More</a>
                                </div>
                            </div>
                        </article><!-- End blog entry -->
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

                </div><!-- End blog entries list -->

                <div class="col-lg-4">

                    <div class="sidebar">

                        <h3 class="sidebar-title">Search</h3>
                        <div class="sidebar-item search-form">
                            <form action="">
                                <input type="text">
                                <button type="submit"><i class="bi bi-search"></i></button>
                            </form>
                        </div><!-- End sidebar search formn-->

                        <h3 class="sidebar-title">Categories</h3>
                        <div class="sidebar-item categories">
                          <ul>
                            @foreach ($categories as $category)
                                <a wire:click="filterByCategory({{ $category->id }})" @if ($selectedCategory == $category->id) class="selected" @endif>{{ $category->name }}</a>
                            @endforeach
                        </ul>
                        </div><!-- End sidebar categories-->

                        <h3 class="sidebar-title">Recent Posts</h3>
                        <div class="sidebar-item recent-posts">
                            <div class="post-item clearfix">
                                <img src="assets/img/blog/blog-recent-1.jpg" alt="">
                                <h4><a href="blog-single.html">Nihil blanditiis at in nihil autem</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/blog/blog-recent-2.jpg" alt="">
                                <h4><a href="blog-single.html">Quidem autem et impedit</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/blog/blog-recent-3.jpg" alt="">
                                <h4><a href="blog-single.html">Id quia et et ut maxime similique occaecati ut</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/blog/blog-recent-4.jpg" alt="">
                                <h4><a href="blog-single.html">Laborum corporis quo dara net para</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>

                            <div class="post-item clearfix">
                                <img src="assets/img/blog/blog-recent-5.jpg" alt="">
                                <h4><a href="blog-single.html">Et dolores corrupti quae illo quod dolor</a></h4>
                                <time datetime="2020-01-01">Jan 1, 2020</time>
                            </div>

                        </div><!-- End sidebar recent posts-->

                        <h3 class="sidebar-title">Tags</h3>
                        <div class="sidebar-item tags">
                            <ul>
                                <li><a href="#">App</a></li>
                                <li><a href="#">IT</a></li>
                                <li><a href="#">Business</a></li>
                                <li><a href="#">Mac</a></li>
                                <li><a href="#">Design</a></li>
                                <li><a href="#">Office</a></li>
                                <li><a href="#">Creative</a></li>
                                <li><a href="#">Studio</a></li>
                                <li><a href="#">Smart</a></li>
                                <li><a href="#">Tips</a></li>
                                <li><a href="#">Marketing</a></li>
                            </ul>
                        </div><!-- End sidebar tags-->

                    </div><!-- End sidebar -->

                </div><!-- End blog sidebar -->

            </div>

        </div>
    </section><!-- End Blog Section -->

    </main><!-- End #main -->
@endsection
