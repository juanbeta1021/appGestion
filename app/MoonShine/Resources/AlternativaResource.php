<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Alternativa;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Layout\Box;

/**
 * @extends ModelResource<Alternativa>
 */
class AlternativaResource extends ModelResource
{
    protected string $model = Alternativa::class;

    protected string $title = 'Alternativas';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),          // ID visible y sortable
            Text::make('Nombre')->sortable(), // Campo Nombre visible en el índice
            Text::make('Descripción')->sortable(), // Campo Descripción visible en el índice
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                Text::make('Nombre')->required(),   // Campo Nombre, obligatorio
                Textarea::make('Descripción')->required(),  // Campo Descripción, obligatorio
            ]),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),                        // Mostrar el ID en detalle
            Text::make('Nombre'),               // Mostrar el Nombre en detalle
            Textarea::make('Descripción'),     // Mostrar la Descripción en detalle
        ];
    }

    /**
     * @param Alternativa $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'nombre' => 'required|string|max:255', // Validar el campo nombre
            'descripcion' => 'required|string',   // Validar el campo descripción
        ];
    }
}
