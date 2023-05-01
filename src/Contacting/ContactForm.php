<?php declare(strict_types=1);

namespace Contacting;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $email
 * @property string $ip_address
 * @property string $message
 * @property string $name
 */
final class ContactForm extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'contacting_contact_forms';

    public static function submit(string $email, string $ipAddress, string $message, string $name): self
    {
        return new self(['email' => $email, 'ip_address' => $ipAddress, 'message' => $message, 'name' => $name]);
    }

    public function getUpdatedAtColumn(): null
    {
        return null;
    }

    protected static function newFactory(): ContactFormFactory
    {
        return ContactFormFactory::new();
    }
}
