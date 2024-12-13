<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Producto;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Number;
use MoonShine\UI\Fields\Textarea;

/**
 * @extends ModelResource<Producto>
 */
class ProductoResource extends ModelResource
{
    protected string $model = Producto::class;

    protected string $title = 'Productos';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('name', 'Nombre'),
            Text::make('code', 'Código'),
            Number::make('price', 'Precio'),
            Number::make('stock', 'Stock'),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                Text::make('name', 'Nombre')->required(),
                Text::make('code', 'Código')->required(),
                Number::make('price', 'Precio')->step(0.01)->required(),
                Textarea::make('description', 'Descripción')->required(),
                Number::make('stock', 'Stock')->required(),
            ]),
        ];
    }

    /**
     * @return list<FieldContract>
     */
    protected function detailFields(): iterable
    {
        return [
            ID::make(),
            Text::make('name', 'Nombre'),
            Text::make('code', 'Código'),
            Number::make('price', 'Precio'),
            Textarea::make('description', 'Descripción'),
            Number::make('stock', 'Stock'),
        ];
    }

    /**
     * @param Producto $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'name' => ['nullable', 'string', 'max:255'], // Opcional pero con un máximo de 255 caracteres
            'code' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:0'], // Opcional y positivo
            'description' => ['nullable', 'string'], // Puede estar vacío
            'stock' => ['nullable', 'integer', 'min:0'], // Opcional y mínimo 0
        ];
    }
}