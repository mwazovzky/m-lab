{{-- SEARCH PANEL --}}
<div class="panel panel-primary">

    <div class="panel-heading">
        <strong>Search</strong>
    </div>
    <div class="panel-body">
        <form method="GET" action="/posts">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Search posts title and body by query ..." />
                <div class="input-group-btn">
                    <button class="btn btn-info btn-md" type="submit">
                        <span class="glyphicon glyphicon-search"></span>
                    </button>
                </div>
            </div>
            <div class="text-center mt-1">
                <label class="radio-inline">
                    <input type="radio" name="search-type" id="mySQL" value="mySQL" checked> mySQL
                </label>
                <label class="radio-inline">
                    <input type="radio" name="search-type" id="algolia" value="algolia" disabled> algolia
                </label>
                <label class="radio-inline">
                    <input type="radio" name="search-type" id="elasticsearch" value="elasticsearch" disabled> elastic
                </label>
            </div>

        </form>
    </div>
</div>
{{-- TAGS PANEL --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <strong>Tags</strong>
    </div>
    <div class="panel-body">
        <ul class="sidebar-ul">
            @foreach($tags as $tag)
                <li>
                    <a href="/posts?tag={{ $tag->name }}">{{ $tag->name }}</a>
                    <span class="label label-info">{{ $tag->posts_count }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
{{-- LATEST POSTS PANEL --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <strong>Latest posts</strong>
    </div>
    <div class="panel-body">
        <ul class="sidebar-ul">
            @foreach($latest as $post)
                <li>
                    <a href="{{ route('posts.show', $post) }}">
                        {{ substr($post->title, 0, 30) . '...' }}
                    </a>
                    by
                    <a href="{{ route('profiles.show', $post->user) }}">
                        {{ $post->user->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
{{-- POPULAR POSTS PANEL --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <strong>Popular posts (top 5)</strong>
    </div>
    <div class="panel-body">
        <ul class="sidebar-ul">
            @foreach($popular as $post)
                <li>
                    <a href="{{ route('posts.show', $post) }}">
                        {{ substr($post->title, 0, 28) . '...' }}
                    </a>
                    by
                    <a href="{{ route('profiles.show', $post->user) }}">
                        {{ $post->user->name }}
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
{{-- ARCHIVES PANEL --}}
<div class="panel panel-primary">
    <div class="panel-heading">
        <strong>Archives</strong>
    </div>
    <div class="panel-body">
        <ul class="sidebar-ul">
            @foreach($archives as $period)
                <li>
                    <a href="/posts?year={{ $period['year'] }}&month={{ $period['month'] }}">{{ $period['month'] . ' ' . $period['year'] }}</a>
                    <span class="label label-info">{{ $period['published'] }}</span>
                </li>
            @endforeach
        </ul>
    </div>
</div>
{{-- IMAGE PANEL --}}
<div class="panel panel-primary">
    <div class="panel-body panel-about">
        <div>
            <img width="100%" src="/images/about.jpg" alt="Monster Lab. Team">
        </div>
    </div>
</div>
{{-- ABOUT PANEL --}}
<div class="panel panel-primary">
    <div class="panel-body">
        <ul class="terms">
            <li><a href="#">О нас</a></li>
            <li><a href="#">Проекты</a></li>
            <li><a href="#">Условия использования</a></li>
            <li><a href="#">Политика конфиденциальности</a></li>
            <li><a href="#">Рекламa</a></li>
            <li><a href="#">Контакты</a></li>
        </ul>
    </div>
    <div class="panel-footer center">
        <span><a href="/main">Monster-Lab, 2017</a></span>
    </div>
</div>
