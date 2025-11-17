@php
    $title = 'Nouvelle demande de prêt';
@endphp

<x-layouts.dashboard :title="$title">
    @livewire('credit-request-form-simplified')
</x-layouts.dashboard>
