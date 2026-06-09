<?php

namespace App\Http\Controllers;

use App\Models\Personaje;
use Illuminate\Http\Request;

class PersonajeController extends Controller
{
    public function index()
    {
        return response()->json(
            Personaje::latest()->get()->map(fn (Personaje $personaje) => $this->toAngularCharacter($personaje))
        );
    }

    public function create()
    {
        return view('personajes.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => ['required', 'string', 'min:3'],
            'tipo' => ['required', 'string'],
            'color_pelo' => ['required', 'string'],
            'trabajo' => ['required', 'string'],
        ], [
            'nombre.required' => 'El nombre es obligatorio.',
            'nombre.min' => 'El nombre debe tener al menos 3 caracteres.',
            'tipo.required' => 'El tipo es obligatorio.',
            'color_pelo.required' => 'El color de pelo es obligatorio.',
            'trabajo.required' => 'El trabajo es obligatorio.',
        ]);

        Personaje::create($validated);

        return redirect()
            ->route('personajes.create')
            ->with('success', 'Personaje registrado correctamente en SimpsonsDex.');
    }

    public function apiStore(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'category' => ['required', 'string'],
            'hairColor' => ['required', 'string'],
        ]);

        $personaje = Personaje::create([
            'nombre' => $validated['name'],
            'tipo' => $validated['category'],
            'color_pelo' => $validated['hairColor'],
            'trabajo' => 'Sin especificar',
        ]);

        return response()->json($this->toAngularCharacter($personaje), 201);
    }

    public function apiDestroy(Personaje $personaje)
    {
        $personaje->delete();

        return response()->json(null, 204);
    }

    private function toAngularCharacter(Personaje $personaje): array
    {
        return [
            'id' => $personaje->id,
            'name' => $personaje->nombre,
            'category' => $personaje->tipo,
            'hairColor' => $personaje->color_pelo,
            'status' => 'Registrado',
            'image' => 'img/optimized/casa.png',
            'alt' => $personaje->nombre,
            'cardClass' => $this->getCardClass($personaje->color_pelo),
        ];
    }

    private function getCardClass(string $hairColor): string
    {
        $normalizedColor = mb_strtolower(trim($hairColor));

        if (str_contains($normalizedColor, 'azul')) {
            return 'bg-primary text-white';
        }

        if (str_contains($normalizedColor, 'gris') || str_contains($normalizedColor, 'negro')) {
            return 'bg-dark text-white';
        }

        if (str_contains($normalizedColor, 'rojo')) {
            return 'bg-danger text-white';
        }

        if (str_contains($normalizedColor, 'calvo')) {
            return 'bg-warning';
        }

        return 'bg-info';
    }
}
