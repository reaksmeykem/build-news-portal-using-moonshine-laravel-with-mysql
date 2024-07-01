<?php

declare(strict_types=1);

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

use MoonShine\Resources\ModelResource;
use MoonShine\Decorations\Block;
use MoonShine\Fields\ID;
use MoonShine\Fields\Field;
use MoonShine\Components\MoonShineComponent;
use MoonShine\Fields\Relationships\BelongsTo;
use MoonShine\Fields\Text;
use MoonShine\Fields\Image;
use App\MoonShine\Resources\UserResource;
use MoonShine\Fields\TinyMce;
use MoonShine\Fields\Slug;
use Sweet1s\MoonshineRBAC\Traits\WithRolePermissions;
/**
 * @extends ModelResource<Post>
 */
class PostResource extends ModelResource
{
    protected string $model = Post::class;

    protected string $title = 'Articles';
    use WithRolePermissions;

    /**
     * @return list<MoonShineComponent|Field>
     */
    public function fields(): array
    {
        return [
            Block::make([
                ID::make()->sortable(),
                Text::make('Title','title')->reactive()->required(),
                Slug::make('Slug','slug')->from('title')->live()->unique()->required()->hideOnIndex(),
                BelongsTo::make('Categories', 'categories','name', resource: new CategoryResource()),
                BelongsTo::make('Users','users','name', resource: new UserResource()),
                Image::make('Thumbnail'),
                TinyMce::make('Body')->hideOnIndex(),
            ]),
        ];
    }

    /**
     * @param Post $item
     *
     * @return array<string, string[]|string>
     * @see https://laravel.com/docs/validation#available-validation-rules
     */
    public function rules(Model $item): array
    {
        return [];
    }
}
