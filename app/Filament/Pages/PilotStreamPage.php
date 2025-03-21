<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Models\Pilot;

class PilotStreamPage extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-video-camera'; // Icono en el sidebar
    protected static ?string $navigationGroup = 'Streaming Drones'; // Agrupar en el sidebar
    protected static ?int $navigationSort = 2; // Orden en el menú
    protected static string $view = 'filament.pages.pilot-stream-page';

    public $pilots;

    public function mount()
    {
        // Obtener todos los pilotos de la base de datos
        $this->pilots = Pilot::all();
    }

    // ✅ Debe ser NO estático (instancia)
    public function getTitle(): string
    {
        return 'Transmisión de Pilotos';
    }

    // ✅ Debe ser estático
    public static function getNavigationLabel(): string
    {
        return 'Streaming Drones';
    }
}
