<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

require_once('firebase/src/JWT.php');
use \ivole\Firebase\JWT\JWT;

if ( ! class_exists( 'Ivole_Replies' ) ) :

	require_once('class-ivole-email.php');

	class Ivole_Replies {
		private $api_url = 'https://z4jhozi8lc.execute-api.us-east-1.amazonaws.com/stage/review-reply';

	  public function __construct( $comment_id ) {
			if( 'yes' == get_option( 'ivole_reviews_verified', 'no' ) ) {
				$comment = get_comment( $comment_id );
	    	if ( $comment ) {
					// get parent comment (orignal review) and find order number related to this review
					//it is possible that we have a reply to reply
					//in this case, we will have to loop through previous replies to find the original review
					$parent_id = $comment->comment_parent;
					while( $parent_id ) {
						$parent = get_comment( $comment->comment_parent );
						if( $parent ) {
							if( $parent->comment_parent ) {
								$parent_id = $parent->comment_parent;
								continue;
							} else {
								$ivole_order = get_comment_meta( $parent->comment_ID, 'ivole_order', true );
								$rating = get_comment_meta( $parent->comment_ID, 'rating', true );
								if( $ivole_order && $rating ) {
									$current_user = wp_get_current_user();

									if( $current_user->ID ) {
										$key = get_option( 'ivole_license_key' );
										$payload = array(
											'iss' => Ivole_Email::get_blogurl(),
											'aud' => 'www.cusrev.com',
											'iat' => time()
										);
										error_log( print_r( $key, true) );
										$jwt = JWT::encode( $payload, $key, 'HS256' );
										$data = array(
											'shopDomain' => Ivole_Email::get_blogurl(),
											'orderId' => $ivole_order,
											'productId' => $parent->comment_post_ID,
											'replyId' => strval( $comment_id ),
											'replyType' => 1, //1 means this is a reply from a shop owner
											'email' => $current_user->user_email,
											'text' => $comment->comment_content,
											'token' => $jwt
										);
										$data_string = json_encode( $data );
										error_log( print_r( $data_string, true ) );
										$ch = curl_init();
										curl_setopt( $ch, CURLOPT_URL, $this->api_url );
										curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
										curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, "POST" );
										curl_setopt( $ch, CURLOPT_POSTFIELDS, $data_string );
										curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
											'Content-Type: application/json',
											'Content-Length: ' . strlen( $data_string ) )
										);
										$result = curl_exec( $ch );
										error_log( print_r( $result, true ) );
										if( false === $result ) {
											error_log( print_r( $result, true ) );
											error_log( print_r( curl_error( $ch ), true ) );
											return array( 2, curl_error( $ch ) );
										}
										$result = json_decode( $result );
										if( isset( $result->code ) && isset( $result->error ) ) {
											add_comment_meta( $comment_id, 'ivole_reply', array( $result->code, $result->error ), true );
										} else {

										}
									} else {

									}
								}
								break;
							}
						} else {
							break;
						}
					}
				};
			}
	  }

	}

endif;

?>
