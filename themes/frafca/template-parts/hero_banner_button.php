<!-- hero contents -->
<?php
$limit_heros = count(frafca_cfs('banner')) - 1;
$heros = array(0 => frafca_cfs('banner')[$limit_heros]);
foreach ($heros as $hero) :
    $hero_img = $hero['banner_image'];
    $hero_title = $hero['banner_title'];
    $hero_description = $hero['banner_description'];
    $hero_button = $hero['banner_button'];
    ?>
    <div class="hero-image-page" style="
        background : 
        linear-gradient( to bottom, rgba(47,43,92,0.3) 0%, rgba(47,43,92,0.3) 100% ), 
            url(<?php echo $hero_img; ?>);
        background-size: ;
        background-position: center; 
        
        background-repeat: no-repeat;                   
    ">
        <h1 class="page-title screen-reader-text">
            <?php single_post_title(); ?>
        </h1>

        <div class="header-meta">
            <h2 class="banner-title">
                <?php echo $hero_title; ?>
            </h2>
            <p>
                <?php echo $hero_description; ?>
            </p>
            <a class='banner-button default-btn yellow' href="<?php echo $hero_button['url']; ?>" target="<?php echo $hero_button['target']; ?>">
                <?php echo $hero_button['text']; ?>
            </a>
        </div>
    </div>
<?php endforeach ?>
<!-- end hero contents -->