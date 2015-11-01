<!--RWP Review-->
<div 
	class="rwp-review-wrap <?php $this->template_field('template_theme'); ?>" 
	id="rwp-review-<?php echo $this->post_id; ?>-<?php $this->review_field('review_id'); ?>" 
	style="color: <?php $this->template_field('template_text_color'); ?>; font-size: <?php $this->template_field('template_box_font_size') ?>px"
    <?php RWP_Snippets::schema( $this->branch, $this->is_UR ); ?>
>
    <div class="rwp-review">
        <?php 

            if( empty( $this->branch ) || $this->branch == 'recap' ) {

                $title_option = $this->review_field('review_title_options', true);

                switch ( $title_option ) {
                    case 'hidden':
                        $title = get_the_title( $this->post_id );
                        $this->snippets->add('name', $title);
                        echo '<div'; 
                        RWP_Snippets::itemReviewed( $this->branch, $this->schema_type );
                        echo '>';
                            echo '<meta'; 
                            RWP_Snippets::name( $this->branch );
                            echo 'content="'. $title .'">';
                        echo '</div>';
                        break;

                    case 'post_title':
                        $title = get_the_title( $this->post_id );
                        $this->snippets->add('name', $title);
                        echo '<span class="rwp-title"'; 
                        RWP_Snippets::itemReviewed( $this->branch, $this->schema_type );
                        echo '><em'; 
                        RWP_Snippets::name( $this->branch );
                        echo '>'. $title .'</em></span>';
                        break;
                    
                    default:
                        $title = $this->review_field('review_title', true );
                        if( empty( $title ) ) {
                            $title = get_the_title( $this->post_id );
                            $this->snippets->add('name', $title);
                            echo '<div'; 
                            RWP_Snippets::itemReviewed( $this->branch, $this->schema_type );
                            echo '>';
                                echo '<meta'; 
                                RWP_Snippets::name( $this->branch );
                                echo 'content="'. $title .'">';
                            echo '</div>';
                        } else {
                            $this->snippets->add('name', $title);
                            echo '<span class="rwp-title"'; 
                            RWP_Snippets::itemReviewed( $this->branch, $this->schema_type );
                            echo '><em'; 
                            RWP_Snippets::name( $this->branch );
                            echo '>'. $title .'</em></span>';
                        }
                        break;
                } 
            }

            if( !$this->is_UR ) {
                $this->snippets->add('review', array());
                $this->snippets->add('review.@type', 'Review');
                $this->snippets->add('review.datePublished', get_the_date( 'Y-m-d', $this->post_id ));
                $this->snippets->add('review.author', array());
                $this->snippets->add('review.author.@type', 'Person');
                $this->snippets->add('review.author.name', get_the_author_meta( 'display_name', get_post_field( 'post_author', $this->post_id ) ));

                echo '<div property="author" typeof="Person">';
                    echo '<meta property="name" content="'. get_the_author_meta( 'display_name', get_post_field( 'post_author', $this->post_id ) ) .'" />';
                echo '</div>';
                echo '<meta property="datePublished" content="'. get_the_date( 'Y-m-d', $this->post_id ) .'" />';
            }
        ?>

        <?php $this->include_sections( $this->themes[ $this->template_field('template_theme', true) ] ); ?>

    </div><!-- /review -->

    <?php //if( empty( $this->branch ) || $this->branch == 'recap' ) $this->snippets->insert(); ?>

</div><!--/review-wrap-->


