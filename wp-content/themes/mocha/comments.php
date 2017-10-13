<!-- comments -->
<div id="comments" class="comments content-section">

    <?php if(post_password_required()) : ?>

    <h3><?php echo __('Post Protected' , 'dsf'); ?></h3>
    
    </div>
    <!-- end comments -->
    
    <?php elseif(!comments_open()) : ?>

    <h3><?php echo __('Comments Closed' , 'dsf'); ?></h3>

    <?php else : ?>
    
    <h3 id="comments"><?php 
              $comments_n = __('No Comments', 'dsf');
              $comments_o = __('1 Comment', 'dsf');
              $comments_r = __('% Comments', 'dsf');
              comments_number($comments_n, $comments_o, $comments_r ); ?></h3>

    <?php   
            // list the comments
            wp_list_comments(array('type' => 'comment' , 'style' => 'div' , 'callback' => 'ds_list_comments'));

            // get comments count and check if pagination required
            if(dsf_check_comments(get_the_ID()) === 'true' ) :
            ?>
              <div class="clearfix"></div>
              <span class="prev"> <?php previous_comments_link('Older Comments'); ?></span>
              <span style="float: right;" class="next"> <?php next_comments_link('Newer Comments'); ?></span>

            <?php endif; // end check comments pagination  ?>
    
        
        


</div>
<!-- end comments -->


<!-- comments form -->
<div class="content-section comments-wrapper"> 



                <?php if(get_option('comment_registration') == 1 && !is_user_logged_in()) : ?>
              
                <p><?php echo __('Only registerd members can post a comment , ' , 'dsf'); ?><a href="<?php echo wp_login_url(get_permalink());  ?>"><?php echo __('Login / Register' , 'dsf'); ?></a></p>

                <?php else : ?>
                
                <!-- comments form -->
                <div class="comments-form" id="respond">

                <?php  
                $reqs = '';
                if($req) $reqs = '('.__('required').')'; else $reqs = '';
                $commenter = wp_get_current_commenter(); 
                $comment_form_args = array(
                    'id_form' => 'respond',
                    'comment_notes_before' => '<p class="light-font">' . get_option('blogify_comment_form_text' , 'Please be polite. We appreciate that.<br /> Your email address will not be published and required fields are marked.')
                    . '</p>' ,
                    'comment_notes_after' => '',
                    'id_submit' => 'submit-comment',
                    'class_submit' => 'mocha-button',
                    'title_reply' => __('Leave a Comment' , 'dsf') ,
                      'title_reply_to' => __( 'Leave a Reply to %s' , 'dsf' ),
                      'cancel_reply_link' => __( ' or Cancel Reply' , 'dsf' ),
                      'label_submit' => __( 'Post Comment' , 'dsf' ),
                      'comment_field' => '<textarea name="comment" id="comment-text" placeholder="'.__('Write Message' , 'dsf').'" class="comment-text"></textarea>' ,
                      'fields' => apply_filters( 'comment_form_default_fields', array(
                                    
                                    'author' => '<br /><input type="text" value="'.esc_attr( $commenter['comment_author'] ).'" name="author" class="name textfield"  id="comment-name" placeholder="'.__('Your Name *' , 'dsf').'" />' ,


                                    'email' => '<input type="text" value="'. esc_attr(  $commenter['comment_author_email'] ).'" name="email" class="email textfield"  id="comment-email" placeholder="'.__('Your Email *' , 'dsf').'" />' ,

                                    'url' => '<input type="text" value="'. esc_attr(  $commenter['comment_author_url'] ).'" name="url" class="url textfield"  id="comment-url" placeholder="'.__('Your Website ' , 'dsf').'" />'

                                  ) )
                  );

                comment_form($comment_form_args);  ?>

                </div>
                <!-- end comments form -->
    

                <?php endif; // end if registreation require check  ?>

</div>
<!-- end comments form -->
<?php endif; // end if passworod protected post ?>