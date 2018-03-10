<!-- Benefit -->

<div class="benefit">
    <div class="container">
        <div class="row benefit_row">
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fa fa-truck" aria-hidden="true"></i></div>
                    <div class="benefit_content">
                        <h6>Бесплатная доставка</h6>
                        <p>Lorem ipsum dolor sit amet</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fa fa-money" aria-hidden="true"></i></div>
                    <div class="benefit_content">
                        <h6>Оплата при доставке</h6>
                        <p>Lorem ipsum dolor sit amet, sed sale nemore denique te</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fa fa-undo" aria-hidden="true"></i></div>
                    <div class="benefit_content">
                        <h6>Возврат в течении 45 дней</h6>
                        <p>Lorem ipsum dolor sit amet, sed sale nemore</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 benefit_col">
                <div class="benefit_item d-flex flex-row align-items-center">
                    <div class="benefit_icon"><i class="fa fa-clock-o" aria-hidden="true"></i></div>
                    <div class="benefit_content">
                        <h6>Работаем 24/7</h6>
                        <p>Lorem ipsum dolor sit amet, sed sale nemore denique te, eam</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Footer -->

<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="footer_nav_container d-flex flex-sm-row flex-column align-items-center justify-content-lg-start justify-content-center text-center">
                    <ul class="footer_nav">
                        <li><a href="/categories">Каталог</a></li>
                        <li><a href="/contact">Контакты</a></li>
                        <?php if(User::isGuest()) { ?>
                            <li><a href="/login">Вход</a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="footer_social d-flex flex-row align-items-center justify-content-lg-end justify-content-center">
                    <ul>
                        <li><a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-skype" aria-hidden="true"></i></a></li>
                        <li><a href="#"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="footer_nav_container">
                    <div class="cr">Example shop with use MVC / Developed by Kobrenko V.
                        <br>
                        This template is made with:
                        <i class="fa fa-heart-o" aria-hidden="true"></i> by
                        <a target="_blank" href="https://colorlib.com/wp/template/coloshop/">Colorlib</a></div>
                </div>
            </div>
        </div>
    </div>
</footer>
</div>

<script src="/template/default/js/jquery-3.2.1.min.js"></script>
<script src="/template/default/styles/bootstrap4/popper.js"></script>
<script src="/template/default/styles/bootstrap4/bootstrap.min.js"></script>
<script src="/template/default/plugins/Isotope/isotope.pkgd.min.js"></script>
<script src="/template/default/plugins/OwlCarousel2-2.2.1/owl.carousel.js"></script>
<script src="/template/default/plugins/easing/easing.js"></script>
<script src="/template/default/plugins/noty/noty.min.js"></script>
<script src="/template/default/plugins/bounce/bounce.min.js"></script>
<script src="/template/default/js/template.js"></script>
<script src="/template/default/js/custom_all.js"></script>
</body>

</html>
