<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.101.0">
    <title>Blog Template · Bootstrap v4.6</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.6/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
          integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
    @vite(['resources/css/blog.css'])
    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair&#43;Display:700,900" rel="stylesheet">
</head>
<body>

<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-4 pt-1">
                <a class="text-muted" href="#" data-toggle="modal" data-target="#subscribeModal">Subscribe</a>
            </div>

            <!-- The Modal -->
            <div class="modal fade" id="subscribeModal">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal body -->
                        <div class="modal-body">
                            <form method="post" action="{{ route('categories.store') }}"
                                  enctype="multipart/form-data" class="mt-6 space-y-6">
                                <div class="input-group mb-3">
                                    @csrf
                                    @method('POST')
                                    <div class="input-group-prepend">
                                        <button class="btn btn-outline-primary" type="submit">Subscribe</button>
                                    </div>
                                    <input type="text" class="form-control" placeholder="Enter Your Email">

                                </div>
                            </form>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-4 text-center">
                <a class="blog-header-logo text-dark" href="#">
                    <img src="{{ asset('logo.svg') }}" alt="">
                </a>
            </div>
            <div class="col-4 d-flex justify-content-end align-items-center">
                @if (Route::has('login'))
                    <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                        @auth
                            <a class="btn btn-sm btn-outline-secondary" href="{{ url('/dashboard') }}">Dashboard</a>
                        @else
                            <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign in</a>
                            @if (Route::has('register'))
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">Sign up</a>
                            @endif
                        @endauth
                    </div>
                @endif

            </div>
        </div>
    </header>

    <div class="py-1 mb-2">
        <nav class="navbar navbar-expand-sm d-flex justify-content-between">
            <!-- Links -->
            <ul class="navbar-nav">

                @foreach ($categories as $category)
                    @if (!$category->parent_id)
                        @if ($category->children)
                            <li class="nav-item dropdown">
                                <a class="nav-link text-muted dropdown-toggle" href="#" id="navbardrop"
                                   data-toggle="dropdown">
                                    {{ $category->name }}
                                </a>
                                <div class="dropdown-menu">
                                    @foreach ($category->children as $child)
                                        <a class="dropdown-item text-muted"
                                           href="{{ route('category.show', $child->id) }}">{{ $child->name }}</a>
                                    @endforeach
                                </div>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="p-2 text-muted"
                                   href="{{ route('category.show', $category->id) }}">{{ $category->name }}</a>
                            </li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>

    <img class="rounded img-fluid" src="{{ asset('images/mariana.png') }}"
         alt="W3yz BLOG">
</div>

<main role="main" class="container">
    <div class="row">
        <div class="col-md-8 blog-main">

            @foreach ($posts as $post)
                <div class="blog-post">
                    <h2 class="blog-post-title">{{$post->title}}</h2>
                    <p class="blog-post-meta">{{$post->created_at}}</p>
                    <img class="rounded img-fluid" src="{{ asset('images/uploads/'.$post->hero_image) }}"
                         alt="{{$post->title}}">
                    <p>{{$post->text}}</p>

                    <div class="progress">
                        <div class="progress-bar progress-bar-striped" role="progressbar" style="width: 100%"
                             aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                </div><!-- /.blog-post -->

            @endforeach

        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">

            <div class="p-4">
                <h4 class="font-italic">Elsewhere</h4>
                <ol class="list-unstyled">
                    <li><a href="#">GitHub</a></li>
                    <li><a href="#">Twitter</a></li>
                    <li><a href="#">Facebook</a></li>
                </ol>
            </div>
        </aside><!-- /.blog-sidebar -->

    </div><!-- /.row -->

</main><!-- /.container -->

<footer class="blog-footer">
    <p>Blog template built for <a href="https://getbootstrap.com/">Bootstrap</a> by <a href="https://twitter.com/mdo">@mdo</a>.
    </p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>


<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
        crossorigin="anonymous"></script>
</body>
</html>
