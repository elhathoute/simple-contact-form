<?php

/**
 * Plugin Name: Simple Contact Form
 * Description: Simple Contact Form
 * Author: ABDELAZIZ
 * Author URI: https://abdelaziz.com.au
 * Version:1.0.0
 * Text Domain: simple-contact-form
 * 
 */

// define absolute path
if(!defined('ABSPATH')){
    echo 'what you want to do ?';
    exit;
}
class SimpleContactForm {
    public function __construct(){
        // action hooks(create custom type)
        add_action('init',array($this,'create_custom_post_type'));
        //add assets(js css bootstrap ,html)
        add_action('wp_enqueue_scripts',array($this,'load_assets'));

        // add shortcode
        add_shortcode('contact-form',array($this,'load_shortcode'));

        // add jquery
        add_action('wp_footer',array($this,'load_scripts'));

        // create rest api 
        add_action('rest_api_init',array($this,'register_rest_api'));

    
    }
    public function create_custom_post_type(){
        $args=array(
            'public'=>true,
            'has_archive'=>true,
            'supports'=>array('title'),
            'exclude_from_search'=>true,
            'publicly_queryable'=>false,
            'capability'=>'manage_options',
            'labels'=>array(
                'name'=>'Contact Form',
                'singular_name'=>'Contact Form Entry'
            ),
            'menu_icon'=>'dashicons-media-document'
        );
        register_post_type('simple_contact_form',$args);
    }

    public function load_assets(){
        // css
        wp_enqueue_style(
            'bootstrap',
            'https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css',
            array(),
            '5.0.0',
            'all'
        );
        // js
        wp_enqueue_script(
            'simple-contact-form',
            plugin_dir_url(__FILE__).'js/simple-contact-form.js',
            array('jquery'),
            1,
            true,
        );
    }
    public function load_shortcode()
    {?>
<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-lg-8 col-md-10">
      <div class="card border-primary rounded-0">
        <div class="card-header p-0 bg-primary text-white">
          <h4 class="m-0 text-center py-2">Contact Form</h4>
        </div>
        <div class="card-body p-3">
          <p class="text-muted text-center mb-3">Remplir cette formulaire</p>
          <div 
          style="background-color: green;color:white"
          id="enquiry-form-success"></div>
            <div
          style="background-color: red;color:white"

             id="enquiry-form-error"></div>
          <form id="simple-contact-form__form">
          
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="name" class="form-label">Name</label>
                  <input name="name" type="text" class="form-control" id="name" placeholder="Enter your name">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="email" class="form-label">Email address</label>
                  <input name="email" type="email" class="form-control" id="email" placeholder="Enter your email">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="phone" class="form-label">Phone number</label>
                  <input name="phone" type="tel" class="form-control" id="phone" placeholder="Enter your phone number">
                </div>
              </div>
              <div class="col-md-6">
                <div class="mb-3">
                  <label for="message" class="form-label">Message</label>
                  <textarea name="message" class="form-control" id="message" rows="5" placeholder="Enter your message"></textarea>
                </div>
              </div>
            </div>
            <div class="d-grid gap-2">
              <button  type="submit" class="btn btn-primary rounded-0">Send</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

 
    <?php
    }
    public function  load_scripts()
    {?>
<script>
    // var nonce = '<?php echo wp_create_nonce('wp_rest');?>';

   jQuery(document).ready(function($) {
       $('#simple-contact-form__form').submit(function(e){
          e.preventDefault();
          $("#form_error").hide();
        var form = $(this).serialize();
       $.ajax({
        type:'POST',
        url: '<?php echo get_rest_url(null,'simple-contact-form/v1/send-email'); ?>',
        data:form,
        success:function(res){
            form.hide();
            $("#form_success").html(res).fadeIn();

        },
        error:function(error){
          $("#form_error").html("There was an error submitting").fadeIn();

        }
       })



       });
   });
</script>
<?php

    }
   public function register_rest_api(){
    register_rest_route('simple-contact-form/v1','send-email',array(
            'methods'=>'POST',
            'callback'=>array($this,'handle_contact_form')
    ));
   }

   public function handle_contact_form($data){
   
    
    $headers = $data->get_headers();
    $params = $data->get_params();
    
    if (isset($headers['x_wp_nonce'][0])) {
        $nonce = $headers['x_wp_nonce'][0];
        if (!wp_verify_nonce($nonce, 'wp_rest')) {
            return new WP_REST_Response('Message not sent', 422);
        }
    } 
  $post_id = wp_insert_post([
    'post_type'=>'simple_contact_form',
    'post_title'=>'Email :'.$params['email'],
    'post_status'=>'publish',
    
  ]);

   if($post_id){
 
    return new WP_REST_Response('Thank you for Email'.$table_name,200);
   }
  //  add to db
  // if (isset($_POST['name'], $_POST['email'], $_POST['phone'], $_POST['message'])) {
  //   $name = sanitize_text_field($_POST['name']);
  //   $email = sanitize_email($_POST['email']);
  //   $phone = sanitize_text_field($_POST['phone']);
  //   $message = esc_textarea($_POST['message']);

  //   // Perform validation using regular expressions
  //   $valid = true;
  //   $regex = '/^[a-zA-Z ]*$/'; // Only letters and spaces
  //   if (!preg_match($regex, $name)) {
  //     $valid = false;
  //     $error_message = 'Name can only contain letters and spaces.';
  //   }
  //   $regex = '/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/';
  //   if (!preg_match($regex, $email)) {
  //     $valid = false;
  //     $error_message = 'Invalid email address.';
  //   }

  //   if ($valid) {
  //     // Add the form data to the WordPress database
     

  //   }
  // }
unset($params['_wpnonce']);
unset($params['_wp_http_referer']);
//    send the email message
   $headers = [];

   $admin_email = get_bloginfo('admin_email');
   $admin_name = get_bloginfo('name');

   $headers[] = "From:{$admin_name} <{$admin_email}>";
   $headers[]="Replay-to:{$params['name']} <{$params['email']}>";

   $subject = "New enquiry from {$params['name']}";

   $message ='';
   $message .="Message has been sent from {$params['name']} <br /> <br />";
 
   foreach($params as $label=>$value){
    $message .=ucfirst($label).':'.$value;
   }
   wp_mail($admin_email,$subject,$message,$headers);
   return new WP_REST_RESPONSE('the message was sent',422);
}

}

new SimpleContactForm;

