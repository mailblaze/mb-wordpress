<?php

/**
 * Returns a Form instance
 *
 * @access public
 *
 * @param int|WP_Post $form_id.
 *
 * @return MB4WP_Form
 */
function mb4wp_get_form( $form_id = 0 ) {
    return MB4WP_Form::get_instance( $form_id );
}

/**
 * Get an array of Form instances
 *
 * @access public
 * @uses get_posts
 *
 * @param array $args Array of parameters
 *
 * @return MB4WP_Form[]
 */
function mb4wp_get_forms( array $args = array() ) {
    $default_args = array(
        'post_status' => 'publish',
        'numberposts' => -1,
    );
    $args = array_merge( $default_args, $args );
    $args['post_type'] = 'mb4wp-form';
    $posts = get_posts( $args );
    $forms = array();

    foreach( $posts as $post ) {
        try {
            $form = mb4wp_get_form( $post );
        } catch( Exception $e ) {
            continue;
        }

        $forms[] = $form;
    }
    return $forms;
}

/**
 * Echoes the given form
 *
 * @access public
 *
 * @param int $form_id
 * @param array $config
 * @param bool $echo
 *
 * @return string
 */
function mb4wp_show_form( $form_id = 0, $config = array(), $echo = true ) {
    /** @var MB4WP_Form_Manager $forms */
    $forms = mb4wp('forms');
    return $forms->output_form( $form_id, $config, $echo );
}

/**
 * Check whether a form was submitted
 *
 * @ignore
 * @since 2.3.8
 * @deprecated 3.0
 * @use mb4wp_get_form
 *
 * @param int $form_id The ID of the form you want to check. (optional)
 * @param string $element_id The ID of the form element you want to check, eg id="mb4wp-form-1" (optional)
 *
 * @return boolean
 */
function mb4wp_form_is_submitted( $form_id = 0, $element_id = null ) {

    try {
        $form = mb4wp_get_form( $form_id );
    } catch( Exception $e ) {
        return false;
    }

    if( $element_id ) {
        $form_element = new MB4WP_Form_Element( $form, array( 'element_id' => $element_id ) );
        return $form_element->is_submitted;
    }

    return $form->is_submitted;
}

/**
 * @since 2.3.8
 * @deprecated 3.0
 * @ignore
 * @use mb4wp_get_form
 *
 * @param int $form_id (optional)
 *
 * @return string
 */
function mb4wp_form_get_response_html( $form_id = 0 ) {

    try {
        $form = mb4wp_get_form( $form_id );
    } catch( Exception $e ) {
        return '';
    }

    return $form->get_response_html();
}

/**
 * Gets an instance of the submitted form, if any.
 *
 * @access public
 *
 * @return MB4WP_Form|null
 */
function mb4wp_get_submitted_form() {
    return mb4wp('forms')->get_submitted_form();
}