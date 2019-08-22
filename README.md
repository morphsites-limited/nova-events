# Nova Events

An Events CMS for Laravel Nova.

## Installation

`composer require dewsign/nova-events`

Run the migrations:

```bash
php artisan migrate
```

## Templates

This package doesn't come with any pre-made templates. Simply replace the published `resources/view/vendor/nova-events/show.blade.php` view, or create new templates inside the `resources/view/vendor/nova-events/templates` folder. When more than one template exists, a select option will be displayed on within nova where you can select the template for the event.

## Configuration

### Customisation

If you want more control, you can specify which Nova Resources and Models to use. Because of the way nova reads the model from a static veriable, you **must** provide your own custom resource if you choose to use a custom model.

```php
// config/nova-events.php

'models' => [
    'event' => 'App\Event',
],
'resources' => [
    'event' => 'App\Nova\Event',
],
```

### Nova Resource Group

This will change the group name in the Nova admin sidebar.

```php
'group' => 'Events',
```

## Routing

All event routing is included under the `/events` slug.

## Factories & Seeders

This package comes with pre-made factories and seeders. Should you wish to use them in your application, simply call the seeder or use the factory provided.

```php
// database/seeds/DatabaseSeeder.php

public function run()
{
    $this->call(Dewsign\NovaEvents\Database\Seeds\EventSeeder::class)
}
```
