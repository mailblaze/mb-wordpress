<?php

$email_label        = __( 'Email address', 'mailblaze-for-wp' );
$email_placeholder  = __( 'Your email address', 'mailblaze-for-wp' );
$signup_button      = __( 'Sign up', 'mailblaze-for-wp' );

$content = "<p>\n\t<label>{$email_label}: </label>\n";
$content .= "\t<input type=\"email\" name=\"EMAIL\" placeholder=\"{$email_placeholder}\" required />\n</p>\n\n";
$content .= "<p>\n\t<input type=\"submit\" value=\"{$signup_button}\" />\n</p>";

return $content;