<div class="side-bar">
    <div class="sidebar-search">
        <!-- 検索フォーム -->
        <?php get_search_form(); ?>

        <!-- 詳細検索ボタン -->
        <button class="toggle-advanced-search">詳細検索</button>

        <!-- 詳細検索フォーム -->
        <form action="<?php echo esc_url(home_url('/')); ?>" method="get" class="advanced-search">
            <input type="hidden" name="post_type" value="service">

            <!-- サービスタイプ -->
            <label>学割カテゴリ:</label>
            <?php
            wp_dropdown_categories(array(
                'taxonomy' => 'service-type',
                'name' => 'service-type[]', // 修正
                'show_option_all' => 'すべて',
                'value_field' => 'term_id',
                'selected' => isset($_GET['service-type']) ? $_GET['service-type'] : '',
                'hide_empty' => false
            ));
            ?>

            <!-- 年齢タイプ -->
            <label>年齢タイプ:</label>
            <?php
            wp_dropdown_categories(array(
                'taxonomy' => 'age-type',
                'name' => 'age-type[]', // 修正
                'show_option_all' => 'すべて',
                'value_field' => 'term_id',
                'selected' => isset($_GET['age-type']) ? $_GET['age-type'] : '',
                'hide_empty' => false
            ));
            ?>

            <!-- 地域タイプ -->
            <label>地域タイプ:</label>
            <?php
            wp_dropdown_categories(array(
                'taxonomy' => 'region-type',
                'name' => 'region-type[]', // 修正
                'show_option_all' => 'すべて',
                'value_field' => 'term_id',
                'selected' => isset($_GET['region-type']) ? $_GET['region-type'] : '',
                'hide_empty' => false
            ));
            ?>

            <div class="search-actions">
                <button type="reset" class="reset-btn">リセット</button>
                <button type="submit" class="search-btn">検索</button>
            </div>
        </form>
    </div>

    <a href="http://gakuwari.site/"><p class="side-mioxrgnsete">TOP</p></a>
    <div class="service-list">
        <a href="http://gakuwari.site/service/" class="side-mioxrgnsete">学割カテゴリ一覧</a>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/traffic.png" alt="公共交通機関">
            <a href="http://gakuwari.site/service-type/transportation/">JR・私鉄などの公共交通機関</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/food.png" alt="飲食店">
            <a href="http://gakuwari.site/service-type/food/">飲食店</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/themapark.png" alt="レジャー">
            <a href="http://gakuwari.site/service-type/park/">遊園地・動物園・植物園など</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/art.png" alt="美術館">
            <a href="http://gakuwari.site/service-type/musium/">美術館・博物館など</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/mobile.png" alt="携帯電話サービス">
            <a href="http://gakuwari.site/service-type/telephone/">携帯電話サービス</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/pc.png" alt="パソコン">
            <a href="http://gakuwari.site/service-type/pc/">パソコン・電子機器</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/music.png" alt="動画音楽配信">
            <a href="http://gakuwari.site/service-type/music/">動画・音楽配信</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/eiga.png" alt="映画館">
            <a href="http://gakuwari.site/service-type/movie/">映画館</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/karaoke.png" alt="カラオケ">
            <a href="http://gakuwari.site/service-type/karaoke/">カラオケ</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/hotel.png" alt="ホテル等">
            <a href="http://gakuwari.site/service-type/hotel/">ホテル・宿泊施設</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/sports.png" alt="スポーツ">
            <a href="http://gakuwari.site/service-type/sports/">スポーツ</a>
        </p>
        <p class="side-service">           
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/shopping.png" alt="EC">
            <a href="http://gakuwari.site/service-type/ec/">EC・ネット通販</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/fashion.png" alt="ファッション">
            <a href="http://gakuwari.site/service-type/fashion/">ファッション</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/tour.png" alt="ツアー">
            <a href="http://gakuwari.site/service-type/tour/">ツアー</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/school.png" alt="教育">
            <a href="http://gakuwari.site/service-type/study/">学習・教育</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/clinic.png" alt="クリニック">
            <a href="http://gakuwari.site/service-type/clinic/">クリニック</a>
        </p>
        <p class="side-service">
            <img src="<?php echo get_template_directory_uri(); ?>/images/gakuwari.site-header-nav-img/hairsalon.png" alt="美容">
            <a href="http://gakuwari.site/service-type/beauty/">美容</a>
        </p>
    </div>

    <a href="http://gakuwari.site/recommendation/"><p class="side-reco side-mioxrgnsete">おすすめ情報</p></a>
    <a href="http://gakuwari.site/news/"><p class="side-mioxrgnsete">News&Topics</p></a>
    <a href="http://gakuwari.site/form/"><p class="side-mioxrgnsete">学割情報 掲載申込フォーム</p></a>
    <a href="http://gakuwari.site/contact/"><p class="side-mioxrgnsete">お問合せ</p></a>
</div>
