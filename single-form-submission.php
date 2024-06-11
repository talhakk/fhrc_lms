<?php

/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package FHRC_LMS
 */
get_header();
?>
<main id="primary" class="site-main">
    <?php
    while (have_posts()) :
        the_post();
        $post_id = get_the_ID();
        $post_title = get_the_title();
        $post_content = get_the_content();
        $post_date = get_the_date();
        $author_id = get_the_author_meta('ID');
        $author_name = get_the_author_meta('display_name');
        $author_avatar = get_avatar_url($author_id);
        $is_author = ($current_user->ID == $author_id);
        $attachments = get_posts(array(
            'post_type' => 'attachment',
            'posts_per_page' => -1,
            'post_status' => 'inherit',
            'post_parent' => $post_id
        ));
    ?>
        <section class="head-back-btn">
            <div class="container">
                <div class="inner">
                    <div class="head small">
                        <a onclick="history.back()"><i class="fa-solid fa-arrow-left"></i></a>
                        <div class="head-wrapper">
                            <h2> Request # <?php echo $post_id; ?></h2>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="request-details mt-5">
            <div class="container">
                <div class="inner">
                    <div class="block-wrapper d-flex">
                        <img class="user-profile-pic" src="<?php echo $author_avatar; ?>" alt="<?php echo $author_name; ?>'s Avatar">
                        <div class="head small">
                            <h2><?php echo $author_name; ?> : </h2>
                            <p><?php echo $post_title; ?></p>
                        </div>
                        <span class="date"><?php echo $post_date; ?></span>
                    </div>
                    <div class="block-wrapper details">
                        <div class="head small">
                            <h2>Description:</h2>
                            <p><?php echo $post_content; ?></p>
                        </div>
                    </div>
                    <div class="block-wrapper details">
                        <div class="head small">
                            <h2>Attachments:</h2>
                            <div class="attachments-wrapper">
                                <?php foreach ($attachments as $attachment) {
                                    $attachment_url = wp_get_attachment_url($attachment->ID);
                                    $attachment_title = $attachment->post_title;
                                ?>
                                    <a href="">
                                        <img src="<?php echo $attachment_url; ?>" alt="<?php echo $attachment_title; ?>">
                                        <span>New Attachment.PNG <span>2 Mb <i class="fa-solid fa-download"></i></span></span>
                                        <a href="<?php echo $attachment_url; ?>" download>Download</a>
                                    </a>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                    <div class="block-wrapper response">
                        <?php

                        if (comments_open() || get_comments_number()) :
                            comments_template();
                        endif;
                        ?>
                    </div>

                </div>
            </div>
        </section>
    <?php
    endwhile;
    ?>

    <script>
        jQuery(document).ready(function($) {
            // Add placeholder attribute to the comment textarea.
            $('#comment').attr('placeholder', 'Type a Message');
        });
    </script>

    <style>
        #reply-title {
            display: none;
        }

        .comments-title {
            display: none;
        }

        .comment-list {
            list-style-type: none;
            padding-left: 0px;
        }

        .fn {
            display: none;
            padding-left: 40px;
            color: #000;
            font-family: Poppins;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: 21.253px;
        }

        .comment-meta {
            box-shadow: none;
        }

        .says {
            display: none;
        }

        .comment-author img {
            width: 68px;
            height: 68px;
        }

        .comment-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            text-align: center;
        }

        .comment-meta .comment-author {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .comment-meta .comment-author-name {
            padding-left: 40px;
            color: #000;
            font-family: Poppins;
            font-size: 20px;
            font-style: normal;
            font-weight: 600;
            line-height: 21.253px;
        }

        .comment-content {
            padding-left: 109px;
            width: 70%;
        }

        .reply a {
            display: none;
        }

        .logged-in-as {
            display: none;
        }

        .comment-body {
            align-items: center;
            padding-bottom: 15px;
            border-bottom: 1px solid #DAEEEF;
            margin-bottom: 40px;
        }

        .comment-form-comment label {
            display: none;
        }

        .comment-form-comment #comment {
            width: 100%;
            border-radius: 7px;
            border: 1px solid rgba(0, 0, 0, 0.25);
            background: #FAFAFA;
            padding: 20px;
        }

        .comment-form-comment #comment:focus-visible {
            outline: none;
        }

        .form-submit {
            display: flex;
            justify-content: end;
            margin-right: 20px;
            position: relative;
            top: -75px;
        }

        .form-submit input {
            border-radius: 5px;
            background: #104627;
            color: #FFF;
            text-align: center;
            font-family: Poppins;
            font-size: 13.128px;
            font-style: normal;
            font-weight: 600;
            line-height: normal;
            border: none;
            padding: 8px 12px;
        }
    </style>

</main>
<?php
get_footer();
