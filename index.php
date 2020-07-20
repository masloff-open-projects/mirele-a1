<?php
/**
 *
 * @package WordPress
 * @subpackage Mirele
 * @version 1.0
 */

get_header();
?>

    <section>
        <div class="container">
            <div class="row">
                <div>
                    <h1><?php // заголовок архивов
                        if (is_day()) : printf('Daily Archives: %s', get_the_date()); // если по дням
                        elseif (is_month()) : printf('Monthly Archives: %s', get_the_date('F Y')); // если по месяцам
                        elseif (is_year()) : printf('Yearly Archives: %s', get_the_date('Y')); // если по годам
                        else : 'Archives';
                        endif; ?></h1>
                    <?php if (have_posts()) : while (have_posts()) : the_post(); // если посты есть - запускаем цикл wp ?>
                        <?php get_template_part('loop'); // для отображения каждой записи берем шаблон loop.php ?>
                    <?php endwhile; // конец цикла
                    else: echo '<p>Нет записей.</p>'; endif; // если записей нет, напишим "простите" ?>
                </div>
                <?php get_sidebar(); // подключаем sidebar.php ?>
            </div>
        </div>
    </section>

<?php get_footer(); ?>