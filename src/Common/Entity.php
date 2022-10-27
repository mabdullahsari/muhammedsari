<?php declare(strict_types=1);

namespace Domain\Common;

abstract class Entity
{
    use HasEvents;
    use Persistable;
}
