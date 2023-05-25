<?php declare(strict_types=1);

namespace PreventingSpam;

enum DetectionMethod: string
{
    case BlacklistedEmails = 'email_blacklist';
    case BlacklistedWords = 'word_blacklist';
    case KeyHeldDown = 'key_held_down';
    case Multi = 'multi';
}
