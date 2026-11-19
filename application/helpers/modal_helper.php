<?php

function modal_fields(array $fields): string
{
    return htmlspecialchars(
        json_encode($fields, JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_TAG),
        ENT_QUOTES,
        'UTF-8'
    );
}
