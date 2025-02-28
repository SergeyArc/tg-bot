<?php

namespace App\DataTransferObjects\CastsAndTransformers;

use Carbon\Carbon;
use Spatie\LaravelData\Casts\Cast;
use Spatie\LaravelData\Transformers\Transformer;
use Spatie\LaravelData\Support\Creation\CreationContext;
use Spatie\LaravelData\Support\DataProperty;
use Spatie\LaravelData\Support\Transformation\TransformationContext;

class CarbonCastAndTransformer implements Cast, Transformer
{
    public function cast(DataProperty $property, mixed $value, array $properties, CreationContext $context): ?Carbon
    {
        return is_numeric($value) ? Carbon::createFromTimestamp($value) : null;
    }

    public function transform(DataProperty $property, mixed $value, TransformationContext $context): ?string
    {
        if ($value instanceof Carbon) {
            return $value->format('d.m.Y H:i');
        }

        return null;
    }
}
