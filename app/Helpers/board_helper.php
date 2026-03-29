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

/**
 * 게시판 extra_fields 파싱
 * @param string|null $json
 * @return array
 */
if (!function_exists('parseExtraFields')) {
    function parseExtraFields(?string $json): array
    {
        if (empty($json)) return [];
        return json_decode($json, true) ?? [];
    }
}

/**
 * extra_fields에서 특정 필드 활성화 여부 확인
 * @param array  $extraFields
 * @param string $key
 * @return bool
 */
if (!function_exists('hasExtraField')) {
    function hasExtraField(array $extraFields, string $key): bool
    {
        return !empty($extraFields[$key]);
    }
}