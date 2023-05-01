<?php declare(strict_types=1);

namespace App\UserInterface\Http\Admin\Contact\ContactForm;

use Filament\Resources\Pages\ListRecords;

final class ListContactForms extends ListRecords
{
    protected static string $resource = ContactForm::class;

    protected function isTablePaginationEnabled(): bool
    {
        return false;
    }
}
