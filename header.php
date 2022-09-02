<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package builer
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<!--
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">	
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
        -->
            
        <?php wp_head(); ?>
        <!-- CSS only -->

</head>

<body <?php body_class(); ?>>



<?php wp_body_open(); ?>



<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'builer' ); ?></a>

	<header id="masthead" class="site-header">

                <?php // if ( is_front_page() && is_home() ) : ?>
            <!-- 
                <div class="site-branding row">
                    <div class="col-8"><?php echo get_bloginfo( 'description', 'display' ); ?></div>
                    <div class="col-2">telefon</div>
                    <div class="col-2">email</div>
                </div>
            -->    
            
                <nav id="site-navigation" class="navbar navbar-expand-lg navbar-light bg-light ">
                 <div class="container-fluid">
                   <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php  the_custom_logo();  bloginfo( 'name' ); ?></a>
                   <!-- <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'builer' ); ?></button> -->
                   
                   
                   <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                     <span class="navbar-toggler-icon"></span>
                   </button>
                   <div class="collapse navbar-collapse" id="navbarSupportedContent"> 
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0"> 
                        <?php                
                        no_nav_menu('menu-1');    
                        ?>
                        <li class="nav-item">
                          <a class="nav-link" href="callto:">Tel.</a>
                        </li>
                        
                        <li class="nav-item">
                          <a class="nav-link" href="mailto">Email</a>
                        </li>
                        
                    </ul> 
                    <form class="d-flex">
                       <input class="form-control me-2" type="search" placeholder="Szukaj" aria-label="Search">
                       <button class="btn btn-outline-success" type="submit">Szukaj</button>
                    </form>
                   </div>
                 </div>
               </nav>                   
                
	</header><!-- #masthead -->
    
<hr>  

    
<i class="bi-alarm"></i>



<hr>  

<hr>  