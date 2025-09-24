<?php get_header(); ?>
<?php if(have_posts()): ?>
        <?php while(have_posts()): the_post(); ?>
        
         <?php
                $merchImage = get_field('merch_image_main');
                $merchImageOptional1 = get_field('merch_image_optional_1');
                $merchImageOptional2 = get_field('merch_image_optional_2');
                $merchTitle = get_the_title();
                $merchPrice = get_field('merch_item_price');
                $merchSpecifications = get_field('merch_item_specifications');
                $merchDescription = get_field('merch_item_description');
                $merchCategory = get_field('merch_item_category');

                        if ($merchCategory) {
                            if (is_object($merchCategory)) {
                            $categoryLabel = $merchCategory->name;
                                                    }
                        }
            ?>

                        <section class="merchItemSection">
                            <section class="merchItemSectionTop">
                                <div class="merchItemImageArea">
                                    <div class="merchSideImages">
                                        <?php 
                                            $images = [$merchImageOptional1, $merchImageOptional2];

                                            foreach ($images as $image) {
                                                if ($image) {
                                                    echo '<img src="' . esc_url($image['url']) . '" alt="' . esc_attr($image['alt']) . '">';
                                                }
                                            }
                                        ?>
                                    </div>
                                    <div class="merchMainImage"><img src="<?php echo esc_url($merchImage['url'])?>" alt="<?php echo esc_attr($merchImage['alt']); ?>"></div>
                                </div>
                                <div class="merchItemTextArea">
                                    <h2><?php echo esc_html($merchTitle); ?></h2>
                                    <h3><?php echo esc_html($categoryLabel); ?></h3>
                                    <p>kr <?php echo esc_html($merchPrice); ?>,-</p>
                                    <div class="sizesArea">
                                            
                                    </div>
                                    <div class="merchItemTextAreaBottom">
                                        <form class="buyForm" method="post" action="">
                                                <input type="number" name="quantity" value="1" min="1">
                                            <button type="submit" class="buyButton">Læg i kurv</button>
                                        </form>
                                    </div>
                                </div>
                            </section>
                            <section class="merchItemSectionBottom">
                                <h3>Produkt beskrivelse</h3>
                                <div class="merchItemSpecifications">
                                    <?php echo $merchSpecifications; ?>
                                </div>
                                <div class="merchItemDescription">
                                    <?php echo $merchDescription; ?>
                                </div>
                            </section>
                        </section>




        <?php endwhile; ?>
    <?php endif; ?>

<?php get_footer(); ?>