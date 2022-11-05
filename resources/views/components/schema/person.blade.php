@props(['model' => null])

<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Person",
        "name": "{{ $model->name }}",
        "givenName": "{{ $model->first_name }}",
        "familyName": "{{ $model->last_name }}",
        "url": "{{ $app['config']['app.url'] }}",
        "image": "{{ $app['url']->asset($model->avatar) }}",
        "sameAs": [
            "https://www.github.com/{{ $model->username }}",
            "https://www.twitter.com/{{ $model->username }}",
            "https://www.youtube.com/{{ "@{$model->username}" }}"
        ]
    }
</script>
