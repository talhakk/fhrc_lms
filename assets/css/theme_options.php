<style>
		<?php if(!empty(get_option( "headerTextColor"))):?>
		#primary-menu a{
			color: <?php echo get_option( "headerTextColor")?>;
		}
		#primary-menu a:hover{
			color: <?php echo get_option( "headerTextColorHover")?>;
		}
		#primary-menu a:after{
			background: <?php echo get_option( "headerTextColorHover")?>;
		}
		.inner a{
			color: <?php echo get_option( "headerTextColor")?>;
		}
		.inner h6{
			color: <?php echo get_option( "headerTextColor")?>;
		}
		.inner a:hover{
			color: <?php echo get_option( "headerTextColorHover")?>;
		}
		.footer__bottom p{
			color: <?php echo get_option( "headerTextColor")?>;
		}
		.footer__top{
			border-bottom:1px solid <?php echo get_option( "headerTextColor")?> ;
		}
		.btn{
			color:<?php echo get_option( "headerTextColor")?> ;
			background-color:<?php echo get_option( "headerTextColorHover")?>
		}
		.btn:hover{
			color:<?php echo get_option( "headerTextColorHover")?> ;
			background-color:<?php echo get_option( "headerTextColor")?>
		}
		.nav__btn{
			color:<?php echo get_option( "headerTextColor")?> ;
			background-color:<?php echo get_option( "headerTextColorHover")?>
		}
		<?php endif;?>
	</style>