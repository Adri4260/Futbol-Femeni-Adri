<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Partit;
use App\Mail\JornadaMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EnviarJornadaManagers extends Command
{
    protected $signature = 'jornada:enviar';
    protected $description = 'Envia un resum de la jornada als managers';

    public function handle()
    {
        // Busca partidos futuros
        $partits = Partit::with(['local', 'visitant']) // Asegúrate de usar los nombres de relación de tu modelo Partit (local/visitant)
            ->where('data', '>=', Carbon::now())
            ->orderBy('data', 'asc')
            ->take(5)
            ->get();

        if ($partits->isEmpty()) {
            $this->info('No hi ha partits programats.');
            return;
        }

        $managers = User::where('role', 'manager')->get();

        foreach ($managers as $manager) {
            Mail::to($manager->email)->send(new JornadaMail($partits));
        }

        $this->info('Correus enviats correctament.');
    }
}
