<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Test Livewire</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body style="font-family: Arial, sans-serif; padding: 40px; background: #e0e0e0;">
    <div style="max-width: 800px; margin: 0 auto; background: white; padding: 30px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.1);">
        <h1 style="font-size: 32px; margin-bottom: 20px; color: #333;">🧪 Page de Test Livewire</h1>

        <div style="background: #fff3cd; border: 2px solid #ffc107; padding: 15px; margin-bottom: 30px; border-radius: 5px;">
            <p style="margin: 0; font-size: 16px;"><strong>⚠️ Instructions:</strong></p>
            <ol style="margin: 10px 0 0 20px; padding: 0;">
                <li>Ouvrez la console JavaScript (F12)</li>
                <li>Testez le compteur et le champ nom</li>
                <li>Notez si ça fonctionne ou non</li>
            </ol>
        </div>

        @livewire('test-simple')

        <div style="margin-top: 30px; padding: 20px; background: #d1ecf1; border: 2px solid #0c5460; border-radius: 5px;">
            <h3 style="margin-top: 0;">📋 Checklist de Diagnostic</h3>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin: 10px 0;">✅ Si le compteur augmente = Livewire fonctionne</li>
                <li style="margin: 10px 0;">✅ Si le nom s'affiche = wire:model.live fonctionne</li>
                <li style="margin: 10px 0;">❌ Si rien ne se passe = Regarder la console (F12)</li>
            </ul>
        </div>

        <div style="margin-top: 20px; text-align: center;">
            <a href="/fr/credit-request" style="display: inline-block; padding: 15px 30px; background: #007bff; color: white; text-decoration: none; border-radius: 5px; font-size: 18px;">
                → Retour au formulaire de crédit
            </a>
        </div>
    </div>

    @livewireScripts
</body>
</html>
