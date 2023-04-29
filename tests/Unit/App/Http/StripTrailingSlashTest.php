<?php declare(strict_types=1);

namespace Tests\Unit\App\Http;

use App\UI\Http\StripTrailingSlash;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Response;

final class StripTrailingSlashTest extends TestCase
{
    #[Test]
    public function it_redirects_if_the_request_uri_contains_a_trailing_forward_slash(): void
    {
        // Arrange
        $request = Request::create('/one/two/aloha/?dummy=true');

        // Act
        $result = (new StripTrailingSlash())->handle($request, fn () => 'fail');

        // Assert
        $this->assertInstanceOf(RedirectResponse::class, $result);
        $this->assertSame('/one/two/aloha?dummy=true', $result->getTargetUrl());
        $this->assertSame(Response::HTTP_MOVED_PERMANENTLY, $result->getStatusCode());
    }

    #[Test]
    public function it_does_not_redirect_if_root_path_is_being_served(): void
    {
        // Arrange
        $request = Request::create('/');

        // Act
        $result = (new StripTrailingSlash())->handle($request, fn () => new Response());

        // Assert
        $this->assertInstanceOf(Response::class, $result);
    }
}
