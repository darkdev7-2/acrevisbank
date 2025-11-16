<?php

namespace App\Filament\Resources\CardResource\Pages;

use App\Filament\Resources\CardResource;
use App\Services\CardService;
use Filament\Resources\Pages\CreateRecord;

class CreateCard extends CreateRecord
{
    protected static string $resource = CardResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Generate card details automatically
        $service = app(CardService::class);

        // The service will generate card_number, cvv, and expiry_date
        // We just need to pass the account_id and other data
        return $data;
    }

    protected function afterCreate(): void
    {
        // Auto-generate card number, CVV, and expiry date
        $service = app(CardService::class);
        $account = $this->record->account;

        // Generate card details
        $cardNumber = $this->invokeMethod($service, 'generateCardNumber');
        $cvv = $this->invokeMethod($service, 'generateCVV');
        $expiryDate = $this->invokeMethod($service, 'calculateExpiryDate');

        $this->record->update([
            'card_number' => $cardNumber,
            'cvv' => $cvv,
            'expiry_month' => $expiryDate['month'],
            'expiry_year' => $expiryDate['year'],
        ]);
    }

    protected function invokeMethod($object, $methodName)
    {
        $method = new \ReflectionMethod(get_class($object), $methodName);
        $method->setAccessible(true);
        return $method->invoke($object);
    }
}
