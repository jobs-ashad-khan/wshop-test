<?php

namespace App\Framework\Attribute;

#[\Attribute(\Attribute::TARGET_METHOD)]
class Route
{
    public function __construct(
        public string $path,
        public string $name = '',
        public array $methods = ['GET']
    ) {}
}