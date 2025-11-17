<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait HasEncryptedAttributes
{
    /**
     * Get the encrypted attributes
     *
     * @return array
     */
    abstract protected function encryptedAttributes(): array;

    /**
     * Boot the trait
     */
    public static function bootHasEncryptedAttributes()
    {
        // Encrypt attributes before saving
        static::saving(function ($model) {
            foreach ($model->encryptedAttributes() as $attribute) {
                if (!empty($model->getAttribute($attribute)) && !$model->isEncrypted($attribute)) {
                    $model->attributes[$attribute] = Crypt::encryptString($model->getAttribute($attribute));
                }
            }
        });
    }

    /**
     * Get an attribute from the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function getAttribute($key)
    {
        $value = parent::getAttribute($key);

        // Decrypt if it's an encrypted attribute
        if (in_array($key, $this->encryptedAttributes()) && !empty($value)) {
            try {
                return Crypt::decryptString($value);
            } catch (\Exception $e) {
                // If decryption fails, return the original value
                // This handles cases where the value might already be decrypted
                return $value;
            }
        }

        return $value;
    }

    /**
     * Set a given attribute on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function setAttribute($key, $value)
    {
        // For encrypted attributes, we'll encrypt them before saving
        // The actual encryption happens in the saving event
        if (in_array($key, $this->encryptedAttributes())) {
            $this->attributes[$key] = $value;
            return $this;
        }

        return parent::setAttribute($key, $value);
    }

    /**
     * Check if a value is already encrypted
     *
     * @param  string  $attribute
     * @return bool
     */
    protected function isEncrypted($attribute): bool
    {
        $value = $this->attributes[$attribute] ?? null;

        if (empty($value)) {
            return false;
        }

        try {
            Crypt::decryptString($value);
            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Get the raw (encrypted) value of an attribute
     *
     * @param  string  $key
     * @return mixed
     */
    public function getRawAttribute($key)
    {
        return $this->attributes[$key] ?? null;
    }
}
