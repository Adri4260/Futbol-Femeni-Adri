<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equip extends Model
{
    use HasFactory;

    protected $fillable = ['nom', 'ciutat', 'lliga', 'escut'];

    // --- RELACIONES QUE FALTABAN ---

    /**
     * Un equipo tiene muchas jugadoras.
     */
    public function jugadores(): HasMany
    {
        return $this->hasMany(Jugadora::class);
    }

    /**
     * Un equipo tiene un estadio principal.
     * (Asumiendo que la tabla 'estadis' tiene el campo 'equip_principal_id')
     */
    public function estadi(): HasOne
    {
        return $this->hasOne(Estadi::class, 'equip_principal_id');
    }

    // --- RELACIONES QUE YA TENÍAS ---

    public function partitsLocal(): HasMany
    {
        return $this->hasMany(Partit::class, 'local_id');
    }

    public function partitsVisitant(): HasMany
    {
        return $this->hasMany(Partit::class, 'visitant_id');
    }

    public function manager(): HasOne
    {
        return $this->hasOne(User::class, 'team_id');
    }
    // --- LÒGICA PER A LA CLASSIFICACIÓ ---

    /**
     * Calcula l'edat mitjana de la plantilla
     */
    public function getEdatMitjanaAttribute()
    {
        if ($this->jugadores->isEmpty()) {
            return '-'; // Si no hi ha jugadores
        }

        // Calculem la mitjana d'edat utilitzant Carbon
        $mitjana = $this->jugadores->map(function ($jugadora) {
            return \Carbon\Carbon::parse($jugadora->data_naixement)->age;
        })->avg();

        return number_format($mitjana, 1); // Retorna amb 1 decimal (ex: 24.5)
    }

    /**
     * Retorna un array amb els últims 5 resultats ('G', 'P', 'E')
     */
    public function getRachaAttribute()
    {
        $partits = $this->partitsLocal->whereNotNull('resultat')
            ->merge($this->partitsVisitant->whereNotNull('resultat'))
            ->sortByDesc('data')
            ->take(5);

        $resultats = [];

        foreach ($partits as $partit) {
            // Separem els gols
            $parts = explode('-', $partit->resultat);

            // Si el resultat no té el format "X-Y", l'ignorem per evitar errors
            if (count($parts) !== 2) continue;

            // IMPORTANT: Convertim a enter (int) per comparar números, no text
            $golsLocal = (int) $parts[0];
            $golsVisitant = (int) $parts[1];

            if ($partit->local_id === $this->id) {
                // Som locals
                if ($golsLocal > $golsVisitant) $resultats[] = 'G';
                elseif ($golsLocal < $golsVisitant) $resultats[] = 'P';
                else $resultats[] = 'E';
            } else {
                // Som visitants
                if ($golsVisitant > $golsLocal) $resultats[] = 'G';
                elseif ($golsVisitant < $golsLocal) $resultats[] = 'P';
                else $resultats[] = 'E';
            }
        }

        return $resultats;
    }
    /**
     * Calcula els punts totals de l'equip (3 per victòria, 1 per empat)
     */
    public function getPuntsAttribute()
    {
        $punts = 0;

        // Càlcul com a Local
        foreach ($this->partitsLocal as $partit) {
            if ($partit->resultat) {
                $parts = explode('-', $partit->resultat);
                if (count($parts) === 2) {
                    $golsLocal = (int)$parts[0];
                    $golsVisitant = (int)$parts[1];

                    if ($golsLocal > $golsVisitant) $punts += 3;      // Guanyat
                    elseif ($golsLocal == $golsVisitant) $punts += 1; // Empat
                }
            }
        }

        // Càlcul com a Visitant
        foreach ($this->partitsVisitant as $partit) {
            if ($partit->resultat) {
                $parts = explode('-', $partit->resultat);
                if (count($parts) === 2) {
                    $golsLocal = (int)$parts[0];
                    $golsVisitant = (int)$parts[1];

                    if ($golsVisitant > $golsLocal) $punts += 3;      // Guanyat
                    elseif ($golsVisitant == $golsLocal) $punts += 1; // Empat
                }
            }
        }

        return $punts;
    }
}
