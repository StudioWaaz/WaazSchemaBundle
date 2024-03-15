## Installation

```
composer require waaz/schema-bundle

```

Add the following lines to base.html.twig

```
{% include "@WaazSchema/schema.html.twig" with {
    "schema": extension.schema|default([]),
    "localizations": localizations|default([]),
} %}

```
