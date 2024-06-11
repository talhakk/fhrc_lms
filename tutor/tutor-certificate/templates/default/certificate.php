<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PDF Certificate Title</title>
    <style type="text/css"><?php $this->pdf_style(); ?></style>
</head>
<body>
<?php
$main_sinature_id = (int) tutor_utils()->get_option( 'tutor_cert_signature_image_id' );
if ( $main_sinature_id ) {
            // Get default ID.
            // Assign default image from plugin file system if even global one is not set yet.
            $main_signature_image_url = $main_sinature_id ?
                                        wp_get_attachment_url( $main_sinature_id ) :
                                        TUTOR_CERT()->url . 'assets/images/signature.png';
        }
?>
<div class="certificate-wrap text-center">
        <div class="certificate-topheading" style="text-align: center; width:100%; ">
            <div class="logo" style="max-width: 300px;width: 100%;margin: 0 auto;">
            <?php
							$header_image = get_header_image();
							$custom_logo_id = get_theme_mod('custom_logo');
							$image_url = wp_get_attachment_image_url($custom_logo_id, 'full');
							if ($custom_logo_id) { ?>
								<img src="<?php echo $image_url ?>" alt="Header Image">
							<?php } else { ?>
								<img src="<?php echo esc_url($header_image); ?>" alt="Header Image">
							<?php } ?>
           </div>
        </div>
        <div class="certificate-content" style="text-align: center;position: relative;padding: 28px;z-index: 1;">
            <h3 style="color: #C6A24D;font-family: 'Century Schoolbook', sans-serif;font-size: 26px;font-weight: 700;margin: 25px 0; text-align: center;">CERTIFICATE OF APPRECIATION</h3>
            <h4 style="color: #3A3B4F;font-size: 18px;font-weight: 600;text-align: center;">Is Presented to</h4>
            <h3 class="candidate" style="font-size: 28px;text-transform: uppercase;"><?php echo esc_html( tutor_utils()->get_user_name( $user ) ); ?></h3>
            <p style="color: #121212;font-size: 13px;letter-spacing: 0.8px;text-align: center;">for successfully completing the following Training Program</p>
            <h5 class="course-title" style="color: #3A3B4F;font-size: 27px;font-weight: 600;text-align: center;"><?php echo esc_html( $course->post_title ); ?></h5>
            <p>Credit Hrs of <?php echo esc_html( $duration_text );?> <?php echo esc_html__( 'on', 'tutor-pro' ) . ' ' . esc_html( $completed_date ); ?></p>
        </div>
        <div class="certificate-footer w-100">
            <div class="signature-wrap w-100 d-flex">
                <table>
                    <tbody style="width: 100%;">
                        <tr>
                            <td style="border-bottom: 2px solid #C6A24D;text-align: center;"><img src="<?php echo esc_url( $signature_image_url ); ?>" class="w-100" alt="Signature"></td>
                            <td class="second-col"></td>
                            <td style="border-bottom: 2px solid #C6A24D;text-align: center;"><img src="<?php echo esc_url( $main_signature_image_url ); ?>" class="w-100" alt="Signature"></td>
                        </tr>
                        <tr>
                            <td><p class="certificate-author-name"><h6 style="color: #C6A24D;font-size: 18px;text-transform: uppercase;"><?php echo esc_html( get_the_author_meta( 'display_name', $course->post_author ). ', Course Tutor' ); ?></h6></p></td>
                            <td class="first-col"><p><?php esc_html_e( 'Valid Certificate ID', 'tutor-pro' ); ?></p></td>
                            <td><p class="certificate-author-name"><h6 style="color: #C6A24D;font-size: 18px;text-transform: uppercase;"><?php 
                            $authoriser_name = str_replace(get_the_author_meta( 'display_name', $course->post_author ).',' , '', tutor_utils()->get_option( 'tutor_cert_authorised_name' ));
                            echo esc_html( $authoriser_name );?></h6></p></td>
                        </tr>
                        <tr>
                            <td><p><?php echo esc_html( tutor_utils()->get_option( 'tutor_cert_authorised_company_name' ) ); ?></p></td>
                            <td class="first-col"><p><?php echo esc_html( $completed->completed_hash ); ?></p></td>
                            <td><p><?php echo esc_html( tutor_utils()->get_option( 'tutor_cert_authorised_company_name' ) ); ?></p></td>
                        </tr>
                    </tbody>
                    
                </table>
            </div>
        </div>
</div>
<div id="watermark">
    <img src="<?php echo esc_url( $this->template['url'] . 'background.png' ); ?>" height="100%" width="100%" />
</div>
</body>
</html>