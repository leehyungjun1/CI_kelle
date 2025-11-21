<?php
if (!function_exists('replyIndent')) {
    function replyIndent(int $depth)
    {
        if ($depth <= 0) {
            return '';
        }

        $margin = ($depth - 1) * 15;
        return "<span style='margin-left: {$margin}px'></span>"
            . "<img src='/img/ico_bd_reply.gif' alt='reply icon'>";
    }
}