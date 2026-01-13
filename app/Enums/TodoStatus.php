<?php

namespace App\Enums;

enum TodoStatus: string
{
    case TODO = 'todo';
    case DONE = 'done';
    case IN_PROGRESS = 'in_progress';
    case ARCHIVED = 'archived';

    public function label(): string
    {
        return match ($this) {
            self::TODO => 'À faire',
            self::IN_PROGRESS => 'En cours',
            self::DONE => 'Terminé',
            self::ARCHIVED => 'Archivé',
        };
    }
}
