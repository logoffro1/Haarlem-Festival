<?php
class footer
{
    public function render()
    {
        echo sprintf('
            <footer class="footer">
                <nav class="footer__nav col-3">
                    <a href="#">
                        <img src="/assets/images/svg/logo-white.svg"/>
                    </a>
                    
                    <ul class="footer__nav__list">
                        <li><a href="#"><img src="/assets/images/svg/instagram.svg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/images/svg/facebook.svg" alt=""></a></li>
                        <li><a href="#"><img src="/assets/images/svg/youtube.svg" alt=""></a></li>
                    </ul>
                </nav>
                <ul class="footer__list col-2">
                    <span class="footer__list__title">Events</span>
                    <li><a href="#">Jazz</a></li>
                    <li><a href="#">Dance</a></li>
                    <li><a href="#">History</a></li>
                    <li><a href="#">Cuisine</a></li>
                </ul>
                <ul class="footer__list col-2">
                    <span class="footer__list__title">Pages</span>
                    <li><a href="#">Your programme</a></li>
                    <li><a href="#">Shopping Cart</a></li>
                    <li><a href="#">Discount</a></li>
                </ul>
                <ul class="footer__list col-2"></ul>
                <ul class="footer__list col-2">
                    <span class="footer__list__title">Partners with</span>

                    <li><a href="#"><img src="/assets/images/svg/haarlem-city-logo.svg" alt=""></a></li>
                </ul>
            </footer>
            <script src="/assets/scripts/index.js"></script>
        </body>

        </html>
        ');
    }
}

?>
