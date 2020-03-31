<?php
$lab_form = "";
$lab_error = "";

//Creates a contact form  
function lab_html_form_code() {
    $lab_form .= '<form role="form" action="' . esc_url( $_SERVER['REQUEST_URI'] ) . '" method="post">';
    $lab_form .= '<div class="form-group">
    <label for="contact-form-name">' . __( 'Name * : ' , 'labcf' ) . '</label>
	<input type="text" class="form-control" required name="contact-form-name" id="contact-form-name" value="' . ( isset( $_POST["contact-form-name"] ) ? esc_attr( $_POST["contact-form-name"] ) : '' ) . '" /></div>';

    $lab_form .= '<div class="form-group">
    <label for="contact-form-email">' . __( 'E-mail * :  ' , 'labcf' ) . '</label>
	<input type="email" name="contact-form-email" required class="form-control" id="contact-form-email" value="' . ( isset( $_POST["contact-form-email"] ) ? esc_attr( $_POST["contact-form-email"] ) : '' ) . '" />
	</div>';
    
    $lab_form .= '<div class="form-group">
    <label for="contact-form-subject">' . __( 'Subject : ' , 'labcf' ) . '</label><input class="form-control" type="text" name="contact-form-subject" value="' . ( isset( $_POST["contact-form-subject"] ) ? esc_attr( $_POST["contact-form-subject"] ) : '' ) . '" /></div>';
    
    $lab_form .= '<div class="form-group">
    <label for="contact-form-message">' . __( 'Message * : ' , 'labcf' ) . '</label>
	<textarea class="form-control" rows="6" id="massage" required name="contact-form-message">' . ( isset( $_POST["contact-form-message"] ) ? esc_attr( $_POST["contact-form-message"] ) : '' ) . '</textarea>	
	</div>';
	
	$lab_form .= '<div class="form-group">
	<input type="checkbox" id="aceptacion" name="aceptacion" value="1" required> - '	
	 . __(' I consent to having this website collect my personal data via this form.' , 'labcf' ) .
	'</div>';
    $lab_form .= '<button class="btn btn-primary btn-lg" type="submit" name="contact-form-submit">'. __('Submit') . '</button>';
	
	$lab_form .= '<div class="legal">
                <br><label for="aceptacion">Nos comprometemos a custodiar de manera responsable los datos que vas
                a enviar. Su finalidad es la de responder a las solicitudes del formulario.<br>
                En cualquier momento puedes solicitar el acceso, la rectificación
                o la eliminación de tus datos desde esta página web.</label>
        </div>';

    $lab_form .= '</form>';
	echo $lab_form;
}


function lab_deliver_mail() {
	

 	if ( isset( $_POST['contact-form-submit'] ) ) { 	
		
        if (empty($_POST["contact-form-name"])) {
				return  _e('* Name is required.' , 'labcf' );
			}  		 
		else {
			$lab_name = sanitize_text_field( $_POST["contact-form-name"]);
  		}
		
    	if (empty($_POST["contact-form-email"])) {				
					return  _e('* E-mail is required.' , 'labcf' );
				}			
		else {
			$lab_email = sanitize_email( $_POST["contact-form-email"] );
			if (!filter_var($lab_email, FILTER_VALIDATE_EMAIL)) {
				 return  _e('* Invalid e-mail format.' , 'labcf' );
				}		
			else {
				$lab_email = sanitize_email( $_POST["contact-form-email"] );
			}
		}
		
		if (empty($_POST["contact-form-subjet"])) {
                $lab_subject = stripslashes(sanitize_text_field( $_POST["contact-form-subject"] ));
		    }
		
		if (empty($_POST["contact-form-message"])) {
			    return  _e('* Message is required.' , 'labcf' );
			}
		else {
			$lab_message = stripslashes(esc_textarea( $_POST["contact-form-message"] ));
		}
 
        // get the email address
    	$lab_to = get_option('lab_contactform_email');
 
        $lab_headers = "From: $lab_name <$lab_email>" . "\r\n";

        // If email has been process for sending, display a success message

			if ($lab_error != "") {
				echo '<div id="errorMessages">' . $lab_error . '</div>';
				return; 
			}
			elseif ( wp_mail( $lab_to, $lab_subject, $lab_message, $lab_headers ) ) {
            	$lab_success = '<p class="alert alert-success" role="alert">' . __( 'Thanks for the message, we will contact you shortly.' , 'labcf' ) . '</p>';
				$_POST["contact-form-name"] = "";
				$_POST["contact-form-email"] = "";
				$_POST["contact-form-subject"] = "";
				$_POST["contact-form-message"] = "";
				echo '<div class="formSuccess">' .  $lab_success . '</div>' ;	
        	} 
			else {
            	echo _e( 'An unexpected error occurred! Please try again or send an e-mail to ' , 'labcf' ) . $lab_to . '.';
        	}
    	}
	}
?>