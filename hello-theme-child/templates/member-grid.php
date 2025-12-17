<?php
$data = wp_parse_args($args, [
    'class' => 'member-grid',
]);

$_class = !empty($data['class']) ? esc_attr(' ' . $data['class']) : '';

$_swiper_items = [];

$users = new \Indeed\Ihc\Db\SearchUsers();
$results = $users->getResults();

?>

<div data-block="member-grid" class="<?php echo esc_attr($_class); ?>">
    <div class="member-grid-swiper-container">
        <div class="member-grid-swiper">
            <div class="row">
                
                    <?php
                    foreach ($results as $user) {
                        echo '<div class="col-lg-3">';
                        get_template_part(
                            'templates/member-grid-item',
                            null,
                            array(
                                'item' => $user
                            )
                        );
                        echo '</div>';
                    }
                    wp_reset_postdata();
                    ?>
                
            </div>

        </div>
    </div>
</div>