<?php

/**
 * View: Month View Nav Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe/events/v2/month/mobile-events/nav.php
 *
 * See more documentation about our views templating system.
 *
 * @link http://evnt.is/1aiy
 *
 * @var string $prev_url The URL to the previous page, if any, or an empty string.
 * @var string $prev_label The label for the previous link.
 * @var string $next_url The URL to the next page, if any, or an empty string.
 * @var string $next_label The label for the next link.
 * @var string $today_url The URL to the today page, if any, or an empty string.
 *
 * @version 4.9.10
 *
 */


global $wp_locale;
$current_month_name = date_i18n('F Y');

?>

<!-- <style>
    .tribe-events-calendar-month__header .current-month-name {
        text-align: center;
        padding-bottom: 20px;
    }

    .current-month-name {
        text-align: center;
    }
</style> -->

<h2 class="tribe-common-a11y-visual-hide" id="tribe-events-calendar-header">
    <?php printf(esc_html__('Calendar of %s', 'the-events-calendar'), tribe_get_event_label_plural()); ?>
</h2>

<!-- Output current month name -->
<h3 class="current-month-name"><?php //echo esc_html($current_month_name); ?></h3>

<nav class="tribe-events-calendar-month-nav tribe-events-c-nav">
    <ul class="tribe-events-c-nav__list">
        <?php
        if (!empty($prev_url)) {
            $this->template('month/mobile-events/nav/prev', ['label' => $prev_label, 'link' => $prev_url]);
        } else {
            $this->template('month/mobile-events/nav/prev-disabled', ['label' => $prev_label]);
        }
        ?>

        <?php $this->template('month/mobile-events/nav/today') ?>

        <?php
        if (!empty($next_url)) {
            $this->template('month/mobile-events/nav/next', ['label' => $next_label, 'link' => $next_url]);
        } else {
            $this->template('month/mobile-events/nav/next-disabled', ['label' => $next_label]);
        }
        ?>
    </ul>
</nav>