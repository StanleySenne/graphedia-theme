<?php
/* Template Name: Grephedia */
// @phpstan-ignore-file
// @psalm-suppress UndefinedFunction
get_header();
?>

<style>
  .pagina-unica {
    max-width: 960px;
    margin: 0 auto;
    padding: 2rem;
    font-family: sans-serif;
  }

  .pagina-unica .hero {
    text-align: center;
    margin-bottom: 3rem;
  }

  .pagina-unica .hero h1 {
    font-size: 2.5rem;
    margin-bottom: 1rem;
  }

  .pagina-unica .hero p {
    font-size: 1.2rem;
    color: #666;
  }

  .pagina-unica .produtos {
    margin-bottom: 3rem;
  }

  .pagina-unica .produtos h2 {
    font-size: 1.8rem;
    margin-bottom: 1rem;
  }

  .pagina-unica .produtos-lista {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 1.5rem;
  }

  .pagina-unica .info-extra {
    background: #f7f7f7;
    padding: 2rem;
    border-radius: 8px;
    text-align: center;
  }
</style>

<main class="pagina-unica">
  <!-- HERO -->
  <section class="hero">
    <h1><?php the_title(); ?></h1>
    <p><?php the_field('subtitulo'); ?></p>
  </section>

  <!-- PRODUTOS WOO -->
  <section class="produtos">
    <h2>Produtos teste</h2>
    <ul class="produtos-lista">
      <?php
      $args = array(
        'post_type' => 'product',
        'posts_per_page' => 4,
        'orderby' => 'date',
        'order' => 'DESC',
      );
      $loop = new WP_Query($args);
      if ($loop->have_posts()) :
        while ($loop->have_posts()) : $loop->the_post();
          wc_get_template_part('content', 'product');
        endwhile;
      else :
        echo '<p>Nenhum produto encontrado.</p>';
      endif;
      wp_reset_postdata();
      ?>
    </ul>
  </section>

  <!-- BLOCO COM TEXTO ACF -->
  <section class="info-extra">
    <p><?php the_field('grephedia_field'); ?></p>
  </section>
</main>

<?php get_footer(); ?>