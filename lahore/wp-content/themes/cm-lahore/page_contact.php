<?php
/*
Template Name: Contact Us
*/
?>
<?php
if($_POST)
{
	if($_POST['your-email'])
	{
		$toEmailName = get_option('blogname');
		$toEmail = $General->get_site_emailId();
		
		$subject = $_POST['your-subject'];
		$message = '';
		$message .= '<p>Dear '.$toEmailName.',</p>';
		$message .= '<p>Name : '.$_POST['your-name'].',</p>';
		$message .= '<p>Email : '.$_POST['your-email'].',</p>';
		$message .= '<p>Message : '.nl2br($_POST['your-message']).'</p>';
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
		// Additional headers
		$headers .= 'To: '.$toEmailName.' <'.$toEmail.'>' . "\r\n";
		$headers .= 'From: '.$_POST['your-name'].' <'.$_POST['your-email'].'>' . "\r\n";
		
		// Mail it
		wp_mail($toEmail, $subject, $message, $headers);
		if(strstr($_REQUEST['request_url'],'?'))
		{
			$url =  $_REQUEST['request_url'].'&msg=success'	;	
		}else
		{
			$url =  $_REQUEST['request_url'].'?msg=success'	;
		}
		wp_redirect($url);
		exit;
	}
}
?>
<?php get_header(); ?>
<div id="page" class="clearfix">
	<div class="breadcrumb clearfix">
      	<?php if ( get_option( 'ptthemes_breadcrumbs' )) { yoast_breadcrumb('',''); } ?>
     </div> <!-- breadcrumbs #end -->


<div id="content" >
         <h1 class="head"><?php the_title(); ?></h1>
         
         	 
				
 		<?php if(have_posts()) : ?>
			<?php while(have_posts()) : the_post() ?>
            		<?php $pagedesc = get_post_meta($post->ID, 'pagedesc', $single = true); ?>
            
        
                    <div id="post-<?php the_ID(); ?>" >
                        <div class="entry"> 
                            <?php the_content(); ?>
                        </div>
                    </div><!--/post-->
                
            <?php endwhile; else : ?>
        
        <?php endif; ?>
        
        
              <div class="contact_form">

			 <?php
			if($_REQUEST['msg'] == 'success')
			{
			?>
			<p class="success_msg"><?php _e(CONTACT_PAGE_SUCCESS_MSG);?></p>
			<?php
			}
			?>
			 
			<form action="<?php echo $_SERVER['REQUEST_URI'];?>" method="post" id="contact_frm" name="contact_frm" class="wpcf7-form">
            <input type="hidden" name="request_url" value="<?php echo $_SERVER['REQUEST_URI'];?>" />

            <div class="form_row clearfix"> <label> <?php _e(NAME_CONTACT_TEXT);?>  <span class="indicates">*</span></label>
   				<input type="text" name="your-name" id="your-name" value="" class="textfield" size="40" />
				<span id="your_name_Info" class="message_error2"></span>
		   </div>
           
            <div class="form_row clearfix"><label><?php _e(EMAIL_CONTACT_TEXT);?> <span class="indicates">*</span></label>
  				<input type="text" name="your-email" id="your-email" value="" class="textfield" size="40" /> 
				<span id="your_emailInfo"  class="message_error2"></span>
				  </div>
                  
               <div class="form_row clearfix"><label><?php _e(SUBJECT_CONTACT_TEXT);?>  <span class="indicates">*</span></label>
                <input type="text" name="your-subject" id="your-subject" value="" size="40" class="textfield" />
				<span id="your_subjectInfo"></span>
				 </div>     
                  
           
            <div class="form_row clearfix"><label><?php _e(MESSAGE_CONTACT_TEXT);?> <span class="indicates">*</span></label>
             <textarea name="your-message" id="your-message" cols="40" class="textarea textarea2" rows="10"></textarea> 
			<span id="your_messageInfo"  class="message_error2"></span>
			</div>
                <input type="submit" value="<?php _e(SEND_CONTACT_BUTTON);?>" class="highlight_input_btn  btn_spacer" />  
          </form> 
          
          </div>
		 
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/jquery.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_directory'); ?>/library/js/contact_us_validation.js"></script> 
        
        
        
        
        
        	 
  			  </div> <!-- content #end -->
 		 <?php get_sidebar(); ?>
  </div> <!-- page #end -->
 <?php get_footer(); ?>        
        
        
        
         