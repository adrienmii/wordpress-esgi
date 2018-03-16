<?php 
/*
Plugin Name: Newsletter Plugin ESGI
Description: Plugin de Newsletter semaine thematique
Version: 1.0
Author: Audric, Adrien, Valentin
*/

require('class_newsletter.php');

if(!class_exists('Newsletter')) {

	class Newsletter {

		public function __construct()
		{
			add_action( 'admin_menu', array(&$this,'settings'));
			add_action( 'wp_enqueue_scripts', array(&$this,'scripts' ));
			add_action( 'admin_enqueue_scripts', array(&$this,'admin_scripts' ) );
	

			if(isset($_POST['newsletter']))
			{
				add_action('after_setup_theme', array(&$this, 'generateForm'));
			}

			if(isset($_GET['newsletter_export_method']) && is_admin())
			{
				add_action('after_setup_theme', array(&$this, 'export'));
			}
			
			if(isset($_GET['newsletter_delete']) && is_admin())
			{
				add_action('after_setup_theme', array(&$this, 'delete'));
				header('location: ?page=newsletter-grid');
			}

			add_shortcode('newsletter', array(&$this,'generateForm'));
		}


		public function settings()
		{
			add_options_page( '', 'Newsletter ESGI', 'manage_options', 'newsletter-admin', array( &$this, 'admin_updateSettings' ) );
			add_menu_page('Newsletter', 'Newsletter ESGI', 'administrator', 'newsletter-grid', array(&$this,'admin_gridSubscribers'), 'dashicons-email');
		}


		public function scripts()
		{
			wp_enqueue_script( 'newsletter', plugins_url('js/main.js', __FILE__), array('jquery'));
		}

		public function admin_scripts()
		{
			if( !isset($_GET['page']) || $_GET['page'] != 'newsletter-grid' ){
				return ;
			}
			
			wp_enqueue_script( 'newsletter-admin', plugins_url('js/admin_main.js', __FILE__), array('jquery'));
		}

		public function generateForm( $attr )
		{
			$newsletter = new controllerNewsletter();
			$confirm_ok = 0;

			if(isset($_GET['newsletter_token']))
			{
				if($newsletter->confirm($_GET['newsletter_token']))
				{
					$confirm_ok = 1;
					?>
					<div class="newsletter-confirm-success">
						<p><?php echo get_option('newsletter_confirmedmessage'); ?></p>
					</div>
					
					<?php
				}	
			}

			$errors = array();


			if(isset($_POST['newsletter']) )
			{
				$newsletter->insert($_POST['newsletter']);
				$errors = $newsletter->errors;
				$this->ajaxResponse($errors, $newsletter->success_message);
			}

			if( isset( $errors ) || empty( $_POST['newsletter'] ) )
			{
				foreach( $errors as $field => $error )
				{
					echo "<div class='error1'>$error</div>";
				}
				if (!$confirm_ok) {
					$this->render_form( $attr );
				}
			}
		}

		public function render_form($attr)
		{
			include ('views/user_form.php');
		}

		public function admin_updateSettings()
		{
			if(!empty($_POST))
			{
				foreach($_POST as $name=>$value)
				{
					$value = sanitize_text_field($value);
					update_option($name, $value);
				}

				add_settings_error(
					'newsletterSaveSettings',
					esc_attr( 'settings_updated' ),
					'Configuration mise à jour',
					'updated'
					);
			}

			include('views/admin_form.php');
		}

		public function admin_gridSubscribers()
		{
			include ('views/admin_grid.php');
		}

		public function export()
		{
			$newsletter = new controllerNewsletter();
			$newsletter->export($_GET['newsletter_export_method']);
			exit;
		}
		
		public function delete()
		{
			$newsletter = new controllerNewsletter();
			$newsletter->delete($_GET['newsletter_delete']);
			exit;
		}

		
		public static function activate() {
			global $wpdb;
			add_option("newsletter_dbloptin", "1", null, "no");
			add_option("newsletter_showname", "1", null, "no");
			add_option("newsletter_successmessage", "Merci de vous être inscrit, vous allez recevoir un mail afin de vérifier l'e-mail saisie.", null, "no");
			add_option("newsletter_confirmedmessage", "Votre adresse e-mail a bien été vérifiée", null, "no");
			add_option("newsletter_confirmationemail", "Merci de vous être inscrit, cliquez sur le lien qui vient de vous être envoyé pour confirmer votre e-mail", null, "no");
			add_option("newsletter_logo", "", null, "no");
			add_option("newsletter_showon", "append", null, "no");
			$file = fopen( plugin_dir_path(__FILE__).'table.sql', "r");
			$query = fread($file, filesize(plugin_dir_path(__FILE__).'table.sql'));
			fclose($file);
			$wpdb->query($query);
		}

		public static function deactivate() {
			delete_option("newsletter_dbloptin");
			delete_option("newsletter_logo");
			delete_option("newsletter_confirmationemail");
			delete_option("newsletter_showname");
			delete_option("newsletter_successmessage");
			delete_option("newsletter_confirmedmessage");
			delete_option("newsletter_showon");
		}

		public function ajaxResponse($errors, $success_message)
		{
			if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest')
			{
				if(!empty($errors))
				{
					echo json_encode( array( 'success' => '0', 'message' => $errors ) );
				}else{
					echo json_encode( array( 'success' => '1', 'message' => $success_message ) );
				}
				exit;

				return true;
			}
			
			return true;
		}

	}
}

if(class_exists("Newsletter")){
	register_activation_hook(__FILE__, array('Newsletter', 'activate'));
	register_deactivation_hook(__FILE__, array('Newsletter', 'deactivate'));
	$Newsletter = new Newsletter;
	add_action( 'widgets_init', 'newsletter_register_widgets' );
}

class widgetNewsletter extends WP_Widget {

	function __construct() {
		parent::__construct( false, 'Newsletter ESGI', array('description' => 'Ajouter un formulaire de newsletter.') );
	}

	function widget( $args, $instance ) {
		?>
		<aside id="newsletter-widget" class="widget">
			<h4 class="widget-title penci-border-arrow"><span class="inner-arrow"><?php echo $instance['title'] ?></span></h4>
			<center><img src="https://odrik.fr/wordpress/wp-content/uploads/2018/03/df.png" style="
    width: 15%;
    margin-top: -5px;
    margin-bottom: 20px;
"></center>
			<p style="margin-top:-3px"><?php echo ( isset($instance['boxtext']) && !empty($instance['boxtext']) ) ? $instance['boxtext'] : ''; ?></p>
			<?php do_shortcode('[newsletter]'); ?>
		</aside>
		<?php
	}

	function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['boxtext'] = ( ! empty( $new_instance['boxtext'] ) ) ? strip_tags( $new_instance['boxtext'] ) : '';
		return $instance;
	}

	function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : 'Newsletter';
		$boxtext = ! empty( $instance['boxtext'] ) ? $instance['boxtext'] : 'Texte sous le titre';
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title:</label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
			<label for="<?php echo $this->get_field_id( 'boxtext' ); ?>">Box text:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'boxtext' ); ?>" name="<?php echo $this->get_field_name( 'boxtext' ); ?>" type="text" value="<?php echo esc_attr( $boxtext ); ?>">
		</p>
		<?php 
	}
}

function newsletter_register_widgets() {
	register_widget( 'widgetNewsletter' );
}