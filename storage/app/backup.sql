PRAGMA foreign_keys=OFF;
BEGIN TRANSACTION;
CREATE TABLE IF NOT EXISTS "blogging_posts" ("id" integer primary key autoincrement not null, "author_id" integer not null, "slug" varchar not null, "title" varchar not null, "body" text not null default '', "summary" varchar not null default '', "state" varchar not null default 'draft', "published_at" datetime, "created_at" datetime, "updated_at" datetime);
INSERT INTO blogging_posts VALUES(1,1,'controllers-and-their-true-purpose','Controllers and their true purpose',replace('Last week, [I tweeted](https://twitter.com/mabdullahsari/status/1653718721293172738) about how my controllers look in my own applications and how I generally approach them. The tweet quickly went viral and gained a lot of attention, but unfortunately for all the wrong reasons. That''s why in this blog post, I''d like to shed some light on what I was actually aiming for and explain what a (UI) `Controller` is supposed to be in general.\n\n*The code examples are from the source code of [this blog](https://github.com/mabdullahsari/muhammedsari). Please head over to the repository to see how the different pieces click together.*\n\n## Refactoring the (UI) Controller\n\nThe discussions below the tweet were mainly about [**Dependency Injection (DI)**](https://martinfowler.com/articles/injection.html#FormsOfDependencyInjection) vs. [**Service Location (SL)**](https://martinfowler.com/articles/injection.html#UsingAServiceLocator). However, this was not the point of the tweet in any way, shape or form. So let''s take a minute to refactor the code to make use of SL:\n\n```php\nfinal readonly class SubmitContactFormController\n{\n    public function __invoke(SubmitRequest $request): RedirectResponse\n    {\n        $command = new ContactMuhammed(\n            $request->input(''email''),\n            $request->ip(),\n            $request->input(''message''),\n            $request->input(''name''),\n        );\n        \n        Bus::dispatch($command);\n\n        return Redirect::route(''contact'', [''success'' => true]);\n    }\n}\n```\n\nThe steps we took are:\n\n- The form validation rules have been moved to a `FormRequest` class\n- The `Bus` component is now used through a static container proxy\n- The `ResponseFactory` component is now used through a static container proxy\n\nNow that we have successfully refactored the (UI) `Controller` to make use of SL, we can start talking about its intended purpose.\n\n## The (UI) Controller as the Composition Root\n\nThe (UI) `Controller` actually has a distinguished role during our application''s lifecycle. The web server usually receives a request, forwards it to a PHP process which boots the framework and finally the framework forwards the request to us: the (UI) `Controller`. Based on this, we can establish the fact that a (UI) `Controller` is the [Composition Root](https://blog.ploeh.dk/2011/07/28/CompositionRoot/) of *our application*. It is the first piece of code that is called which we have full control over.\n\nThis is the reason why I don''t really mind whether you make use of DI or SL in your (UI) `Controller`. The object graph has to be composed somehow, so feel free to use either of them.\n\n## Why do you keep prefixing "UI" to Controller?\n\nI''m glad you asked. That''s because I''d like to put emphasis on this very fact: a UI `Controller`s task is to orchestrate the `Request`-`Response` lifecycle which is usually initiated by a user *through a user interface*. The keyword here is *orchestration*. Its primary goal should be to handle UI related concerns such as form validation, rendering a view, creating a redirect etc. If the `Controller` holds onto its true purpose, then it doesn''t really matter whether it''s 10 lines long, or 90 lines long. It should handle the UI concerns, and handle them well. Everything else does not belong inside a `Controller` and should be forwarded to the `Application`.\n\nThis might sound a bit counter-intuitive now, but a CLI `Command` is a `Controller` as well. It also takes user input and does something with it, albeit in a slightly different manner. Livewire components? Yep, they''re `Controller`s as well. Just dynamic ones leveraging XHR on the front-end.\n\n## Forwarding messages to the application\n\nWhen a request comes into our `Controller`, something must happen. Someone tried to invoke some particular behavior in our system. The intent of the user is represented by the command object, or in other words the application is represented by this one single command object:\n\n```php\n$command = new ContactMuhammed(\n    $request->input(''email''),\n    $request->ip(),\n    $request->input(''message''),\n    $request->input(''name''),\n);\n```\n\nThe `Controller`s relationship with the `Application` starts and ends here. It forwards the message, in this case the command, to the application and calls it a day. `ContactMuhammed` is the contract between the `Controller` and the `Application` handling this command. As long as the contract is respected and stays intact, everything will keep functioning without a hitch. This is what one calls "loose coupling" and it was *the entire point* of my original tweet.\n\nNow, I am deliberately keeping the `Application` as abstract as possible because the implementation details can vary from person to person and from codebase to codebase. Some people like implementing Clean Architecture (I call that the "Baklava" Architecture, mmm), some people like to vertically slice their applications and some people like to mix and match.\n\n## Isn''t that the "Action" pattern?\n\nNo, it is not. The `Action` pattern is a rechristened version of the [GoF Command pattern](https://refactoring.guru/design-patterns/command) which represents a self-handling command. \n\nIf we take a closer look at `ContactMuhammed`, we can see that there''s 0 business logic embedded inside of it:\n\n```php\nfinal readonly class ContactMuhammed implements ShouldQueue\n{\n    public function __construct(\n        public string $email,\n        public string $ipAddress,\n        public string $message,\n        public string $name,\n    ) {}\n}\n```\n\n`ContactMuhammed` is what we could call an [EIP Command](https://www.enterpriseintegrationpatterns.com/patterns/messaging/CommandMessage.html). It represents the intent of the user, and only that. Nothing more. Eagle-eyed readers may already have noticed that is also in fact a `Data Transfer Object`, albeit a more specific one.\n\n## What about the query side of things?\n\nIt''s true that we have only talked about commands thus far. However, querying some data and returning that to the user doesn''t change anything regarding the `Controller`s design. While commands *could* be handled asynchronously by the `Application`, queries are typically synchronous and thus we are *temporally coupled* to our `Application`.\n\nThis is the logic that is responsible for rendering this very blog post:\n\n```php\nfinal readonly class ReadBlogPostController\n{\n    public function __construct(\n        private GetSinglePost $posts, \n        private ResponseFactory $response,\n    ) {}\n\n    public function __invoke(string $slug): Response\n    {\n        $post = $this->posts->findBySlug($slug);\n\n        return $this->response->view(''read-blog-post'', $post->toArray());\n    }\n}\n```\n\n`GetSinglePost` is the contract between the `Controller` and our `Application`. As long as it keeps returning a `Post` view model, everything will stay functional and nothing will break.\n\n## Summary\n\n- The `Controller`s main task is to handle the User Interface\n- The `Controller` should delegate everything else to the application\n- The `Controller` should return user friendly error messages in case of failures\n\n[Join the discussion on Twitter!](https://twitter.com/mabdullahsari/status/1657413267772391424) I''d love to know what you thought about this blog post.\n\nThanks for reading!','\n',char(10)),'What are controllers? What''s their intended purpose? Can we put business logic in them? How many lines of code should they contain? Let''s find out.','published','2023-05-13 15:51:30','2023-05-11 19:09:18','2023-05-13 15:59:05');
INSERT INTO blogging_posts VALUES(2,1,'repositories-and-their-true-purpose','Repositories and their true purpose',replace('Lately, posts and tweets regarding the `Repository` pattern have made yet another resurgence. It''s seemingly impossible to predict when, where or why such "spicy topics" will rear their heads... However, the spark that causes the ignition of these "hot topics" is almost always the following question (or something similar):\n\n> How many times have you replaced the underlying database implementation because of your use of the Repository pattern?\n\n*— Random Techfluencer*\n\nThat''s why, in this blog post, I''d like to provide some further clarity regarding this totally misunderstood software design pattern and why the #1 argument (the question above) against its use is actually insignificant and *almost irrelevant*.\n\n## Defining a Repository\n\nFirst and foremost, let''s start off by defining what a `Repository` actually is. The `Repository` pattern is defined as follows in [PoEAA](https://martinfowler.com/eaaCatalog/repository.html):\n\n> Mediates between the domain and data mapping layers using a collection-like interface for accessing domain objects.\n\nIt is of paramount importance that we establish the facts below before moving on to the other sections.\n\n### (...) accessing domain objects\n\nDomain objects are actors in the domain layer that possess an authoritative set of business capabilities for carrying out certain tasks. These capabilities or behaviors are exposed as public methods on said actors in order to make consistent state changes. Domain objects are also known as write models, entities or as aggregates in [DDD](https://www.youtube.com/watch?v=8Z5IAkWcnIw) lingo.\n\n*Note: Aggregates and their exact purpose is out of scope for this blog post. However, I can recommend [this short, concise write-up by Shawn McCool](https://shawnmc.cool/2023-05-11_aggregates-for-those-familiar-with-activerecord) if you''d like to learn more about them.*\n\nYou''ve probably heard the notion "business logic" numerous times by now. Well, these models are the ones that actually determine what that "business logic" should entail.\n\n### (...) collection-like interface (...)\n\nIn an ideal world, a persistence layer for the entities would not be needed as everything can be added and removed from an in-memory collection. For example:\n\n```php\nfinal class Users\n{\n    private array $users;\n\n    private function __construct(User ...$users)\n    {\n        $this->users = $users;\n    }\n\n    public static function empty(): self\n    {\n        return new self();\n    }\n\n    public function add(User $user): void\n    {\n        $this->users[$user->id()->asString()] = $user;\n    }\n\n    public function find(UserId $id): User\n    {\n        return $this->users[$id->asString()] \n            ?? throw CouldNotFindUser::becauseItIsMissing();\n    }\n\n    public function remove(User $user): void\n    {\n        unset($this->users[$user->id()->asString()]);\n    }\n}\n```\n\nUnfortunately, the real world is often rather different from the ideal world. PHP has its (in)famous request-response lifecycle which results in the loss of every bit of relevant context once an incoming request has been handled and a response has been sent to the client. A `Repository` assists us in approximating this ideal world by giving the *illusion* that we can perform our operations on in-memory collections that seemingly live forever. An example `Repository` could be:\n\n```php\ninterface UserRepository\n{\n    public function find(UserId $id): User;\n    public function save(User $user): void;\n    public function remove(User $user): void;\n}\n```\n\nPlease take note of the minimal signature of this interface. \n\n## Collection-oriented vs. persistence-oriented\n\n[Vaughn Vernon](https://vaughnvernon.com/), the author of The Big Red Book ([iDDD](https://kalele.io/books/)), mentions collection-oriented and persistence-oriented `Repository` implementations in Chapter 12. I''d like to briefly mention this fact, because this is the reason why you might see different "flavors" of `Repository` implementations in the wild. The difference lies primarily in the semantics. \n\nA collection-oriented design can be considered a traditional design because of adherance to an in-memory collection''s standard interface.\n\n```php\n$users->add($user);\n```\n\n A persistence-oriented design is also known as a save-based `Repository`.\n\n```php\n$users->save($user);\n```\n\nPersonally, I prefer the persistence orientation due to PHP''s ephemeral nature.\n\n## Authoritative collection\n\nA `Repository` is the authoritative collection for interacting with a specific type of entity. It can be used to store, filter, retrieve and remove entities based on the application''s needs. In other words, we delegate the task for remembering the existence of a certain entity to the `Repository`. \n\n### Explained by example: publishing a post\n\nLet''s take a look at a use case to solidify our understanding. \n\n```php\nfinal readonly class PublishPostHandler\n{\n    public function __construct(\n        private PostRepository $posts,\n    ) {}\n\n    public function handle(PublishPost $command): void\n    {\n        $post = $this->posts->find($command->id);\n        \n        $post->publish();\n        \n        $this->posts->save($post);\n    }\n}\n```\n\nThis use case assumes that a `Post` entity must already exist in order to publish it. Since the `PostRepository` is the authoritative collection for dealing with these `Post` entities, we can ask it to provide us with a `Post` entity for the given `PostId`:\n\n```php\n$post = $this->posts->find($command->id);\n```\n\nOnce we''ve received a `Post` instance, we carry on with the task we were supposed to carry out in the first place: \n\n```php\n$post->publish();\n```\n\nThe `publish` method exposes the behavior that is responsible for actually "publishing a blog post". If we dig a little deeper, we can see that it is also enforcing crucial [invariants](https://codeopinion.com/aggregate-design-using-invariants-as-a-guide):\n\n```php\npublic function publish(): void\n{\n    if ($this->isPublished()) {\n        throw CouldNotPublish::becauseAlreadyPublished();\n    } elseif ($this->summary->isEmpty()) {\n        throw CouldNotPublish::becauseSummaryIsMissing();\n    } elseif ($this->body->isEmpty()) {\n        throw CouldNotPublish::becauseBodyIsMissing();\n    } elseif ($this->tags->isEmpty()) {\n        throw CouldNotPublish::becauseTagsAreMissing();\n    }\n\n    // omitted for brevity\n}\n```\n\nIf everything goes well, we move on and tell the `PostRepository` to remember the `Post` in its *current state*:\n\n```php\n$this->posts->save($post);\n```\n\nNext time we interact with the `PostRepository` and ask for the exact same entity, we can expect to receive the `Post` in this state. The `PostRepository` will ensure that this condition is met at *all times*. This is a `Repository`''s single most important *responsibility*, after all.\nThe `PostRepository` clearly defines the boundaries around the application service which also yields a lot of benefits such as isolated testability and purposefully keeping the (core) domain oblivious to its surroundings.\n\n## Persistence agnosticity\n\nLet''s quickly recall *Random Techfluencer*''s original statement:\n\n> How many times have you replaced the underlying database implementation because of your use of the Repository pattern?\n\n*Random Techfluencer* is actually discouraging the use of the `Repository` because "how many times are you going to swap out data sources?".\n\nNow, please let me make something absolutely clear. The swapping of the data source is a puny argument whether you use it to *promote* **or** *obstruct* the use of the `Repository`. It does *not* matter which camp (pro / contra) you belong to. Do you really want to think about swapping out data sources as you are designing the domain? This kind of thinking is - in my humble opinion - flawed.\n\n### Ad hoc persistence swapping\n\nThe fact that you can easily swap out data sources later on is nothing but a *bonus* that you are awarded by carefully placing boundaries around your application. This is "boundaries in software design 101" and trying to use this as the main selling point every single time does noone any good.\n\nYou can start out your application by using simple JSON files on disk and gradually evolve towards "beefier" solutions as different needs emerge. \n\n```php\nfinal class UserRepositoryUsingJsonFilesOnDisk implements UserRepository\n{\n    public function add(User $user): void\n    {\n        // add a user\n    }\n\n    public function find(UserId $id): User\n    {\n        // find a user\n    }\n\n    public function remove(User $user): void\n    {\n        // remove a user... you get the point\n    }\n}\n```\n\nDifferent features can evolve independent of each other and infrastructural costs can be kept to a minimum. Why use an expensive cloud-hosted solution *for everything* if 90% of the other features are well-suited for a storage mechnism like SQLite? Why keep using MySQL *for every single feature* if 10% of the features are well-suited for Elastic and Riak?\n\n## Testability\n\nIn a similar vein to persistence agnosticity, testability is another *bonus* we are awarded by carefully placing boundaries around our application.\nThe real thing can keep using a `DoctrinePostRepository` while the tests can use an `InMemoryPostRepository` allowing us to have lightning fast tests.\n\nThe test for the "publishing a blog post" use case, that was mentioned previously, might look as follows:\n\n```php\n// Arrange\n$post = $this->aPost([''id'' => PostId::fromInt($id = 123)]); // draft\n$repository = $this->aPostRepository([$post]); // in-memory repository\n$handler = new PublishPostHandler($repository);\n\n// Act\n$handler->handle(new PublishPost($id));\n\n// Assert\n$this->assertTrue($repository->wasSaved($post));\n$this->assertTrue($post->isPublished());\n```\n\nIn this example, we''re testing the application service represented by the command handler. We don''t need to test that the repository stored the data in the database or wherever else. We need to test the specific behavior of the handler, which is to publish the `Post` object and pass it into the repository to preserve its state.\n\n"This is not a big deal", you might rightfully say, "I can just hit persistence during my tests every single time".\nI''m not sure if you know someone who''s worked on a project whose test suite was completely shut down because it just took way too long to go through the entire thing? I do know someone and that person is unfortunately me. Integration and System / E2E tests definitely have their place, but the sheer velocity and the fast feedback loop of unit tests is still highly desirable.\n\n## Alleviating performance issues\n\nPerformance is another reason as to why a `Repository` is often employed. It''s not an uncommon scenario to have millions of instances of a certain entity type so we are kind of forced to offload this to an external data store. \n\nAssume the following excerpt from an imaginary `User` entity:\n\n```php\npublic function changeEmail(Email $newEmail, Users $allUsers)\n{\n    if ($allUsers->findByEmail($newEmail)) {\n        throw new CannotChangeEmail::becauseEmailIsAlreadyTaken();\n    }\n    \n    $this->email = $newEmail;\n}\n```\n\nThe `changeEmail` behavior depends on a `Users` collection to determine whether the new email address can be used. The (imaginary) domain experts told us that an email change may not happen as long as there is another user in possession of that new email address. \n\nThis code will work just fine until we hit a certain amount of users. The collection''s sheer size will become a bottleneck for the lookups that must be performed in order to enforce invariants. We could fix this problem by injecting a `UserRepository` instead of passing every single `User` in existence via an in-memory `Users` collections. \n\n```php\npublic function changeEmail(Email $newEmail, UserRepository $users)\n{\n    if ($users->findByEmail($newEmail)) {\n        throw new CannotChangeEmail::becauseEmailIsAlreadyTaken();\n    }\n    \n    $this->email = $newEmail;\n}\n```\n\nThis way, the domain model will still be responsible for enforcing the invariants; but we had to trade the [domain model''s purity](https://enterprisecraftsmanship.com/posts/domain-model-purity-completeness/) off against performance. Nonetheless, this is most definitely an acceptable trade-off.\n\n## Command Query Responsibility Segregation\n\n"I thought this blog post was about the `Repository` pattern? What''s the deal with [CQRS](https://web.archive.org/web/20120419072250/https://goodenoughsoftware.net/2012/03/02/cqrs) all of a sudden..?" Please let me explain.\n\n### Write models (commands)\n\nUntil now, we''ve seen how the `Repository` helps us with dealing with the lifecycle of *domain objects*. We established the fact that these domain objects are also known as write models / entities / aggregates that are responsible for performing state changes in a consistent manner. In other words, the aggregates represent a consistency boundary that must follow the business rules and apply them at all times in order to stay consistent.\nNaturally, these state changes always occur as a result of a command entering an application. \n\n### Read models (queries)\n\nWe need to ask ourselves whether we actually need to perform state changes or just need some data. Why would we "just need some data"? Well... you guessed it right: for **queries**. [CQRS](https://web.archive.org/web/20120419072250/https://goodenoughsoftware.net/2012/03/02/cqrs) is a dead simple pattern for separating the logical models for read and write concerns—that''s it. It has nothing to do with event sourcing / eventual consistency / separated data stores etc. These buzzwords are often thrown into the mix by people who don''t really know what they''re talking about. Use cases that involve queries will benefit from better optimized, dedicated *read models*.\n\n### Explained by example: displaying a table of invoices\n\nLet''s take a look at a use case to solidify our understanding. \n\n```php\nfinal readonly class ViewInvoicesController\n{\n    public function __construct(\n        private GetMyInvoices $query,\n        private Factory $view,\n    ) {}\n\n    public function __invoke(Request $request): View\n    {\n        $invoices = $this->query->get();\n\n        return $this->view->make(''view-invoices'', [\n            ''invoices'' => $invoices,\n        ]);\n    }\n}\n```\n\nThis use case is responsible for *displaying* a table of invoices to the user. All of the magic happens during this line:\n\n```php\n$invoices = $this->query->get();\n```\n\nThe query handler `GetMyInvoices` provides us with a collection of `InvoiceSummary` **read models** dedicated for this purpose. A single `InvoiceSummary` instance might look as follows:\n\n```php\nfinal readonly class InvoiceSummary\n{\n    public function __construct(\n        public int $amountOfDiscountsApplied,\n        public string $paymentTerms,\n        public string $recipient,\n        public int $totalAmountInCents,\n    ) {}\n}\n```\n\nEagle-eyed readers may already have noticed that this is in fact a `Data Transfer Object`. `DTO`s typically contain only data and no behavior. However, this is exactly what we want: a *read model* dedicated to the purpose of displaying some relevant data to the user. You may already have noticed that this model doesn''t contain any information regarding the individual invoice line items; and this is totally on purpose! A table view cannot display individual invoice line items. Thus, our *read model* is optimized and carefully crafted for this exact use case.\n\nThe write model might look like this (courtesy of [Shawn McCool](https://shawnmc.cool/2023-05-11_aggregates-for-those-familiar-with-activerecord)):\n\n```php\nfinal readonly class LineItem\n{\n    public __construct(private bool $isDiscount) {}\n\n    public function isDiscount(): bool\n    {\n        return $this->isDiscount;\n    }\n}\n\nfinal class Invoice\n{\n    private RecipientName $recipientName;\n	\n    private LineItems $lineItems;\n\n    public function __construct(\n        RecipientName $recipientName\n    ) {\n        $this->recipientName = $recipientName;\n        $this->lineItems = LineItems::empty();\n    }\n\n    public function addLineItem($item): void\n    {\n        if (\n            $item->isDiscount()\n            && $this->lineItems->hasDiscountedItem()\n        ) {\n            throw CannotAddLineItem::multipleDiscountsForbidden($item);\n        }\n\n        $this->lineItems->add($item);\n    }\n}\n```\n\nSo to be more precise, *we went directly to the data source itself instead of trying to shoe-horn a use case into an Invoice write model that is totally not designed to fulfill a specialized query-based, read use case*. Why carry the burden of instantiating this complex write model in order to fulfill a use case that won''t even need any of the line items that are defined within this write model? The write model *requires* all of the line items in order to keep its state consistent, but the read model does not.\n\n## Where does a Repository belong to: application or domain layer?\n\nWe can consider the application layer as the specific layer within a multi-layered architecture that handles the implementation details unique to the application, such as database persistence, internet protocol knowledge (sending emails, API interactions), and more. Now, let''s establish the domain layer as the layer in a multi-layered architecture that primarily deals with business rules and business logic.\n\nGiven these definitions, where exactly do our repositories fit into the picture? Let''s revisit a variation of a source code example we discussed earlier:\n\n```php\nfinal class InMemoryUserRepository implements UserRepository\n{\n    private array $users = [];\n\n    public function find(UserId $id): User\n    {\n        return $this->users[$id->asString()]\n            ?? throw CouldNotFindUser::becauseItIsMissing();\n    }\n\n    public function remove(User $user): void\n    {\n        unset($this->users[$user->id()->asString()]);\n    }\n\n    public function save(User $user): void\n    {\n        $this->users[$user->id()->asString()] = $user;\n    }\n}\n```\n\nI''m observing numerous implementation details that can be regarded as "noise". Therefore, this implementation detail belongs in the application layer. Let''s remove this noise and see what we are left with:\n\n```php\nfinal class InMemoryUserRepository implements UserRepository\n{\n    private array $users = [];\n\n    public function find(UserId $id): User\n    {\n    }\n\n    public function remove(User $user): void\n    {\n    }\n\n    public function save(User $user): void\n    {\n    }\n}\n```\n\nDoes this actually remind you of something? Perhaps this?\n\n```php\ninterface UserRepository\n{\n    public function find(UserId $id): User;\n    public function save(User $user): void;\n    public function remove(User $user): void;\n}\n```\n\nPlacing an interface at layer boundaries entails the following implication: While the interface itself can encompass domain-specific concepts, its implementation should not. In the context of repository interfaces, **they belong to the domain layer**. The *implementation* of repositories belongs to the application layer. Consequently, we can freely utilize type-hinting for repositories within the domain layer, without any need for dependencies on the application layer.\n\n## Various other benefits\n\nBelow is a non-exhaustive list of various other benefits a `Repository` can bring along with it:\n\n- Access to the decorator pattern to add additional concerns without having to modify the domain e.g. to employ something like [hashids](https://hashids.org/) for YouTube-like identifiers.\n- The ability to implement the [transactional outbox pattern](https://microservices.io/patterns/data/transactional-outbox.html) for mission-critical, event-driven systems.\n- Centralizing access / persistence logic if the application relies on data models primarily and you''d like to migrate away.\n- Automatically adding audit information alongside the persisted entity.\n\n...\n\n## Wrap-up\n\nThat was a lot to go through! Thanks for sticking around until the end. \n\nBasically, if we were to enumerate all of the benefits for using a `Repository`, persistence agnosticity would definitely come last or at the very least be close to being last. Therefore, I hope that we can stop taking concepts at face value and actually examine them a little deeper to unearth the actual use cases and the contexts in which they''re supposed to be used. \n\n- `Repository` is the authoritative actor for safely collecting and preserving entities and managing their lifecycle\n- The ability to swap underlying the persistence driver is a mere *bonus*\n- The ability to easily test without an actual persistence driver is a mere *bonus*\n- Do use a `Repository` for your write models\n- Don''t use a `Repository` for your read models: go to the data source instead\n\n[Join the discussion on Twitter!](https://twitter.com/mabdullahsari/status/1661288614263750656) I''d love to know what you thought about this blog post.\n\nThanks for reading!','\n',char(10)),'What is the repository pattern? What is it good for? Why''d we use it if we''re never going to change the RDBMS? Would it be considered over-engineering if we did use one? Let''s find out.','published','2023-05-24 08:29:40','2023-05-20 13:52:01','2023-05-24 12:51:48');
CREATE TABLE IF NOT EXISTS "blogging_tags" ("id" integer primary key autoincrement not null, "slug" varchar not null, "name" varchar not null);
INSERT INTO blogging_tags VALUES(1,'css','CSS');
INSERT INTO blogging_tags VALUES(2,'javascript','JavaScript');
INSERT INTO blogging_tags VALUES(3,'laravel','Laravel');
INSERT INTO blogging_tags VALUES(4,'php','PHP');
INSERT INTO blogging_tags VALUES(5,'react','React');
INSERT INTO blogging_tags VALUES(6,'tailwind','Tailwind');
INSERT INTO blogging_tags VALUES(7,'patterns','Patterns');
CREATE TABLE IF NOT EXISTS "blogging_post_tag" ("post_id" integer not null, "tag_id" integer not null, foreign key("post_id") references "blogging_posts"("id") on delete cascade on update cascade, foreign key("tag_id") references "blogging_tags"("id") on delete cascade on update cascade, primary key ("post_id", "tag_id"));
INSERT INTO blogging_post_tag VALUES(1,4);
INSERT INTO blogging_post_tag VALUES(1,3);
INSERT INTO blogging_post_tag VALUES(2,3);
INSERT INTO blogging_post_tag VALUES(2,4);
INSERT INTO blogging_post_tag VALUES(2,7);
COMMIT;
