<?php

namespace App\Livewire;

use Livewire\Component;

class TestSimple extends Component
{
    public $count = 0;
    public $name = '';

    public function increment()
    {
        $this->count++;
    }

    public function render()
    {
        return <<<'HTML'
        <div>
            <div style="padding: 20px; background: #f0f0f0; border: 2px solid #333; margin: 20px;">
                <h2 style="font-size: 24px; font-weight: bold;">🔬 Test Livewire Simple</h2>

                <div style="margin-top: 20px;">
                    <p style="font-size: 18px;">Compteur: <strong style="color: red;">{{ $count }}</strong></p>
                    <button wire:click="increment" style="background: blue; color: white; padding: 10px 20px; border: none; cursor: pointer; font-size: 16px;">
                        Cliquer pour +1
                    </button>
                </div>

                <div style="margin-top: 30px; border-top: 2px solid #ccc; padding-top: 20px;">
                    <p style="font-size: 18px;">Nom: <strong style="color: green;">{{ $name ?: '(vide)' }}</strong></p>
                    <input type="text" wire:model.live="name" placeholder="Tapez votre nom..."
                           style="padding: 10px; font-size: 16px; border: 2px solid #333; width: 300px;">
                </div>

                <div style="margin-top: 20px; padding: 10px; background: yellow;">
                    <p><strong>✅ Si le compteur augmente = wire:click fonctionne</strong></p>
                    <p><strong>✅ Si le nom s'affiche en temps réel = wire:model.live fonctionne</strong></p>
                </div>
            </div>
        </div>
        HTML;
    }
}
