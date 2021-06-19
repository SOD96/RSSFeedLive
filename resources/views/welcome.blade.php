<html lang="en"><head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>RSS Feed Live</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.0/examples/blog/">

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="css/blog.css" rel="stylesheet">
</head>

<body>

<div class="container">
    <header class="blog-header py-3">
        <div class="row flex-nowrap justify-content-between align-items-center">
            <div class="col-12 text-center">
                <a class="blog-header-logo text-dark" href="#">RSS Feed Live</a>
            </div>
        </div>
    </header>

    <!-- Get the most recent post -->
    <!-- Added some shadow styling to the title, description and link so they don't appear badly on a bright background -->
    @if(!$articles->isEmpty())
        <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark" style="background-image: url('https://picsum.photos/1300/600')">
            <div class="col-md-6 px-0">
                <h1 class="display-4 font-italic" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">{{strtoupper($articles[0]->title)}}</h1>
                <p class="lead my-3" style="text-shadow: 1px 0 0 #000, 0 -1px 0 #000, 0 1px 0 #000, -1px 0 0 #000;">{{$articles[0]->description}}</p>
                <a class="btn btn-primary btn_reading" style="display:none" target="_blank" href="{{$articles[0]->link}}">Continue reading</a>
            </div>
        </div>
    @endif

    <div class="row mb-2">
        @forelse($articles->slice(1,count($articles)) as $a)
        <div class="col-md-6">
            <div class="card flex-md-row mb-4 box-shadow h-md-250">
                <div class="card-body d-flex flex-column align-items-start">
                    <h3 class="mb-0">
                        <p class="text-dark">{{Str::limit($a->title, 55)}}</p>
                    </h3>
                    <div class="mb-1 text-muted">{{\Carbon\Carbon::parse($a->published_date)->diffForHumans()}}</div>
                    <p class="card-text mb-auto">{{Str::limit($a->description, 100)}}</p>
                    <a class="btn btn-primary btn_reading" style="display:none" target="_blank" href="{{$a->link}}">Continue reading</a>
                    <small class="text-muted">Accreditation: {{$a->feed->url}}</small>
                </div>
                <!-- Having to use a random image source because the BBC doesn't seem to give out their images -->
                <img class="card-img-right flex-auto d-none d-md-block" data-src="https://picsum.photos/200/300" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="https://picsum.photos/200/300?random={{rand(1,20)}}" data-holder-rendered="true">
            </div>
        </div>
        @empty
            <p>No feeds added, why not add an RSS feed using the readme.md guide?</p>
        @endforelse
    </div>
</div>


<footer class="blog-footer">
    <p>PHP Technical Test by Sean O'Donnell</p>
    <p>
        <a href="#">Back to top</a>
    </p>
</footer>

<!-- Bootstrap core JavaScript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>

<!--

Javascript to listen for ALT key press, native JS only, so can't use Jquery
Can't use KeyPress as keypress doesn't work for command keys, (alt, shift etc..)
Depressed = Pressed down

 -->
<script type="text/javascript">
    document.addEventListener("keydown", function(e) {
        if (e.altKey) {
            var buttons = document.getElementsByClassName("btn_reading");

            Array.prototype.forEach.call(buttons, function(el) {
                el.style.display = 'block';
            });
        }
    });

    document.addEventListener("click", function(e) {
        var target = e.target;
        var activeElement = document.activeElement;

        // Will check if the active element and the target which is being clicked is either the body
        // and not the hyperlink
        if(activeElement == target && target.tagName.toLowerCase() != 'a') {

            var buttons = document.getElementsByClassName("btn_reading");

            Array.prototype.forEach.call(buttons, function(el) {
                el.style.display = 'none';
            });
        }
    });

</script>

<svg xmlns="http://www.w3.org/2000/svg" width="200" height="250" viewBox="0 0 200 250" preserveAspectRatio="none" style="display: none; visibility: hidden; position: absolute; top: -100%; left: -100%;"><defs><style type="text/css"></style></defs><text x="0" y="13" style="font-weight:bold;font-size:13pt;font-family:Arial, Helvetica, Open Sans, sans-serif">Thumbnail</text></svg></body></html>
