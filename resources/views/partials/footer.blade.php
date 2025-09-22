<footer id="footer" class="footer">
    <div class="container">
        <div class="copyright text-center ">
            <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ config('app.name', 'FolioOne') }}</strong> <span>All Rights Reserved<br></span></p>
        </div>
        <div class="social-links d-flex justify-content-center">
            @if(config('site.social.twitter'))
                <a href="{{ config('site.social.twitter') }}"><i class="bi bi-twitter-x"></i></a>
            @endif
            @if(config('site.social.facebook'))
                <a href="{{ config('site.social.facebook') }}"><i class="bi bi-facebook"></i></a>
            @endif
            @if(config('site.social.instagram'))
                <a href="{{ config('site.social.instagram') }}"><i class="bi bi-instagram"></i></a>
            @endif
            @if(config('site.social.linkedin'))
                <a href="{{ config('site.social.linkedin') }}"><i class="bi bi-linkedin"></i></a>
            @endif
        </div>
        <div class="credits">
            Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
        </div>
    </div>
</footer>
