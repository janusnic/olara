<div class="form-group">
    <div class="col-md-6 col-md-offset-4">

        <a href="{{ route('social.redirect', ['provider' => 'facebook']) }}" class="btn btn-facebook"><i class="fa fa-facebook"></i> Facebook</a>
        <a href="{{ route('social.redirect', ['provider' => 'twitter']) }}" class="btn btn-twitter"><i class="fa fa-twitter"></i> Twitter</a>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6 col-md-offset-4">
        <a href="{{ route('social.redirect', ['provider' => 'google']) }}" class="btn btn-google"><i class="fa fa-google"></i> Google+</a>

        <a href="{{ route('social.redirect', ['provider' => 'github']) }}" class="btn btn-github"><i class="fa fa-github"></i> GitHub</a>
    </div>
</div>
