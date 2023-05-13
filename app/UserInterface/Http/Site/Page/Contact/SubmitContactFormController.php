<?php declare(strict_types=1);

namespace App\UserInterface\Http\Site\Page\Contact;

use Contacting\Contract\ContactMuhammed;
use Illuminate\Contracts\Bus\Dispatcher;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Contracts\Validation\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final readonly class SubmitContactFormController
{
    public function __construct(
        private Dispatcher $commands,
        private ResponseFactory $response,
        private Factory $validator,
    ) {}

    public function __invoke(Request $request): RedirectResponse
    {
        $input = $this->validator->make($request->all(), [
            'email' => ['required', 'email:rfc,dns', 'min:2', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:1000'],
            'name' => ['required', 'string', 'min:2', 'max:255'],
        ])->validate();

        $this->commands->dispatch(
            new ContactMuhammed(
                $input['email'],
                $request->ip(),
                $input['message'],
                $input['name'],
            )
        );

        return $this->response->redirectToRoute(ViewContactFormController::ROUTE, [
            ViewContactFormController::SUCCESS => true,
        ]);
    }
}
