<?php

namespace App\Services;

use App\Models\Language;

class LanguageService
{
    public function getAll()
    {
        return Language::all();
    }

    public function getByCode(string $code)
    {
        return Language::where('code', $code)->first();
    }

    public function create(array $data)
    {
        return Language::create($data);
    }

    public function update(int $id, array $data)
    {
        $lang = Language::find($id);
        if (!$lang) return null;
        $lang->update($data);
        return $lang;
    }

    public function delete(int $id)
    {
        $lang = Language::find($id);
        if (!$lang) return false;
        return $lang->delete();
    }
}
