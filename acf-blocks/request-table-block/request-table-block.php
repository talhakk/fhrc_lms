<section class="requests-table">
    <div class="container">
        <div class="inner">
            <!-- Custom Search Box -->
            <div class="input-group">
                <div class="form-outline" data-mdb-input-init>
                    <input placeholder="Search" type="search" id="customSearchBox" class="form-control" />
                </div>
                <button type="button" class="btn btn-primary" id="customSearchButton" data-mdb-ripple-init>
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="requests-table-wrapper">
                <table id="requests-table" class="table table-striped" style="width:100%">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Subject</th>
                            <th>Created</th>
                            <th>Last Activity</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php

                        global $current_id;

                        $args = array(
                            'post_type'   => 'form-submission',
                            'post_status' => 'publish',
                        );

                        if (current_user_can('administrator')) {

                        } else {

                            $args['author'] = $current_id;

                        }

                        $result = new WP_Query($args);

                        if ($result->have_posts()) :
                            
                            while ($result->have_posts()) : $result->the_post();

                                request_data_table();

                        ?>

                        <?php

                            endwhile;
                        else :

                        endif;

                        ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<?php

function request_data_table()
{

    $post_id = get_the_ID();
    $post_title = get_the_title();
    $post_date = get_the_date();
    $last_activity_date = get_the_modified_date();
    $post_url = get_permalink($post_id);

    $status_radio_buttons = get_field('status_radio_buttons', $post_id);

    if ($status_radio_buttons) {
        $value = $status_radio_buttons['value'];
        $label = $status_radio_buttons['label'];
    } else {
        $label = 'Pending';
    }

    $label_class = ($label == 'Solved') ? 'solved' : 'pending'; ?>

    <tr data-url="<?php echo $post_url ?>">
        <td><?php echo $post_id; ?></td>
        <td><?php echo $post_title ?></td>
        <td><?php echo $post_date ?></td>
        <td><?php echo $last_activity_date ?></td>
        <td class="<?php echo $label_class ?>"><?php echo $label ?></td>
    </tr>

<?php

}

?>


<script>
    jQuery(document).ready(function($) {
        // Initialize the DataTable with custom DOM layout
        var table = $('#requests-table').DataTable({
            "dom": '<"top">rt<"bottom"><"clear">',
            "responsive": true
        });

        //Custom search box integration
        $('#customSearchBox').on('keyup', function() {
            table.search(this.value).draw();
        });

        $('#customSearchButton').on('click', function() {
            table.search($('#customSearchBox').val()).draw();
        });

        $('#requests-table').on('click', 'tbody tr', function() {
            window.location = $(this).data("url");
        });
    });
</script>