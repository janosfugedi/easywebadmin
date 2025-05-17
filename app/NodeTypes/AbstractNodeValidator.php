<?php
namespace App\NodeTypes;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

abstract class AbstractNodeValidator
{
    public function baseRules(bool $isUpdate = false): array
    {
        return $isUpdate
            ? [
                'title' => ['sometimes', 'required', 'string', 'max:255'],
            ]
            : [
                'type' => ['required', 'string'],
                'site_id' => ['required', 'integer'],
                'title' => ['required', 'string', 'max:255'],
            ];
    }

    abstract public function extraRules(): array;

    public function rules(bool $isUpdate = false): array
    {
        return array_merge($this->baseRules($isUpdate), $this->extraRules());
    }

    public function validate(Request $request, bool $isUpdate = false): array
    {
        return Validator::make($request->all(), $this->rules($isUpdate))->validate();
    }
}
