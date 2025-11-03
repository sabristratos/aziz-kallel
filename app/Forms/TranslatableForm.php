<?php

namespace App\Forms;

use Livewire\Form;

abstract class TranslatableForm extends Form
{
    protected array $supportedLocales = ['de', 'ar'];

    protected string $primaryLocale = 'de';

    /**
     * Get translations for a specific field
     */
    public function getTranslatable(string $field): array
    {
        $translations = [];
        foreach ($this->supportedLocales as $locale) {
            $propertyName = "{$field}_{$locale}";
            $translations[$locale] = $this->$propertyName ?? '';
        }

        return array_filter($translations, fn ($value) => ! is_null($value) && $value !== '');
    }

    /**
     * Set translations for a specific field
     */
    public function setTranslatable(string $field, array $translations): void
    {
        foreach ($this->supportedLocales as $locale) {
            $propertyName = "{$field}_{$locale}";
            $this->$propertyName = $translations[$locale] ?? '';
        }
    }

    /**
     * Fill form from a model's translatable fields
     */
    public function fillFromTranslations(array $fields, array $translations): void
    {
        foreach ($fields as $field) {
            $this->setTranslatable($field, $translations[$field] ?? []);
        }
    }

    /**
     * Abstract method that child forms must implement
     */
    abstract public function save(): void;
}
