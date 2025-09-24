<?php wp_footer(); ?>

<footer aria-labelledby="footerKundeservice footerAbout footerService">
      <div class="footerContainer">
        <div class="footerGrid">
            <div class="footerCustomerService">
                <ul class="footerUL">
                    <li id="footerKundeservice" class="footerTitle"><h3 tabindex="0"><?php pll_e("Kundeservice")?></h3><div class="footerLine"></div></li>
                    <li class="footerContact"><img class="footerPic" src="<?php echo get_template_directory_uri(); ?>/assets/img/kantenLogo_white_transparent.webp" alt="Kanten"><p tabindex="0">+45 6767-6767</p></li>
                    <li class="footerContact"><img class="footerPic" src="<?php echo get_template_directory_uri(); ?>/assets/img/kantenLogo_white_transparent.webp" alt="Kanten"><p tabindex="0">Kanten@Kanten.dk</p></li>
                </ul>
            </div>
            <div class="footerAbout">
                <ul class="footerUL">
                    <li id="footerKanten" class="footerTitle"><h3 tabindex="0">Kanten</h3><div class="footerLine"></div></li>
                    <li><a href="#"><?php pll_e("Om kanten")?></a></li>
                    <li><a href="#"><?php pll_e("Bliv medlem")?></a></li>
                    <li><a href="#"><?php pll_e("Bestyrelsen")?></a></li>
                </ul>
            </div>
            <div class="footerService">
                <ul class="footerUL">
                    <li id="footerService" class="footerTitle"><h3 tabindex="0">Service</h3><div class="footerLine"></div></li>
                    <li><a href="#"><?php pll_e("Kontakt")?></a></li>
                    <li><a href="#"><?php pll_e("Privatlivspolitik")?></a></li>
                    <li><a href="#"><?php pll_e("Login")?></a></li>
                 </ul>
            </div>
    </div>
</footer>
</body>
</html>
