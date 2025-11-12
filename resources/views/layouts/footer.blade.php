<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
    <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">
        <div class="mb-2 mb-md-0">
            ©
            <script>
                document.write(new Date().getFullYear());
            </script>
            Aqsal -
            <a href="#" target="_blank" class="footer-link fw-bolder">
                Projectkai
            </a>
        </div>
    </div>
</footer>
@if(request()->is('users/*'))
<a href="https://wa.me/6282140313894" class="whatsapp-float-button" target="_blank">
    <i class="fa fa-whatsapp"></i>
</a>
@endif

@if(!request()->is('admin/*'))
<a href="https://wa.me/6282140313894" class="whatsapp-float-button" target="_blank">
    <i class="fa fa-whatsapp"></i>
</a>
@endif
<!-- / Footer -->