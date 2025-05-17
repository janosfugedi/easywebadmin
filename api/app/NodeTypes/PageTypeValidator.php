<?php
namespace App\NodeTypes;

class PageTypeValidator extends AbstractNodeValidator
{
    public function extraRules(): array
    {
        return [
            'body' => ['nullable', 'string'],
        ];
    }
}
