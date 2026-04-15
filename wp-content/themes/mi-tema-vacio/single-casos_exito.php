<?php
/**
 * Plantilla para mostrar un Caso de Éxito individual
 */
?>
<!DOCTYPE html>
<html>
<head>
    <title><?php wp_title(); ?></title>
    <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">
    <?php wp_head(); ?>
</head>
<body>

    <div class="box">
        <?php
        // EL LOOP: Es lo que busca la info en la base de datos
        if ( have_posts() ) : 
            while ( have_posts() ) : the_post(); ?>
                
                <h1><?php the_title(); ?></h1> <hr>

                <div class="contenido-post">
                    <?php the_content(); ?> </div>

                <?php if ( has_post_thumbnail() ) : ?>
                    <div class="foto">
                        <?php the_post_thumbnail('large'); ?>
                    </div>
                <?php endif; ?>

                <div class="taxonomias">
                    <strong>Procedimientos:</strong> 
                    <?php echo get_the_term_list( get_the_ID(), 'procedimientos', '', ', ' ); ?>
                </div>

                <br>
                <a href="<?php echo home_url(); ?>">⬅ Volver a Gestión de Usuarios</a>

            <?php endwhile; 
        endif; 
        ?>
    </div>

    <?php wp_footer(); ?>
</body>
</html> 
