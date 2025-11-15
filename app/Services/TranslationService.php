<?php

namespace App\Services;

use Stichoza\GoogleTranslate\GoogleTranslate;
use Illuminate\Support\Facades\Cache;

class TranslationService
{
    protected array $supportedLanguages = ['fr', 'de', 'en', 'es'];
    protected string $fallbackLanguage = 'fr';

    /**
     * Translate text from source language to target language
     */
    public function translate(string $text, string $from, string $to): ?string
    {
        if ($from === $to || empty($text)) {
            return $text;
        }

        $cacheKey = "translation.{$from}.{$to}." . md5($text);

        return Cache::remember($cacheKey, now()->addDays(30), function () use ($text, $from, $to) {
            try {
                $translator = new GoogleTranslate($to);
                $translator->setSource($from);
                return $translator->translate($text);
            } catch (\Exception $e) {
                \Log::error('Translation error: ' . $e->getMessage());
                return null;
            }
        });
    }

    /**
     * Auto-translate content to all supported languages
     *
     * @param string|array $content Content to translate (can be string or array for nested translations)
     * @param string $sourceLanguage Source language code
     * @return array Translations in all supported languages
     */
    public function autoTranslate(string|array $content, string $sourceLanguage = 'fr'): array
    {
        if (is_array($content)) {
            // If content is already an array of translations, just fill missing languages
            $translations = $content;
        } else {
            // If content is a string, create initial translations array
            $translations = [
                $sourceLanguage => $content
            ];
        }

        // Translate to all other languages
        foreach ($this->supportedLanguages as $lang) {
            if ($lang === $sourceLanguage) {
                continue;
            }

            // Skip if translation already exists
            if (isset($translations[$lang]) && !empty($translations[$lang])) {
                continue;
            }

            $sourceText = $translations[$sourceLanguage] ?? '';

            if (!empty($sourceText)) {
                $translated = $this->translate($sourceText, $sourceLanguage, $lang);

                if ($translated) {
                    $translations[$lang] = $translated;
                }
            }
        }

        return $translations;
    }

    /**
     * Auto-translate multiple fields
     *
     * @param array $fields Fields to translate [field_name => content]
     * @param string $sourceLanguage Source language code
     * @return array Translated fields
     */
    public function autoTranslateFields(array $fields, string $sourceLanguage = 'fr'): array
    {
        $translatedFields = [];

        foreach ($fields as $fieldName => $content) {
            $translatedFields[$fieldName] = $this->autoTranslate($content, $sourceLanguage);
        }

        return $translatedFields;
    }

    /**
     * Get supported languages
     */
    public function getSupportedLanguages(): array
    {
        return $this->supportedLanguages;
    }

    /**
     * Get fallback language
     */
    public function getFallbackLanguage(): string
    {
        return $this->fallbackLanguage;
    }
}
