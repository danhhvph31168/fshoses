<?php

if (!function_exists('renderStars')) {
    function renderStars($rating)
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
                $stars .= '<i class="fa fa-star" style="color: gold;"></i>';
            } else {
                $stars .= '<i class="fa fa-star-o" style="color: gold;"></i>';
            }
        }
        return $stars;
    }
}
