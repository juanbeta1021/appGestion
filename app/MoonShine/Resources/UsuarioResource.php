<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use App\Models\Usuario;
use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Email;
use MoonShine\UI\Fields\Password;
use MoonShine\UI\Fields\Date;
use MoonShine\UI\Fields\Checkbox;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Layout\Box;

/**
 * @extends ModelResource<Usuario>
 */
class UsuarioResource extends ModelResource
{
    protected string $model = Usuario::class;

    protected string $title = 'Usuarios';

    /**
     * @return list<FieldContract>
     */
    protected function indexFields(): iterable
    {
        return [
            ID::make()->sortable(),
            Text::make('Name')->sortable(),
            Email::make('Email')->sortable(),
            Date::make('Email Verified At'),
            Checkbox::make('Verified')->default('email_verified_at')->sortable(),
        ];
    }

    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function formFields(): iterable
    {
        return [
            Box::make([
                Text::make('Name')->required(),
                Email::make('Email')->required(),  // No usamos "unique" aquí
                Password::make('Password')->required(),
                Date::make('Email Verified At')->nullable(),
                Checkbox::make('Verified')->default('email_verified_at'),
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
            Text::make('Name'),
            Email::make('Email'),
            Date::make('Email Verified At'),
            Checkbox::make('Verified')->default('email_verified_at'),
        ];
    }

    /**
     * @param Usuario $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    protected function rules(mixed $item): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:usuarios,email,' . ($item->id ?? 'NULL'),
            'password' => 'required|string|min:8|confirmed',
        ];
    }
}
